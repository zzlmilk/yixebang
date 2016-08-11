<?php
class MsgModel{
    /**
     * 智能匹配模版接口发短信
     * apikey 为云片分配的apikey
     * text 为短信内容
     * mobile 为接受短信的手机号
     */
    public static $sendCode;
    function getCode(){
        return self::$sendCode;
    }
    function send_sms($mobile)
    {
        self::$sendCode = $this->generate_code();
        $apikey = "8ba4b33d39596c850fdde840ba4e3019";
        $url = "http://yunpian.com/v1/sms/send.json";
        $text = "【云片网】您的验证码是" . self::$sendCode;
        $encoded_text = urlencode($text);
        $post_string = "apikey=" . $apikey . "&text=" . $encoded_text . "&mobile=15618555637";
        return $this->sock_post($url, $post_string);
    }

    /**
     * url 为服务的url地址
     * query 为请求串
     */
    function sock_post($url, $query)
    {
        $data = "";
        $info = parse_url($url);
        $fp = fsockopen($info["host"], 80, $errno, $errstr, 30);
        if (!$fp) {
            return $data;
        }
        $head = "POST " . $info['path'] . " HTTP/1.0\r\n";
        $head .= "Host: " . $info['host'] . "\r\n";
        $head .= "Referer: http://" . $info['host'] . $info['path'] . "\r\n";
        $head .= "Content-type: application/x-www-form-urlencoded\r\n";
        $head .= "Content-Length: " . strlen(trim($query)) . "\r\n";
        $head .= "\r\n";
        $head .= trim($query);
        $write = fputs($fp, $head);
        $header = "";
        while ($str = trim(fgets($fp, 4096))) {
            $header .= $str;
        }
        while (!feof($fp)) {
            $data .= fgets($fp, 4096);
        }
        return $data;
    }

    /*随机生成验证码*/
    function generate_code($length = 6)
    {
        return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }

}
?>