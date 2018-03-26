  
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Amen Web</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if(isset($current_user)): ?> 
            <ul class="nav navbar-nav" id="menu">
                <li id="church">
                    <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-screenshot"></span>&nbsp;Churches'), array('controller' => 'churches', 'action' => 'index'), array('escape' => false)); ?> 
                </li>     
                <li  id="reading">
                    <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-book"></span>&nbsp;Readings'), array('controller' => 'readings', 'action' => 'index'), array('escape' => false)); ?> 
                </li> 
                <li>
                    <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-comment"></span>&nbsp;Conversations'), array('controller' => 'conversations', 'action' => 'index'), array('escape' => false)); ?> 
                </li> 
                <li>
                    <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-phone"></span>&nbsp;Mobile Users'), array('controller' => 'mobile_users', 'action' => 'index'), array('escape' => false)); ?> 
                </li>
                <!--<li >
                    <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-comment"></span>&nbsp;Mensajes del día'), array('controller' => 'daily_messages', 'action' => 'index'), array('escape' => false)); ?> 
                </li> -->
               
            </ul>
            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-user"></span>Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-user"><span class="glyphicon glyphicon-modal-window"></span></span>&nbsp;Web Users'), array('controller' => 'web_users', 'action' => 'index'), array('escape' => false)); ?> 
                        </li>
                        <?php if($current_user['webuser_profile_id'] == 1): ?>
                        
                        <li>
                            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-user"><span class="glyphicon glyphicon-calendar"></span></span>&nbsp;Schedules'), array('controller' => 'schedules', 'action' => 'index'), array('escape' => false)); ?> 
                        </li>
                        <li>
                            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-user"><span class="glyphicon glyphicon-book"></span></span>&nbsp;Reading Types'), array('controller' => 'reading_types', 'action' => 'index'), array('escape' => false)); ?> 
                        </li>
                        <li>
                            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-user"><span class="glyphicon glyphicon-map-marker"></span></span>&nbsp;Countries'), array('controller' => 'countries', 'action' => 'index'), array('escape' => false)); ?> 
                        </li>
                        <li class="divider"></li>
                        <?php endif; ?>
                        <!--<li><a href="#"><span class="glyphicon glyphicon-off"></span>&nbsp;Logout</a></li>-->
                        <li>
                            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-off"></span>&nbsp&nbsp;Logout'),array('controller' => 'web_users', 'action' => 'logout'), array('escape' => false)); ?>
                        </li>
                        
                    </ul>
                </li>
                
            </ul>
            <?php endif; ?>
        </div>
        <!-- /.navbar-collapse -->
        </div>
    </nav>
        
   <script type="text/javascript">
    $("#menu a").click(function() {
          $("#menu .active").removeClass('active');
    $(this).parent().addClass('active'); 
    e.preventDefault();
    });  
        
        $("#r").on("click", function(){
            alert("hola nojoda");  
   $("#church").removeClass("active");
   $("#reading").addClass("active");
});
   </script>