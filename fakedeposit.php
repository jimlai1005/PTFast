<?php
include('incsession.php');
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

parse_str($_SERVER['QUERY_STRING']); //已註冊 $money $method 為Parse Server objectId

$guid = $_COOKIE['session_Mobile'];

// 修改金錢 start

	$query = new ParseQuery("client");
	$query->equalTo("mobile", $guid);
	$results = $query->find();
    $parseObjectId = $results[0]->getObjectId();
    $postmoney = $results[0]->get('money');
    $postIsDeposit = $results[0]->get('deposit');

	if($money=="50")
	{
		$postprice = 55;
	}
	else if($money=="100")
	{
		$postprice = 130;
	}
	else if($money=="500")
	{
		$postprice = 750;
	}
	else if($money=="1000")
	{
		$postprice = 1800;
	}
	else if($money=="1500")
	{
		$postprice = 3000;
	}

    $postmoney = $postmoney + $postprice;
    $moneyInString = "$postmoney";

    $query2 = New ParseObject("client", $parseObjectId);
    $query2->set("money", $moneyInString);
    $query2->set("deposit", "1");
    $query2->save();

// 修改金錢 end


// 儲值測試 start

if(!$postIsDeposit)
{

	if($method=="0") // 0信用卡付款 1ATM付款 2超商付款 3支付寶付款
	{
		$methodString = "信用卡付款";
	}
	else if($method=="1") // 0信用卡付款 1ATM付款 2超商付款 3支付寶付款
	{
		$methodString = "ATM付款";
	}
	else if($method=="2") // 0信用卡付款 1ATM付款 2超商付款 3支付寶付款
	{
		$methodString = "超商付款";
	}
	else if($method=="3") // 0信用卡付款 1ATM付款 2超商付款 3支付寶付款
	{
		$methodString = "支付寶付款";
	}

    $Object = New ParseObject("deposit");
   	$Object->set("money", $money);
    $Object->set("method", $methodString);
    $Object->save();

}

// 儲值測試 end


echo "<script>window.location.replace('profile.php');</script>";

?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
</head>