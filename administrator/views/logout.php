<?php
session_start();
if (isset($_SESSION['userid'])){
sitesettingsClass::lastlogin();
sitesettingsClass::recentActivities('Admin logout sucessfully User ID >> '.$_SESSION['userid'].' on >> '.DATE_TIME_FORMAT.'','g');
unset($_SESSION['userid']);
unset($_SESSION['us_name']);
unset($_SESSION['lastlogin']);
unset($_SESSION['roletype']);
unset($_SESSION['last_activity']);
}
if($_SESSION['userid']=="")
{
header("Location:index.php?option=com_login");
exit();
}
?>