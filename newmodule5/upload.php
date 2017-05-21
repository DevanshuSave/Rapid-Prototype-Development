<!DOCTYPE html>
<?php
require 'database.php';
session_start();
?>
<html>
<head></head>
<body>
<h1>in upload</h1>
<?php
$user = $_SESSION['username'];
printf($user);
printf($_POST['eventdate']);
if(isset($_POST['eventname'])){
        printf("hello??");
        $user = $_SESSION['user'];
        $eventname = $_POST['eventname'];
        if(!$eventname){
                printf("Please enter a name for the event.");
        }
        if(isset($_POST['eventdate'])){
                $eventdate = $_POST['eventdate'];
                if(!$eventdate){
                        printf("Please enter a date for the event.");
                }
                if(isset($_POST['eventtime'])){
                        $eventtime = $_POST['eventtime'];
                        if(!$eventtime){
                                printf("Please enter a time for the event.");
                        }
                        if(isset($_POST['date'])){
                                $eventdate = $_POST['date'];
                                if(!$eventdate){
                                        printf("Invalid date. Please try again.");
                                }
                                        $stmt1 = $mysqli->prepare("insert into events(title, username, event_time, event_date) values(?, ?, ?, ?)");
                                        if(!$stmt1){
                                                printf("Failed: %s\n", $mysqli->error);
                                                exit;
                                        }
                                        $stmt1->bind_param('ssss', $eventname, $user, $eventtime, $eventdate);
                                        $stmt1->execute();
                                        $stmt1->close();
                                        header("Location: calendar.php");
                                }
                        }
                }
        }
?>
</body>
</html>