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

