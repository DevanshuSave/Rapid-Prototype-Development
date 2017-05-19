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

		In order to be able to post stories and comment on them, please login using your email address and password.

		</p>

		<br>

		<form action="logincheck.php" method="POST">
                        <p>

                                <label>Email Address: <input type="text" name="email_address"/></label>
                        <br><br><label>Password: <input type="password" name="password"/></label>
                        </p>

		<br>
                                <input type="submit" value="Log In">
                </form>

		<br><br>
		
		<a href="NWScreateAccount.php">Click here to create an account!</a>

		</div>
	</body>
</html>
