<?php
include('incsession.php');
require 'vendor/autoload.php'; 
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseClient::initialize('OLEbxaLakkb6SVn5t7Qzbewdyy70LSwHp6PQYilb', '6DOD3bArSx2LgNCuE67GDVDPfi9HAKGmkrKLajL1', 'IVNd1TnoknddgQ2F2qCZf7FUPbBWLe21rz2rP1LN');
date_default_timezone_set('Asia/Taipei');

$guid = $_COOKIE['session_Mobile'];
$query = new ParseQuery("client");
$query->equalTo("mobile", $guid);
$results = $query->find();

$postname = $results[0]->get('name');
$postmobile = $results[0]->get('mobile');
$postmoney = $results[0]->get('money');
$postemail = $results[0]->get('email');

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

<p>
<input type="button" value="發新文章" onclick="window.location.assign('newpost.php');" />
<input type="button" value="文章列表" onclick="window.location.assign('main.php');" />
<input type="button" value="個人信箱" onclick="window.location.assign('mailbox.php');" />
<input type="button" value="個人資料" onclick="window.location.assign('profile.php');" />
<input type="button" value="登出帳號" onclick="window.location.assign('logout.php');" />
</p>

<p>會員資料：</p>
  <table>
  <tr>
      <td>姓名：
  <br>
      </td>
      <td>	<?php echo $postname; ?>
          <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
            
    <tr>
     <td>  手機號碼：
<br>
      </td>
      <td>  <?php echo $postmobile; ?>
      <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
    
    <tr>
     <td>  E-mail：
<br>
      </td>
      <td>  <?php echo $postemail; ?>
      <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
  
    <tr>
     <td>  P幣：
<br>
      </td>
      <td>  <?php echo $postmoney; ?> 元 <input type="button" name="moreMoney" value="儲值更多" onclick="window.location.assign('deposit.php');">
      <br>
      </td>
    </tr>
    <tr><td><p></p></td></tr>
    
<br />
<tr>
     <td>
<br>
      </td>
      <td>  
      </td>
    </tr>
    <tr><td><p></p></td></tr>
    
            <tr><td><p></p></td></tr>

  </table>
  
  </div>

<div class="blank" style="float:left; width:80%; height:20px; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;"><p></p></div>
</body>
</html>