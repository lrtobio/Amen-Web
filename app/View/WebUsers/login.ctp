
<div class="container">    
        
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
        
        <div class="row" style="margin-bottom: 35px">                
            <div class="iconmelon">
                <img src="img/Logo-amen.png" width="100%">
            </div>
        </div>
        
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Amen</div>
            </div>     

            <div class="panel-body" >

                <!--<form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">-->
                 <?php echo $this->Form->create('WebUser', array('class' => 'form-horizontal', 'id'=>'form')); ?>  
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <!--<input id="user" type="text" class="form-control" name="user" value="" placeholder="User">-->                                        
                        <?php echo $this->Form->input('email', array('class' => 'form-control','id'=>'user', 'placeholder' => 'usuario@mail.com', 'label'=>false, 'autofocus'=> true));?>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <!--<input id="password" type="password" class="form-control" name="password" placeholder="Password">-->
                        <?php echo $this->Form->input('password', array('class' => 'form-control','id'=>'password','label'=>false, 'placeholder' => 'Password'));?>
                    </div>                                                                  

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Log in</button>                          
                            
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    

            </div>                     
        </div>  
    </div>
</div>
