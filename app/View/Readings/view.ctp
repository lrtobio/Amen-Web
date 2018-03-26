 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="readings view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Reading'); ?></h1>
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
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Reading'), array('action' => 'edit', $reading['Reading']['id']), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Reading'), array('action' => 'delete', $reading['Reading']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $reading['Reading']['id'])); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Readings'), array('action' => 'index'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Reading'), array('action' => 'add'), array('escape' => false)); ?> </li>
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
                            <?php echo __( 'Titulo Es'); ?>
                        </th>
                        <td>
                            <?php echo h($reading[ 'Reading'][ 'titulo_es']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Titulo En'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'titulo_en'] != NULL && $reading[ 'Reading'][ 'titulo_en'] != ''): ?>
                                <?php echo h($reading[ 'Reading'][ 'titulo_en']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Titulo Pt'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'titulo_pt'] != NULL && $reading[ 'Reading'][ 'titulo_pt'] != ''): ?>
                                <?php echo h($reading[ 'Reading'][ 'titulo_pt']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Titulo Fr'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'titulo_fr'] != NULL && $reading[ 'Reading'][ 'titulo_fr'] != ''): ?>
                                <?php echo h($reading[ 'Reading'][ 'titulo_fr']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Titulo It'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'titulo_it'] != NULL && $reading[ 'Reading'][ 'titulo_it'] != ''): ?>
                                <?php echo h($reading[ 'Reading'][ 'titulo_it']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Descripcion Es'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'descripcion_es'] != NULL && $reading[ 'Reading'][ 'descripcion_es'] != ''): ?>
                                <?php echo htmlspecialchars_decode($reading[ 'Reading'][ 'descripcion_es']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Descripcion En'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'descripcion_en'] != NULL && $reading[ 'Reading'][ 'descripcion_en'] != ''): ?>
                                <?php echo htmlspecialchars_decode($reading[ 'Reading'][ 'descripcion_en']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Descripcion Pt'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'descripcion_pt'] != NULL && $reading[ 'Reading'][ 'descripcion_pt'] != ''): ?>
                                <?php echo htmlspecialchars_decode($reading[ 'Reading'][ 'descripcion_pt']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Descripcion Fr'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'descripcion_fr'] != NULL && $reading[ 'Reading'][ 'descripcion_fr'] != ''): ?>
                                <?php echo htmlspecialchars_decode($reading[ 'Reading'][ 'descripcion_fr']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Descripcion It'); ?>
                        </th>
                        <td>
                            <?php if($reading[ 'Reading'][ 'descripcion_it'] != NULL && $reading[ 'Reading'][ 'descripcion_it'] != ''): ?>
                                <?php echo htmlspecialchars_decode($reading[ 'Reading'][ 'descripcion_it']); ?> &nbsp;
                            <?php else: ?>
                                <label class="label label-info"><?php echo __( 'No avialable'); ?></label>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Fecha'); ?>
                        </th>
                        <td>
                            <?php echo ucwords( strftime('%B %d',  strtotime($reading[ 'Reading'][ 'fecha']))); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Reading Type'); ?>
                        </th>
                        <td>
                            <?php echo h($reading[ 'ReadingType'][ 'titulo_es']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Created'); ?>
                        </th>
                        <td>
                            <?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($reading[ 'Reading'][ 'created']))); ?> &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- end col md 9 -->

    </div>
</div>