
    function localize(view){
        if (navigator.geolocation){
            if(view == "add")
                navigator.geolocation.getCurrentPosition(add_pos,function(failure) {
                    $.getJSON('https://ipinfo.io/geo', function(response) { 
                    var loc = response.loc.split(',');
                    var pos = {
                                coords: {
                                    latitude: loc[0],
                                    longitude: loc[1]
                                }
                            }
                    add_pos(pos);
                    });  
                });
            if(view == "edit")
                navigator.geolocation.getCurrentPosition(edit_pos,function(failure) {
                    $.getJSON('https://ipinfo.io/geo', function(response) { 
                    var loc = response.loc.split(',');
                    var pos = {
                                coords: {
                                    latitude: loc[0],
                                    longitude: loc[1]
                                }
                            }
                    edit_pos(pos);
                    });  
                });
            if(view == "list")
                navigator.geolocation.getCurrentPosition(map_create,function(failure) {
                    $.getJSON('https://ipinfo.io/geo', function(response) { 
                    var loc = response.loc.split(',');
                    var pos = {
                                coords: {
                                    latitude: loc[0],
                                    longitude: loc[1]
                                }
                            }
                    map_create(pos);
                    });  
                });
            /*if(view == "manual"){
                var pos = {
                    coords: {
                        latitude: '10.9837',
                        longitude: '-74.7994'
                    }
                }
                add_pos(pos);
            }*/               
        }
        else{
            alert('Tu navegador no soporta geolocalizacion.');
        }
    }

    
    function map_create(pos){
        
        localStorage.setItem('myLat', pos.coords.latitude);
        localStorage.setItem('myLon',pos.coords.longitude);
    }   
    
    function add_pos(pos)
    {
        var latitud = pos.coords.latitude;
        var longitud = pos.coords.longitude;
        var precision = pos.coords.accuracy;
        var zoom = 18;
        var map = new OpenLayers.Map("map_canvas");
        var mapnik = new OpenLayers.Layer.OSM();
        map.addLayer(mapnik);
        
        var size = new OpenLayers.Size(45,45);
        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
        var homeLogo = new OpenLayers.Icon( baseUrl+"/img/my_pos.png", size, offset);	
        var latlong = new OpenLayers.LonLat( longitud, latitud )
        .transform(
            new OpenLayers.Projection("EPSG:4326"),
            new OpenLayers.Projection("EPSG:900913") 
            );
        map.setCenter(latlong, zoom);
        
        {
            var markers = new OpenLayers.Layer.Markers( "Markers" );
            map.addLayer(markers);
            var marker = new OpenLayers.Marker(latlong, homeLogo);
            markers.addMarker( marker );
        }
        var markerSitio = null;
        var txtLat = document.getElementById("lat");
        var txtLon = document.getElementById("long");
        map.events.register("click", map, function(e){
        	
            var latLon = map.getLonLatFromViewPortPx(e.xy);			
            var newPx = map.getPixelFromLonLat(latLon);			
            		
					
            if( markerSitio==null ){			
                var size  = new OpenLayers.Size(45,45);
                var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
                var iconLogo = new OpenLayers.Icon(baseUrl+"/img/gps-church.png", size, offset);
                markerSitio = new OpenLayers.Marker(latLon, iconLogo);				
                markers.addMarker( markerSitio );
				
            }else			
                markerSitio.moveTo( newPx );			
            
            latLon = transformMouseCoords(latLon);	
            txtLat.value = latLon.lat.toString();
            txtLon.value = latLon.lon.toString();
            get_country(latLon);
        });
    }
    
    function edit_pos(pos)
    {
        var txtLat = document.getElementById("lat");
        var txtLon = document.getElementById("long");
        var latitud = txtLat.value;
        var longitud = txtLon.value;
        var zoom = 18;
        var map = new OpenLayers.Map("map_canvas");
        var mapnik = new OpenLayers.Layer.OSM();
        map.addLayer(mapnik);
        
        var size = new OpenLayers.Size(45,45);
        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
        var homeLogo = new OpenLayers.Icon( baseUrl+"/img/gps-church.png", size, offset);	
        var latlong = new OpenLayers.LonLat( longitud, latitud )
        .transform(
            new OpenLayers.Projection("EPSG:4326"),
            new OpenLayers.Projection("EPSG:900913") 
            );
        map.setCenter(latlong, zoom);
        var markerSitio = null;
        {
            var markers = new OpenLayers.Layer.Markers( "Markers" );
            map.addLayer(markers);
            markerSitio = new OpenLayers.Marker(latlong, homeLogo);
            markers.addMarker( markerSitio );
        }        
        map.events.register("click", map, function(e){	
            
            var latLon = map.getLonLatFromViewPortPx(e.xy);			
            var newPx = map.getPixelFromLonLat(latLon);	
            if( markerSitio==null ){			
                var size  = new OpenLayers.Size(45,45);
                var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
                var iconLogo = new OpenLayers.Icon(baseUrl+"/img/gps-church.png", size, offset);
                markerSitio = new OpenLayers.Marker(latLon, iconLogo);				
                markers.addMarker( markerSitio );                   
                
            }else			
                markerSitio.moveTo( newPx );			
			
            latLon = transformMouseCoords(latLon);	
            txtLat.value = latLon.lat.toString();
            txtLon.value = latLon.lon.toString();
            
            get_country(latLon);
        });
    }
    
    function error(errorCode){
        if(errorCode.code == 1)
            alert("No has permitido buscar tu localizacion")
        else if (errorCode.code==2)
            alert("Posicion no disponible")
        else
            alert("Ha ocurrido un error")
    }
    
    function transformMouseCoords(lonlat) {
        var newlonlat = transformToWGS84(lonlat);
        var x = Math.round(newlonlat.lon*10000)/10000;
        var y = Math.round(newlonlat.lat*10000)/10000;
        newlonlat = new OpenLayers.LonLat(x,y);
        return newlonlat;
    }
    function transformToWGS84( sphMercatorCoords) {
        var clon = sphMercatorCoords.clone();
        var pointWGS84= clon.transform(
            new OpenLayers.Projection("EPSG:900913"),
            new OpenLayers.Projection("EPSG:4326") );
        return pointWGS84;
    }    
    

function get_country(latLon) {
    var lat= latLon.lat.toString();
    var lng = latLon.lon.toString();
        var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+lng;
        $.getJSON(url, function(datos) {
            //console.log("Dato: " + datos['results']['0']['address_components']);
            if(datos['status'] == 'OK'){
                $.each(datos['results']['0']['address_components'], function(idx,d) {
                   //console.log("Iglesia "+ idx+": " + d.types['0']);
                   if(d.types['0'] == 'country'){
                       //console.log(d.short_name +','+ d.long_name);
                       document.getElementById("country_name").value = d.long_name;
                       document.getElementById("country_short_name").value = d.short_name;
                   }
                });          
            } 
             
        });
    }