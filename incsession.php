<?php
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

// Check for a cookie, if none go to login page
if (!isset($_COOKIE['session_Mobile']))
{
      echo "<script>alert('登入逾時！');window.location.replace('login.php');</script>";
}

// Try to find a match in the database
$guid = $_COOKIE['session_Mobile'];

$query = new ParseQuery("client");
$query->equalTo("mobile", $guid);
$results = $query->find();
if(count($results)==0)
	
{
    // No match for guid
      echo "<script>alert('無此帳號！');window.location.replace('login.php');</script>";
}
?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
</head>