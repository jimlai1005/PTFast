<?php
setcookie("session_Mobile", "", time()-2600000);
echo "<script>alert('您已經登出。');window.location.replace('login.php');</script>";
?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title>PTFast</title>
</head>