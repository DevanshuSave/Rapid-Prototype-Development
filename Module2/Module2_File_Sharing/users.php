<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./mycss1.css" />
	<title>Share my File</title>
</head>
<body>
	<form action="usersdecider.php" method="POST">
		<p class = 'prime1'>
			<input name="user" type="text" required />
			<input name="act" type="submit" value="Add" />
			<input name="act" type="submit" value="Remove" />
		</p>
	</form>
<?php
	//*Session
	session_start();
	echo $_SESSION['message'];
	//*/
?>
<br><br><a href="login.html">Login</a>
</body>
</html>