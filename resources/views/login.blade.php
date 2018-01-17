<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; maximum-scale=1.0;"/>
    <meta name="author" content="李章岭"/>
    <meta name="keywords" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ env('APP_NAME')}}</title>
    <link rel="stylesheet" href="/css/login.css">
    <script type="text/javascript" src="/lib/jquery-1.10.1.min.js"></script>
</head>
<body>
<div class="login-banner"></div>
<div class="login-box">
    <div class="box-con tran">
        <!-- 登录 -->
        <div class="login-con f-l">
            <div class="form-group">
                <input type="text" name="email" placeholder="邮箱" onblur="verify.verifyEmail(this)" id="login_email"/>
                <span class="error-notic">邮箱不正确</span>{{--/手机号码--}}
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="密码" id="login_password">
                <span class="error-notic">密码不正确</span>
            </div>
            <div class="form-group">
                <button type="submit" class="tran pr">
                    <a href="javascript:;" class="tran" id="login">登录</a>
                </button>
            </div>
            <div class="from-line"></div>
            <div class="form-group">
                <a href="javascript:;" class="move-signup a-tag tran blue-border">还没有帐号？免费注册<i class="iconfont tran">
                        &#xe606;</i></a>
            </div>
            <div class="form-group">
                <a href="javascript:;" class="move-reset a-tag tran">忘记密码？重置 <i class="iconfont tran">&#xe606;</i></a>
            </div>
            {{--<div class="form-group">
                <a href="javascript:;" class="move-other a-tag tran">使用第三方帐号登录<i class="iconfont tran">&#xe606;</i></a>
            </div>--}}
        </div>
        <!-- 邮箱注册 -->
        <div class="signup f-l">
            <div class="form-group">
                <div class="signup-form">
                    <input type="text" placeholder="邮箱" name="email" class="email-mobile" id="register_email"
                           onblur="verify.verifyEmail(this)">
                    {{--<a href="javascript:;" class="signup-select">手机注册</a>--}}
                </div>
                <span class="error-notic">邮箱格式不正确</span>
            </div>
            <div class="signup-email">
                <div class="form-group">
                    <input type="text" name="nick" id="register_nick" placeholder="您的昵称">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="register_password" placeholder="密码（字母、数字，至少6位）"
                           onblur="verify.PasswordLenght(this)">
                    <span class="error-notic">密码不符合规范</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="tran pr">
                        <a href="javascript:;" class="tran" id="register">注册</a>
                    </button>
                </div>
                <p class="view-clause">点击注册，即同意我们的 <a href="#">用户隐私条款</a></p>
            </div>
            <!-- 手机号注册 -->
            <div class="signup-tel" style="display:none">
                <div class="signup-form" id="message-inf" style="display:none">
                    <input type="text" placeholder="短信验证码" style="width:180px;" onblur="verify.VerifyCount(this)">
                    <a href="javascript:;" class="reacquire">重新获取（59）</a>
                    <span class="error-notic">验证码输入错误</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="tran get-message pr">
                        <a href="javascript:;" class="tran">获取短信验证码</a>
                        {{--<img class="loading" src="images/loading.gif">--}}
                    </button>
                </div>
            </div>
            <div class="from-line"></div>
            <div class="form-group">
                <a href="javascript:;" class="move-login a-tag tran blue-border">已有帐号？登录<i class="iconfont tran">
                        &#xe606;</i></a>
            </div>
            {{-- <div class="form-group">
                 <a href="javascript:;" class="move-other a-tag tran">使用第三方帐号登录<i class="iconfont tran">&#xe606;</i></a>
             </div>--}}
        </div>
        <!-- 第三方登录 -->
        {{--<div class="other-way f-l">
            <div class="form-group">
                <button type="submit" class="tran pr">
                    <a href="javascript:;" class="tran">QQ帐号登录</a>
                    <img class="loading" src="images/loading.gif">
                </button>
            </div>
            <div class="form-group">
                <button type="submit" class="tran pr">
                    <a href="javascript:;" class="tran">新浪微博帐号登录</a>
                    <img class="loading" src="images/loading.gif">
                </button>
            </div>
            <div class="form-group">
                <button type="submit" class="tran pr">
                    <a href="javascript:;" class="tran">微信帐号登录</a>
                    <img class="loading" src="images/loading.gif">
                </button>
            </div>
            <div class="form-group">
                <button type="submit" class="tran pr">
                    <a href="javascript:;" class="tran">网易帐号登录</a>
                    <img class="loading" src="images/loading.gif">
                </button>
            </div>
            <div class="from-line"></div>
            <div class="form-group">
                <a href="javascript:;" class="move-signup a-tag tran blue-border">还没有帐号？免费注册<i class="iconfont tran">
                        &#xe606;</i></a>
            </div>
            <div class="form-group">
                <a href="javascript:;" class="move-login a-tag tran">已有帐号？登录<i class="iconfont tran">&#xe606;</i></a>
            </div>
        </div>--}}
        <!-- 重置密码 -->
        <div class="mimachongzhi f-l">
            <div class="form-group">
                <input type="text" placeholder="请输入您的邮箱地址">
                <span class="error-notic">邮箱格式不正确</span>
            </div>
            <div class="form-group">
                <button type="submit" class="tran pr">
                    <a href="javascript:;" class="tran">发送重置密码邮件</a>
                    <img class="loading" src="images/loading.gif">
                </button>
            </div>
            <div class="from-line"></div>
            <div class="form-group">
                <a href="javascript:;" class="move-signup	a-tag tran blue-border">还没有帐号？免费注册<i class="iconfont tran">
                        &#xe606;</i></a>
            </div>
            <div class="form-group">
                <a href="javascript:;" class="move-login a-tag tran">已有帐号？登录<i class="iconfont tran">&#xe606;</i></a>
            </div>
        </div>
        <!-- 登录成功 -->
        <div class="mobile-success f-l">
            <p>手机号 <span>186****7580</span> 验证成功</p>

            <p>请完善您的账号信息，您也可以<a href="#">绑定现有账号</a></p>

            <div class="form-group">
                <input type="text" placeholder="邮箱" class="email-mobile" onblur="verify.verifyEmail(this)"/>
                <span class="error-notic">邮箱格式不正确</span>
            </div>
            <div class="form-group">
                <input type="text" placeholder="您的名字">
            </div>
            <div class="form-group">
                <input type="password" placeholder="密码（字母、数字，至少6位）" onblur="verify.PasswordLenght(this)"/>
                <span class="error-notic">密码不符合规范</span>
            </div>
            <div class="form-group">
                <button type="submit" class="tran pr">
                    <a href="javascript:;" class="tran">注册</a>
                    <img class="loading" src="images/loading.gif">
                </button>
            </div>
            <p class="view-clause">点击注册，即同意我们的 <a href="#">用户隐私条款</a></p>
        </div>
        <!-- 手机注册成功添补信息 -->
    </div>
