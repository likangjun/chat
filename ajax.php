<?php
session_start();
require 'conn.inc';
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
