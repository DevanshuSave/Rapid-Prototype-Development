<!DOCTYPE html>
<?php
require 'database.php';
session_start();
?>
<html><head></head>
<body>
<script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
function ajaxFunction(){
 var ajaxRequest;  // The variable that makes Ajax possible!
        
 try{

   ajaxRequest = new XMLHttpRequest();
 }catch (e){
         // Something went wrong
         alert("Your browser broke!");
         return false;
} 
 ajaxRequest.onreadystatechange = function(){
   if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('ajaxDiv');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
   }
 }

var name = '<?php echo $_SESSION['username']; ?>'
var day = '<?php echo $_POST['date']; ?>'
var queryString = "?name=" + name ;
 queryString +=  "&day=" + day;
 ajaxRequest.open("POST", "serverquery.php" + 
                              queryString, true);
 ajaxRequest.send(null); 
}
</script>
<!--<form>
<input type='button' onclick='ajaxFunction()' 
                              value='show events'/>
</form>
<div id='ajaxDiv'>Your result will display here</div>
--></body>
</html>