 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="churches index">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <div class="navbar-form navbar-right">
                    <b>Opciones de filtro</b>
                    <?php echo $this->Form->create('Church', array('type'=>'POST','url' => array('controller' => 'churches', 'action' => 'index'))); ?> 
                    <!--<div class="form-group">
                        <?php echo $this->Paginator->sort('modificado', array('class'=>'btn btn-default btn-sm')); ?>
                    </div>-->
                    <div class="form-group">
                        <?php echo $this->Form->input('country',array('class' => 'form-control input-sm','id'=>'country', 'type' => 'select', 'label' => '', 'options'=>$countries, 'empty'=>'Paises')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('search',array('class' => 'form-control input-sm','id'=>'search', 'placeholder' => 'Buscar: Nombre, email, direccion', 'label' => '', 'autocomplete'=>'off')); ?>
                       
                    </div>
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-default btn-sm')); ?>
                    </div>
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Clear'), array('class' => 'btn btn-default btn-sm', 'onclick'=>'clearSearch()')); ?>
                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>
                <h1><?php echo __('Churches'); ?></h1>
            </div>
        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4 class="panel-title">
                      Acciones
                  </h4></div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;View Map'), array('action' => 'map'), array('escape' => false)); ?></li>
                            <li>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Church'), array('action' => 'add'), array('escape' => false)); ?></li>
                        </ul>
                    </div>
                    <!-- end body -->
                </div>
                <!-- end panel -->
            </div>
            
            <!-- end actions -->
            <!--<div class="row">-->
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                              <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer">
                                <h4 class="panel-title">
                                    Resultado filtros
                                </h4>
                              </div>
                              <div id="collapse1" class="panel-collapse collapse in">
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="badge" style=" background-color:  #82af6f!important"><?php echo $this->Paginator->counter(array('format' => __('{:count}')));?></span> Registros</li>
                                </ul>
                              </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer">
                                <h4 class="panel-title">
                                      Top 5 Paises
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                              <ul class="list-group">
                                <?php foreach ($dataChurches as $church): ?>  
                                  <li class="list-group-item"><span class="badge" style="background-color: #2283c5!important "><?php echo h($church[ 'Church'][ 'count_country']); ?></span><?php echo h($church[ 'Country'][ 'nombre']); ?></li>
                                <?php endforeach; ?>  
                              </ul>
                            </div>
                        </div>
                        
                    </div>
                <!--</div>-->
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <!--
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <?php echo $this->Paginator->sort('nombre'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('direccion'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('email'); ?></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($churches as $church): ?>
                    
                    <tr>
                        <td>
                            <?php echo h($church[ 'Church'][ 'nombre']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($church[ 'Church'][ 'direccion']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($church[ 'Church'][ 'email']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $church['Church']['id']), array('escape' => false)); ?>
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $church['Church']['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $church['Church']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $church['Church']['id'])); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>-->
                            <?php foreach ($churches as $church): ?>
            <div class="business-card block-update-card status">
                <div class="update-card-body">
                <div class="media update-card-body">
                    <div class="card-action-pellet btn-toolbar pull-right">
                        <div class="btn-group ">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $church['Church']['id']), array('escape' => false)); ?>
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $church['Church']['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $church['Church']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $church['Church']['nombre'])); ?>
                        </div>
                    </div>
                    <!--
                    <div class="media-left">
                        <?php if($mobileUser[ 'MobileUser'][ 'foto']!= ''): ?>
                            <img class="avatar" src="<?php echo h($mobileUser[ 'MobileUser'][ 'foto']); ?>">
                        <?php else: ?>
                            <img class="avatar" src="http://s3.amazonaws.com/37assets/svn/765-default-avatar.png">
                        <?php endif; ?>
                    </div>-->
                    <div class="media-body">
                        <h3 class="media-heading"><?php echo h($church[ 'Church'][ 'nombre']); ?></h3>
                        <div class="job"><?php echo h($church[ 'Church'][ 'direccion']); ?></div>
                        <div class="mail"><?php echo h($church[ 'Church'][ 'email']); ?></div>
                        <br/>
                        <div class="small" style="color: #5e5e5e;"><?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($church[ 'Church'][ 'modified']))); ?></div>
                    </div>
                    
                    <div class=" btn-toolbar pull-right">
                        
                    </div>
                </div> 
                </div>
            </div>
            <?php endforeach; ?>
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
        document.getElementById('country').value = '';
    }
</script>