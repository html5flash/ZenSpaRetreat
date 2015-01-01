<?php
class otherpackagesClass
{ 
  function getAllotherpackagesList($sortfield,$order,$start,$limit,$type)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	
	$where=" other_status='Active' and other_type='".$type."'";
	 $query=$callConfig->selectQuery(TPREFIX.TBL_OTHERPACKAGES,'*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllotherpackagesListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_OTHERPACKAGES,'other_id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getPackageData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_OTHERPACKAGES,'*','other_id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertPackage($post)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
	$fieldnames=array('other_title'=>$title,'other_price'=>$for_one,'other_status'=>$status,'other_type'=>$type);
	$res=$callConfig->insertRecord(TPREFIX.TBL_OTHERPACKAGES,$fieldnames);
	
	
		if($res!="")
		{
			sitesettingsClass::recentActivities('Package created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=otherpackages&err=Package created successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Package creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=otherpackages&ferr=Package creation failed");
		}
	}
	
	function updatePackage($post)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
	$fieldnames=array('other_title'=>$title,'other_price'=>$for_one,'other_status'=>$status,'other_type'=>$type);
	$res=$callConfig->updateRecord(TPREFIX.TBL_OTHERPACKAGES,$fieldnames,'other_id',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Package updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=otherpackages&err=Package updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Package updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=otherpackages&ferr=Package updation failed");
	}
	}
	function PackageDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_OTHERPACKAGES,'other_id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Package deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=otherpackages&err=Package deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Package deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=otherpackages&ferr=Package deletion failed");
	}
	}

}
?>