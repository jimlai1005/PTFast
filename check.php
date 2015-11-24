<?php
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

	$postmobile = $_POST['tel_input'];
	$postpassword = $_POST['pw'];

    $query = new ParseQuery("client");
    $query->equalTo("mobile", $postmobile);
    $query->equalTo("password", $postpassword);

    $results = $query->find();



    if(count($results)!=0)
    {
    	$postname = $results[0]->get('name');
    	$postmoney = $results[0]->get('money');

		//加入cookie
		  $cookieexpiry = (time() + 2600000);
      setcookie("session_Mobile", $postmobile, $cookieexpiry);

    // 設定 session 變數之初值
      $_SESSION["userMobile"] = $postmobile;

      echo "<script>window.location.replace('main.php');</script>";
    }
    else
    {
      echo "<script>alert('登入失敗，密碼錯誤！');window.location.replace('login.php');</script>";
    }
?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
</head>