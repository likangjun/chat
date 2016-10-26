<?php

error_reporting('E_ALL ~& E_NOTICE');
$host = ""; //主机名
$root = ""; //用户名
$pwd = ""; //密码
$dbname = ""; //要连接的数据库名
//如果连接失败，显示错误
$link = mysqli_connect($host, $root, $pwd) or die("Could not connect: " . mysqli_error($link));
//如果选择数据库失败，显示错误
mysqli_select_db($link, $dbname) or die('Can\'t use mygbook : ' . mysqli_error($link));
//设置编码
mysqli_query($link, "SET NAMES 'utf8'");
mysqli_query($link, "SET CHARACTER_SET_CLIENT=utf8");
mysqli_query($link, "SET CHARACTER_SET_RESULTS=utf8");