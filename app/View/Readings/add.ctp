
<div class="readings form">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Add Reading'); ?></h1>
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
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Readings'), array('action' => 'index'), array('escape' => false)); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('Reading', array('role' => 'form')); ?>
            <div class="form-group">
                <?php echo $this->Form->input('titulo_es', array('class' => 'form-control', 'placeholder' => 'Titulo Es'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('titulo_en', array('class' => 'form-control', 'placeholder' => 'Titulo En'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('titulo_pt', array('class' => 'form-control', 'placeholder' => 'Titulo Pt'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('titulo_fr', array('class' => 'form-control', 'placeholder' => 'Titulo Fr'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('titulo_it', array('class' => 'form-control', 'placeholder' => 'Titulo It'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('descripcion_es', array('class' => 'form-control', 'placeholder' => 'Descripcion Es', 'value'=>'<p>&nbsp;</p><p>&nbsp;</p><p style="text-align: right;"><small><em>fuente:&nbsp;www.evangeliodeldia.org</em></small></p>'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('descripcion_en', array('class' => 'form-control', 'placeholder' => 'Descripcion En', 'value'=>'<p>&nbsp;</p><p>&nbsp;</p><p style="text-align: right;"><small><em>source:&nbsp;www.evangeliodeldia.org</em></small></p>'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('descripcion_pt', array('class' => 'form-control', 'placeholder' => 'Descripcion Pt', 'value'=>'<p>&nbsp;</p><p>&nbsp;</p><p style="text-align: right;"><small><em>fonte:&nbsp;www.evangeliodeldia.org</em></small></p>'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('descripcion_fr', array('class' => 'form-control', 'placeholder' => 'Descripcion Fr', 'value'=>'<p>&nbsp;</p><p>&nbsp;</p><p style="text-align: right;"><small><em>fontaine:&nbsp;www.evangeliodeldia.org</em></small></p>'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('descripcion_it', array('class' => 'form-control', 'placeholder' => 'Descripcion It', 'value'=>'<p>&nbsp;</p><p>&nbsp;</p><p style="text-align: right;"><small><em>fonte:&nbsp;www.evangeliodeldia.org</em></small></p>'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('fecha', array('type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'Fecha', 'label'=> 'Fecha', 'readonly')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('reading_type_id', array('class' => 'form-control', 'placeholder' => 'Reading Type Id', 'default'=>'2'));?>
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
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
  tinymce.init({
    selector: 'textarea',
    plugin: 'a_tinymce_plugin',
    a_plugin_option: true,
    a_configuration_option: 400,
    menu: {
      view: {title: 'Codigo', items: 'code'}
    },
    plugins: 'code'
    });
</script>
<!--<script text="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
<script text="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>-->
<?php echo $this->Html->css(array('bootstrap-datepicker.min'));
      echo $this->Html->script(array('bootstrap-datepicker.min','bootstrap-datepicker.es.min')); 
?>