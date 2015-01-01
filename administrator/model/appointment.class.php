<?php
class appointmentsClass
{ 
  function getAllappointmentsList($sortfield,$order,$start,$limit,$type)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	
	
	 $query=$callConfig->selectQuery(TPREFIX.TBL_APPOINTMENT,'*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllappointmentsListCount()
  {
	global $callConfig;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_APPOINTMENT,'a_id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getappointmentsData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_APPOINTMENT,'*','a_id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertappointments($post,$orderid)
	{
	global $callConfig;
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
		
		//name,telephone,emailid,celular,treatment,otherpacks,app_date,hours,mints
	$fieldnames=array('a_name'=>$name,'a_phone'=>$telephone,'a_emailid'=>$emailid,'a_celular'=>$celular,'a_treatment'=>$treatment,'a_addons'=>$otherpacks,'a_date'=>$app_date,'a_time'=>$hours.":".$mints,'order_number'=>$orderid);
	$res=$callConfig->insertRecord(TPREFIX.TBL_APPOINTMENT,$fieldnames);
		return $res;
	}
	 function UpdateOrderlist($str)
	  {
		global $callConfig;
		 $query=$str;
		return $callConfig->executeQuery($query);
	  }
	
		function appointmentsDelete($id)
		{
		global $callConfig;
		$res=$callConfig->deleteRecord(TPREFIX.TBL_APPOINTMENT,'a_id',$id);
		if($res==1)
		{
			/*sitesettingsClass::recentActivities('appointments deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=appointments&err=appointments deleted successfully");*/
		}
		else
		{
			/*sitesettingsClass::recentActivities('appointments deletion failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=appointments&ferr=appointments deletion failed");*/
		}
	}

}
?>