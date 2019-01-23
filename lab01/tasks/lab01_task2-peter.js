function addMouseOverEvents() {
  addHighlightMouseOverEvents();
  addSectionMouseOverEvents();
  addCityMouseOverEvents();
}

function addHighlightMouseOverEvents() {
  var elements = document.body.querySelectorAll("h1, h2, img, p, .circle")
  for (let i = 0; i < elements.length; i++) {
    elements[i].onmouseover = function() {
      paintBackground(elements[i], "yellow")
    }
    elements[i].onmouseout = function() {
      paintBackground(elements[i], "");
    }
  }
}

function addSectionMouseOverEvents() {
  var sections = document.getElementsByTagName("section")
  for (let i = 0; i < sections.length; i++) {
    sections[i].onmouseover = function() { 
      document.getElementById("moused-over-section-title").innerHTML = sections[i].id;
    };
    sections[i].onmouseout = function() { 
      document.getElementById("moused-over-section-title").innerHTML = "&nbsp;";
    };
  }
}

function addCityMouseOverEvents() {
  var calgary = {
    name      : "Calgary",
    latitude  : 51.0486,
    longitude : -114.0708,
    population: 1096833,
    area      : 825.29,
    density   : function() {
      return this.population / this.area;
    }
  };

  var edmonton = {
    name      : "Edmonton",
    latitude  : 53.5444,
    longitude : -113.4909,
    population: 960015,
    area      : 684.37,
    density   : function() {
      return this.population / this.area;
    }
  };

  var calgaryElement = document.getElementById("city-calgary")
  calgaryElement.onmouseover = function() {
    paintBackground(calgaryElement, "yellow")
    populateCityInfo(calgary);
  }
  calgaryElement.onmouseout = function() {
    paintBackground(calgaryElement, "")
    clearCityInfo();
  }

  var edmontonElement = document.getElementById("city-edmonton")
  edmontonElement.onmouseover = function() {
    paintBackground(edmontonElement, "yellow")
    populateCityInfo(edmonton);
  }
  edmontonElement.onmouseout = function() {
    paintBackground(edmontonElement, "")
    clearCityInfo();
  }
}

function paintBackground(element, color) {
  element.style.backgroundColor = color;
}

function populateCityInfo(city) {
  document.getElementById("city-name").innerHTML = "Name: " + city.name;
  document.getElementById("city-latitude").innerHTML = "Latitude: " + city.latitude;
  document.getElementById("city-longitude").innerHTML = "Longitude: " + city.longitude;
  document.getElementById("city-population").innerHTML = "Population: " + city.population;
  document.getElementById("city-area").innerHTML = "Area: " + city.area;
  document.getElementById("city-density").innerHTML = "Density: " + city.density();
}

function clearCityInfo() {
  document.getElementById("city-name").innerHTML = "";
  document.getElementById("city-latitude").innerHTML = "";
  document.getElementById("city-longitude").innerHTML = "";
  document.getElementById("city-population").innerHTML = "";
  document.getElementById("city-area").innerHTML = "";
  document.getElementById("city-density").innerHTML = "";
}