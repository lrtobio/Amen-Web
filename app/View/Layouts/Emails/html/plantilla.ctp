<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php //echo $title_for_layout; ?></title>
</head>
<body>
	<?php //echo $this->fetch('content'); ?>

	<p>This email was sent using the <a href="http://cakephp.org">CakePHP Framework</a></p>
</body>
</html>

-->

<?php

$hoy = strftime("%B %d, %Y", time());
		
$hora = strftime("%H", time());
$horaampm = strftime("%I:%M", time()).' ';
if( $hora>=12 )
	$horaampm .= 'pm';
else 
	$horaampm .= 'am';
	
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1'/>
<!--<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>-->
</head>
<body>
<div style='background-color:#f2f2f2;color:#464646;font-size:14px; border-radius:10px;' align='center'>
    
    <br/>
    <!--<img src='<?php echo FULL_BASE_URL . $this->webroot; ?>img/Unet-Logotipo.png'/>-->
    <img src='<?php echo $url_img; ?>img/Logo-amen.png' width="150px" height="150px" alt="AMEN"/>
    <!--<img src='<?php echo WWW_ROOT; ?>img/Logo-amen.png' width="150px" height="150px" alt="AMEN"/>-->
    <!--<p style='color:#ffffff; font-size:14px;'>UNET</p>-->
    <br/>
    <div id='ecxcontainer' style='width:80%;font-family:Verdana, Geneva, sans-serif;'>
        <?php echo $content_for_layout; ?>
        <p>
            <br/>
            <small>Sent on date <font style='color:#373737;font-weight:bold;'><?php echo $hoy; ?> at <?php echo $horaampm; ?></small>
        </font>
        </p>        
    </div>
    
    <!--<a href='http://www.soats.co/' style='color:#ffffff;'>UNET</a>-->
    <br/>
    <center>
        <font style='font-weight:bold;font-size:16px;'>Copyright <?php echo date("Y"); ?></font>
    </center>
    <br/>
</div>
</body>
</html>