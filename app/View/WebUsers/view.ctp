<div class="webUsers view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Web User'); ?></h1>
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
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Web User'), array('action' => 'edit', $webUser['WebUser']['id']), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Web User'), array('action' => 'delete', $webUser['WebUser']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $webUser['WebUser']['id'])); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Web Users'), array('action' => 'index'), array('escape' => false)); ?></li>
                            <?php if ($user == '1'): ?>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Web User'), array('action' => 'add'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Webuser Profiles'), array('controller' => 'webuser_profiles', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Webuser Profile'), array('controller' => 'webuser_profiles', 'action' => 'add'), array('escape' => false)); ?> </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- end body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end actions -->
        </div>
        <!-- end col md 3 -->

        <div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo __( 'Email'); ?>
                        </th>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'email']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Password'); ?>
                        </th>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'copiapassword']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Webuser Profile'); ?>
                        </th>
                        <td>
                            <?php echo h($webUser['WebuserProfile']['nombre']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Activo'); ?>
                        </th>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'activo']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Created'); ?>
                        </th>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'created']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Modified'); ?>
                        </th>
                        <td>
                            <?php echo h($webUser[ 'WebUser'][ 'modified']); ?> &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- end col md 9 -->

    </div>
</div>