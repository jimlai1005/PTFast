<?php
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

if(isset($_POST["submit"])) 
{
	if($_POST['tel_input']=='')
	{
		echo '<script>alert("請輸入手機號碼！");</script>';
	}
	else if($_POST['pw']=='')
	{
		echo '<script>alert("請輸入密碼！");</script>';
	}
	else // 都過關，存入Parse
	{
		
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
	document.getElementById("pw").value = "12345678";
}

</script>
</head>

















 



<body background="body-bg.jpg" style="background-attachment: fixed; color:#7e7a75; font-family: Arial, sans-serif; font-size: 18px; line-height: 1.5;">
<div id="box" style="width:90%; margin-left:10px; margin:0 auto;">

<div id="top" style="float:left; width:85%; text-align:left; "><p style="color:#FFFFFF; font-size:30px;">PTFast</p></div>

<div id="registerbox" style="float:left; width:80%; height:450px; background-color:#fff; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;">
<p>登入PTFast：</p>
  <table>

<form action="check.php" method="post">

    <tr>
     <td>  請輸入手機號碼：
<br>
      </td>
      <td>  <input type="text" name="tel_input" id="tel_input" size="20" placeholder="EX.0912345678"/><br>
        <!-- <input type="button"  onClick="test()"  value="測試用"> -->
      </td>
    </tr>
    <tr><td><p></p></td></tr>
  
    <tr>
     <td>  請輸入密碼：
<br>
      </td>
      <td>  <input type="password" name="pw" id="pw" size="20" placeholder="EX.********"/><br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
   
<br />
<tr>
     <td>
<br>
      </td>
      <td>  <input type="submit" name="submit" value="登入帳號">  
      <input type="button" onclick="window.location.assign('register.php');" value="註冊新會員">
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
