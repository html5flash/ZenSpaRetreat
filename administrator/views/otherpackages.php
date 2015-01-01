<?php 
include('includes/session.php');
include("model/otherpackages.class.php");
$contentpageObj=new otherpackagesClass();
if($_POST['admininsert']=="Submit")
{
   $contentpageObj->insertPackage($_POST);
}
if($_POST['admininsert']=="Update")
{
   $contentpageObj->updatePackage($_POST);
}
if(isset($_GET['id']) && $_GET['id']!="")
{
   $hdn_value="Update";
   $indivdata=$contentpageObj->getPackageData($_GET['id']); 
   $hdn_in_up='class="button button_save"';
}
else
{ 
  $hdn_value="Submit";
  $hdn_in_up='class="button button_add"';
}
if($_GET['action']=="delete")
{
   $contentpageObj->PackageDelete($_GET['id']);
}
$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=1;
$allpages=$contentpageObj->getAllotherpackagesList($_GET['fld'],$_GET['ord'],$start,$limit);
$total=$contentpageObj->getAllotherpackagesListCount();
?>
<script type="text/javascript">
function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate(){
		   var title=trim(document.frmCreateListing.title.value);
			if(title.length<1)
			{
				alert("Please Enter Title");
				document.frmCreateListing.title.focus();
				return false;
		    }
		return true;	
}

</script>

<?php
if($option!="otherpackages_insert")
{
?>
<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/content.jpeg" alt="">Packages</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=otherpackages_insert';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="20" align="center" valign="middle" style="text-align: center;">Sno</td>
			   <td width="290" align="left" valign="middle" >title</td>
              <td width="308" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=otherpackages&ord=ASC&fld=other_title" class="up" title="up"></a>
					<a href="index.php?option=otherpackages&ord=DESC&fld=other_title" class="down" title="down"></a>
					</div>
</td>
 <td width="100" align="left" valign="middle" >Type</td>
			   <td width="100" align="left" valign="middle" >Price</td>
			  <td width="43" align="center" valign="middle" >status</td>
              <td width="35" align="center" valign="middle" >Edit</td>
			  <td width="35" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
			if(sizeof($allpages)>0){
					$ii=0;
					foreach($allpages as $all_pages)
					{
					?>
			<tr height="22">
			<td align="center" valign="middle"><?=($ii+1);?></td>
			<td colspan="2" align="left" valign="middle"><?php echo $all_pages->other_title;?></td>
			<td align="center" valign="middle"><?php echo $all_pages->other_type ;?></td>
			<td align="center" valign="middle">$ <?php echo $all_pages->other_price;?></td>
			<td align="center" valign="middle"><?php echo $all_pages->other_status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=otherpackages_insert&id=<?php echo $all_pages->other_id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=otherpackages&action=delete&id=<?php echo $all_pages->other_id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
			  </td>
			</tr>
			<?php
				$ii++; } } else{
			?>
							<tr><td colspan="7" align="center" height="100">No Records..</td></tr>
			<?php 
			}
			?>
			</tbody>
						<tr><td colspan="10" align="left"><?php if($total>$limit)
			{
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['ord']!="")
			$param.="&ord=".$_GET['ord'];
			if($_GET['ord']!="")
			$param.="&fld=".$_GET['fld'];
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=otherpackages', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

    </table>
	
  </div>
  </div>
   <?php } else {?>
   <div class="box">
    <div class="heading">
      <h1><img src="allfiles/content.jpeg" alt=""> Add Package &nbsp;&nbsp;/&nbsp;&nbsp; Edit Package</h1>
    </div>
    <div class="content">
	<form action="index.php?option=otherpackages_insert" method="post" id="frmCreateListing" name="frmCreateListing" class="middle_form" onsubmit="return validate();" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Package Title:</label></td>
                <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->other_title);?>" style="width:800px;" maxlength="400"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
				
				<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Price :</label></td>
                <td width="94%" align="left" valign="middle"><input name="for_one" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->other_price);?>" style="width:800px;" maxlength="13"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
             
			 
				   
				<tr>
                <td align="left" class="caption-field"><label class="title">Status :</label> </td>
                <td align="left" valign="middle" class="caption-field">
    <select name="status" id="status" class="select_large required">
	<option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
	</select>
	<script type="text/javascript">
                for(var i=0;i<document.getElementById('status').length;i++)
                {
						if(document.getElementById('status').options[i].value=="<?php echo $indivdata->other_status; ?>")
						{
						document.getElementById('status').options[i].selected=true
						}
                }			
                </script></td>
			  </tr>
			  <tr>
                <td align="left" class="caption-field"><label class="title">Package Type :</label> </td>
                <td align="left" valign="middle" class="caption-field">
    <select name="type" id="type" class="select_large required">
	<option value="ADD-ONS">ADD-ONS</option>
    <option value="Upgrade">Upgrade</option>
	</select>
	<script type="text/javascript">
                for(var i=0;i<document.getElementById('type').length;i++)
                {
						if(document.getElementById('type').options[i].value=="<?php echo $indivdata->other_type; ?>")
						{
						document.getElementById('type').options[i].selected=true
						}
                }			
                </script></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
	<tr>
	<td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->other_id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><input <?php echo $hdn_in_up;?> type="submit" value="">
	</td>
	</tr>
        </table>
		</form>
</div>
</div>
<?php }?>