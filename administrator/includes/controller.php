<?php
if($_GET['option']!="")
$option=$_GET['option'];
else
$option="com_login";
		switch($option)
		{
			case "com_login":
			$disptemp="views/login.php";
			break;
			case "com_dashboard":
			$disptemp="views/dashboard.php"; 
			$left_dashboard_focus='class="selected"'; 
			break;
			case "com_dashboardadmin":
			$disptemp="views/dashboardadmin.php"; 
			$left_dashboard_focus='class="selected"'; 
			break;
			case "com_adminlist":
			$disptemp="views/adminlist.php";
			$left_adminlist_focus='class="selected"';  
			break;
			case "com_adminlist_insert":
			$disptemp="views/adminlist.php";
			$left_adminlist_focus='class="selected"';  
			break;
			
			
			case "com_sitesettings":
			$disptemp="views/sitesettings.php";
			$left_sitesettings_focus='class="selected"'; 
			break;
			
			
			case "packages":
			$disptemp="views/packages.php";
			$left_mainmenu_focus='class="selected"';  
			break;
			case "packages_insert":
			$disptemp="views/packages.php";
			$left_mainmenu_focus='class="selected"';  
			break;
			
			case "otherpackages":
			$disptemp="views/otherpackages.php";
			$left_mainmenu_focus='class="selected"';  
			break;
			
			case "otherpackages_insert":
			$disptemp="views/otherpackages.php";
			$left_mainmenu_focus='class="selected"';  
			break;
			
			
			case "packageorder":
			$disptemp="views/packageorder.php";
			$left_order_focus='class="selected"';  
			break;
				case "view_order":
			$disptemp="views/packageorder.php";
			$left_order_focus='class="selected"';  
			break;
			
				case "gifts":
			$disptemp="views/giftsorder.php";
			$left_order_focus='class="selected"';  
			break;
				case "view_giftsorder":
			$disptemp="views/giftsorder.php";
			$left_order_focus='class="selected"';  
			break;
			
			
				case "appointments":
			$disptemp="views/appointments.php";
			$left_order_focus='class="selected"';  
			break;
				case "view_appsorder":
			$disptemp="views/appointments.php";
			$left_order_focus='class="selected"';  
			break;
		
		
			
			
					case "treatment":
			$disptemp="views/treatments.php";
			$left_treatment_focus='class="selected"';  
			break;
				case "treatment_insert":
			$disptemp="views/treatments.php";
			$left_treatment_focus='class="selected"';  
			break;
			case "com_logout":
			$disptemp="views/logout.php";
			break;
			
		}
		
?>
