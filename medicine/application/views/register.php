<div class="header2">
    <div>
        <img class="back" src="<?=base_url('html/images/icon/back.png')?>" alt=""/>
        <span class="back">返回</span>
    </div>
    注册
</div>
<div class="contain" style="min-height: 300px;padding-bottom: 30px">
    <div class="doubleHeadimg">
        <p>选择角色</p>
        <div style="margin-right:25px">
            <div><img src="<?=base_url('html/images/doctor.png')?>" alt=""/></div>
            <p>医生</p>
        </div>
        <div>
            <div><img src="<?=base_url('html/images/patient.png')?>" alt=""/></div>
            <p>患者</p>
        </div>
    </div>
    <form style="padding: 0 15px">
        <div class="inputModule">
            <div>
                <div>
                    <div>
                        <div class="user"></div>
                        <input id="nickname" type="text" placeholder="请输入用户名"/>
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
        <div div class="inputModule">
            <div>
                <div>
                    <div>
                        <div class="mobile"></div>
                        <input id="phone" type="text" placeholder="请输入手机号"/>
                    </div>
                </div>
            </div>
            <p>111</p>
        </div>
        <div div class="inputModule">
            <div>
                <div>
                    <div>
                        <div class="verification"></div>
                        <input id="keyCode" type="text" placeholder="请输入验证码"/>
                    </div>
                </div>
                <div onclick="sendCode()">获取验证码</div>
            </div>
            <p>111</p>
        </div>
        <div div class="inputModule">
            <div>
                <div>
                    <div>
                        <div class="email"></div>
                        <input id="email" type="text" placeholder="请输入邮箱"/>
                    </div>
                </div>
            </div>
            <p>111</p>
        </div>
        <div class="button">
            <p onclick="doRegister()">注册</p>
        </div>
        <div class="doubleButton">
            <span><i class="check"></i>同意《医学帮》协议</span><span style="color: red" onclick="window.location.href='<?=base_url('index.php/user/login')?>'">登录</span>
        </div>
    </form>
</div>
<script>
    function sendCode(){
        var phone=$("#phone").val();
        var sendJSON={};
        sendJSON.url_ajax='../user/sendCode';
        sendJSON.type_ajax='post';
        sendJSON.phone=phone;
        JK.ajax(sendJSON,function(data){
            alert(JSON.stringify(data));
        })
    }
    function doRegister(){
        var nickname=$("#nickname").val();
        var userPwd=$("#userPwd").val();
        var phone=$("#phone").val();
        var keyCode=$("#keyCode").val();
        var email=$("#email").val();
        var sendJSON={};
        sendJSON.url_ajax='../user/doRegister';
        sendJSON.type_ajax='post';
        sendJSON.nickname=nickname;
        sendJSON.userPwd=userPwd;
        sendJSON.phone=phone;
        sendJSON.keyCode=keyCode;
        sendJSON.email=email;
        JK.ajax(sendJSON,function(data){
            alert(JSON.stringify(data));
        })
    }
</script>