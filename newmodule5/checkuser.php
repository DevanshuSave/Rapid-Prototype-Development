<?php
if(isset($_SESSION['checkuser'])){
	$checkuser = $_SESSION['checkuser'];
	if($checkuser == false){
		printf("<form action=\"login.php\" method=\"POST\"><p>
                        <label for=\"username\">Username:</label>
                        <input type=\"text\" name=\"username\" id=\"username\" /
><br>
                        <label for=\"password\">Password:</label>
                        <input type=\"password\" name=\"password\" id=\"password\" /><br>
                        <input type=\"submit\" name=\"submit\" value=\"Go\" /></p>
			"
                );
	}
	else{
		$token = $_SESSION['token'];
		$username = $_SESSION['username'];
		//$userid = $_SESSION['userid'];
		printf("Welcome, %s", $username);
		printf("<a href=\"logout.php\">Logout</a>");
	}
}
else{
        printf("<form action=\"login.php\" method=\"POST\" align=\"right\"><p>
                <label for=\"username\">Username:</label>
                <input type=\"text\" name=\"username\" id=\"username\" /><br>
                <label for=\"password\">Password:</label>
                <input type=\"password\" name=\"password\" id=\"password\" /><br>
		
                <input type=\"submit\" name=\"submit\" value=\"Go\" /></p>
                </form>"
        );
}
?>