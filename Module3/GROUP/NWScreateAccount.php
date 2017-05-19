<!DOCTYPE html>
<html>
        <head>
                <title>News Made Simple</title>

                <link rel="stylesheet" type="text/css" href="style.css">
        </head>

        <body>
                <div id=logo>
                <h1><a href="home.php">News Made Simple</a></h1>

                </div>
                <div id=menu></div>
                <div id=page> 
		<p>
			In order to create an account, please enter your email (which will serve as a username), a password, your first name, and your last name.
		</p>
		<br><br>
		<form action="add_user.php" method="POST">
                        
						<table>
                            <tr><td><label>First Name: </td><td><input type="text" name="first_name" required/></label></td></tr><tr/><tr/><tr/>
                            <tr><td><label>Last Name: </td><td><input type="text" name="last_name"required/></label></td></tr><tr/><tr/><tr/>
                            <tr><td><label>Email Address: </td><td><input type="email" name="email_address" required/></label></td></tr><tr/><tr/><tr/>
                            <tr><td><label>Password: </td><td><input type="password" name="password" required/></label></td></tr><tr/><tr/><tr/>
                            <tr><td><label>Location: </td><td><input type="text" name="location"/></label></td></tr><tr/><tr/><tr/>
							<tr><td><label>User Bio: </td><td><input type="text" name="info"/></label></td></tr><tr/><tr/><tr/>
						
						</table>
						<br><br><br>
                        <input type="submit" value="Create an Account">
                </form>

		<br>
		<br>
		<p class = "comments">
		<?php 
			session_start();
			if($_SESSION['yesorno']==1)
				echo $_SESSION['message'];
		?>
		</p>
		<a href="NWSlogin.php">Click here to log in with an existing account!</a>
		<br>
		</div>
	</body>

</html>
