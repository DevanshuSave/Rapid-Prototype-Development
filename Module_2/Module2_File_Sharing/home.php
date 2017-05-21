<!DOCTYPE html><html>
<head>
	<link rel="stylesheet" type="text/css" href="./mycss1.css" />
	<title>Share my File</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['username'])){
	echo "<p>Welcome {$_SESSION['username']}</p>";
}
else
        header("Location: login.html");
?>
	<!-- Code taken from Course Wiki-->
	<form enctype="multipart/form-data" action="upload.php" method="POST">
		<p class = 'prime1'>
			<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
			<label for="uploadfile_input">Choose a file to upload:</label>
			<input name="uploadedfile" type="file" id="uploadfile_input" required />
			<input type="submit" value="Upload File" />
		</p>
	</form>
<h3>List of files in user directory</h3>
<!--Code to read directory from server referred from http://php.net/manual/en/function.scandir.php-->
<?php
$directory = sprintf("/srv/uploads/%s/", $_SESSION['username']);
$dh=opendir($directory);
?>
<form enctype="multipart/form-data" action="decider.php" method="GET">
<table>

<?php
while (false !== ($myFile = readdir($dh))) {
	if($myFile !== "." && $myFile !== "..") {
		?>
		<tr><td>&nbsp;<input type="radio" name="filelist" value="<?php echo $myFile;?>" required/></td><td>
		<?php
		$files[] = $myFile;
		echo $myFile."<br></td></tr>";
	}
}
//$files = array_slice(scandir($directory), 2);
//print_r($files);
//chmod($d, 0777);
?>
<tr><td colspan="2">&nbsp;<input name="page" type="submit" value="view" />&nbsp;<input name="page" type="submit" value="download" />&nbsp;<input name="page" type="submit" value="delete" /></td></tr>
</table></form>
<br><br><a href="logout.php">Logout</a>
</body>
</html>