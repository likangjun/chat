<?php

require 'conn.inc';
session_start();
$result = mysqli_query($link, "update member set islogin = '0' where id = '{$_SESSION['uid']}'");
if ($result) {
    session_destroy();
    $data['res'] = 0;
    $data['msg'] = "退出成功";
} else {
    $data['res'] = 1;
    $data['msg'] = "退出失败";
}
exit(json_encode($data));
