<?php
$dbhost = "localhost";
$dbuser = "dc";
$dbpass = "dc330";
$dbname = "calendar";
mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname) or die(mysql_error());
$name = $_GET['name'];
$day = $_GET['day'];
$name = mysql_real_escape_string($name);
$day = mysql_real_escape_string($day);
$query = "SELECT * FROM events WHERE username = '$name' AND date = '$day'";
$qry_result = mysql_query($query) or die(mysql_error());
$display_string = "<table>";
$display_string .= "<tr>";
$display_string .= "<th>eventname</th>";
$display_string .= "<th>time</th>";
$display_string .= "<th>day</th>";
while($row = mysql_fetch_array($qry_result)){
        $display_string .= "<tr>";
        $display_string .= "<td>$row[event_name]</td>";
        $display_string .= "<td>$row[time]</td>";
        $display_string .= "<td>$row[date]</td>";
        $display_string .= "</tr>";      
}
$display_string .= "</table>";
echo ($display_string);
?>