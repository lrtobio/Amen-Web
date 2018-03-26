
<div class="churches index">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Churches'); ?></h1>
            </div>            
        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;View List'), array('action' => 'index'), array('escape' => false)); ?></li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Church'), array('action' => 'add'), array('escape' => false)); ?></li>
                        </ul>
                    </div>
                    <!-- end body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end actions -->
        </div>
        <!-- end col md 3 -->
        
        <div class="col-md-9">
            <div id="map_canvas"></div>
        </div>
        <!-- end col md 9 -->
    </div>
    <!-- end row -->
</div>
<!-- end containing of content -->
<?php echo $this->Html->script(array('scriptsMap')); ?>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>

  
 <script>
    localize("list");
    
    var map = new OpenLayers.Map("map_canvas");
    map.addLayer(new OpenLayers.Layer.OSM());    
    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    //epsg900913 = new OpenLayers.Projection("EPSG:900913"); //The map projection (Spherical Mercator)
    projectTo = map.getProjectionObject()
    var latitud =  localStorage.getItem('myLat');
    var longitud =  localStorage.getItem('myLon');
    console.log('mi latitud: '+latitud+', mi longitud: '+longitud);
    var lonLat = new OpenLayers.LonLat( longitud ,latitud ).transform(epsg4326, projectTo);   
    var zoom=15;
    map.setCenter (lonLat, zoom);
    var vectorLayer = new OpenLayers.Layer.Vector("Overlay");    
    // Define markers as "features" of the vector layer:
    var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( longitud, latitud ).transform(epsg4326,projectTo),
            {description:'Estas aquí', id: '#'} ,
            {externalGraphic: '<?php echo FULL_BASE_URL . $this->webroot; ?>img/my_pos.png', graphicHeight: 45, graphicWidth: 45, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);
    var nombre;
    var id;
     <?php foreach ($churches as $church): ?>
         latitud = <?php echo h($church[ 'Church'][ 'latitud']); ?> ;
         longitud = <?php echo h($church[ 'Church'][ 'longitud']); ?> ;
         nombre = '<?php echo h($church[ 'Church'][ 'nombre']); ?>' ;
         id = '<?php echo h($church[ 'Church'][ 'id']); ?>' ;
        //console.log('lat: '+latitud+', long: '+longitud+', nombre:'+nombre);
        feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( longitud, latitud ).transform(epsg4326, projectTo),
            {description: nombre, id: '../churches/view/'+id} ,
            {externalGraphic: '<?php echo FULL_BASE_URL . $this->webroot; ?>img/gps-church.png', graphicHeight: 45, graphicWidth: 45, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);
    <?php endforeach; ?>
    map.addLayer(vectorLayer);
 
    
    //Add a selector control to the vectorLayer with popup functions
    var controls = {
      selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: destroyPopup })
    };

    function createPopup(feature) {
      feature.popup = new OpenLayers.Popup.FramedCloud("pop",
          feature.geometry.getBounds().getCenterLonLat(),
          null,
          '<a href="'+feature.attributes.id+'"><div class="markerContent">'+feature.attributes.description+'</div> </a> ',
          null,
          true,
          function() { controls['selector'].unselectAll(); }
      );
      //feature.popup.closeOnMove = true;
      map.addPopup(feature.popup);
    }

    function destroyPopup(feature) {
      feature.popup.destroy();
      feature.popup = null;
    }
    
    map.addControl(controls['selector']);
    controls['selector'].activate();
      
  </script>
 