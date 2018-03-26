<div class="dailyMessages form">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Editar Mensaje'); ?></h1>
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
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('DailyMessage.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('DailyMessage.id'))); ?></li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Daily Messages'), array('action' => 'index'), array('escape' => false)); ?></li>
                          
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('DailyMessage', array('role' => 'form')); ?>

            <div class="form-group">
                <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('mobile_user_id', array('class' => 'form-control', 'placeholder' => 'Mobile User Id', 'disabled'=>'disabled'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('title', array('class' => 'form-control', 'placeholder' => 'Titulo'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('message', array('class' => 'form-control', 'placeholder' => 'Message'));?>
            </div>
            <!--<div class="form-group">
                <?php echo $this->Form->input('private_message', array('class' => 'form-control', 'placeholder' => 'Private Message'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('latitude', array('class' => 'form-control', 'placeholder' => 'Latitude'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('longitude', array('class' => 'form-control', 'placeholder' => 'Longitude'));?>
            </div>-->
            <div class="form-group">
                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
            </div>

            <?php echo $this->Form->end() ?>

        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
</div>