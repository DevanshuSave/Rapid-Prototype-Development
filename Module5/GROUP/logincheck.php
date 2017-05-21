<!-- Check Login Functionality of the Calendar -->

<?php
session_start();
require 'database.php';
if (isset($_POST['login'])){
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->bind_result($user_id, $pwd_hash);
	$stmt->fetch();
	$stmt->close();

	if(crypt($password, $pwd_hash)==$pwd_hash){
		$token= substr(md5(rand()),0,10);
		$_SESSION['token'] = $token;
		$_SESSION['username']=$username;
		$returnObj = array('user'=>$username, 'token'=>$token, 'success'=>'yes');
		echo (json_encode($returnObj));
	}else{
	   exit;
	}

}elseif (isset($_POST['signup'])) {
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$stmt = $mysqli->prepare("select COUNT(*) from users where username=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->close();
	if ($count != 0){
		exit;
	}
	else{
		$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}

		$stmt->bind_param('ss', $username, crypt($password));
		$stmt->execute();
		$stmt->close();
		$token= substr(md5(rand()),0,10);
		$_SESSION['token'] = $token;
		$_SESSION['username']=$username;
		$returnObj = array('user'=>$username, 'token'=>$token, 'success'=>'yes');
		echo (json_encode($returnObj));
	}
}
else{
	exit;
}
?>