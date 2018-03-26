<div class="dailyMessages view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Daily Message'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Daily Message'), array('action' => 'edit', $dailyMessage['DailyMessage']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Daily Message'), array('action' => 'delete', $dailyMessage['DailyMessage']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $dailyMessage['DailyMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Daily Messages'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Daily Message'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Mobile Users'), array('controller' => 'mobile_users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Mobile User'), array('controller' => 'mobile_users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($dailyMessage['DailyMessage']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mobile User'); ?></th>
		<td>
			<?php echo $this->Html->link($dailyMessage['MobileUser']['nombre'], array('controller' => 'mobile_users', 'action' => 'view', $dailyMessage['MobileUser']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Message'); ?></th>
		<td>
			<?php echo h($dailyMessage['DailyMessage']['message']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Private Message'); ?></th>
		<td>
			<?php echo h($dailyMessage['DailyMessage']['private_message']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($dailyMessage['DailyMessage']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Latitude'); ?></th>
		<td>
			<?php echo h($dailyMessage['DailyMessage']['latitude']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Longitude'); ?></th>
		<td>
			<?php echo h($dailyMessage['DailyMessage']['longitude']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($dailyMessage['DailyMessage']['created']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

