$(document).ready(function() {
  // Highlight all elements
  $('h1, h2, img, p, marquee, .circle').hover(function () {
    $(this).css('background-color', 'yellow');
  },
  function() {
    $(this).css('background-color', "")
  });

  // Set heading to moused over section
  $('section').hover(function () {
      $('#moused-over-section-title').html($(this).attr('id'));
    },
    function () {
      $('#moused-over-section-title').html('&nbsp;');
    });

  // City mouse over events
  $('#city-calgary').hover(function () {
      var calgary = {
        name: "Calgary",
        latitude: 51.0486,
        longitude: -114.0708,
        population: 1096833,
        area: 825.29,
        density: function () {
          return this.population / this.area;
        }
      };
      populateCityInfo(calgary);
    },
    function () {
      clearCityInfo();
  });

  $('#city-edmonton').hover(function () {
    var edmonton = {
      name: "Edmonton",
      latitude: 53.5444,
      longitude: -113.4909,
      population: 960015,
      area: 684.37,
      density: function () {
        return this.population / this.area;
      }
    };
    populateCityInfo(edmonton);
  },
  function () {
    clearCityInfo();
  });
});

function populateCityInfo(city) {
  $('#city-name').html('Name: ' + city.name);
  $('#city-latitude').html('Latitude: ' + city.latitude);
  $('#city-longitude').html('Longitude: ' + city.longitude);
  $('#city-population').html('Population: ' + city.population);
  $('#city-area').html('Area: ' + city.area);
  $('#city-density').html('Density: ' + city.density());
}

function clearCityInfo() {
  $('#city-name').html('');
  $('#city-latitude').html('');
  $('#city-longitude').html('');
  $('#city-population').html('');
  $('#city-area').html('');
  $('#city-density').html('');
}
