<?php 
include('includes/session.php');
include('includes/pageaccess.php');
$countusers=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_ADMIN,'user_id'," roletype='senior' or roletype='level1' ");
$countRegisterdusers=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_ADMIN,'user_id'," roletype='level2' ");
$countpages=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_CONTENTPAGES,'page_id','');
$countimages=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_BANNERS,'id','');
$countproducts=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_STOREPRODUCTS,'spid','');
$countnewsevents=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_NEWSEVENTS,'id','');
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
  <tr>
    <td align="left" valign="middle"><label class="title">Total admin users</label> </td>
    <td align="left" valign="middle"><?php echo $countusers;?></td>
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
    <td colspan="2"  align="left" valign="middle">Panel shortcuts</td>
  </tr>
  <tr>
    <td  align="left" valign="middle" colspan="2">
	<div id="shortcuts">
	<ul>
		<li><a href="index.php?option=com_sitesettings"><img src="allfiles/settings.jpeg" alt="Settings"><span>Settings</span></a></li>
		<li><a href="index.php?option=com_adminlist"><img src="allfiles/users.jpg" alt="Admin Users"><span>Admin Users</span></a></li>
		<li><a href="index.php?option=packages"><img src="allfiles/pages.jpeg" alt="Pages"><span>Package</span></a></li>
		<li><a href="index.php?option=packageorder"><img src="allfiles/store.jpg" alt="Store"><span>Orders</span></a></li>
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