<!DOCTYPE html>
<?php
require 'database.php';
session_start();
$_SESSION['token2'] = substr(md5(rand()), 0, 10);
?>
<head>
<link rel="stylesheet" type="text/css" href="calendar.css">
<title>Calendar</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script type="text/javascript">
daysoftheweek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
monthsoftheyear = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
daysinmonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
currentdate = new Date();
currentday = currentdate.getDate();
currentmonth = currentdate.getMonth();
currentyear = currentdate.getFullYear();
function Calendar(month, year){
        this.month = (isNaN(month) || month == null) ? currentmonth : month;
        this.year = (isNaN(year) || year == null) ? currentyear : year;
        this.html = '';
}
Calendar.prototype.generateHTML = function(){
        var firstDay = new Date(this.year, this.month, 1);
        var startingDay = firstDay.getDay();
        var monthLength = daysinmonth[this.month];
        if(this.month == 1) {
                if((this.year %4 == 0 && this.year % 100 != 0) || this.year % 400 == 0){
                        monthLength = 29;
                }
        }
        var month = monthsoftheyear[this.month];
        var html = '<table class="calendar_grid">';
        html += '<tr><th colspan="7">';
        html += month + "&nbsp;" + this.year;
        html += '</th></tr>'
        html += '<tr class="calendar_header">';
        for(var i = 0; i <= 6; i++){
                html += '<td class="calendar_header_day">';
                html += daysoftheweek[i];
                html += '</td>';
        }
        html += '</tr><tr>';
	var day = 1;
        for(var i = 0; i < 9; i++){
                for(var j = 0; j <= 6; j++){
                        html += '<td class="calendar_day">';
                        if(day <= monthLength && (i > 0 || j >= startingDay)){
html += '<div onclick = showDayDialog('+day+') id="dayevents">' + day + '</div><div onClick=ajaxFunction('+currentyear+currentmonth+day+') id='+currentyear+currentmonth+day+'</div><div id="result_table" style="display:none;">events here on ' + currentmonth + day + currentyear + '<br></div><input type="hidden" name="date" value="' + currentyear + currentmonth + day + '"/><input type="submit" name="" value="click to show events"/></div>';
                            day++;
                        }
                        html += '</td>';
                }
                if(day > monthLength){
                        break;
                } else{
                        html += '</tr><tr>';
                }       
        }
        html += '</tr></table>';
        this.html = html;
}
Calendar.prototype.getHTML = function() {
        return this.html;
}
function updateCalendarNext(){
	if(currentmonth == 12){
		this.currentmonth = 0;
		this.currentyear = currentyear + 1;
		var nextmonth = new Calendar(this.currentmonth, this.currentyear);
		nextmonth.generateHTML();
		document.getElementById("calendar").innerHTML = nextmonth.getHTML();
	} else{
		var nextmonth = new Calendar(this.currentmonth, this.currentyear);
		nextmonth.generateHTML();
		document.getElementById("calendar").innerHTML = nextmonth.getHTML();
	}
}
function updateCalendarPrev(){
	if(currentmonth == -1){
		this.currentmonth = 11;
		this.currentyear = currentyear - 1;
		var prevmonth = new Calendar(this.currentmonth, this.currentyear);
		prevmonth.generateHTML();
		document.getElementById("calendar").innerHTML = prevmonth.getHTML();
	} else{
		var prevmonth = new Calendar(this.currentmonth, this.currentyear);
		prevmonth.generateHTML();
		document.getElementById("calendar").innerHTML = prevmonth.getHTML();
	}
}
function showDayDialog(day){
	$('#' + currentmonth + day + currentyear + '').dialog();	
}
function showEvents(day) {
	$('#' + currentmonth + day + currentyear + '').dialog();
	ajaxFunction.dialog(day);
}
function ajaxFunction(theDay) {
        var xmlHttp = new XMLHttpRequest();
        var name = '<?php echo $_SESSION['username']; ?>'
        var day = theDay;
    
        var queryString = "?name=" + name ;
        queryString +=  "&day=" + day;
        xmlHttp.open("POST", "serverquery.php" + queryString, false);
        xmlHttp.addEventListener("load", ajaxCallback, false);
        xmlHttp.send(null);
}
function ajaxCallback (event) {
        document.getElementById("result_table").innerHTML = event.target.responseText;
} 
</script>
</head>
<body>
<script>
//add event
$(function() {
$("#dialog").dialog({
    autoOpen: false,
    buttons: {
        Ok: function () {
            $("#nameentered").text($("#eventname").val());
            $("#dateentered").text($("#eventdate").val());
            $("#timeentered").text($("#eventtime").val());
console.log($("#eventname").val());
console.log($("#eventdate").val());
console.log($("#eventtime").val());
        request =  $.ajax({
        
                type:"POST",
                url: "uploadevent.php",
		data: { name: $("#eventname").val(), day: $("#eventdate").val(), time: $("#eventtime").val()},
                success: function () {
      //          alert ("success");
                },
                error:function() {
                alert("failure");
                }   
    });  
            $(this).dialog("close");
}    
    ,
        Cancel: function () {
            $(this).dialog("close");
        }
    }
});
$("#open").click(function () {
    $("#dialog").dialog("open");
    });
});
//for deleting events 
$(function() {
$("#deletedialog").dialog({
    autoOpen: false,
    buttons: {
        Ok: function () {
            $("#nameentered").text($("#evtname").val());
            $("#dateentered").text($("#evtdate").val());
            $("#timeentered").text($("#evttime").val());
console.log($("#evtname").val());
console.log($("#evtdate").val());
console.log($("#evttime").val());
        request =  $.ajax({
                type:"POST",
                url: "deleteevent.php",
                
                data: { name: $("#evtname").val(), day: $("#evtdate").val(), time: $("#evttime").val()},
                success: function () {
    //            alert ("success");
                },
                error:function() {
                alert("failure");
                }   
    });  
            $(this).dialog("close");
}    
    ,
        Cancel: function () {
            $(this).dialog("close");
        }
    }
});
$("#del").click(function () {
    $("#deletedialog").dialog("open");
    });
});
//edit event
$(function() {
$("#editdialog").dialog({
    autoOpen: false,
    buttons: {
        Ok: function () {
            $("#nameentered").text($("#ename").val());
            $("#dateentered").text($("#edate").val());
            $("#timeentered").text($("#etime").val());
       	$("#changenameentered").text($("#changename").val());
            $("#changedateentered").text($("#changedate").val());
            $("#changetimeentered").text($("#changetime").val());
console.log($("#ename").val());
console.log($("#edate").val());
console.log($("#etime").val());
console.log($("#changename").val());
console.log($("#changedate").val());
console.log($("#changetime").val());
        request =  $.ajax({
                type:"POST",
                url: "editevent.php",
                
                data: { name: $("#ename").val(), day: $("#edate").val(), time: $("#etime").val(), changename: $("#changename").val(), changedate: $("#changedate").val(), changetime: $("#changetime").val(),},
                success: function () {
  //              alert ("success");
                },
                error:function() {
                alert("failure");
                }   
    });  
            $(this).dialog("close");
}    
    ,
        Cancel: function () {
            $(this).dialog("close");
        }
    }
});
$("#edit").click(function () {
    $("#editdialog").dialog("open");
    });
});
//register dialog
$(function() {
$("#registerdialog").dialog({
    autoOpen: false,
    buttons: {
        Ok: function () {
            $("#nameentered").text($("#newuser").val());
            $("#pwd").text($("#newpass").val());
            $("#repeatpwd").text($("#repeatpass").val());
if($("#newpass").val()!=$("#repeatpass").val()) {
alert ("passwords do not match");
} else {
console.log($("#newuser").val());
console.log($("#newpass").val());
console.log($("#repeatpass").val());
        request =  $.ajax({
        
                type:"POST",
                url: "registeruser.php",
                
                data: { newuser: $("#newuser").val(), newpass: $("#newpass").val(), repeatpass: $("#repeatpass").val()},
                success: function () {
//                alert ("success");
                },
                error:function() {
                alert("failure");
                }   
    });
}  
            $(this).dialog("close");
}
    
    ,
        Cancel: function () {
            $(this).dialog("close");
        }
    }
});
$("#register").click(function () {
    $("#registerdialog").dialog("open");
    });
});
function today() {
        currentdate = new Date();
	currentday = currentdate.getDate();
	currentmonth = currentdate.getMonth();
	currentyear = currentdate.getFullYear();
console.log(currentyear);
console.log(currentmonth);
console.log(currentday);	
	var xmlHttp = new XMLHttpRequest();
        var name = '<?php echo $_SESSION['username']; ?>'
        var day =  currentyear+""+currentmonth+""+currentday;
   console.log(day); 
        var queryString = "?name=" + name ;
        queryString +=  "&day=" + day;
        xmlHttp.open("POST", "serverquery2.php" + queryString, false);
        xmlHttp.addEventListener("load", ajaxCallback, false);
        xmlHttp.send(null);
}
function ajaxCallback (event) {
       // alert ("hello");
       // document.getElementById("ajaxDiv").innerHTML = event.target.responseText;
        document.getElementById("todayevents").innerHTML = event.target.responseText;
} 
</script>
<div id="registerdialog" title="Add Event">
    <p>
                <label for="newuser">Username:</label><br>
                <input type="text" name="newuser" id="newuser"/>
        <br>
                <label for="newpass">Password:</label>
                <input type="password" name="newpass" id="newpass"/>
        <br>
                <label for="repeatpass">Retype Password:</label>
                <input type="password" name="repeatpass" id="repeatpass"/>
        <br>
              
        </p>
