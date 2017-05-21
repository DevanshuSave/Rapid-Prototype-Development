function registerAjax(event){
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", "register.php", true);
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlHttp.send(dataString);
        xmlHttp.addEventListener("load", function(event){
                var jsonData = JSON.parse(event.target.responseText);
                if(jsonData.success){
                        alert("Registration successful. Please log in.");
                        document.getElementById("login").style.display="inline";
                        document.getElementById("welcome").style.display="none";
                }else{
                        alert("Registration failed. "+jsonData.message);
                }
        }, false);
}
document.getElementById("registerbtn").addEventListener("click", registerAjax, false);