 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="conversations view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Conversation'); ?></h1>
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
                            <?php if($user == '1'): ?>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Conversation'), array('action' => 'edit', $conversation['Conversation']['id']), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Conversation'), array('action' => 'delete', $conversation['Conversation']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $conversation['Conversation']['id'])); ?> </li>
                            <?php endif; ?>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Conversations'), array('action' => 'index'), array('escape' => false)); ?> </li>
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
                            <?php echo __( 'Sender'); ?>
                        </th>
                        <td>
                            <?php echo $this->Html->link($conversation['Sender']['nombre'].' '.$conversation['Sender']['apellido'], array('controller' => 'mobile_users', 'action' => 'view', $conversation['Sender']['id'])); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Receiver'); ?>
                        </th>
                        <td>
                            <?php echo $this->Html->link($conversation['Receiver']['nombre'].' '.$conversation['Receiver']['apellido'], array('controller' => 'mobile_users', 'action' => 'view', $conversation['Receiver']['id'])); ?> &nbsp;
                        </td>
                    </tr>
                    <!--
                    <tr>
                        <th>
                            <?php echo __( 'Subject'); ?>
                        </th>
                        <td>
                            <?php echo h($conversation[ 'Conversation'][ 'subject']); ?> &nbsp;
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            <?php echo __( 'Last Reply'); ?>
                        </th>
                        <td>
                            <?php if($conversation[ 'Conversation'][ 'last_reply'] != ''): ?>
                                <?php echo h($conversation[ 'Conversation'][ 'last_reply']); ?>
                            &nbsp;
                            <?php else: ?>
                                <span class="label label-info">Sin respuesta</span>
                            <?php endif; ?>
                        </td>
                    </tr>-->
                    <tr>
                        <th>
                            <?php echo __( 'Status'); ?>
                        </th>
                        <td>
                            <span class="<?php echo $op_status[$conversation[ 'Conversation'][ 'status']]?>">
                                <?php echo $conversation[ 'Conversation'][ 'status']; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Created'); ?>
                        </th>
                        <td>
                            <?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($conversation[ 'Conversation'][ 'created']))); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Modified'); ?>
                        </th>
                        <td>
                            <?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($conversation[ 'Conversation'][ 'modified']))); ?> &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- end col md 9 -->
    </div>
</div>