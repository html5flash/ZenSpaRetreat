<script type="text/javascript" src="js/checkuncheckall.js"></script>
<div id="header">
  <div class="div1">
    <div class="div2"><a href="index.php" ><img src="../uploads/site/<?php echo $site_settings_disp->site_image; ?>" style="width:185px; height:51px;" alt="Site Logo" /></a></div>
        <div class="div3"><?php if(isset($_SESSION['us_name']) && $_SESSION['us_name']!=""){?><img src="allfiles/lock.png" alt="" style="position: relative; top: 3px;">&nbsp;You are logged in as <span><?php echo $_SESSION['us_name'];?></span><?php }?></div>
    </div>
	<?php
	if($option!="com_login"){
	?>
	<div id="menu">
	<?php
	if($_SESSION['roletype']=="senior")
	{ 
	?>
    <ul class="left sf-js-enabled" style="display: block; ">
      <li  <?php echo $left_dashboard_focus;?>><a href="index.php" class="top">Dashboard</a></li>	  
	  <li  <?php echo $left_sitesettings_focus;?>><a href="index.php?option=com_sitesettings" class="top">Site Settings</a></li>  
	  <li id="catalog" <?php echo $left_adminlist_focus;?>><a class="top"  href="#">Users</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_adminlist">Admin Users</a></li>
		  <li><a href="index.php?option=com_adminlist_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Admin User</a></li>
       </ul>
      </li>
	  <li id="catalog" <?php echo $left_mainmenu_focus;?>><a class="top"  href="#">Zenspa Packages</a>
        <ul style="display: none; visibility: hidden; ">
		<li><a href="index.php?option=packages">Packages</a></li>
		  <li><a href="index.php?option=packages_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Package</a></li>
		  <li><a href="index.php?option=otherpackages">Other Packages</a></li>
		  <li><a href="index.php?option=otherpackages_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Other Package</a></li>
       </ul>
      </li>

 <li id="catalog" <?php echo $left_order_focus;?>><a class="top"  href="#">Orders</a>
        <ul style="display: none; visibility: hidden; ">
	
		  <li><a href="index.php?option=packageorder">Packages Order</a></li>
		    <li><a href="index.php?option=gifts">Gifts Order</a></li>
			 <li><a href="index.php?option=appointments">Appointments</a></li>
       </ul>
      </li>
<li id="catalog" <?php echo $left_treatment_focus;?>><a class="top"  href="index.php?option=treatment">Package Treatment</a>
        <ul style="display: none; visibility: hidden; ">
		  <li><a href="index.php?option=treatment_insert">Add Package Treatment</a></li>
       </ul>
      </li>

   
   
    </ul>
	<?php } else {?>
	
	<ul class="left sf-js-enabled" style="display: block; ">
      <li  <?php echo $left_dashboard_focus;?>><a href="index.php" class="top">Dashboard</a></li>
	  <li id="catalog" <?php echo $left_adminlist_focus;?>><a class="top"  href="#">Zenspa Packages</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=packages">Packages</a></li>
		  <li><a href="index.php?option=packages_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Package</a></li>
       </ul>
      </li>

    </ul>
	<?php 
	}
	?>
    <ul class="right sf-js-enabled" style="display: block; ">
      <li id="store"><a class="top" href="index.php?option=com_logout">Logout</a></li>
    </ul>
    <script type="text/javascript"><!--
$(document).ready(function() {
	$('#menu > ul').superfish({
		hoverClass	 : 'sfHover',
		pathClass	 : 'overideThisToUse',
		delay		 : 0,
		animation	 : {height: 'show'},
		speed		 : 'normal',
		autoArrows   : false,
		dropShadows  : false, 
		disableHI	 : false, /* set to true to disable hoverIntent detection */
		onInit		 : function(){},
		onBeforeShow : function(){},
		onShow		 : function(){},
		onHide		 : function(){}
	});
	
	$('#menu > ul').css('display', 'block');
});
 
function getURLVar(urlVarName) {
	var urlHalves = String(document.location).toLowerCase().split('?');
	var urlVarValue = '';
	
	if (urlHalves[1]) {
		var urlVars = urlHalves[1].split('&');

		for (var i = 0; i <= (urlVars.length); i++) {
			if (urlVars[i]) {
				var urlVarPair = urlVars[i].split('=');
				
				if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
					urlVarValue = urlVarPair[1];
				}
			}
		}
	}
	
	return urlVarValue;
} 

$(document).ready(function() {
	route = getURLVar('route');
	
	if (!route) {
		$('#dashboard').addClass('selected');
	} else {
		part = route.split('/');
		
		url = part[0];
		
		if (part[1]) {
			url += '/' + part[1];
		}
		
		$('a[href*=\'' + url + '\']').parents('li[id]').addClass('selected');
	}
});
//--></script> 
  </div>
  <?php
  }
  ?>
  </div>