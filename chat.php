<?php
require 'conn.inc';
session_start();
if (empty($_SESSION['username'])) {
    header("HTTP/1.1 303 See Other");
    header("Location: index.php");
    exit;
}
?>
<html>
<head>
    <title>Jun-McGrady聊天室</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="user-scalable=no"/>
    <script src="jquery-1.6.min.js"></script>
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css"/>
    <script>
        var uid = '<?php echo $_SESSION['uid'] ?>';
        $(function () {
            function bottom() {
                var div = document.getElementById("chatshow");
                div.scrollTop = div.scrollHeight;
            }

            $("#post").click(function () {
                postMsg();
            });
            $(document).keypress(function (e) {
                if (e.which == 13) {
                    e.preventDefault();
                    postMsg();
                }
            });
            function postMsg() {
                var content = $("#content").val();
                if (!$.trim(content)) {
                    alert('请填写内容');
                    return false;
                }
                $("#content").val("");
                $.post("ajax.php", {content: content});
            }

            $(".close").click(function () {
                if (confirm("您确定要关闭本页吗？")) {
                    $.post("logout.php", {"uid": uid}, function (data) {
                        var obj = JSON.parse(data);
                        if (obj.res == 0) {
                            window.location.reload();
                        } else if (obj.res == 1) {
                            alert(obj.msg);
                        }
                    });
                }
            });
            function getData(msg) {
                $.post("get.php", {"msg": msg}, function (data) {
                    if (data) {
                        var chatcontent = '';
                        var obj = JSON.parse(data);
                        $.each(obj, function (key, val) {
                            if (val['uid'] == uid) {
                                chatcontent += "<li class='right'>" + val['content'] + "</li>";
                            } else {
                                chatcontent += "<li class='left'>" + val['username'] + "：" + val['content'] + "</li>";
                            }
                        });
                        $("#chatshow").html(chatcontent);
                        bottom();
                    }
                    getData("");
                });
            }

            getData("one");

            $("#userlist p").click(function () {
                $("#content").val("@" + $(this).text() + " ");
            });
        });


    </script>
</head>
<body>
<div id="main">
    <div id="userlist">
        <h1>用户列表</h1>
        <div>
            <?php
            $sql = "select * from member where islogin = '1'";
            $res = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                echo '<p>' . $row['username'] . '</p>';
            }
            ?>
        </div>
    </div>
    <div class="message">
        <span class="close""></span>
        <ul class="chat-thread" id="chatshow">
        </ul>
        <div style="margin-top: 20px;">
            <textarea name="content" id="content"></textarea>
        </div>
        <span id="post">发布</span>
    </div>
</div>

</body>
</html>