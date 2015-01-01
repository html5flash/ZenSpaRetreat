<?php
class treatmentClass
{
  function getAlltreatmentList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$where="status='Active'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_TREATMENT,'*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAlltreatmentListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_TREATMENT,'t_id','','','','');
	 return $callConfig->getCount($query);
  } 
   function getAlltreatmentListByCID($id)
  {
	global $callConfig;
	$where="status='Active' and c_id=".$id;
	  $query=$callConfig->selectQuery(TPREFIX.TBL_TREATMENT,'*',$where,"",'','');
	return $callConfig->getAllRows($query);
  } 
  function getTreatmentData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_TREATMENT,'*','t_id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertTreatment($post)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
	$fieldnames=array('c_id'=>$cid,'t_title'=>$title,'t_price'=>$price,'status'=>$status);
	$res=$callConfig->insertRecord(TPREFIX.TBL_TREATMENT,$fieldnames);
		if($res!="")
		{
			sitesettingsClass::recentActivities('Treatment created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=treatment&err=Treatment created successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Treatment creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=treatment&ferr=Treatment creation failed");
		}
	}
	
	function updateTreatment($post)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
		$fieldnames=array('c_id'=>$cid,'t_title'=>$title,'t_price'=>$price,'status'=>$status);
	$res=$callConfig->updateRecord(TPREFIX.TBL_TREATMENT,$fieldnames,'t_id',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Treatment updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=treatment&err=Treatment updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Treatment updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=treatment&ferr=Treatment updation failed");
	}
	}
	function TreatmentDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_TREATMENT,'t_id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Treatment deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=treatment&err=Treatment deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Treatment deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=treatment&ferr=Treatment deletion failed");
	}
	}

}
?>