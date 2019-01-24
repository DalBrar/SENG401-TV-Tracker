function activateMyScripts() {
	jsHover();
	sectionHover();
	cityHover();
}

function jsHover() {
	var images = document.body.querySelectorAll("img")
	for (let i = 0; i < images.length; i++) {
		images[i].style.border = "5px solid black";
		images[i].onmouseover = function() {images[i].style.borderColor= "silver";}
		images[i].onmouseout = function() {images[i].style.borderColor = "black";}
	}
}

function sectionHover() {
	var sections = document.getElementsByTagName("section");
	var dispArea = document.getElementById("hoverdisplay");
	var dispDiv = document.getElementById("hoveringdiv");
	for (let i = 0; i < sections.length; i++) {
		sections[i].onmouseover = function() {
			dispDiv.style.backgroundColor = "rgba(0, 0, 0, 0.75)";
			dispDiv.style.borderColor = "red";
			dispArea.innerHTML = sections[i].getAttribute("name");
		}
		sections[i].onmouseout = function() {
			dispDiv.style.backgroundColor = "rgba(0, 0, 0, 0)";
			dispDiv.style.borderColor = "#880000";
			dispArea.innerHTML = "&nbsp;"
		}
	}
}

var calgary = {
	Name: "Calgary",
	Latitude: 51.0486,
	Longitude: -114.0708,
	Population: 1096833,
	Area: 825.29,
	Density: function() {return this.Population/this.Area;}
};

var edmonton = {
	Name: "Edmonton",
	Latitude: 53.5444,
	Longitude: -113.4909,
	Population: 960015,
	Area: 684.37,
	Density: function() {return this.Population/this.Area;}
};

function cityHover() {
	var cities = document.getElementsByClassName("citycircle");
	var dispArea = document.getElementById("worldmapdiv");
	for (let i = 0; i < cities.length; i++) {
		cities[i].onmouseover = function() {
			var cityName = cities[i].getAttribute("name");
			if (cityName == "Calgary") {displayCityInfo(calgary);}
			if (cityName == "Edmonton") {displayCityInfo(edmonton);}
		}
		cities[i].onmouseout = function() {
			dispArea.innerHTML = "";
		}
	}
}
function displayCityInfo(city) {
	var dispArea = document.getElementById("worldmapdiv");
	dispArea.innerHTML = "Name: <strong>" + city.Name + "</strong><br>" +
						"Latitude: <strong>" + city.Latitude + "</strong><br>" +
						"Longitude: <strong>" + city.Longitude + "</strong><br>" +
						"Population: <strong>" + city.Population + "</strong><br>" +
						"Area: <strong>" + city.Area + " SqKM</strong><br>" +
						"Density: <strong>" + city.Density();
}