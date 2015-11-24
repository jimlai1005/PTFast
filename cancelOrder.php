<?php
include('incsession.php');
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

parse_str($_SERVER['QUERY_STRING']); //已註冊 $postId 為Parse Server objectId


// 抓文章資料 start

$query4 = New ParseQuery("order");
$query4->equalTo("objectId", $postId);
$results3 = $query4->find();
$postmobile = $results3[0]->get('mobile');
$postprice = $results3[0]->get('price');


// 抓文章資料 end



// 文章刪除 start

$query = New ParseObject("order", $postId);
$query->set("isDelete", "1");
$query->save();

// 文章刪除 end




// 退回P幣 start

$query2 = new ParseQuery("client");
$query2->equalTo("mobile", $postmobile);
$results2 = $query2->find();

$parseObjectId = $results2[0]->getObjectId();
$postmoney = $results2[0]->get('money');

$postmoney = $postmoney + $postprice;
$moneyInString = "$postmoney";

$query3 = New ParseObject("client", $parseObjectId);
$query3->set("money", $moneyInString);
$query3->save();

// 退回P幣 end

echo "<script>alert('本文已刪除，Ｐ幣已退回您的帳戶中！');window.location.replace('main.php');</script>";

?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
</head>