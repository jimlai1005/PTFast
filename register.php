<?php
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

if(isset($_POST["submit"])) 
{
	if($_POST['name_input2']=='')
	{
		echo '<script>alert("請輸入姓名！");</script>';
	}
	else if($_POST['tel_input']=='')
	{
		echo '<script>alert("請輸入手機！");</script>';
	}
	else if($_POST['email_input']=='')
	{
		echo '<script>alert("請輸入E-mail！");</script>';
	}
	else if($_POST['pw']=='')
	{
		echo '<script>alert("請輸入密碼！");</script>';
	}
	else if($_POST['pwConfirm']==''||$_POST['pwConfirm']!=$_POST['pw'])
	{
		echo '<script>alert("密碼不符！");</script>';
	}
	else // 都過關，存入Parse
	{

		$postname = $_POST['name_input2'];
		$postmobile = $_POST['tel_input'];
		$postpassword = $_POST['pw'];
		$postemail = $_POST['email_input'];

// 新增成員
		$Object = New ParseObject("client");
		$Object->set("name", $postname);
		$Object->set("mobile", $postmobile);
		$Object->set("password", $postpassword);
		$Object->set("email", $postemail);
    $Object->set("money", "100");
    $Object->set("deposit", "0");
		$Object->save();

// 新增站內信 start

    $mailTitle = "歡迎加入PTFast";
    $mailContent = "歡迎加入您加入PTFast，PTFast是一個可以媒合外送方與被外送方的服務平台，守護消費安全、提供透明價格、保證快速便利，祝您使用愉快。<br /><br /><br />PTFast營運團隊";

    $Object2 = New ParseObject("mailbox");
    $Object2->set("mobile", $postmobile);
    $Object2->set("title", $mailTitle);
    $Object2->set("content", $mailContent);
    $Object2->set("isDelete", "0");
    $Object2->save();

// 新增站內信 end

  //加入cookie
    $cookieexpiry = (time() + 2600000);
    setcookie("session_Mobile", $postmobile, $cookieexpiry);

		echo "<script>alert('註冊成功！');window.location.replace('main.php');</script>";

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
	document.getElementById("tel_input").value = "0912345678";
	document.getElementById("name_input2").value = "王小明";
	document.getElementById("pw").value = "12345678";
	document.getElementById("pwConfirm").value = "12345678";
	document.getElementById("email_input").value = "abc123@gmail.com";

}

</script>
</head>

















 



<body background="body-bg.jpg" style="background-attachment: fixed; color:#7e7a75; font-family: Arial, sans-serif; font-size: 18px; line-height: 1.5;">
<div id="box" style="width:90%; margin-left:10px; margin:0 auto;">

<div id="top" style="float:left; width:85%; text-align:left; "><p style="color:#FFFFFF; font-size:30px;">PTFast</p></div>

<div id="registerbox" style="float:left; width:80%; height:450px; background-color:#fff; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;">
<p>註冊加入PTFast：</p>
  <table>

<form action="" method="post">

  <tr>
      <td>姓名：
  <br>
      </td>
      <td><input type="text" name="name_input2" id="name_input2" size="20" placeholder="EX.王小明"/>		
        <!-- <input type="button"  onClick="test()"  value="測試用"> -->
          <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
            
    <tr>
     <td>  手機：
<br>
      </td>
      <td>  <input type="text" name="tel_input" id="tel_input" size="20" placeholder="EX.0912345678"/><br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
    
    <tr>
     <td>  E-mail：
<br>
      </td>
      <td>  <input type="text" name="email_input" id="email_input" size="20" placeholder="EX.abc123@gmail.com"/><br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
  
    <tr>
     <td>  密碼：
<br>
      </td>
      <td>  <input type="password" name="pw" id="pw" size="20" placeholder="EX.********"/><br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
    
    <tr>
     <td>  確認密碼：
<br>
      </td>
      <td>  <input type="password" name="pwConfirm" id="pwConfirm" size="20" placeholder="EX.********"/><br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
<br />
<tr>
     <td>
<br>
      </td>
      <td>  <input type="submit" name="submit" value="註冊">
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
