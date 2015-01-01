<?php
class packagesClass
{ 
  function getAllpackagesList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$where=" status='Active'";
	
	 $query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES,'*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllpackagesListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES,'package_id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getPackageData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES,'*','package_id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertPackage($post)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
	$fieldnames=array('package_title'=>$title,'package_one'=>$for_one,'package_two'=>$for_two,'package_desc'=>$content,'status'=>$status);
	$res=$callConfig->insertRecord(TPREFIX.TBL_PACKAGES,$fieldnames);
	if($res="")
	{
		sitesettingsClass::recentActivities('Package created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=packages&err=Package created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Package creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=packages&ferr=Package creation failed");
	}
	}
	
	function updatePackage($post)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
	$fieldnames=array('package_title'=>$title,'package_one'=>$for_one,'package_two'=>$for_two,'package_desc'=>$content,'status'=>$status);
	$res=$callConfig->updateRecord(TPREFIX.TBL_PACKAGES,$fieldnames,'package_id',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Package updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=packages&err=Package updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Package updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=packages&ferr=Package updation failed");
	}
	}
	function PackageDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_PACKAGES,'package_id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Package deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=packages&err=Package deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Package deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=packages&ferr=Package deletion failed");
	}
	}

}
?>