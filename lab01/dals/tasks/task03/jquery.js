$(document).ready(function() {
	// Image Hover
	$("img").css("border", "5px solid black");
	$("img").mouseenter(function() {$(this).css("border-color", "silver")});
	$("img").mouseleave(function() {$(this).css("border-color", "black")});
	
	// Section Hover
	$("section").mouseenter(function() {
		$("#hoveringdiv").css("background-color", "rgba(0, 0, 0, 0.75)").css("border-color", "red");
		$("#hoverdisplay").text($(this).attr("name"));
	});
	$("section").mouseleave(function() {
		$("#hoveringdiv").css("background-color", "rgba(0, 0, 0, 0)").css("border-color", "#880000");
		$("#hoverdisplay").html("&nbsp;");
	});
	
	// World Map City Hover
	var calgary = new Object();
		calgary.Name = "Calgary";
		calgary.Latitude = 51.0486;
		calgary.Longitude = -114.0708;
		calgary.Population = 1096833;
		calgary.Area = 825.29;
		calgary.Density = calgary.Population / calgary.Area;
	var edmonton = new Object();
		edmonton.Name = "Edmonton";
		edmonton.Latitude = 53.5444;
		edmonton.Longitude = -113.4909;
		edmonton.Population = 960015;
		edmonton.Area = 684.37;
		edmonton.Density = edmonton.Population / edmonton.Area;
	$(".citycircle").mouseenter(function() {
		var cityName = $(this).attr("name");
		if (cityName == "Calgary") {displayCityInfo(calgary);}
		if (cityName == "Edmonton") {displayCityInfo(edmonton);}
	});
	$(".citycircle").mouseleave(function() {
		$("#worldmapdiv").html("");
	});
	
});

function displayCityInfo(city) {
	$("#worldmapdiv").html("Name: <strong>" + city.Name + "</strong><br>" +
						"Latitude: <strong>" + city.Latitude + "</strong><br>" +
						"Longitude: <strong>" + city.Longitude + "</strong><br>" +
						"Population: <strong>" + city.Population + "</strong><br>" +
						"Area: <strong>" + city.Area + " SqKM</strong><br>" +
						"Density: <strong>" + city.Density);
}