<?php
ini_set("session.cookie_httponly", 1);
require 'database.php';
session_start();
if ($_SESSION['token'] != $_POST['token'] OR $_SESSION['username'] != $_POST['user']){
	exit();
}

$user = $mysqli->real_escape_string($_POST['user']);
$date = $mysqli->real_escape_string($_POST['date']);
$time = $mysqli->real_escape_string($_POST['time']);
$title = $mysqli->real_escape_string($_POST['title']);
$loc = $mysqli->real_escape_string($_POST['loc']);
$description = $mysqli->real_escape_string($_POST['description']);
$type = $mysqli->real_escape_string($_POST['type']);

$stmt = $mysqli->prepare("INSERT INTO events (username, title, event_date, event_time, location, description, privacy) VALUES(?,?,?,?,?,?,?)");
if(!$stmt){
 printf("Query Prep Failed: %s\n", $mysqli->error);
 exit;
}
$stmt->bind_param('sssssss', $user, $title, $date, $time, $location, $description, $type);
$stmt->execute();
$stmt->close();
?>