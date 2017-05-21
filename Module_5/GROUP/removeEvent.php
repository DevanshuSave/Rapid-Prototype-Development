<?php
//Remove the event

ini_set("session.cookie_httponly", 1);
require 'database.php';
session_start();


if ($_SESSION['token'] != $_POST['token'] OR $_SESSION['user'] != $_POST['user']){
	die("Request Forgery");
}

//Delete from database

$my_eventID = $_POST['my_eventID'];
$stmt = $mysqli->prepare("DELETE from events where id = ?");

if(!$stmt){
 printf("Query Prep Failed: %s\n", $mysqli->error);
 exit;
}
$stmt->bind_param('s',$my_eventID);
$stmt->execute();
$stmt->close();
?>