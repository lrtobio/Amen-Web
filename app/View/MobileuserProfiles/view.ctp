<div class="mobileuserProfiles view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Mobileuser Profile'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Mobileuser Profile'), array('action' => 'edit', $mobileuserProfile['MobileuserProfile']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Mobileuser Profile'), array('action' => 'delete', $mobileuserProfile['MobileuserProfile']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $mobileuserProfile['MobileuserProfile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Mobileuser Profiles'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Mobileuser Profile'), array('action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($mobileuserProfile['MobileuserProfile']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Titulo'); ?></th>
		<td>
			<?php echo h($mobileuserProfile['MobileuserProfile']['titulo_es']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Descripcion'); ?></th>
		<td>
			<?php echo h($mobileuserProfile['MobileuserProfile']['descripcion']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($mobileuserProfile['MobileuserProfile']['created']); ?>
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
	<h3><?php echo __('Related Mobile Users'); ?></h3>
	<?php if (!empty($mobileuserProfile['MobileUser'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Mobileuser Profile Id'); ?></th>
		<th><?php echo __('Foto'); ?></th>
		<th><?php echo __('Locale'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($mobileuserProfile['MobileUser'] as $mobileUser): ?>
		<tr>
			<td><?php echo $mobileUser['id']; ?></td>
			<td><?php echo $mobileUser['nombre']; ?></td>
			<td><?php echo $mobileUser['email']; ?></td>
			<td><?php echo $mobileUser['password']; ?></td>
			<td><?php echo $mobileUser['mobileuser_profile_id']; ?></td>
			<td><?php echo $mobileUser['foto']; ?></td>
			<td><?php echo $mobileUser['locale']; ?></td>
			<td><?php echo $mobileUser['city_id']; ?></td>
			<td><?php echo $mobileUser['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'mobile_users', 'action' => 'view', $mobileUser['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'mobile_users', 'action' => 'edit', $mobileUser['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'mobile_users', 'action' => 'delete', $mobileUser['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $mobileUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Mobile User'), array('controller' => 'mobile_users', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
