<?php
session_start();
if (isset($_SESSION['username'])){}
else
	header("Location: login.html");
?>
<?php
	$username = $_SESSION['username'];
	$filename = $_SESSION['filelist'];
	$full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);
	header('Content-Type: application/octet-stream');
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-disposition: attachment; filename=\"" . basename($filename) . "\""); 
	readfile($full_path);
?>