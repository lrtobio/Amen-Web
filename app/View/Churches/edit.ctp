<div class="churches form">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Edit Church'); ?></h1>
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
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Church.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Church.nombre'))); ?></li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Churches'), array('action' => 'index'), array('escape' => false)); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('Church', array('role' => 'form')); ?>
            <div class="form-group">
                <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Nombre'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('comunidad', array('class' => 'form-control', 'placeholder' => 'Nombre de la comunidad'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('direccion', array('class' => 'form-control', 'placeholder' => 'Direccion'));?>
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
                    <?php echo $this->Form->input('latitud', array('id'=>'lat','class' => 'form-control', 'label' => 'Latiutd', 'onkeyup'=>'validar_coord("lat")'));?>
                    <p id="p_lat" ></p>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->input('longitud', array('id'=>'long','class' => 'form-control', 'label' => 'Longitud', 'onkeyup'=>'validar_coord("long")'));?>
                    <p id="p_long"></p>
                </div>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('country_name', array('class' => 'form-control', 'value' => $this->request->data['Country']['nombre'],'id'=>'country_name', 'readonly'=> true));?>
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
    localize("edit");
    
    function validar_coord(coord) { 
        var c = document.getElementById(coord).value;
        var expreg
        if(coord == 'lat' )
            expreg = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,16}$/;//latitud
        else
            expreg = /^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,15}$/;//longitud

        if(expreg.test(c))
            document.getElementById('p_'+coord).innerHTML = "<p style='color: green'>Coordenada válida</p>";
        else
            document.getElementById('p_'+coord).innerHTML = "<p style='color: red'>Coordenada Inválida</p>";
      } 
</script>