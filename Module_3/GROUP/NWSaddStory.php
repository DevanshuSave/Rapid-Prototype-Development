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
		
		<div id="page">
			
		<h1 class="title">Add a Story</h1>
		

		<form action="addstory.php"  method="POST">

		<label>Title: <input type="text" name="title"/> </label>
		<br><br>

		<label>Link: <input type="text" name="link"/> </label>
                <br><br>

		Content:<br>
		<label><textarea type = "text" name="content" rows="10" cols="50"></textarea> </label>
                <br><br>

		
		<select type ="text" name="type" required/>
			<option value="">-- Please select --</option>
			<option value="Politics">Politics</option>
			<option value="Technology">Technology</option>
			<option value="Health">Health</option>
			<option value="Finance">Finance</option>
			<option value="Sports">Sports</option>
			<option value="Others">Others</option>
		</select><br><br>

		<input type="submit" value"Post Story">
		</input>
		</form>

                </div>
        </body>

</html>
