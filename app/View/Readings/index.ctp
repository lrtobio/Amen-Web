 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="readings index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Readings'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Reading'), array('action' => 'add'), array('escape' => false)); ?></li>
		<!--<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Reading Type'), array('controller' => 'reading_types', 'action' => 'add'), array('escape' => false)); ?> </li>-->
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('titulo_es', 'Titulo'); ?></th>
						<!--<th><?php echo $this->Paginator->sort('titulo_en'); ?></th>-->
						<!--<th><?php echo $this->Paginator->sort('descripcion_es'); ?></th>
						<th><?php echo $this->Paginator->sort('descripcion_en'); ?></th>-->
						<th><?php echo $this->Paginator->sort('fecha'); ?></th>
						<th><?php echo $this->Paginator->sort('reading_type_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
                                                <th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($readings as $reading): ?>
					<tr>
						<td><?php echo h($reading['Reading']['titulo_es']); ?>&nbsp;</td>
						<!--<td><?php echo h($reading['Reading']['titulo_en']); ?>&nbsp;</td>-->
						<!--<td><?php echo h($reading['Reading']['descripcion_es']); ?>&nbsp;</td>
						<td><?php echo h($reading['Reading']['descripcion_en']); ?>&nbsp;</td>-->
						<td><?php echo ucwords( strftime('%B %d',  strtotime($reading[ 'Reading'][ 'fecha']))); ?>&nbsp;</td>
								<td>
                                                                 <?php echo h($reading['ReadingType']['titulo_es']); ?>   
		</td>
						<td><?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($reading[ 'Reading'][ 'created']))); ?>&nbsp;</td>
                                                <td><?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($reading[ 'Reading'][ 'modified']))); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $reading['Reading']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $reading['Reading']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $reading['Reading']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $reading['Reading']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->