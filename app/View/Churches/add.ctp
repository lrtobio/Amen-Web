<div class="churches form">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Add Church'); ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Churches'), array('action' => 'index'), array('escape' => false)); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if($user == '1'): ?>
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Add by JSON</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <h3 id="item"></h3>
                        </div>
                        <div class="form-group">
                            <button type="button" class="form-control btn btn-default" onclick="lee_json()">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('Church', array('role' => 'form')); ?>

            <div class="form-group">
                <?php echo $this->Form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Nombre', 'id'=>'nombre'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('comunidad', array('class' => 'form-control', 'placeholder' => 'Nombre de la comunidad'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('direccion', array('class' => 'form-control', 'placeholder' => 'Direccion','id'=>'vicinity'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('telefonos', array('class' => 'form-control', 'placeholder' => 'Telefonos'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('direccion_web', array('class' => 'form-control', 'placeholder' => 'Sitio Web'));?>
            </div>
            <div class="form-group">
                <h4>Geoposicionamiento</h4>
                <div id="map_canvas"></div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <?php echo $this->Form->input('latitud', array('id'=>'lat','class' => 'form-control', 'label' => 'Latiutd', 'onkeyup'=>'validar_coord("lat")',  'onchange'=>'validar_coord("lat")'));?>
                    <p id="p_lat"></p>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->input('longitud', array('id'=>'long','class' => 'form-control', 'label' => 'Longitud', 'onkeyup'=>'validar_coord("long")',  'onchange'=>'validar_coord("long")'));?>
                    <p id="p_long"></p>
                </div>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('country_name', array('class' => 'form-control', 'placeholder' => 'País', 'id'=>'country_name','label'=>'País', 'readonly'=> true));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('country_short_name', array('class' => 'form-control', 'type'=> 'hidden', 'id'=>'country_short_name'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('observaciones', array('class' => 'form-control', 'placeholder' => 'Observaciones'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
            </div>
            <?php echo $this->Form->end() ?>
        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
</div>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
<?php echo $this->Html->script(array('scriptsMap')); ?>

<script>
    
    localize("add");
     function lee_json() {
        var cont = parseInt(localStorage.getItem('cont'));
        if(cont < 19){ 
           cont = cont + 1;
        }
        else{
            cont = 0;
        }
        console.log( localStorage.getItem('cont'));
        localStorage.setItem('cont',cont);
        $.getJSON("../churches_cascade.json", function(datos) {
            /*console.log("Dato: " + datos["results"]);
            $.each(datos["results"], function(idx,primo) {
                console.log("Iglesia "+ idx+": " + primo.name);
            });*/
            document.getElementById('item').innerHTML = cont ;
            console.log(datos["results"][cont].name);
            document.getElementById('nombre').value = datos["results"][cont].name;
            document.getElementById('vicinity').value = datos["results"][cont].vicinity;
            document.getElementById('lat').value = datos["results"][cont].geometry.location.lat;
            document.getElementById('long').value = datos["results"][cont].geometry.location.lng;
        });
    }
    
    function validar_coord(coord) { 
        var c = document.getElementById(coord).value;
        var expreg
        if(coord == 'lat' )
            expreg = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,16}$/;
        else
            expreg = /^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,15}$/;

        if(expreg.test(c))
            document.getElementById('p_'+coord).innerHTML = "<p style='color: green'>Coordenada válida</p>";
        else
            document.getElementById('p_'+coord).innerHTML = "<p style='color: red'>Coordenada Inválida</p>";
      } 

</script>