<?php
include('incsession.php');
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

$guid = $_COOKIE['session_Mobile'];
$query2 = new ParseQuery("mailbox");
$query2->equalTo("mobile", $guid);

$query2->ascending("createdAt");

$results2 = $query2->find();

$heightValue = 350 + (count($results2)*90);

$all_text='<table width="80%" border="1"><tr><th scope="col">編號</th><th scope="col">日期</th><th scope="col">標題</th><th scope="col">刪除</th></tr>';

$IsDeleteCounter = 0;

// 為了處理刪除後文章的編號更新問題，所以比較複雜 start 

for ($i = count($results2); $i>0; $i--) 
{
  $parseIsDelete = $results2[$i-1]->get("isDelete"); // 0新文章 1取消文章

  if($parseIsDelete==0) // 0新文章 1取消文章
  {
    $IsDeleteCounter = $IsDeleteCounter + 1;
  }

}
for ($i = count($results2); $i>0; $i--) 
{

  $parseObjectId = $results2[$i-1]->getObjectId();
  $parsetime = $results2[$i-1]->getCreatedAt();
  $taipeiTimeZone = new DateTimeZone('Asia/Taipei');
  $parsetime->setTimezone($taipeiTimeZone);
  $parsetime = $parsetime->format('m/d');
  $parseTitle = $results2[$i-1]->get("title");
  $parseIsDelete = $results2[$i-1]->get("isDelete"); // 0新文章 1取消文章

  if($parseIsDelete==0) // 0新文章 1取消文章
  {
    $all_text = "<tr>$all_text
    <td align='center'>$IsDeleteCounter</td>
    <td align='center'>$parsetime</td>
    <td align='center'><a href='maildetail.php?postId=$parseObjectId'>$parseTitle</a></td>
    <td align='center'><a href='deletemail.php?postId=$parseObjectId'>刪除</a></td>  
    </tr>";
  }
  $IsDeleteCounter = $IsDeleteCounter - 1 ;
}

// 為了處理刪除後文章的編號更新問題，所以比較複雜 end

  $all_text = "$all_text</table>";

?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
<script>
window.onload = function ()
{
        document.getElementById("registerbox").style.height = <?php echo $heightValue; ?> + "px";
};  
</script>
</head>

















 



<body background="body-bg.jpg" style="background-attachment: fixed; color:#7e7a75; font-family: Arial, sans-serif; font-size: 18px; line-height: 1.5;">
<div id="box" style="width:90%; margin-left:10px; margin:0 auto;">

<div id="top" style="float:left; width:85%; text-align:left; "><p style="color:#FFFFFF; font-size:30px;">PTFast</p></div>

<div id="registerbox" style="float:left; width:80%; height:730px; background-color:#fff; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;">

<p>
<input type="button" value="發新文章" onclick="window.location.assign('newpost.php');" />
<input type="button" value="文章列表" onclick="window.location.assign('main.php');" />
<input type="button" value="個人信箱" onclick="window.location.assign('mailbox.php');" />
<input type="button" value="個人資料" onclick="window.location.assign('profile.php');" />
<input type="button" value="登出帳號" onclick="window.location.assign('logout.php');" />
</p>

<p>個人信箱：</p>

 <?php echo $all_text; ?>
 
  </div>

<div class="blank" style="float:left; width:80%; height:20px; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;"><p></p></div>
</body>
</html>
