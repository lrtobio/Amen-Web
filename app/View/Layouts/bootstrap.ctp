<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <?php
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        
        echo $this->Html->css(array('bootstrap.min', 'bootstrap-theme.min','myStyle'));
        echo $this->Html->script(array('jquery.min','bootstrap.min','jquery-ui.min'));
        
        echo $this->fetch('css');
        echo $this->fetch('script');
        
        //echo $this->Html->meta( 'logo.ico', '/logo.ico', array('type' => 'icon') );
        //echo $this->Html->meta('icon', $this->Html->url('/icon.png'));
    ?>

    <!-- Latest compiled and minified CSS -->
    <!--
    <?php //echo $this->Html->css("bootstrap.min"); ?>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    -->

    <!-- Latest compiled and minified JavaScript -->
    <?php //echo $this->Html->script("jquery.min"); ?>
    <!--
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    -->
    
    <?php //echo $this->Html->script("bootstrap.min"); ?>
    <!--
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    	body{ 
            /*padding: 70px 0px; */
            padding: 70px 50px 0px 50px;            
        }
    </style>

    <script type="text/javascript">var baseUrl = '<?php echo $this->webroot;//$this->base; ?>';</script>
   
  </head>

  <body>

    <?php echo $this->Element('navigation'); ?>

      <!--<div class="container">-->
    
        <?php //echo Configure::version(); ?>

        <?php echo $this->Session->flash(); ?>

        <?php echo $this->fetch('content'); ?>

    <!-- </div>/.container -->
     
  </body>
</html>
