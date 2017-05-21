<?php
$mysqli = new mysqli('localhost','dc','dc330','calendar');

if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
?>