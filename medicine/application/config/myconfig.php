<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//微信渠道号
$config['chnl_no_weixin'] = '450003';
//全民付渠道号
$config['chnl_no_qmf'] = '03';

//签名地址
$config['api_sign_url'] = 'http://144.131.254.51:15311/mgtserv/hsm/fun010';
//验签地址
$config['api_verify_url'] = 'http://144.131.254.51:15311/mgtserv/hsm/fun011';
//获取卡bin接口地址
$config['api_get_card_bin_url'] = 'http://144.131.254.51:15311/mgtserv/hsm/fun009';
//用户于活动可否领券状态接口
$config['api_chk_coupon_status_url'] = 'http://144.131.254.51:15511/onlinetx-mkt/api/106027';
//SP领券地址
$config['api_get_coupon_url'] = 'http://144.131.254.51:15411/spservice/coupon/usercoupon';
//短信发送地址
$config['api_sms_url'] = 'http://144.131.254.51:15211/smsboss/sms/sms01';
//获取AccessToken
$config['api_get_access_token_url'] = 'http://wtest.happyums.com/wechat-site/index.php/GetToken';
//领券通知接口
$config['api_send_coupons_msg_url'] = 'http://wtest.happyums.com/wechat-site/index.php/Template/sendMsg';

//获取用户经纬度
$config['api_get_user_location_url'] = '';

//微信appId
$config['wx_app_id'] = 'wx5cb0427850cd8c49';
//'wxb9ccd0aaec6b5e90';//'wxb5beab6ae82a7aea';//wx5cb0427850cd8c49

//微信appSecret
$config['wx_app_secret'] = '47eb70c0feda7c287b5429cc2b783f53';
//'a4bf05f849aa0363be05944299aff750';//'05e973a7af9483e2cbef15ff08dca71a';//47eb70c0feda7c287b5429cc2b783f53 

//静态资源地址
$config['static_url'] = 'http://ci.study2.com/statics/';
//sendCode
$config['sendCode']='0000';