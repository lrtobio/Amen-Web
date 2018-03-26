<?php setlocale (LC_TIME, "es_ES"); ?>
<div class="conversations index">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <div class="navbar-form navbar-right">
                    <b>Opciones de filtro</b>
                    <?php echo $this->Form->create('Conversation', array('type'=>'POST','url' => array('controller' => 'conversations', 'action' => 'index'))); ?> 
                    
                    <div class="form-group">
                        <?php echo $this->Form->input('country',array('class' => 'form-control input-sm','id'=>'country', 'type' => 'select', 'label' => '', 'options'=>$countries, 'empty'=>'Paises')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('locale',array('class' => 'form-control input-sm','id'=>'locale', 'type' => 'select', 'label' => '', 'options'=>$locales, 'empty'=>'Idiomas')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('status',array('class' => 'form-control input-sm','id'=>'status', 'type' => 'select', 'label' => '','style'=>'max-width: 150px', 'options'=>$op_status, 'empty'=>'Estados')); ?>
                       
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('search',array('class' => 'form-control input-sm','id'=>'search', 'placeholder' => 'Buscar: Nombres, Apellidos', 'label' => '', 'autocomplete'=>'off')); ?>
                       
                    </div>
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Buscar'), array('class' => 'btn btn-default btn-sm')); ?>
                    </div>  
                    <div  class="form-group">
                        <?php echo $this->Form->submit(__('Limpiar'), array('class' => 'btn btn-default btn-sm', 'onclick'=>'clearSearch()')); ?>
                    </div> 
                    <?php echo $this->Form->end(); ?>

                </div>
                <h1><?php echo __('Conversations'); ?></h1>
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
                        <?php foreach ($dataCountry as $country): ?>  
                          <li class="list-group-item"><span class="badge" style="background-color: #2283c5!important "><?php echo h($country[ 'Conversation'][ 'count_items']); ?></span><?php echo h($countries[$country[ 'Sender'][ 'country_id']] ); ?></li>
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
                          <li class="list-group-item"><span class="badge" style="background-color: #2283c5!important "><?php echo h($locale[ 'Conversation'][ 'count_items']); ?></span><?php echo h($locales[$locale[ 'Sender'][ 'locale']]); ?></li>
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
                    <th>
                        <?php echo $this->Paginator->sort('sender_id'); ?></th>
                    <th>
                        <?php echo $this->Paginator->sort('receiver_id'); ?></th>
                    <!--<th>
                        <?php echo $this->Paginator->sort('subject'); ?></th>-->
                    <th>
                        <?php echo $this->Paginator->sort('status'); ?></th>
                    <th>
                        <?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($conversations as $conversation): ?>
                    <tr>
                        <td>
                            <!--<?php echo $this->Html->link($conversation['Sender']['nombre'], array('controller' => 'mobile_users', 'action' => 'view', $conversation['Sender']['id'])); ?>-->
                        
                        <?php if($conversation['Sender']['foto'] != '' && $conversation['Sender']['foto'] != null): ?>
                            <img src=" <?php echo h($conversation['Sender']['foto']) ?>"  class="avatar" data-toggle="tooltip" title="<?php echo $conversation['Sender']['nombre'] ?>">
                        <?php else: ?>
                            <img src="http://placehold.it/50x50" alt="" class="avatar" data-toggle="tooltip" title="<?php echo $conversation['Sender']['nombre'] ?>" />
                        <?php endif; ?>
                            </td>
                        <td>
                            <!--<?php echo $this->Html->link($conversation['Receiver']['nombre'], array('controller' => 'mobile_users', 'action' => 'view', $conversation['Receiver']['id'])); ?>-->
                        <?php if($conversation['Receiver']['foto'] != '' && $conversation['Receiver']['foto'] != null): ?>
                            <img src=" <?php echo h($conversation['Receiver']['foto']) ?>"  class="avatar" data-toggle="tooltip" title="<?php echo $conversation['Receiver']['nombre'] ?>">
                        <?php else: ?>
                            <img src="http://placehold.it/50x50" alt="" class="avatar" data-toggle="tooltip" title="<?php echo $conversation['Receiver']['nombre'] ?>" />
                        <?php endif; ?>
                        </td>
                        <!--
                        <td>
                            <?php if(strlen($conversation[ 'Conversation'][ 'subject']) > 99): ?>
                                <?php echo h(substr($conversation[ 'Conversation'][ 'subject'],0,99).'...'); ?>&nbsp;<br/>
                            <?php else: ?>
                                <?php echo h($conversation[ 'Conversation'][ 'subject']); ?>&nbsp;<br/>
                            <?php endif; ?>
                       
                            </td>-->
                        <td>
                            <span class="<?php echo $label_status[$conversation[ 'Conversation'][ 'status']]?>" data-toggle="tooltip" title="<?php echo $op_status[$conversation[ 'Conversation'][ 'status']] ?>">
                                <?php echo $conversation[ 'Conversation'][ 'status']; ?>
                            </span>
                        </td>
                        <td>
                            <?php echo ucwords( strftime('%Y, %b %d. %R',  strtotime($conversation[ 'Conversation'][ 'created']))); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $conversation['Conversation']['id']), array('escape' => false)); ?>
                            <?php if($user == '1'): ?>
                                <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $conversation['Conversation']['id']), array('escape' => false)); ?>
                                <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $conversation['Conversation']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $conversation['Conversation']['id'])); ?>
                            <?php endif; ?>
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
        document.getElementById('status').value = '';
        document.getElementById('country').value = '';
        document.getElementById('locale').value = '';
    }
    //document.getElementById('status').style = 'max-width: 150px';
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>