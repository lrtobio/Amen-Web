<div class="webUsers form">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Edit Web User'); ?></h1>
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
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('WebUser.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('WebUser.id'))); ?></li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Web Users'), array('action' => 'index'), array('escape' => false)); ?></li>
                            <?php if ($user == '1'): ?>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Webuser Profiles'), array('controller' => 'webuser_profiles', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Webuser Profile'), array('controller' => 'webuser_profiles', 'action' => 'add'), array('escape' => false)); ?> </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('WebUser', array('role' => 'form')); ?>

            <div class="form-group">
                <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('copiapassword', array('class' => 'form-control', 'placeholder' => 'Copiapassword'));?>
            </div>
            <?php if ($user == '1'): ?>
            <div class="form-group">
                <?php echo $this->Form->input('webuser_profile_id', array('class' => 'form-control', 'placeholder' => 'Webuser Profile Id'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('activo', array('class' => 'form-control', 'type' => 'select', 'options'=>array('SI'=>'SI', 'NO'=>'NO')));?>
            </div>
            <?php endif; ?>   
            <div class="form-group">
                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
            </div>

            <?php echo $this->Form->end() ?>

        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
</div>