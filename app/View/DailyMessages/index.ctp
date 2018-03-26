 <?php setlocale (LC_TIME, "es_ES"); ?>
<div class="dailyMessages index">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <div class="navbar-form navbar-right">
                    <b>Opciones de filtro</b>
                    <?php echo $this->Form->create('DailyMessage', array('type'=>'POST','url' => array('controller' => 'daily_messages', 'action' => 'index'))); ?> 
              
                    <div class="form-group">
                        <?php echo $this->Form->input('country',array('class' => 'form-control input-sm','id'=>'country', 'type' => 'select', 'label' => '', 'options'=>$countries, 'empty'=>'Paises')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('locale',array('class' => 'form-control input-sm','id'=>'locale', 'type' => 'select', 'label' => '', 'options'=>$locales, 'empty'=>'Idiomas')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('search',array('class' => 'form-control input-sm','id'=>'search', 'placeholder' => 'Buscar: Nombre, Mensaje, Titulo', 'label' => '', 'autocomplete'=>'off')); ?>
                       
                    </div>
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-default btn-sm')); ?>
                    </div>
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Clear'), array('class' => 'btn btn-default btn-sm', 'onclick'=>'clearSearch()')); ?>
                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>
                <h1><?php echo __('Mensajes del Día'); ?></h1>
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
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Mobile Users'), array('controller' => 'mobile_users', 'action' => 'index'), array('escape' => false)); ?> </li>
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
                        <?php foreach ($dataCountries as $country): ?>  
                          <li class="list-group-item"><span class="badge" style="background-color: #2283c5!important "><?php echo h($country[ 'DailyMessage'][ 'count_items']); ?></span><?php echo h($countries[$country[ 'MobileUser'][ 'country_id']] ); ?></li>
                        <?php endforeach; ?>  
                      </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer">
                      <h4 class="panel-title">
                           Idiomas
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <ul class="list-group">
                        <?php foreach ($dataLocale as $locale): ?>  
                          <li class="list-group-item"><span class="badge" style="background-color: #2283c5!important "><?php echo h($locale[ 'DailyMessage'][ 'count_items']); ?></span><?php echo h($locales[$locale[ 'MobileUser'][ 'locale']]); ?></li>
                        <?php endforeach; ?>  
                      </ul>
                    </div>
                </div>
            </div>
            <!-- end acordion -->
        </div>
        <!-- end col md 3 -->

        <div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <?php echo $this->Paginator->sort('mobile_user_id'); ?></th>
                     
                        <!--<th>
                            <?php echo $this->Paginator->sort('private_message'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('status'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('latitude'); ?></th>
                        <th>
                            <?php echo $this->Paginator->sort('longitude'); ?></th>-->
                        <th>
                            <?php echo $this->Paginator->sort('created'); ?></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody id="accordion">
                    <tr></tr>
                    <?php foreach ($dailyMessages as $dailyMessage): ?>
                    <tr>
                        <td >
                            <div class="small">
                                <?php echo $this->Html->link($dailyMessage['MobileUser']['nombre'], array('controller' => 'mobile_users', 'action' => 'view', $dailyMessage['MobileUser']['id'])); ?>
                            </div>
                            <div>
                                <!--<?php if(strlen($dailyMessage[ 'DailyMessage'][ 'message'])> 49): ?>
                                <?php echo h(substr($dailyMessage[ 'DailyMessage'][ 'message'],0,49).'...'); ?>

                                <?php else: ?>
                                <?php echo h($dailyMessage[ 'DailyMessage'][ 'message']); ?>
                                <?php endif; ?>-->
                                <?php echo h($dailyMessage[ 'DailyMessage'][ 'title']); ?>
                            </div>
                            &nbsp;
                        </td>
                        <!--<td>
                            <?php echo h($dailyMessage[ 'DailyMessage'][ 'private_message']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($dailyMessage[ 'DailyMessage'][ 'status']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($dailyMessage[ 'DailyMessage'][ 'latitude']); ?>&nbsp;</td>
                        <td>
                            <?php echo h($dailyMessage[ 'DailyMessage'][ 'longitude']); ?>&nbsp;</td>-->
                        <td>
                            <div class="small" style="color: #5e5e5e;"><?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($dailyMessage[ 'DailyMessage'][ 'created']))); ?></div>&nbsp;</td>
                        <td class="actions">
                            <a class="glyphicon glyphicon-eye-open" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo h($dailyMessage[ 'DailyMessage'][ 'id']); ?>"></a>
                            <!--<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $dailyMessage['DailyMessage']['id']), array('escape' => false)); ?>-->
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $dailyMessage['DailyMessage']['id']), array('escape' => false)); ?>
                            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', array('action' => 'delete', $dailyMessage['DailyMessage']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $dailyMessage['DailyMessage']['id'])); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" style="padding-top: 0; padding-bottom: 0">
                            <div id="collapse<?php echo h($dailyMessage[ 'DailyMessage'][ 'id']); ?>" class="panel-collapse collapse daily-message-text">
                                <?php echo h($dailyMessage[ 'DailyMessage'][ 'message']); ?>&nbsp;
                            </div> 
                        </td>    
                    </tr>
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

<script type="text/javascript">
    function clearSearch(){
        document.getElementById('search').value = '';
        document.getElementById('country').value = '';
        document.getElementById('locale').value = '';
    }
</script>