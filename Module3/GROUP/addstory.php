<?php
session_start();
$mysqli1 = new mysqli('localhost', 'dc', 'dc330', 'news');
					 
	$stmt1 = $mysqli1->prepare("insert into stories (owner, title, content, type, link) values(?,?,?,?,?)");
	if(!$stmt1){
				 printf("Query Prep Failed: %s\n", $mysqli1->error);
	exit;
	}
	$stmt1->bind_param('sssss',$_SESSION['email'],$_POST['title'],$_POST['content'],$_POST['type'],$_POST['link']);
	//$stmt1->execute();
	//$stmt1->execute();
	if ($stmt1->execute() === TRUE) {
				 $_SESSION['message']="New story created";
	}
	else {
				 $_SESSION['message']="Story could not be created";
	}

	echo $_SESSION['message'];
	$mysqli1->commit();
	$stmt1->close();
	$mysqli1->close();
	header("Location: home.php");
?>