<?php
class giftsClass
{ 
  function getAllgiftsList($sortfield,$order,$start,$limit,$type)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	
 $query=$callConfig->selectQuery(TPREFIX.TBL_GIFTS,'*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllgiftsListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_GIFTS,'g_id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getGiftsData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_GIFTS,'*','g_id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertGifts($post,$orderid)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
		
		//name,recepientname,emailid,price,message
	$fieldnames=array('g_name'=>$name,'g_recepientname'=>$recepientname,'g_emailid'=>$emailid,'g_price'=>$price,'g_message'=>$message,'order_number'=>$orderid);
	$res=$callConfig->insertRecord(TPREFIX.TBL_GIFTS,$fieldnames);
		return $res;
	}
	 function UpdateOrderlist($str)
	  {
		global $callConfig;
		 $query=$str;
		return $callConfig->executeQuery($query);
	  }
	function updateGifts($post)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
	$fieldnames=array('other_title'=>$title,'other_price'=>$for_one,'other_status'=>$status,'other_type'=>$type);
	$res=$callConfig->updateRecord(TPREFIX.TBL_GIFTS,$fieldnames,'g_id',$post['hdn_id']);
	if($res==1)
	{
		/*sitesettingsClass::recentActivities('Gifts updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=gifts&err=Gifts updated successfully");*/
	}
	else
	{
		/*sitesettingsClass::recentActivities('Gifts updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=gifts&ferr=Gifts updation failed");*/
	}
	}
	function GiftsDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_GIFTS,'g_id',$id);
	if($res==1)
	{
		/*sitesettingsClass::recentActivities('Gifts deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=gifts&err=Gifts deleted successfully");*/
	}
	else
	{
		/*sitesettingsClass::recentActivities('Gifts deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=gifts&ferr=Gifts deletion failed");*/
	}
	}

}
?>