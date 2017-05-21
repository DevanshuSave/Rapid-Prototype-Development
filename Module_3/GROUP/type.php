<?php
	session_start();
	if(isset($_POST['ntype'])){
		$_SESSION['page']=$_POST['ntype'];
	}
	else 
		$_SESSION['page']="%";
	//echo $_SESSION['page'];
	header("Location: home.php");
?>