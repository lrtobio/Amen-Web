<div class="readings form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Reading'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Reading.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Reading.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Readings'), array('action' => 'index'), array('escape' => false)); ?></li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Reading', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
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
					<?php echo $this->Form->input('descripcion_es', array('class' => 'form-control', 'placeholder' => 'Descripcion Es'));?>
				</div>
                                
				<div class="form-group">
					<?php echo $this->Form->input('descripcion_en', array('class' => 'form-control', 'placeholder' => 'Descripcion En'));?>
				</div>
                                <div class="form-group">
					<?php echo $this->Form->input('descripcion_pt', array('class' => 'form-control', 'placeholder' => 'Descripcion Pt'));?>
				</div>
                                <div class="form-group">
                                    <?php echo $this->Form->input('descripcion_fr', array('class' => 'form-control', 'placeholder' => 'Descripcion Fr'));?>
                                </div>
                                <div class="form-group">
                                    <?php echo $this->Form->input('descripcion_it', array('class' => 'form-control', 'placeholder' => 'Descripcion It'));?>
                                </div>
				<div class="form-group">
                                    <?php echo $this->Form->input('fecha', array('type' => 'text', 'class' => 'form-control', 'readonly', 'label'=>'Fecha', 'readonly')); ?>
                                </div>
				<div class="form-group">
					<?php echo $this->Form->input('reading_type_id', array('class' => 'form-control', 'placeholder' => 'Reading Type Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
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