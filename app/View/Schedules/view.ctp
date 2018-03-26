<div class="schedules view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Schedule'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Schedule'), array('action' => 'edit', $schedule['Schedule']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Schedule'), array('action' => 'delete', $schedule['Schedule']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $schedule['Schedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Schedules'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Schedule'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Schedule Types'), array('controller' => 'schedule_types', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Schedule Type'), array('controller' => 'schedule_types', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Churches'), array('controller' => 'churches', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Church'), array('controller' => 'churches', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($schedule['Schedule']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Lunes'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['lunes']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Martes'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['martes']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Miercoles'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['miercoles']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Jueves'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['jueves']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Viernes'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['viernes']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sabado'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['sabado']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Domingo'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['domingo']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Festivos'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['festivos']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Schedule Type'); ?></th>
		<td>
			<?php echo $this->Html->link($schedule['ScheduleType']['id'], array('controller' => 'schedule_types', 'action' => 'view', $schedule['ScheduleType']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Church'); ?></th>
		<td>
			<?php echo $this->Html->link($schedule['Church']['id'], array('controller' => 'churches', 'action' => 'view', $schedule['Church']['id'])); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

