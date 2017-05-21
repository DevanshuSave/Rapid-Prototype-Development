<!DOCTYPE html>
<?php 
require 'database.php';
session_start();
?>
<head>
<title>Login to Calendar</title>

</head>
<body>
<?php
if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt1 = $mysqli->prepare("select count(*) from users where username like ?");
        if(!$stmt1) {
                printf("Failed: %s\n", $mysqli->error);
                exit;
        }
        $stmt1->bind_param('s', $username);
        $stmt1->execute();
        $stmt1->bind_result($number);
        $stmt1->fetch();
        $stmt1->close();
        if ($number == 0) {
                printf("User does not exist\n");
        }
else {
                $stmt = $mysqli->prepare("select count(username), username, password from users where username=?"
);
                if(!$stmt){
                        printf("Query Prep Failed: %s\n", $mysqli->error);                        exit;
                }
                $encrypted = crypt($password, 'pwd');
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $stmt->bind_result($count, $user, $hashpass);
                $stmt->fetch();
                $stmt->close();
                if ($count == 1 && $user==$username && $encrypted==$hashpass) {
   session_start();
                    
                        $_SESSION['username'] = $username;
                        $_SESSION['checkuser'] = true;
                        $_SESSION['token'] = substr(md5(rand()), 0, 10);
                        header("Location: calendar.php");
                        exit;
                }
                else {
                        printf("Incorrect password. Try again");
                }
        }
}
?>
</body>
</html>