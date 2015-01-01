<?php
class contentpagesClass
{ 
  function getAllContentPagesList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$where=" status='Active'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllContentPagesListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'page_id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getContentPageData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'*','page_id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertcontentPage($post)
	{
	global $callConfig;
	if($post['title_slug']!="")
	$titleslug=$callConfig->remove_special_symbols($post['title_slug']);
	else
	$titleslug=$callConfig->remove_special_symbols($post['title']);
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'title_slug'=>$titleslug,'content'=>mysql_real_escape_string($post['content']),'page_title'=>mysql_real_escape_string($post['page_title']),'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'status'=>$post['status']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_CONTENTPAGES,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('Page created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_pagelist&err=Page created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Page creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_pagelist&ferr=Page creation failed");
	}
	}
	
	function updatecontentPage($post)
	{
	global $callConfig;
	if($post['title_slug']!="")
	$titleslug=$callConfig->remove_special_symbols($post['title_slug']);
	else
	$titleslug=$callConfig->remove_special_symbols($post['title']);
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'title_slug'=>$titleslug,'content'=>mysql_real_escape_string($post['content']),'page_title'=>mysql_real_escape_string($post['page_title']),'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'status'=>$post['status']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_CONTENTPAGES,$fieldnames,'page_id',$post['hdn_page_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Page updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_pagelist&err=Page updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Page updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_pagelist&ferr=Page updation failed");
	}
	}
	function contentpageDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_CONTENTPAGES,'page_id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Page deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_pagelist&err=Page deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Page deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_pagelist&ferr=Page deletion failed");
	}
	}

}
?>