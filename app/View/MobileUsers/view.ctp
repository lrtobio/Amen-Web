 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="mobileUsers view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Mobile User'); ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Acciones</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Mobile User'), array('action' => 'edit', $mobileUser['MobileUser']['id']), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Mobile User'), array('action' => 'delete', $mobileUser['MobileUser']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $mobileUser['MobileUser']['id'])); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Mobile Users'), array('action' => 'index'), array('escape' => false)); ?> </li>
                        </ul>
                        
                    </div>
                    <!-- end body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end actions -->
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Estadísticas</div>
                    <div class="panel-collapse">
                        <ul class="list-group">
                            <li class="list-group-item"><span class="badge" style="background-color: #2283c5!important "><?php echo h(count ($mobileUser[ 'Church'])); ?></span>Iglesias creadas</li>
                            <?php if($mobileUser[ 'MobileuserProfile']['id'] == '2'): ?>
                            <li class="list-group-item"><span class="badge" style="background-color: #2283c5!important "><?php echo h(count ($mobileUser[ 'DailyMessage'])); ?></span>Mensajes diarios</li>
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
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <?php if($mobileUser['MobileUser']['foto'] != '' && $mobileUser['MobileUser']['foto'] != null): ?>
                        <img src="<?php echo h($mobileUser[ 'MobileUser'][ 'foto']); ?>" alt="" class="img-rounded img-responsive" style="width: 400px; height: 400px"/>
                        <!--<div class="img-rounded img-responsive" style="background: url('<?php echo h($mobileUser[ 'MobileUser'][ 'foto']); ?>'); width: 380px; height: 400px;"></div>-->
                        <?php else: ?>
                            <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" style="width: 400px; height: 400px"/>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h3>
                            <?php echo strtoupper($mobileUser[ 'MobileUser'][ 'nombre'] .' '. $mobileUser['MobileUser']['apellido']); ?></h3>
                        <h4 class="h4-formated"><?php echo h($mobileUser[ 'MobileuserProfile'][ 'titulo_es']); ?></h4>
                        <h4 class="h4-formated"><cite title="<?php echo h($mobileUser[ 'Country'][ 'nombre']); ?>"> <?php echo h($mobileUser[ 'Country'][ 'nombre']); ?> <!--<?php echo $this->Html->link($mobileUser['Country']['nombre'], array('controller' => 'cities', 'action' => 'view', $mobileUser['City']['id'])); ?> --> &nbsp;<i class="glyphicon glyphicon-map-marker"></i></cite></h4>
                        <br/>
                        <p style="font-size: medium">
                            <i class="glyphicon glyphicon-envelope"></i><?php echo h($mobileUser[ 'MobileUser'][ 'email']); ?>
                            <br />
                            <i class="glyphicon glyphicon-lock"></i><?php echo h($mobileUser[ 'MobileUser'][ 'password']); ?>
                            <br/>
                            <?php if($mobileUser[ 'MobileUser'][ 'telefono'] != ''): ?>
                            <i class="glyphicon glyphicon-phone-alt"></i><?php echo h($mobileUser[ 'MobileUser'][ 'telefono']); ?>
                            <br />
                            <?php endif; ?>
                            <i class="glyphicon glyphicon-gift"></i><?php echo h($mobileUser[ 'MobileUser'][ 'fechanacimiento']); ?>
                        <!-- Split button -->
                        </p>
                        <br/>
                        
                            <table cellpadding="0" cellspacing="0" class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Status'); ?>
                                        </th>
                                        <td>
                                            <span class="<?php echo $opciones_status[$mobileUser[ 'MobileUser'][ 'status']]['label']?> ">
                                                <?php echo $opciones_status[$mobileUser[ 'MobileUser'][ 'status']]['status']?> &nbsp;
                                            </span>
                                        </td>
                                    </tr>
                                     <?php if($mobileUser[ 'MobileUser'][ 'comunidad'] != ''): ?>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Comunidad'); ?>
                                        </th>
                                        <td>
                                            <?php echo h($mobileUser[ 'MobileUser'][ 'comunidad']); ?> &nbsp;
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($mobileUser[ 'MobileUser'][ 'consagracion'] != ''): ?>
                                     <tr>
                                        <th>
                                            <?php echo __( 'Consagracion'); ?>
                                        </th>
                                        <td>
                                            <?php echo h($mobileUser[ 'MobileUser'][ 'consagracion']); ?> &nbsp;
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($mobileUser[ 'MobileUser'][ 'locale'] != ''): ?>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Locale'); ?>
                                        </th>
                                        <td>
                                            <?php echo h($mobileUser[ 'MobileUser'][ 'locale']); ?> &nbsp;
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Created'); ?>
                                        </th>
                                        <td>
                                            <?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($mobileUser[ 'MobileUser'][ 'created']))); ?> &nbsp;
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- Split button -->                        
                    </div>
                </div>
            </div>
        </div>
        <!-- end col md 9 -->
    </div>
    <div class="related row">
    <div class="col-md-12">
        <?php if (!empty($mobileUser['Church'])): ?>
        <h3><?php echo __('Churches'); ?></h3>
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <?php echo __( 'Nombre'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Direccion'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Created'); ?>
                    </th>                   
                    <th class="actions"></th>
                </tr>
                <thead>
                    <tbody>
                        <?php foreach ($mobileUser[ 'Church'] as $church): ?>
                        <tr>
                            <td>
                                <?php echo $church[ 'nombre']; ?>
                            </td>
                            <td>
                                <?php echo $church[ 'direccion']; ?>
                            </td>
                            <td>
                                <?php echo $church[ 'created']; ?>
                            </td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'churches', 'action' => 'view', $church['id']), array('escape' => false)); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
        </table>
        <?php endif; ?>

    </div>
</div>
</div>
