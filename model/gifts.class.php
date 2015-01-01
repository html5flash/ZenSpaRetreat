<?php
class giftsClass
{ 
	function gatpackages()
	{
	//echo "sdfdsf";
	 global $callConfig;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES,'*',"status='Active'",'','','');
	 return $callConfig->getAllRows($query);
	}
 function getAllgiftsList($sortfield,$order,$start,$limit,$type)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	
	$where=" status='Active'";
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
		if(count($_POST['certified'])!=0)
		{
		   $strcertified='8.50';
		}
		
		if(count($_POST['Messenger'])!=0)
		{
		   $strMessenger='12.50';
		}
		
		if(count($_POST['NextDay'])!=0)
		{
			$strNextDay='20.00';
		}		
		
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
		if($package!=0)
		{
		   $packages=packagesClass::getPackageData($package);
		    $price=$packages->package_one;
			$pck_name=$packages->package_title;
		}
		else if($g_price!='' && $price=='')
			$price=$g_price;
		else
			$price=$price;
		
		
		//name,recepientname,emailid,price,message
		$fieldnames=array('g_name'=>$name,'g_recepientname'=>$recepientname,'g_emailid'=>$emailid,'g_treatmenttype'=>$treatmenttype,'g_price'=>$price,'g_services'=>$treatment,'g_message'=>$message,'order_number'=>$orderid,'from_user'=>$from,'buyer_name'=>$buyersfullname,'buyer_phone'=>$buyerstelephone,'buyermessage'=>$other_message,'is_certified'=>$strcertified,'cretified_mesage'=>$certified_msg,'is_messanger'=>$strMessenger,'messager_msg'=>$Messenger_msg,'is_nextday'=>$strNextDay,'nextday_msg'=>$NextDay_msg,'g_package'=>$pck_name);
		
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