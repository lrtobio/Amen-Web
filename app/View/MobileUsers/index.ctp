 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="mobileUsers index">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <div class="navbar-form navbar-right">
                    <b>Opciones de filtro</b>
                    <?php echo $this->Form->create('MobileUser', array('type'=>'POST','url' => array('controller' => 'mobile_users', 'action' => 'index'))); ?> 
                    <div class="form-group">
                        <?php echo $this->Form->input('search',array('class' => 'form-control input-sm','id'=>'search', 'placeholder' => 'Buscar: Nombres, Apellidos', 'label' => '', 'autocomplete'=>'off')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('estado',array('class' => 'form-control input-sm','id'=>'status', 'type' => 'select', 'label' => '', 'options'=>array('A'=>'Activo', 'I'=>'Inactivo', 'V'=>'Verificado'), 'empty'=>'Estados')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('perfil',array('class' => 'form-control input-sm','id'=>'perfil', 'type' => 'select', 'label' => '', 'options'=>array('1'=>'Feligrés', '2'=>'Religioso(a)'), 'empty'=>'Perfiles')); ?>
                       
                    </div>
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Buscar'), array('class' => 'btn btn-default btn-sm')); ?>
                    </div>  
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Limpiar'), array('class' => 'btn btn-default btn-sm', 'onclick'=>'clearSearch()')); ?>
                    </div> 
                    <?php echo $this->Form->end(); ?>

                </div>
                <h1><?php echo __('Mobile Users'); ?></h1>
            </div>
        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Churches'), array('controller' => 'churches', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Church'), array('controller' => 'churches', 'action' => 'add'), array('escape' => false)); ?> </li>
                        </ul>
                    </div>
                    <!-- end body -->
                </div>
                <!-- end panel -->
            </div>
            <!-- end actions -->
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                      <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer">
                        <h4 class="panel-title">
                            Resultado filtros
                        </h4>
                      </div>
                      <div id="collapse1" class="panel-collapse collapse in">
                        <ul class="list-group">
                            <li class="list-group-item" style="font-size: medium"><span class="badge" style=" background-color:  #82af6f!important; font-size: small" ><?php echo $this->Paginator->counter(array('format' => __('{:count}')));?></span> Registros</li>
                        </ul>
                      </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer">
                        <h4 class="panel-title">
                              Estados
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                      <ul class="list-group">
                        <?php foreach ($dataStatus as $estado): ?>  
                          <li class="list-group-item" style="font-size: medium"><?php echo h($opciones_status[$estado[ 'MobileUser'][ 'status']]['status']); ?><span class="badge" style="<?php echo h($opciones_status[$estado[ 'MobileUser'][ 'status']]['style']); ?>"><?php echo h($estado[ 'MobileUser'][ 'items']); ?></span></li>
                        <?php endforeach; ?>  
                      </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer">
                        <h4 class="panel-title">
                            Perfiles
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <ul class="list-group">
                        <?php foreach ($dataProfile as $profile): ?>  
                          <li class="list-group-item" style="font-size: medium"><?php echo h($profile[ 'MobileuserProfile'][ 'titulo_es']); ?><span class="badge" style=" background-color:  #257cb6 !important; font-size: small"><?php echo h($profile[ 'MobileUser'][ 'items']); ?></span></li>
                        <?php endforeach; ?>  
                      </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <?php echo $this->Paginator->sort('foto'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('nombre'); ?> &nbsp; <?php echo $this->Paginator->sort('email'); ?></th>
                        <!--<th>
                            <?php echo $this->Paginator->sort('email'); ?></th>-->
                        <th>
                            <?php echo $this->Paginator->sort('mobileuser_profile_id'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('created'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('status'); ?></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mobileUsers as $mobileUser): ?>
                    <tr>
                        <td>
                            <?php if($mobileUser['MobileUser']['foto'] != '' && $mobileUser['MobileUser']['foto'] != null): ?>
                            <img src=" <?php echo h($mobileUser[ 'MobileUser'][ 'foto']) ?>"  class="avatar">
                        <?php else: ?>
                            <img src="http://placehold.it/50x50" alt="" class="avatar" />
                        <?php endif; ?>
                        </td>
                        <td>
                            <h4><?php echo h($mobileUser[ 'MobileUser'][ 'nombre']); ?>&nbsp;</h4>
                            <div><?php echo h($mobileUser[ 'MobileUser'][ 'email']); ?>&nbsp;</div>
                            </td>
                            
                        <!--<td>
                            <?php echo h($mobileUser[ 'MobileUser'][ 'email']); ?>&nbsp;</td>-->
                        <td>
                            <?php echo $this->Html->link($mobileUser['MobileuserProfile']['titulo_es'], array('controller' => 'mobileuser_profiles', 'action' => 'view', $mobileUser['MobileuserProfile']['id'])); ?>
                        </td>
                        <td>
                            <?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($mobileUser[ 'MobileUser'][ 'created']))); ?>&nbsp;</td>
                        <td>
                            <span class="<?php echo $opciones_status[$mobileUser[ 'MobileUser'][ 'status']]['label']?> ">
                                <?php echo $opciones_status[$mobileUser[ 'MobileUser'][ 'status']]['status']?> &nbsp;
                            </span>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $mobileUser['MobileUser']['id']), array('escape' => false)); ?>
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $mobileUser['MobileUser']['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $mobileUser['MobileUser']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $mobileUser['MobileUser']['id'])); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>
                <small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
            </p>
            <?php $params= $this->Paginator->params(); if ($params['pageCount'] > 1) { ?>
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
<script type="text/javascript">
    function clearSearch(){
        document.getElementById('search').value = '';
        document.getElementById('status').value = '';
        document.getElementById('perfil').value = '';
    }
</script>