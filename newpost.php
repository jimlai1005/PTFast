<?php
include('incsession.php');
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

$guid = $_COOKIE['session_Mobile'];
$query2 = new ParseQuery("client");
$query2->equalTo("mobile", $guid);
$results2 = $query2->find();

$postname = $results2[0]->get('name');
$postmobile = $results2[0]->get('mobile');
$postmoney = $results2[0]->get('money');
$postemail = $results2[0]->get('email');

if(isset($_POST["submit"])) 
{
	if($_POST['title_input']=='')
	{
		echo '<script>alert("請輸入標題！");</script>';
	}
	else if($_POST['content_input']=='')
	{
		echo '<script>alert("請輸入內容！");</script>';
	}
	else if($_POST['price_input']=='')
	{
		echo '<script>alert("請輸入運費！");</script>';
	}
	else if($_POST['price_input']>$postmoney)
	{
		echo '<script>alert("您的P幣不足！");</script>';
	}
	else // 都過關，存入Parse
	{

//發文完成 start

		$posttitle = $_POST['title_input'];
		$postcontent = $_POST['content_input'];
		$postprice = $_POST['price_input'];

		$Object = New ParseObject("order");
		$Object->set("title", $posttitle);
		$Object->set("content", $postcontent);
		$Object->set("price", $postprice);
		$Object->set("mobile", $postmobile);
    $Object->set("author", $postname);
    $Object->set("isDelete", "0"); // 0新文章 1取消文章 2進行中
		$Object->save();

//發文完成 end

// 修改金錢 start

    $parseObjectId = $results2[0]->getObjectId();
    $postmoney = $postmoney - $postprice;
    $moneyInString = "$postmoney";

    $query3 = New ParseObject("client", $parseObjectId);
    $query3->set("money", $moneyInString);
    $query3->save();

// 修改金錢 end

		echo "<script>window.location.assign('main.php');</script>";

		}
	}
?>
<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
<script>

function test()
{
	document.getElementById("title_input").value = "我要吃便當";
	document.getElementById("content_input").value = "請送便當到我家樓下，伯由路跟大馬路的交叉口";
  document.getElementById("price_input").value = "30";

}

</script>
</head>

















 



<body background="body-bg.jpg" style="background-attachment: fixed; color:#7e7a75; font-family: Arial, sans-serif; font-size: 18px; line-height: 1.5;">
<div id="box" style="width:90%; margin-left:10px; margin:0 auto;">

<div id="top" style="float:left; width:85%; text-align:left; "><p style="color:#FFFFFF; font-size:30px;">PTFast</p></div>

<div id="registerbox" style="float:left; width:80%; height:850px; background-color:#fff; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;">

<p>
<input type="button" value="發新文章" onclick="window.location.assign('newpost.php');" />
<input type="button" value="文章列表" onclick="window.location.assign('main.php');" />
<input type="button" value="個人信箱" onclick="window.location.assign('mailbox.php');" />
<input type="button" value="個人資料" onclick="window.location.assign('profile.php');" />
<input type="button" value="登出帳號" onclick="window.location.assign('logout.php');" />
</p>

<p>新增文章：</p>
  <table>

<form action="" method="post">

  <tr>
      <td>  
  <br>
      </td>
      <td>標題：
          <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
            
    <tr>
     <td>  
<br>
      </td>
      <td>  <input type="text" name="title_input" id="title_input" size="30" placeholder="EX.我是標題"/>
        <!-- <input type="button"  onClick="test()"  value="測試用"> -->

      <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
    
    <tr>
      <td>  
  <br>
      </td>
      <td>內容：
          <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>

    <tr>
     <td>  
<br>
      </td>
      <td>  <textarea name="content_input" id="content_input" rows="15" cols="30" placeholder="EX.我是內容"></textarea>
      <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
  
  <tr>
      <td>  
  <br>
      </td>
      <td>您目前擁有 <?php echo $postmoney; ?> P幣
          <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>

  <tr>
      <td>  
  <br>
      </td>
      <td>運費：
          <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>

    <tr>
     <td>  
<br>
      </td>
      <td>  <input type="text" name="price_input" id="price_input" size="15" placeholder="EX.100"/> P幣
      <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>

<br />
<tr>
     <td>
<br>
      </td>
      <td>  <input type="submit" name="submit" value="貼文">  <input type="button" onclick="window.location.replace('main.php');" value="取消">
      </td>
    </tr>
    <tr><td><p></p></td></tr>
    
            <tr><td><p></p></td></tr>
  </form>

  </table>
  
  </div>

<div class="blank" style="float:left; width:80%; height:20px; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;"><p></p></div>
</body>
</html>
