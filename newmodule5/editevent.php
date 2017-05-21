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
$changename=$_POST['changename'];
$changetime=$_POST['changetime'];
$changedate=$_POST['changedate'];
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
$mysqli = new mysqli('localhost', 'dc', 'dc330', 'calendar');
if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
}
        mysqli_query($mysqli, "DELETE FROM events WHERE title='$eventname' and  username='$username' and event_time='$eventtime' and  event_date='$eventdate'"); // VALUES ('$eventname', '$username', '$eventtime', '$eventdate')");
 mysqli_query($mysqli, "INSERT INTO events (title, username, event_time, event_date) VALUES ('$changename', '$username', '$changetime', '$changedate')");
//                                       header("Location: calendar.php");
echo($eventname + "ev" + $eventtime + "tt" + $eventdate);
                                }
                        }
                }
?>
</body>
</html>