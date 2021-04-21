var map = null;

function initMaps() {
  
    function new_map( $el ) { 
      // var
      var $markers = $el.find('.marker');
      // Styling the map to give it colours / branding
      var styles = [{
        "featureType": "landscape",
        "stylers": [{
                "saturation": -100
            },{
                "lightness": 65
            },{
                "visibility": "on"
            }]
    } , {
        "featureType": "poi",
        "stylers": [{
                "saturation": -100
            },{
                "lightness": 51
            },{
                "visibility": "simplified"
            }]
    } , {
        "featureType": "road.highway",
        "stylers": [{
                "saturation": -100
            },{
                "visibility": "simplified"
            }]
    } , {
        "featureType": "road.arterial",
        "stylers": [{
                "saturation": -100
            },{
                "lightness": 30
            },{
                "visibility": "on"
            }]
    } , {
        "featureType": "road.local",
        "stylers": [{
                "saturation": -100
            } , {
                "lightness": 40
            } , {
                "visibility": "on"
            }]
    } , {
        "featureType": "transit",
        "stylers": [{
                "saturation": -100
            } , {
                "visibility": "simplified"
            }]
    } , {
        "featureType": "administrative.province",
        "stylers": [{
                "visibility": "off"
            }]
    } , {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [{
                "visibility": "on"
            } , {
                "lightness": -25
            } , {
                "saturation": -100
            }]
    } , {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{
                "hue": "#ffff00"
            } , {
                "lightness": -25
            } , {
                "saturation": -97
            }]
    }];
      var styledMap = new google.maps.StyledMapType(styles, {name: "Unser Standort"} );

      // vars
      var args = {
        zoom    : 14,
        center    : new google.maps.LatLng(0, 0),
        mapTypeId : google.maps.MapTypeId.ROADMAP,
        mapTypeControlOptions: {
          mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
      };  
      // create map           
      var map = new google.maps.Map( $el[0], args); 

      // styled
      map.mapTypes.set('map_style', styledMap);
		  map.setMapTypeId('map_style');

      // add a markers reference
      map.markers = []; 
      // add markers
      $markers.each(function(){   
          add_marker( $(this), map );   
      }); 
      // center map
      center_map( map );  
      // return
      return map;
    }

    function add_marker( $marker, map ) {
      // var
      var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
      // marker
      var image = $marker.attr('data-marker-icon');
      console.log( image );
      // create marker
      var marker = new google.maps.Marker({
        position  : latlng,
        map     : map,
        icon: image
      });
      // add to array
      map.markers.push( marker );
      // if marker contains HTML, add it to an infoWindow
      if( $marker.html() )
      {
        // create info window
        var infowindow = new google.maps.InfoWindow({
          content   : $marker.html()
        });
        // show info window when marker is clicked
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open( map, marker );
        });
      }
    }

    function center_map( map ) {
      // vars
      var bounds = new google.maps.LatLngBounds();
      // loop through all markers and create bounds
      $.each( map.markers, function( i, marker ){
        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
        bounds.extend( latlng );
      });
      // only 1 marker?
      if( map.markers.length == 1 )
      {
        // set center of map
          map.setCenter( bounds.getCenter() );
          map.setZoom( 16 );
      }
      else
      {
        // fit to bounds
        map.fitBounds( bounds );
      }
    }
    $('.google-map').each(function(){
      // create map
      map = new_map( $(this) );
    });
    

}