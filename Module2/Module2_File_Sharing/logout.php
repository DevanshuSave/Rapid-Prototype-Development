<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./mycss1.css" />
	<title>Share my File</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['username'])){
	unset($_SESSION);
	session_destroy();
	?>
	Thank you for visiting! <br><br><a align href="login.html">Click here to Login Again</a>
<?php
}
else
        header("Location: login.html");
?>
</body></html>