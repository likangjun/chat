<?php

session_start();
if (!empty($_SESSION['username'])) {
    header("HTTP/1.1 303 See Other");
    header("Location: chat.php");
    exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>聊天室登录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <script src="jquery-1.6.min.js"></script>
    <script>
        function trim(str) { //删除左右两端的空格
            return str.replace(/(^\s*)|(\s*$)/g, "");
        }
        function login() {
            var name = trim($("input[name='name']").val());
            var pwd = trim($("input[name='pwd']").val());
            if (name == '') {
                alert("请填写用户名");
                return;
            }
            if (pwd == '') {
                alert("请填写密码");
                return;
            }
            $.post("login.php", {"name": name, "pwd": pwd}, function (data) {
                var obj = JSON.parse(data);
                if (obj.res == 0) {
                    window.location.href = "chat.php";
                } else if (obj.res == 1) {
                    alert(obj.msg);
                }
            });
        }
        $(function () {
            $("#button").click(function () {
                login();
            });
            $("#register").click(function () {
                login();
            });
        });
    </script>
</head>
<body>
<div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo" style="margin: 30px 10px">
            <img src="image/logo.jpg"/>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="用户名" name="name"/>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="密码" name="pwd"/>
        </div>
        <div class="row">
            <input type="button" class="btn btn-primary btn-block btn-flat" id="button" value="登录"/>
            <input type="button" style="margin-right: 10px;" class="btn btn-primary btn-block btn-flat" id="register"
                   value="注册"/>
        </div>

    </div>
</div>
<div class="common_footer">
    Powered by likangjun.com | Copyright © All rights reserved.
</div>

</body>
</html>