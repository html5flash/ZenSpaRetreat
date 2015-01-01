<?php 
ob_start();
include_once("includes/sessions.php");
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
include('model/appointment.class.php');
$sel="select * from tb_packages where package_id=".$_REQUEST['pakid'];
$res=$callConfig->getRow($sel);
echo $res->package_one ;
?>
