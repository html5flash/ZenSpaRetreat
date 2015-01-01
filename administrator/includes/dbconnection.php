<?php
$ss=strpos($_SERVER['PHP_SELF'],ADMINROOT);
if($ss!="")
include("model/db.class.php");
else
include("administrator/model/db.class.php");
$callConfig=new configClass();
$callConfig->configConnection();
?>