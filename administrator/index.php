<?php 
ob_start();
session_start();
include('../dbconfig.php');
include('includes/dbconnection.php');
include("model/user.class.php");
$userObj=new userClass();
include('model/sitesettings.class.php');
$site_settings_disp=sitesettingsClass::getsitesettings();
include("includes/controller.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?=$site_settings_disp->title;?></title>
<link type="text/css" rel="stylesheet" href="allfiles/layout_<?=$site_settings_disp->theme_selection;?>.css">
<script type="text/javascript" src="allfiles/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="allfiles/superfish.js"></script>
</head>
<body>
<div id="container">
<?php
include('includes/headermenu.php'); 
?> 
<div id="content">
<!--<div class="breadcrumb"><a href="allfiles/Dashboard.htm">Home</a></div>-->
<?php 
if(isset($_GET['err']) && $_GET['err']!=""){
?>
<div class="success">Success: <?=$_GET['err']?>!</div>
<?php } if(isset($_GET['ferr']) && $_GET['ferr']!=""){?>
<div class="warning">Fail: <?=$_GET['ferr']?>.</div>
<?php }?>
<?php include($disptemp); ?> 
</div>
</div>
<?php include('includes/footer.php'); ?> 
</body></html>