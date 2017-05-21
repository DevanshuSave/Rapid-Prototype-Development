<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mycss1.css" />
	<title>Upload</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['username'])){}
else
	header("Location: login.html");
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}
 
// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}
 
$full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);
echo $filename;
if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	echo " has been uploaded successfully.";
	//header("Location: upload_success.html");
}
else{
	echo " has not been uploaded. Please try again.";
	//header("Location: upload_failure.html");
}
	?>
	<br>
	<a href="home.php">Go back to home</a>
</body>
</html>
