function fetchWeather(event) {
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET", "http://classes.engineering.wustl.edu/cse330/content/weather_json.php", true);
	xmlHttp.addEventListener("load", weatherCallback, false);
	xmlHttp.send(null);
	}
function weatherCallback(event) {
	var jsonData = JSON.parse(event.target.responseText);
	
	//Location
	var htmlLocParent = document.getElementsByClassName("weather-loc")[0];
	var jsonCity = jsonData.location.city;
	var jsonState = jsonData.location.state;
	
	//Temperature
	var htmlTempParent = document.getElementsByClassName("weather-temp")[0];
	var jsonTemp = jsonData.wind.chill;
	
	//Humidity
	var htmlHumidityParent = document.getElementsByClassName("weather-humidity")[0];
	var jsonHumidity = jsonData.atmosphere.humidity;
	
	//Tomorrow's weather
	var htmlTomorrowParent = document.getElementsByClassName("weather-tomorrow")[0];
	var jsonTomorrow = jsonData.tomorrow.code;
	var tomorrowString = "http://us.yimg.com/i/us/nws/weather/gr/" + jsonTomorrow + "ds.png";
	
	//Day After Tomorrow's weather
	var htmlDayAfterTomorrowParent = document.getElementsByClassName("weather-dayaftertomorrow")[0];
	var jsonDayAfterTomorrow = jsonData.dayafter.code;
	var dayAfterTomorrowString = "http://us.yimg.com/i/us/nws/weather/gr/" + jsonDayAfterTomorrow + "ds.png";
	
	//Loading Data for Display in HTML
	htmlLocParent.innerHTML = "<strong>" + jsonCity + "</strong>" + " " + jsonState;
	htmlTempParent.innerHTML = jsonTemp + "\u00B0" + "F";
	htmlHumidityParent.innerHTML = jsonHumidity;
	htmlTomorrowParent.src = tomorrowString;
	htmlDayAfterTomorrowParent.src = dayAfterTomorrowString;	
}
document.addEventListener("DOMContentLoaded", fetchWeather, false);
document.getElementById("update").addEventListener("click", fetchWeather, false);