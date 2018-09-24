function initMap() {
    
    //Init Center
    var myLatLng = {lat: 1.3, lng: 36};


    // Create a map object and specify the DOM element
    // for display.
    var map = new google.maps.Map(document.getElementById('facilities_container'), {
      center: myLatLng,
      zoom: 6
    });


    //Use Geocoding service to get center
    var country = 'Kenya';
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address':country}, function(results, status){
    if(status == 'OK'){
        map.setCenter(results[0].geometry.location);
        }
    })

    //Load Kenya GeoJson
    map.data.loadGeoJson('https://data.humdata.org/dataset/e66dbc70-17fe-4230-b9d6-855d192fc05c/resource/51939d78-35aa-4591-9831-11e61e555130/download/kenya.geojson');

    //Style Geojson DataLayer
    map.data.setStyle({
        fillColor: '#1C4A5A',
        strokeWeight: 0.5,
        strokeColor: 'white'
      });

    
    
  }
