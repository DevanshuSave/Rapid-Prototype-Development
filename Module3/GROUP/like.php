<?php
		session_start();
		if(!isset($_POST['story1'])) {
			$new_id = $_SESSION['story'];
			echo "In here";
		}
		else {
			$new_id = (int)$_POST['story1'];
		}
		$email = $_SESSION['email'];
		$mysqli1 = new mysqli('localhost', 'dc', 'dc330', 'news');
		if($email != "Guest")
		{
			$stmt2 = $mysqli1->prepare("insert into likes (news_id, user) values(?,?)");
			if(!$stmt2){
				printf("Query Prep Failed: %s\n", $mysqli1->error);
			exit;
			}
			$stmt2->bind_param('is', $new_id, $_SESSION['email']);
			$stmt2->execute();
			$stmt2->close();
		}
		header("Location: home.php");
?>