</div>
<div id="dialog" title="Add Event">
 <p>Enter event name</p>
    <textarea id="eventname"></textarea>
    <p>Enter a time</p>
    <input type="time" id="eventtime"></textarea>
    <p>Enter a date (yearmonthday)</p>
    <textarea id="eventdate"></textarea>
</div>

<div id="deletedialog" title="Delete Event">
 <p>Enter event name</p>
    <textarea id="evtname"></textarea>
    <p>Enter the time</p>
    <input type="time" id="evttime"></textarea>
    <p>Enter the  date (yearmonthday)</p>
    <textarea id="evtdate"></textarea>
</div>

<div id="editdialog" title="Edit Event">
 <p>Current event name</p>
    <textarea id="ename"></textarea>
 <p>change name to:</p>
    <textarea id="changename"></textarea>   
 <p>Current the time</p>
    <input type="time" id="etime"></textarea>
 <p>change time to:</p>
    <input type="time" id="changetime"></textarea>    
<p>Current date (yearmonthday)</p>
    <textarea id="edate"></textarea>
 <p>change date to:</p>
    <textarea id="changedate"></textarea>
</div>

<!--<form action="registeruser.php" method="POST">
-->	<input type="button" name="register" id="register" value="Register" />
</form>
<?php
include 'checkuser.php'
?>
</br>
<form>
	<p>
		<input type="button" name="prevmonth" value ="<<" id="prevmonth"/>
		<input type="button" name="nextmonth" value=">>" id="nextmonth"/>
	</p>
</form>
<!--<div style="float: left;" id="result_table">Results</div>-->
<input  onclick=today() style="float: right;" type="button" id="todayevts" value="Click to see today's events" /></br>
<div style="float: right;" id="todayevents"></div>
<input type="button" id="open" value="Add Event" /> 
<input type="button" id="del" value="Delete Event" />
<input type="button" id="edit" value="Edit Event" />

<div id = "calendar">
</div>
<script type="text/javascript">
var cal = new Calendar();
cal.generateHTML();
document.getElementById("calendar").innerHTML = cal.getHTML();
document.getElementById("nextmonth").addEventListener("click", function(event){
	currentmonth = currentmonth + 1;
	updateCalendarNext();
	}, false);
document.getElementById("prevmonth").addEventListener("click", function(event){
        currentmonth = currentmonth - 1;
        updateCalendarPrev();
        }, false);
</script>
</body>
</html>