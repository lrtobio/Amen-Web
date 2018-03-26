<div class="favorites view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Favorite'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Favorite'), array('action' => 'edit', $favorite['Favorite']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Favorite'), array('action' => 'delete', $favorite['Favorite']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $favorite['Favorite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Favorites'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Favorite'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Mobile Users'), array('controller' => 'mobile_users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Mobile User'), array('controller' => 'mobile_users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Favorites'), array('controller' => 'favorites', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Favorite'), array('controller' => 'favorites', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($favorite['Favorite']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mobile User'); ?></th>
		<td>
			<?php echo $this->Html->link($favorite['MobileUser']['nombre'], array('controller' => 'mobile_users', 'action' => 'view', $favorite['MobileUser']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type Id'); ?></th>
		<td>
			<?php echo h($favorite['Favorite']['type_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Favorite Id'); ?></th>
		<td>
			<?php echo h($favorite['Favorite']['favorite_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($favorite['Favorite']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Titulo'); ?></th>
		<td>
			<?php echo h($favorite['Favorite']['titulo']); ?>
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
	<h3><?php echo __('Related Favorites'); ?></h3>
	<?php if (!empty($favorite['Favorite'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mobile User Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Favorite Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Titulo'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($favorite['Favorite'] as $favorite): ?>
		<tr>
			<td><?php echo $favorite['id']; ?></td>
			<td><?php echo $favorite['mobile_user_id']; ?></td>
			<td><?php echo $favorite['type_id']; ?></td>
			<td><?php echo $favorite['favorite_id']; ?></td>
			<td><?php echo $favorite['created']; ?></td>
			<td><?php echo $favorite['titulo']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'favorites', 'action' => 'view', $favorite['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'favorites', 'action' => 'edit', $favorite['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'favorites', 'action' => 'delete', $favorite['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $favorite['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Favorite'), array('controller' => 'favorites', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
