<?php
include('incsession.php');
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

parse_str($_SERVER['QUERY_STRING']); //已註冊 $postId 為Parse Server objectId

$guid = $_COOKIE['session_Mobile'];

// 抓文章資料 start

$query = new ParseQuery("order");
$query->equalTo("objectId", $postId);
$results = $query->find();

$posttitle = $results[0]->get('title');
$postcontent = $results[0]->get('content');
$postmobile = $results[0]->get('mobile');
$postname = $results[0]->get('author');
$parseprice = $results[0]->get("price");
$parsetime = $results[0]->getCreatedAt();
$taipeiTimeZone = new DateTimeZone('Asia/Taipei');
$parsetime->setTimezone($taipeiTimeZone);
$parsetime = $parsetime->format('Y/m/d H:i:s');

// 抓文章資料 end



// 文章進行中 start

$query2= New ParseObject("order", $postId);
$query2->set("isDelete", "2");
$query2->set("poster", $guid);
$query2->save();

// 文章進行中 end



// 新增發文者站內信 start
    $mailURL = '<a href= $URLString >我是傳送門！</a>';
    $mailTitle = "您的訂單正在進行中，標題：$posttitle";
    $mailContent = "運送專員聯絡方式：$guid <br /> 前往結帳：<a href= 'payment.php?postId=$postId ' >我是傳送門！</a> <br /> 標題：$posttitle <br /> 內容：$postcontent <br /> 運費：$parseprice 元<br /> ";
    $Object2 = New ParseObject("mailbox");
    $Object2->set("mobile", $postmobile);
    $Object2->set("title", $mailTitle);
    $Object2->set("content", $mailContent);
    $Object2->set("isDelete", "0");
    $Object2->save();

// 新增發文者站內信 end

// 新增接單者站內信 start

    $mailTitle = "您已經接受訂單，標題：$posttitle";
    $mailContent = "用戶姓名：$postname <br /> 聯絡方式：$postmobile <br /> 標題：$posttitle <br /> 內容：$postcontent <br /> 運費：$parseprice 元<br /> ";
    $Object3 = New ParseObject("mailbox");
    $Object3->set("mobile", $guid);
    $Object3->set("title", $mailTitle);
    $Object3->set("content", $mailContent);
    $Object3->set("isDelete", "0");
    $Object3->save();

// 新增接單者站內信 end


echo "<script>alert('您已接受訂單！');window.location.replace('main.php');</script>";

?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
</head>