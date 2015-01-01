<?php
class contentpagesClass
{ 
  function getContentPageSlugnameBasedOnPageId($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'title_slug',"page_id='".$id."'",'','','');
	$res=$callConfig->getRow($query);
	return $res->title_slug;
 }
 function getContentPageData($id)
  {
	global $callConfig;
	if(is_numeric($id))
	$whr="page_id=".$id;
	else
	$whr="title_slug='".$id."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'*',$whr,'','','');
	return $callConfig->getRow($query);
 }
  
  // site settings //
   function getsitesettings()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_SITESETTINGS,'*','','','','');
	return $callConfig->getRow($query);
  }
  
  
  function getAllNeweventsList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_NEWSEVENTS,'*'," status='Active'",$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
   function getAllNeweventsListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_NEWSEVENTS,'id'," status='Active'",'','','');
	return $callConfig->getCount($query);
  } 
  
  function getindivLatestNews($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_NEWSEVENTS,'*'," id='".$id."' and status='Active'",$order,$start,$limit);
	return $callConfig->getRow($query);
  }
  
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
	
	  function checkHomeORBlogPostsForRightNav($blogpostid)
	  {
		global $callConfig;
		$query=$callConfig->selectQuery(TPREFIX.TBL_BLOGPOST,'*',"id=".$blogpostid,$order,$start,$limit);
		return $callConfig->getRow($query);
	  } 
	  
  function getAllBannersList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BANNERS,'*',"status='Active' and type='home'",$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getBannersIndivData($bid)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BANNERS,'*'," id=".$bid,'','','');
	return $callConfig->getRow($query);
  } 

}
?>