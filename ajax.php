<?php

session_start();
if (isset($_POST['content'])) {
    $filename = "log/" . date("Ymd", time()) . ".txt";
    $con = array(
        'username' => $_SESSION["username"],
        'uid' => $_SESSION["uid"],
        'content' => $_POST["content"]
    );
    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        $data = json_decode($content, true);
    }
    $file = fopen($filename, "w");
    $data[] = $con;
    fwrite($file, json_encode($data));
    fclose($file);
}


/****数据库方式
require 'conn.inc';
session_start();
if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $sql = "INSERT INTO talkroom (content,uid) VALUES ('{$content}','{$_SESSION['uid']}');";
    $res = mysqli_query($link, $sql);
}
*****/
