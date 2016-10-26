<?php

set_time_limit(0);

$filename = "log/" . date("Ymd", time()) . ".txt";
if (file_exists($filename)) {
    $content = file_get_contents($filename);
    $data = json_decode($content, true);
    $count = count($data);
    if ($_POST['msg'] == "one") {
        exit(json_encode($data));
    }
    while (true) {
        $contents = file_get_contents($filename);
        $datas = json_decode($contents, true);
        $counts = count($datas);
        if ($counts > $count) {
            echo json_encode($datas);
            break;
        }
        usleep(300);
    }
} else {
    $file = fopen($filename, "w");
    $con['username'] = "系统消息";
    $con['content'] = "欢迎来到Jun-McGrady聊天室";
    $data[] = $con;
    fwrite($file, json_encode($data));
    fclose($file);
    exit(json_encode($data));
}

/****数据库方式
require 'conn.inc';

if ($_POST['msg'] == "one") {
    $data = getContent($link);
    if ($data == "[]") {
        $con[] = array(
            'username' => "系统消息",
            'content' => "欢迎来到Jun-McGrady聊天室"
        );
        $data = json_encode($con);
    }
    exit($data);
}

$old = getData($link);

while (true) {
    $new = getData($link);
    if ($new > $old) {
        $newdata = getContent($link);
        echo $newdata;
        break;
    }
    usleep(1000);
}

function getContent($link)
{
    $csql = "SELECT c.*,u.username FROM talkroom c LEFT JOIN member u ON c.uid = u.id ORDER BY c.id ASC";
    $cres = mysqli_query($link, $csql);
    $data[] = array(
        'username' => "系统消息",
        'content' => "欢迎来到Jun-McGrady聊天室"
    );
    while ($row = mysqli_fetch_assoc($cres)) {
        $data[] = array(
            'username' => $row['username'],
            'content' => $row['content'],
            'uid' => $row['uid']
        );
    }
    return json_encode($data);
}

function getData($link)
{
    $sql = "SELECT count(*) FROM talkroom";
    $res = mysqli_query($link, $sql);
    $count = mysqli_fetch_row($res);
    return $count[0];
}
****/