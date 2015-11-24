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
$postposter = $results[0]->get('poster');
$postrecipient = $results[0]->get('mobile');
$postIsDelete = $results[0]->get('isDelete');
$parseprice = $results[0]->get("price");

// 抓文章資料 end


// 0新文章 1取消文章 2進行中 3完成
if($postIsDelete=="2") //文章狀態與server認證，避免被外部干擾款項轉移。
{

// 文章結案 start

	$query2= New ParseObject("order", $postId);
	$query2->set("isDelete", "3");
	$query2->set("poster", $postmobile);
	$query2->save();

// 文章結案 end

// 新增發文者站內信 start

    $mailTitle = "您的訂單已經完成，標題：$posttitle";
    $mailContent = "您的訂單已經完成，非常感謝您的使用。<br /><br /><br />PTFast營運團隊 <br /> 標題：$posttitle <br /> 內容：$postcontent <br /> 運費：$parseprice 元<br /> ";
    $Object2 = New ParseObject("mailbox");
    $Object2->set("mobile", $postrecipient);
    $Object2->set("title", $mailTitle);
    $Object2->set("content", $mailContent);
    $Object2->set("isDelete", "0");
    $Object2->save();

// 新增發文者站內信 end

// 新增接單者站內信 start

    $mailTitle = "您的訂單已經完成，標題：$posttitle";
    $mailContent = "您的訂單已經完成，運費$parseprice 元，已經轉入您的帳戶中，非常感謝您的使用。<br /><br /><br />PTFast營運團隊 <br /> 標題：$posttitle <br /> 內容：$postcontent <br /> 運費：$parseprice 元<br /> ";
    $Object3 = New ParseObject("mailbox");
    $Object3->set("mobile", $postposter);
    $Object3->set("title", $mailTitle);
    $Object3->set("content", $mailContent);
    $Object3->set("isDelete", "0");
    $Object3->save();

// 新增接單者站內信 end

// 轉移P幣 start

	$query3 = new ParseQuery("client");
	$query3->equalTo("mobile", $postposter);
	$results2 = $query3->find();

	$parseObjectId = $results2[0]->getObjectId();
	$postmoney = $results2[0]->get('money');

	$postmoney = $postmoney + $parseprice;
	$moneyInString = "$postmoney";

	$query4 = New ParseObject("client", $parseObjectId);
	$query4->set("money", $moneyInString);
	$query4->save();

// 轉移P幣 end

	echo "<script>alert('運費已經成功地轉入運送專員的帳戶中！');window.location.replace('main.php');</script>";

}
else
{
	echo "<script>alert('轉移失敗！如有問題，請聯絡PTFast，將有專人為您服務。');window.location.replace('http://ptfast.weebly.com/24847352112145325033.html');</script>";
}

?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
</head>