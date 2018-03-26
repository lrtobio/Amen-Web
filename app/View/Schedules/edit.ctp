<div class="schedules form">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <div class="navbar-form navbar-right">
                    <label class="checkbox-inline" for="Checkboxes">
                        <input type="checkbox" name="Checkboxes" id="Checkbox" value="use">
                        <?php echo __( 'Use from Monday to Friday'); ?>
                    </label>
                </div>
                <h1><?php echo __('Edit Schedule'); ?></h1>
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
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp&nbsp;Back'), array('controller' => 'churches', 'action' => 'view/'.$this->request->data['Schedule']['church_id']), array('escape' => false)); ?> </li>
                            <li>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Schedule.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Schedule.id'))); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('Schedule', array('role' => 'form')); ?>
            <div class="form-group">
                <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horrario Lunes</label>
                    <input type="time" id='time1' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time1','lunes')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('lunes', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'lunes'));?>
                        <span class="input-group-btn">
                                                <button  type="button" class="btn btn-default" onclick="clearHour('lunes')">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horario Martes</label>
                    <input type="time" id='time2' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time2','martes')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('martes', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'martes'));?>
                        <span class="input-group-btn">
                                                <button  type="button" class="btn btn-default" onclick="clearHour('martes')">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horario Miercoles</label>
                    <input type="time" id='time3' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time3','miercoles')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('miercoles', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'miercoles'));?>
                        <span class="input-group-btn">
                                                <button  type="button" class="btn btn-default" onclick="clearHour('miercoles')">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horario Jueves</label>
                    <input type="time" id='time4' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time4','jueves')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('jueves', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'jueves'));?>
                        <span class="input-group-btn">
                                                <button  type="button" class="btn btn-default" onclick="clearHour('jueves')">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horario Viernes</label>
                    <input type="time" id='time5' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time5','viernes')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('viernes', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'viernes'));?>
                        <span class="input-group-btn">
                                                <button  type="button" class="btn btn-default" onclick="clearHour('viernes')">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horario Sábado</label>
                    <input type="time" id='time6' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time6','sabado')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('sabado', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'sabado'));?>
                        <span class="input-group-btn">
                                                <button  type="button" class="btn btn-default" onclick="clearHour('sabado')">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horario Domingo</label>
                    <input type="time" id='time7' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time7','domingo')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('domingo', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'domingo'));?>
                        <span class="input-group-btn">
                                                <button  type="button" class="btn btn-default" onclick="clearHour('domingo')">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Horario Festivos</label>
                    <input type="time" id='time8' class="form-control" step="300">
                </div>
                <div class="col-md-2">
                    <label>
                        <br>
                    </label>
                    <button type="button" class="form-control" onclick="concatenarHora('time8','festivos')">
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <label>
                        <br>
                    </label>
                    <div class="input-group">
                        <?php echo $this->Form->input('festivos', array('class' => 'form-control', 'placeholder' => 'HH:mm, HH,mm, ...', 'label'=>false,'readonly', 'id'=>'festivos'));?>
                        <span class="input-group-btn">
                            <button  type="button" class="btn btn-default" onclick="clearHour('festivos')">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('schedule_type_id', array('class' => 'form-control', 'placeholder' => 'Schedule Type Id', 'disabled'=>true));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('church_id', array('class' => 'form-control', 'placeholder' => 'Church Id', 'disabled'=>true));?>
                <?php echo $this->Form->input('ch_id', array('class' => 'form-control','type'=>'hidden', 'value' => $this->request->data['Schedule']['church_id']));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
            </div>
            <?php echo $this->Form->end() ?>
        </div>
        <!-- end col md 12 -->
    </div>
    <!-- end row -->
</div>
<script type="text/javascript">
    function concatenarHora(time, d) {
        input = document.getElementById(time);
        cbx = document.getElementById('Checkbox');
        if (input.value != '') {
            var dia = document.getElementById(d);
            if (dia.value != '')
                dia.value = dia.value + ', ' + input.value;
            else
                dia.value = dia.value + input.value;
            if (cbx.checked && d == 'lunes') {
                document.getElementById('martes').value = dia.value;
                document.getElementById('miercoles').value = dia.value;
                document.getElementById('jueves').value = dia.value;
                document.getElementById('viernes').value = dia.value;
            }
        }
    }
    function clearHour(input) {
        var dia = document.getElementById(input);
        dia.value = '';
        if (cbx.checked && input == 'lunes') {
            document.getElementById('martes').value = '';
            document.getElementById('miercoles').value = '';
            document.getElementById('jueves').value = '';
            document.getElementById('viernes').value = '';
        }
    }

    $('.navbar-form').on('click', 'input[type=checkbox]', function() {
        $(this).closest('.checkbox-inline, .checkbox').toggleClass('checked');
    });
</script>