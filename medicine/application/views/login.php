<div class="header2">
    <div>
        <img class="back" src="<?=base_url('html/images/icon/back.png')?>" alt=""/>
        <span class="back">返回</span>
    </div>
    登录
</div>
<div class="contain" style="min-height: 300px">
    <div class="headimg">
        <div>
            <div><img src="<?=base_url('html/images/icon/user.png')?>" alt=""/></div>
            <p>用户名</p>
        </div>
    </div>
    <form style="padding: 0 15px">
        <div class="inputModule">
            <div>
                <div>
                    <div>
                        <div class="user"></div>
                        <input id="phone" type="text" placeholder="请输入手机号"/>
                    </div>
                </div>
            </div>
            <p>111</p>
        </div>
        <div class="inputModule">
            <div>
                <div>
                    <div>
                        <div class="lock"></div>
                        <input id="userPwd" type="text" placeholder="请输入不少于6位字符的密码"/>
                    </div>
                </div>
            </div>
            <p>111</p>
        </div>
        <div class="button">
            <p onclick="doLogin()">登&nbsp;录</p>
        </div>
        <div class="doubleButton">
            <span style="color: red" onclick="window.location.href='<?=base_url('index.php/user/register')?>'">注册</span><span style="color: red" onclick="window.location.href='getpwd.html'">忘记密码</span>
        </div>
    </form>
</div>
<script>
    var actionType='<?=$type?>';
    var base_url='<?=base_url('index.php/user/doLogin')?>';
    function doLogin(){
        var userPwd=$("#userPwd").val();
        var phone=$("#phone").val();
        var sendJSON={};
        sendJSON.url_ajax=base_url;
        sendJSON.type_ajax='post';
        sendJSON.userPwd=userPwd;
        sendJSON.phone=phone;
        JK.ajax(sendJSON,function(data){
            alert(JSON.stringify(data));
            if(actionType==1){
//                跳转到评论
                window.location.href='<?=base_url('index.php/article/comment')?>/<?=$article_id?>';
            }
        })
    }
</script>