<div class="mobileUsers form">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Edit Mobile User'); ?></h1>
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
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('MobileUser.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('MobileUser.nombre'))); ?></li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Mobile Users'), array('action' => 'index'), array('escape' => false)); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('MobileUser', array('role' => 'form')); ?>
            <div class="form-group">
                <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
            </div>
            <div class="form-group">
                    <?php echo $this->Form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Nombre'));?>
                
                <!--<div class="col-md-6">
                    <?php echo $this->Form->input('apellido', array('class' => 'form-control', 'placeholder' => 'Apellido'));?>
                </div>-->
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('fechanacimiento', array('type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'Fecha', 'label'=> 'Fecha','readonly')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('gender', array('class' => 'form-control', 'placeholder' => 'Sexo', 'type'=>'select','options'=>array('M'=>'Masculino','F'=>'Femenino')));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('mobileuser_profile_id', array('class' => 'form-control', 'placeholder' => 'Mobileuser Profile Id'));?>
            </div>  
            <div class="form-group">
                <?php echo $this->Form->input('locale', array('class' => 'form-control', 'placeholder' => 'Locale'));?>
            </div>
            <!--<div class="form-group">
                    <?php echo $this->Form->input('city_id', array('class' => 'form-control', 'placeholder' => 'City Id'));?>
            </div>-->
            <div class="form-group">
                    <?php echo $this->Form->input('country_id', array('class' => 'form-control', 'placeholder' => 'Country Id'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status', 'type'=>'select', 'options'=>$opStatus/*array('A'=>'Activo','I'=>'Inactivo', 'V'=>'Verificado')*/));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('comunidad', array('class' => 'form-control', 'placeholder' => 'Comunidad'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('consagracion', array('class' => 'form-control', 'placeholder' => 'Consagracion'));?>
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

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.datepicker.defaults.language = 'es';

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: "linked",
        });

    });
</script>
<?php echo $this->Html->css(array('bootstrap-datepicker.min')); echo $this->Html->script(array('bootstrap-datepicker.min','bootstrap-datepicker.es.min')); ?>