</div>

<script>
    var _handle = '';//储存电话是否填写正确
    $(function () {
        $(".signup-form input").on("focus", function () {
            $(this).parent().addClass("border");
        });
        $(".signup-form input").on("blur", function () {
            $(this).parent().removeClass("border");
        })
        //注册方式切换
        $(".signup-select").on("click", function () {
            var _text = $(this).text();
            var $_input = $(this).prev();
            $_input.val('');
            if (_text == "手机注册") {
                $(".signup-tel").fadeIn(200);
                $(".signup-email").fadeOut(180);
                $(this).text("邮箱注册");
                $_input.attr("placeholder", "手机号码");
                $_input.attr("onblur", "verify.verifyMobile(this)");
                $(this).parents(".form-group").find(".error-notic").text("手机号码格式不正确")

            }
            if (_text == "邮箱注册") {
                $(".signup-tel").fadeOut(180);
                $(".signup-email").fadeIn(200);
                $(this).text("手机注册");
                $_input.attr("placeholder", "邮箱");
                $_input.attr("onblur", "verify.verifyEmail(this)");
                $(this).parents(".form-group").find(".error-notic").text("邮箱格式不正确")
            }
        });
        //步骤切换
        var _boxCon = $(".box-con");
        $(".move-login").on("click", function () {
            $(_boxCon).css({
                'marginLeft': 0
            })
        });
        $(".move-signup").on("click", function () {
            $(_boxCon).css({
                'marginLeft': -320
            })
        });
        $(".move-other").on("click", function () {
            $(_boxCon).css({
                'marginLeft': -640
            })
        });
        $(".move-reset").on("click", function () {
            $(_boxCon).css({
                'marginLeft': -960
            })
        });
        $("body").on("click", ".move-addinf", function () {
            $(_boxCon).css({
                'marginLeft': -1280
            })
        });

        //获取短信验证码
        var messageVerify = function () {
            $(".get-message").on("click", function () {
                if (_handle) {
                    $("#message-inf").fadeIn(100)
                    $(this).html('<a href="javascript:;">下一步</a><img class="loading" src="images/loading.gif">').addClass("move-addinf");
                }
            });
        }();
    });

    //表单验证
    function showNotic(_this) {
        $(_this).parents(".form-group").find(".error-notic").fadeIn(100);
    }//错误提示显示
    function hideNotic(_this) {
        $(_this).parents(".form-group").find(".error-notic").fadeOut(100);
    }//错误提示隐藏
    var verify = {//验证邮箱
        verifyEmail: function (_this) {
            var validateReg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var _value = $(_this).val();
            if (!validateReg.test(_value)) {
                showNotic(_this)
            } else {
                hideNotic(_this)
            }
        },//验证手机号码
        verifyMobile: function (_this) {
            var validateReg = /^((\+?86)|(\(\+86\)))?1\d{10}$/;
            var _value = $(_this).val();
            if (!validateReg.test(_value)) {
                showNotic(_this);
                _handle = false;
            } else {
                hideNotic(_this);
                _handle = true;
            }
            return _handle
        },//验证设置密码长度
        PasswordLenght: function (_this) {
            var _length = $(_this).val().length;
            if (_length < 6) {
                showNotic(_this)
            } else {
                hideNotic(_this)
            }
        },//验证验证码
        VerifyCount: function (_this) {
            var _count = "123456";
            var _value = $(_this).val();
            console.log(_value)
            if (_value != _count) {
                showNotic(_this)
            } else {
                hideNotic(_this)
            }
        }
    }

    $("#register").click(function () {
        var register_email = $("#register_email").val();
        var register_nick = $("#register_nick").val();
        var register_password = $("#register_password").val();

        var validateReg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!validateReg.test(register_email)) {
            showNotic($("#register_email"));
            return false;
        }

        if (!/^[a-z0-9_-]{5,18}$/.test(register_password)) {
            showNotic($("#register_password"));
            return false;
        }

        if (register_nick == '') {
            showNotic($("#register_nick"));
            return false;
        }

        $.ajax({
            url: '/login',
            type: 'post',
            dataType: 'json',
            data: {
                'email': register_email,
                'nick': register_nick,
                'password': register_password,
                '_token': '{{ csrf_token() }}',
                'type': 1,//1注册 0登录
            },
            success: function (data) {
                if (data.statusCode == 200) {
                    window.location.href = '{{ isset($redirect_url)?$redirect_url:'/' }}';
                } else if (data.statusCode == 200) {
                    alert('填写信息审核未通过');
                } else {
                    alert('账号已经存在');
                }
            }
        });
    });

    $("#login").click(function () {
        var login_email = $("#login_email").val();
        var login_password = $("#login_password").val();

        var validateReg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!validateReg.test(login_email)) {
            showNotic($("#login_email"));
            return false;
        }

        if (!/[a-z0-9_-]{5,18}/.test(login_password)) {
            showNotic($("#login_password"));
            return false;
        }

        $.ajax({
            url: '/login',
            type: 'post',
            dataType: 'json',
            data: {
                'email': login_email,
                'password': login_password,
                '_token': '{{ csrf_token() }}',
                'type': 0,//1注册 0登录
            },
            success: function (data) {
                if (data.statusCode == 200) {
                    window.location.href = '{{ isset($redirect_url)?$redirect_url:'/' }}';
                } else if (data.statusCode == 200) {
                    alert('填写信息审核未通过');
                } else {
                    alert('账号或密码错误');
                }
            }
        });
    });
</script>

</body>
</html>