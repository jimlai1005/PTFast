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

$query = new ParseQuery("order");
$query->equalTo("objectId", $postId);
$results = $query->find();

$posttitle = $results[0]->get('title');
$postcontent = $results[0]->get('content');
$postposter = $results[0]->get('poster');
$postrecipient = $results[0]->get('mobile');
$parsetime = $results[0]->getCreatedAt();
$taipeiTimeZone = new DateTimeZone('Asia/Taipei');
$parsetime->setTimezone($taipeiTimeZone);
$parsetime = $parsetime->format('Y/m/d H:i:s');

// all_text 內容 start

$all_text='<table width="80%" border="1">';

$all_text = "$all_text
<tr><td align='right'>標題：</td><td align='left'>$posttitle</td></tr>
<tr><td align='right'>時間：</td><td align='left'>$parsetime</td></tr>
<tr><td align='right'>內文：</td><td align='left'>$postcontent</td></tr>
";
$all_text = "$all_text</table>";

// all_text 內容 end



// 運費轉移 內容 start

$transfer_Text = '<table width="80%" border="0">';
$transfer_Text = "$transfer_Text<tr>
<td align='center'>收件人<br /> $postrecipient</td>
<td align='left'>      </td>
<td align='center'><input type='button' value='運費轉移' onclick='transferFee()'></td>
<td align='left'>      </td>
<td align='center'>運送專員<br /> $postposter</td>
</tr>";
$transfer_Text = "$transfer_Text</table>";

// 運費轉移 內容 end


?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
<script>
function transferFee()
{
	//動畫 + 轉移的Code


	// 先驗證文章狀態，文章 isDelete序號改3，寄信給運送專員、收件人，文章運費轉移到運送專員帳號。
	var postidStrings;
	var AllVars = window.location.search.substring(1);
	var Vars = AllVars.split("&");
	for (i = 0; i < Vars.length; i++)
	{
		var Var = Vars[i].split("=");
		if (Var[0] == "postId") 
		{
			postidStrings = decodeURIComponent(Var[1]);
		}
	}
	window.location.assign("transfer.php?postId=" + postidStrings);
}
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

<p>文章內容：</p>

我已經順利收到物品，訂單已經完成，現在我要交付運費！

<?php echo $transfer_Text; ?>

 <?php echo $all_text; ?>

 <br />
 </div>

<div class="blank" style="float:left; width:80%; height:20px; padding-left:5%; padding-right:5%; padding-top:5%; padding-bottom:5%;"><p></p></div>
</body>
</html>
