<!DOCTYPE html>
<?php
require 'database.php';
session_start();
?>
<html>
<head></head>
<body>
<?php
$username=$_SESSION['username'];
if (isset($_POST ['name'])) {
	$eventname = $_POST['name'];       
        if(!$eventname){
                printf("Please enter a name for the event.");
        }
                if(isset($_POST['time'])){         
			 $eventtime = $_POST['time'];
        if(!$eventtime){
                                printf("Please enter a time for the event.");
                        }
                        if(isset($_POST['day'])){
                                $eventdate = $_POST['day'];	
               if(!$eventdate){
                                        printf("Invalid date. Please try again.");
                                }
                                        $stmt1 = $mysqli->prepare("insert into events(title, username, event_time, event_date) values(?, ?, ?, ?)");
                                        if(!$stmt1){
                                                printf("Failed: %s\n", $mysqli->error);
                                                exit;
                                        }
                                        $mysqli = new mysqli('localhost', 'dc', 'dc330', 'calendar');
if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
}
	mysqli_query($mysqli, "INSERT INTO events (title, username, event_time, event_date) VALUES ('$eventname', '$username', '$eventtime', '$eventdate')");
                                        $stmt1->bind_param('ssss', $eventname, $username, $eventtime, $eventdate);
                                        $stmt1->execute();
                                        $stmt1->close();
echo($eventname + "ev" + $eventtime + "tt" + $eventdate);
                                }
                        }
                }
?>
</body>
</html>