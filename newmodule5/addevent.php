<?php
require 'database.php';
session_start();
?>

<!DOCTYPE html>
<head>
<title>Add Event</title>
</head>
<body>
<form name="addevent" action="uploadevent.php" method="POST">
	<p>
<?php
if(isset($_POST['date'])){
	$date = $_POST['date'];
	printf("<input type=\"hidden\" name=\"date\" value=\"$date\" \>");
}
?>
<label for="eventname">Event Name:</label><input type="text" name="eventname" id="eventname"><br>

<label for="eventtime">Time:</label><input type="time" name="eventtime" id="eventtime"><br>
<input type="submit" name="addevent" value="add event" />
	</p>
</form>
<a href="calendar.php">Go Back</a>
</body>
</html>