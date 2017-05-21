<?php
session_start();
if (isset($_SESSION['username'])){}
else
	header("Location: login.html");
$username = $_SESSION['username'];
$filename = $_SESSION['filelist'];
$full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);
// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);
// Finally, set the Content-Type header to the MIME type of the file, and display the file.
header("Content-Type: ".$mime);
readfile($full_path);
?>