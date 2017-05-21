<?php
?><html>
<head></head>
<body>
<script type="text/javascript">
function logoutAjax(event){
        var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET", "logout.php", true);
        xmlHttp.send(null);
        xmlHttp.addEventListener("load", function(event){
                var jsonData = JSON.parse(event.target.responseText);
                if(jsonData.success){
                        alert("Log out successful!");
                        document.getElementById("login").style.display="inline";
                        document.getElementById("welcome").style.display="none";
			document.getElementById("username").value = "";
			document.getElementById("password").value = "";
                }else{
                        alert("You were not logged out.");
                }
        }, false);
}
document.getElementById("logoutbtn").addEventListener("click", logoutAjax, false);
</script>
</body></html>