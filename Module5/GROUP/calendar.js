var user;
var day_today = new Date();
var month_today = new Month(day_today.getFullYear(), day_today.getMonth());

var list_days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var list_months = ["January","February","March","April", "May", "June","July","August","September","October","November","December"];

function drawGrid(){
$("#calendar_grid").remove();
grid  = document.createElement("table");
grid.id = "calendar_grid";
var day_today = new Date();
document.getElementById("year").innerHTML = month_today.year;
document.getElementById("month").innerHTML = list_months[month_today.month];
var weeks = month_today.getWeeks();
var first_row = grid.insertRow();
first_row.id = "weekdays";
for(var temp_days in list_days){
var td = first_row.insertCell();
td.appendChild(document.createTextNode(list_days[temp_days]));
}
for(var w in weeks){
var tr = grid.insertRow();
var days = weeks[w].getDates();
for(var d in days){
drawBox(tr,days[d]);
}
}
$("#monthgrid").append(grid);
var x = month_today.getDateObject(day_today.getDate());
if (day_today.getMonth()== x.getMonth() && day_today.getFullYear() == x.getFullYear()){
var cel = document.getElementById(day_today.getDate()+" "+day_today.getMonth());
cel.style.backgroundColor = "pink";
}
if (user){
loadUserData(user);
}
}

function drawBox(tr,day_today){
var td = tr.insertCell();
td.align = "center";
td.className = "cell";
td.setAttribute("id",day_today.getDate()+" "+day_today.getMonth());
var td_day = document.createElement("div");
td_day.className = "day_num";
$(td_day).append(day_today.getDate());
td.appendChild(td_day);

if (day_today.getMonth()!= month_today.month){
td_day.id = "wrongMonth";
}
var td_div = document.createElement("div");
td_div.className = "box";
$(td_div).click(function(){});
td.appendChild(td_div);
}

function loadUserData(user){
var month_today_num = parseInt(month_today.month) + 1;
var year_today = month_today.year;
var token = $("#token").val();
var type = checkButton("type");
switch(type){
case "all":
type = "P%";
break;
case "pri":
type = "Private";
break;
case "pub":
type = "Public";
break;
}
$.post("monthlyevents.php", {user: user, month: month_today_num, year: year_today, type: type, token: token}).
done(
function(rawdata){
if (!rawdata){
return;
}
var data = JSON.parse(rawdata);
for (var i in data){
addEvents(data[i]);
}
})
.fail(function() {
alert( "error" );
});
}

function addEvent(){
var this_title = $("#title").val();
var this_date = $("#event_date").val();
var this_location = $("#location").val();
var this_time = $("#event_time").val();
var this_des = $("#description").val();
var this_type = $("#type").val();
var token = $("#token").val();
$.post("addEvent.php", {date: this_date, time: this_time, loc: this_location, description: this_des, type: this_type, user: user, token: token});
drawGrid();
}


function editEvent(){
var this_event = $("#edit").attr("my_eventID");
var this_title = $("#edit_title").val();
var this_date = $("#edit_event_date").val();
var this_location = $("#edit_location").val();
var this_time = $("#edit_event_time").val();
var this_des = $("#edit_description").val();
var this_type = $("#edit_type").val();
var token = $("#token").val();
$.post("updateEvent.php", {my_eventID: this_event, date: this_date, time: this_time, loc: this_location, description: this_des, type: this_type, user: user, token: token}).
done(function(data){
drawGrid();})
}

function deleteEvent(){
$("#calendar_grid").remove();
var this_event =  $("#edit").attr("my_eventID");
var token = $("#token").val();
$.post("removeEvent.php", {my_eventID: this_event, user: user, token: token}).
done(function(){
drawGrid();
});
}

function checkButton(radio_name){
var operation_radio_pointers = document.getElementsByName(radio_name);
var which_operation = null;
for (var i = 0; i < operation_radio_pointers.length; i++){
if (operation_radio_pointers[i].checked){
which_operation = operation_radio_pointers[i].value;
}
}
return(which_operation);
}

//http://stackoverflow.com/questions/22213495/jquery-post-done-and-success
function userlogin(type){
var user = $("#user").val();
var pass = $("#pass").val();
if (type=="l"){
$.post("logincheck.php", {user: user, pass: pass, login: type}).
done(function(data){logged_in(data);});
}else if (type=="c"){
$.post("logincheck.php", {user: user, pass: pass, signup: type}).
done(function(data){
logged_in(data);
});
}
}
function logged_in(data){
user = $("#user").val();
$("#calendar_grid").remove();
drawGrid();
var welcome = "Welcome "+user+"!";
document.getElementById("hiuser").innerHTML=welcome;
$("#type").show();
}
function logout(){
user=null;
document.getElementById("hiuser").innerHTML="";
$("#token").val("");
drawGrid();
}
document.getElementById("login").addEventListener("click", function(){
userlogin("l");
},false);
document.getElementById("signup").addEventListener("click", function(){
userlogin("c");
},false);
document.getElementById("logout").addEventListener("click", function(){
logout();
},false);

//--------------------------------------------

drawGrid();
document.getElementById("forwardM").addEventListener("click", function(){
month_today = month_today.nextMonth();drawGrid();},false);
document.getElementById("backwardM").addEventListener("click", function(){
month_today = month_today.prevMonth();drawGrid();},false);

document.getElementById("forwardY").addEventListener("click", function(){
for (var i = 0; i < 12; i++){
month_today = month_today.nextMonth();
drawGrid();
}
},false);
document.getElementById("backwardY").addEventListener("click", function(){
for (var i = 0; i < 12; i++){
month_today = month_today.prevMonth();
drawGrid();
}
},false);


document.getElementById("exit").addEventListener("click",function(){
document.getElementById("title").value=null;
document.getElementById("description").value=null;
document.getElementById("location").value=null;
document.getElementById("event_date").value=null;
document.getElementById("event_time").value=null;
document.getElementById("pri").checked=false;
document.getElementById("pub").checked=false;
},false);

document.getElementById("edit_exit").addEventListener("click",function(){
document.getElementById("edit_title").value=null;
document.getElementById("edit_description").value=null;
document.getElementById("edit_location").value=null;
document.getElementById("edit_event_date").value=null;
document.getElementById("edit_event_time").value=null;
document.getElementById("edit_pri").checked=false;
document.getElementById("edit_pub").checked=false;
},false);

document.getElementById("save").addEventListener("click",addEvent,false);

document.getElementById("show").addEventListener("click",drawGrid, false);
var operation_radio_pointers = document.getElementsByName("operation");
for (var i = 0; i < operation_radio_pointers.length; i++){
operation_radio_pointers[i].addEventListener("change", drawGrid, false);
}