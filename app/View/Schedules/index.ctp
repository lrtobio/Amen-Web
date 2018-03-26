<div class="schedules index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Schedules'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Schedule'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Schedule Types'), array('controller' => 'schedule_types', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Schedule Type'), array('controller' => 'schedule_types', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Churches'), array('controller' => 'churches', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Church'), array('controller' => 'churches', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('lunes'); ?></th>
						<th><?php echo $this->Paginator->sort('martes'); ?></th>
						<th><?php echo $this->Paginator->sort('miercoles'); ?></th>
						<th><?php echo $this->Paginator->sort('jueves'); ?></th>
						<th><?php echo $this->Paginator->sort('viernes'); ?></th>
						<th><?php echo $this->Paginator->sort('sabado'); ?></th>
						<th><?php echo $this->Paginator->sort('domingo'); ?></th>
                                                <th><?php echo $this->Paginator->sort('festivos'); ?></th>
						<th><?php echo $this->Paginator->sort('schedule_type_id'); ?></th>
						<th><?php echo $this->Paginator->sort('church_id'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($schedules as $schedule): ?>
					<tr>
						<td><?php echo h($schedule['Schedule']['lunes']); ?>&nbsp;</td>
						<td><?php echo h($schedule['Schedule']['martes']); ?>&nbsp;</td>
						<td><?php echo h($schedule['Schedule']['miercoles']); ?>&nbsp;</td>
						<td><?php echo h($schedule['Schedule']['jueves']); ?>&nbsp;</td>
						<td><?php echo h($schedule['Schedule']['viernes']); ?>&nbsp;</td>
						<td><?php echo h($schedule['Schedule']['sabado']); ?>&nbsp;</td>
						<td><?php echo h($schedule['Schedule']['domingo']); ?>&nbsp;</td>
                                                <td><?php echo h($schedule['Schedule']['festivos']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($schedule['ScheduleType']['nombre'], array('controller' => 'schedule_types', 'action' => 'view', $schedule['ScheduleType']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($schedule['Church']['nombre'], array('controller' => 'churches', 'action' => 'view', $schedule['Church']['id'])); ?>
		</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $schedule['Schedule']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $schedule['Schedule']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $schedule['Schedule']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $schedule['Schedule']['id'])); ?>
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