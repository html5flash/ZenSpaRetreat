<?php 
include('includes/session.php');
$countusers=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_ADMIN,'user_id'," roletype='senior' or roletype='level1' ");
$countRegisterdusers=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_ADMIN,'user_id'," roletype='level2' ");
$countpages=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_CONTENTPAGES,'page_id','');
$countimages=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_BANNERS,'id','');
//$countproducts=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_PRODUCTS,'id');
$countnewsevents=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_NEWSEVENTS,'id','');
//$counttestimonials=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_TESTIMONIALS,'id');
$recent=sitesettingsClass::gettenrecentActivitiesList(10);
?>
<div class="box">
    <div class="heading">
      <h1><img src="allfiles/home.png" alt=""> Dashboard</h1>
    </div>
    <div class="content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><div class="overview" style="width:99%;">
          <table width="100%" border="0" align="left" cellpadding="2" cellspacing="2">
		   <tr class="overview_heading">
    <td colspan="2"  align="left" valign="middle">Overview</td>
  </tr>
  <tr>
    <td  align="left" valign="middle"><label class="title">Last login</label></td>
    <td align="left" valign="middle"><?php echo date("l dS F Y, H:i:s A", $_SESSION['lastlogin']);?></td>
  </tr>
</table>
</div></td>
    <td rowspan="3" align="left" valign="top">
	<div class="overview" style="margin-left:10px;width:99%;">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
		   <tr class="overview_heading">
    <td colspan="2"  align="left" valign="middle">Recent Activites / Errors</td>
  </tr>
  <tr>
    <td align="left" valign="top"></td>
    <td align="left" valign="top">
	<?php foreach($recent as $recentact)
	{
	if($recentact->type=="g")
	$tdstyle="class='greenerror'";
	else
	$tdstyle="class='rederror'";
	?>
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
	<tr>
	<td align="left" height="20" valign="top" <?php echo $tdstyle;?>><?php echo $recentact->matter?> </td>
	</tr>
	</table>
	<?php 
	}
	?></td>
  </tr>
</table>
      </div>	</td>
  </tr>
  <tr>
    <td valign="top" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" align="left" valign="top">
	<div class="overview" style="width:99%;">
          <table width="100%" border="0" align="left" cellpadding="2" cellspacing="2">
		   <tr class="overview_heading">
    <td colspan="2"  align="left" valign="top">Panel shortcuts</td>
  </tr>
  <tr>
    <td  align="left" valign="top" colspan="2">
	<div id="shortcuts">
	<ul>
	<li><a href="index.php?option=com_articlepost"><img src="allfiles/articles.jpg" alt="Articles"><span>Articles</span></a></li>
	<li><a href="index.php?option=com_blogpost"><img src="allfiles/blogimage.jpg" alt="Blog"><span>Blog</span></a></li>
	<li><a href="index.php?option=com_forumtopics"><img src="allfiles/forum.jpg" alt="Forum"><span>Forum</span></a></li>
	</ul>
	</div>	</td>
  </tr>
</table>
</div></td>
    </tr>
</table>
	  
      <!--<div class="latest">
        <div class="dashboard-heading">Latest 10 Orders</div>
        <div class="dashboard-content">
          <table width="400" cellpadding="0" cellspacing="0" class="list">
            <thead>
              <tr>
                <td class="right">Order ID</td>
                <td class="left">Customer</td>
                <td class="left">Status</td>
                <td class="left">Date Added</td>
                <td class="right">Total</td>
                <td class="right">Action</td>
              </tr>
            </thead>
            <tbody>
                            <tr>
                <td class="center" colspan="6">No results!</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>-->
    </div>
  </div>