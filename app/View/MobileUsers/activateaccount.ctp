<?php 

if( $message!=NULL && $message!='' )
    echo "<script type='text/javascript'>alert('".$message."'); window.close();</script>";
else
    echo "<script type='text/javascript'>alert('Your account couldn´t be enabled.\nPlease, try again or send us an email.\nThanks!'); window.close();</script>";
