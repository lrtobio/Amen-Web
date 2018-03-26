 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="churches view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Church'); ?></h1>
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
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Church'), array('action' => 'edit', $church['Church']['id']), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Church'), array('action' => 'delete', $church['Church']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $church['Church']['nombre'])); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Churches'), array('action' => 'index'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Church'), array('action' => 'add'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-calendar"></span>&nbsp&nbsp;New Schedule'), array('controller' => 'schedules', 'action' => 'add/'.$church[ 'Church'][ 'id']), array('escape' => false)); ?> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo __( 'Nombre'); ?>
                        </th>
                        <td>
                            <?php echo h($church[ 'Church'][ 'nombre']); ?> &nbsp;
                        </td>
                    </tr>
                    <?php if(!empty($church[ 'Church'][ 'comunidad'])): ?>
                    <tr>
                        <th>
                            <?php echo __( 'Pertenece a la comunidad'); ?>
                        </th>
                        <td>
                            <?php echo h($church[ 'Church'][ 'comunidad']); ?> &nbsp;
                        </td>

                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>
                            <?php echo __( 'Direccion'); ?>
                        </th>
                        <td>
                            <?php echo h($church[ 'Church'][ 'direccion']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Telefonos'); ?>
                        </th>
                        <td>
                            <?php if(!empty($church[ 'Church'][ 'telefonos'])): echo h($church[ 'Church'][ 'telefonos']); else: echo __( 'Telefonos no disponible'); endif; ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Latitud'); ?>
                        </th>
                        <td>
                            <?php echo h($church[ 'Church'][ 'latitud']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Longitud'); ?>
                        </th>
                        <td>
                            <?php echo h($church[ 'Church'][ 'longitud']); ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Email'); ?>
                        </th>
                        <td>
                            <?php if(!empty($church[ 'Church'][ 'email'])): echo h($church[ 'Church'][ 'email']); else: echo __( 'Correo electrónico no disponible.'); endif; ?> &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo __( 'Sitio Web'); ?>
                        </th>
                        <td>
                            <?php if(!empty($church[ 'Church'][ 'direccion_web'])): echo h($church[ 'Church'][ 'direccion_web']); else: echo __( 'Sitio web no disponible.'); endif; ?> &nbsp;
                        </td>
                    </tr>
                    <?php if (!empty($church[ 'MobileUser'][ 'id'])): ?>
                    <tr>                        
                        <th>
                            <?php echo __( 'Mobile User'); ?>
                        </th>
                        <td>
                            <?php echo $this->Html->link($church['MobileUser']['nombre'], array('controller' => 'mobile_users', 'action' => 'view', $church['MobileUser']['id'])); ?> &nbsp;
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>
                            <?php echo __( 'Country'); ?>
                        </th>
                        <td>
                            <?php echo h($church['Country']['nombre']); ?> &nbsp;
                        </td>
                    </tr>
                    <?php if(!empty($church[ 'Church'][ 'observaciones'])): ?>
                    <tr>                        
                        <th>
                            <?php echo __( 'Observaciones'); ?>
                        </th>
                        <td>
                            <?php echo h($church[ 'Church'][ 'observaciones']); ?> &nbsp;
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>
                            <?php echo __( 'Modified'); ?>
                        </th>
                        <td>
                            <?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($church[ 'Church'][ 'modified']))); ?> &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div id="map_canvas" style="pointer-events: none;"></div>
        </div>
    </div>
</div>
<div class="related row">
    <div class="col-md-12">
        <h3><?php echo __('Related Schedules'); ?></h3>
        <?php if (!empty($church[ 'Schedule'])): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <?php echo __( 'Schedule Type Id'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Lunes'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Martes'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Miercoles'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Jueves'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Viernes'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Sabado'); ?>
                    </th>
                    <th>
                        <?php echo __( 'Domingo'); ?>
                    </th>  
                    <th>
                        <?php echo __( 'Festivos'); ?>
                    </th> 
                    <th class="actions"></th>
                </tr>
                <thead>
                    <tbody>
                        <?php foreach ($church[ 'Schedule'] as $schedule): ?>
                        <tr>
                            <td>
                                <?php echo $schedule_list[$schedule[ 'schedule_type_id']]; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'lunes']; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'martes']; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'miercoles']; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'jueves']; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'viernes']; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'sabado']; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'domingo']; ?>
                            </td>
                            <td>
                                <?php echo $schedule[ 'festivos']; ?>
                            </td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'schedules', 'action' => 'edit', $schedule['id']), array('escape' => false)); ?>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'schedules', 'action' => 'delete', $schedule['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $schedule_list[$schedule[ 'schedule_type_id']])); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
        </table>
        <?php endif; ?>
        <?php echo $this->Form->input('latitud', array('id'=>'lat','type'=>'hidden', 'value'=> $church[ 'Church'][ 'latitud'], 'label' => 'Latiutd'));?>
        <?php echo $this->Form->input('longitud', array('id'=>'long','type'=>'hidden','value'=> $church[ 'Church'][ 'longitud'] , 'label' => 'Longitud',));?>

    </div>
</div>

<?php echo $this->Html->script(array('scriptsMap')); ?>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>

<script>
    localize("edit");
    
</script>