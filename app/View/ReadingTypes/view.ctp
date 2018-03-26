<div class="readingTypes view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Reading Type'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Reading Type'), array('action' => 'edit', $readingType['ReadingType']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Reading Type'), array('action' => 'delete', $readingType['ReadingType']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $readingType['ReadingType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Reading Types'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Reading Type'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Readings'), array('controller' => 'readings', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Reading'), array('controller' => 'readings', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($readingType['ReadingType']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Titulo Es'); ?></th>
		<td>
			<?php echo h($readingType['ReadingType']['titulo_es']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Titulo En'); ?></th>
		<td>
			<?php echo h($readingType['ReadingType']['titulo_en']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($readingType['ReadingType']['created']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Readings'); ?></h3>
	<?php if (!empty($readingType['Reading'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Titulo Es'); ?></th>
		<th><?php echo __('Titulo En'); ?></th>
		<th><?php echo __('Descripcion Es'); ?></th>
		<th><?php echo __('Descripcion En'); ?></th>
		<th><?php echo __('Fecha'); ?></th>
		<th><?php echo __('Reading Type Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($readingType['Reading'] as $reading): ?>
		<tr>
			<td><?php echo $reading['id']; ?></td>
			<td><?php echo $reading['titulo_es']; ?></td>
			<td><?php echo $reading['titulo_en']; ?></td>
			<td><?php echo $reading['descripcion_es']; ?></td>
			<td><?php echo $reading['descripcion_en']; ?></td>
			<td><?php echo $reading['fecha']; ?></td>
			<td><?php echo $reading['reading_type_id']; ?></td>
			<td><?php echo $reading['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'readings', 'action' => 'view', $reading['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'readings', 'action' => 'edit', $reading['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'readings', 'action' => 'delete', $reading['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $reading['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Reading'), array('controller' => 'readings', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
