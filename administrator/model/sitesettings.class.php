<?php
class sitesettingsClass
{
 function recentActivities($matter,$type)
 {
 	global $callConfig;
	$fieldnames=array('matter'=>$matter,'date_time'=>STR_TO_TIME,'type'=>$type);
	$res=$callConfig->insertRecord(TPREFIX.TBL_RECENTACTIVITIES,$fieldnames);
	$query=$callConfig->selectQuery(TPREFIX.TBL_RECENTACTIVITIES,'id','','id desc','10','100000000');
	$res=$callConfig->getAllRows($query);
	foreach($res as $r)
	{
	 $callConfig->deleteRecord(TPREFIX.TBL_RECENTACTIVITIES,'id',$r->id);
	}
 }
 function gettenrecentActivitiesList($limit)
 {
 	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_RECENTACTIVITIES,'*','','id DESC','',$limit);
	return $callConfig->getAllRows($query);
 }
 function lastlogin()
 {
	global $callConfig;
	$query="UPDATE ".TPREFIX.TBL_ADMIN." SET lastlogin='".strtotime(date("Y-m-d H:i:s"))."' where user_id='".$_SESSION['userid']."'";
	$callConfig->executeQuery($query);
 }
  function sitesettings($post)
  {
	global $callConfig;
    $logobanner = $callConfig->freeimageUploadcomncode('logo','site_image',"../uploads/site/","../uploads/site/thumbs/",$post['hdn_site_image'],185,51);
	$fieldnames=array('theme_selection'=>$post['theme_selection'],'title'=>mysql_real_escape_string($post['title']),'site_image'=>$logobanner,'noofrecords'=>$post['noofrecords'],'footer_txt'=>mysql_real_escape_string($post['footer_txt']),'googleanalytics'=>mysql_real_escape_string($post['googleanalytics']),'local_tax'=>$post['local_tax'],'govt_tax'=>$post['govt_tax']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_SITESETTINGS,$fieldnames,'','');
	if($res==1)
	{
		sitesettingsClass::recentActivities('Site settings updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_sitesettings&err=Site settings updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Site settings updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_sitesettings&ferr=Site settings updation failed");
	}
  }
  function getsitesettings()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_SITESETTINGS,'*','','','','');
	return $callConfig->getRow($query);
  }
}
?>