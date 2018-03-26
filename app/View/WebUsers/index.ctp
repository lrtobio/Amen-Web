<div class="webUsers index">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Web Users'); ?></h1>
            </div>
        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-3">
            <?php if($user == '1'): ?>
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Web User'), array('action' => 'add'), array('escape' => false)); ?></li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Webuser Profiles'), array('controller' => 'webuser_profiles', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Webuser Profile'), array('controller' => 'webuser_profiles', 'action' => 'add'), array('escape' => false)); ?> </li>
                        </ul>
                    </div>
                    <!-- end body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end actions -->
            <?php endif; ?>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <?php echo $this->Paginator->sort('email'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('password'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('webuser_profile_id'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('activo'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('created'); ?></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($webUsers as $webUser): ?>
                    <?php if($webUser['WebUser']['id']!= '1' || $user == '1'): ?>
                    <tr>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'email']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'copiapassword']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($webUser['WebuserProfile']['nombre']); ?>
                        </td>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'activo']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'created']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $webUser['WebUser']['id']), array('escape' => false)); ?>
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $webUser['WebUser']['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $webUser['WebUser']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $webUser['WebUser']['id'])); ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p>
                <small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
            </p>

            <?php $params = $this->Paginator->params(); if ($params['pageCount'] > 1) { ?>
            <ul class="pagination pagination-sm">
                <?php echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false)); echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a')); echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false)); ?>
            </ul>
            <?php } ?>

        </div>
        <!-- end col md 9 -->
    </div>
    <!-- end row -->


</div>
<!-- end containing of content -->