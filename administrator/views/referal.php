<?php 
include('includes/session.php');
include("model/referal.class.php");
$categoryObj=new referalcodeClass();
if($_GET['action']=="delete"){
   $categoryObj->ReferalcodeDelete($_GET['id']);
}

if($option=="referal"){
$start=0;
if($_GET['start']!="")
$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=1;
if($_GET['fld']!="")
$fldname=$_GET['fld'];
else
$fldname="created_date";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="DESC";
$allcategory=$categoryObj->getAllReferalcodeList($fldname,$orderby,$start,$limit);
$total=$categoryObj->getAllReferalcodeListCount();

?>
<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt="">MANAGE REFERRAL CODES</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=referal_code';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
				<td width="36" align="center" valign="middle">sno</td>
				<td width="1093" align="left" valign="middle" >Title</td>
				<td width="1093" align="left" valign="middle" >Referal Code</td>
				<td width="35" align="left" valign="middle" >Status</td>
				<td width="32" align="center" valign="middle" >Edit</td>
				<td width="35" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
			if(sizeof($allcategory)>0){
					$ii=0;
					foreach($allcategory as $category){
					?>
			<tr height="22">
			<td align="center" valign="middle"><?=($ii+1);?></td>
			<td  align="left" valign="middle"><?php echo stripslashes($category->title);?></td>
			<td  align="left" valign="middle"><?php echo stripslashes($category->referal_code);?></td>
			<td align="left" valign="middle"><?php echo $category->status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=referal_code&id=<?php echo $category->id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=referal&action=delete&id=<?php echo $category->id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
						</td>
			</tr>
			<?php
				$ii++; } } else{
			?>
							<tr><td colspan="8" align="center" height="100">No Records..</td></tr>
			<?php 
			}
			?>
			</tbody>
						<tr><td colspan="10" align="left">
						<?php if($total>$limit)
			{
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['ord']!="")
			$param.="&ord=".$_GET['ord'];
			if($_GET['ord']!="")
			$param.="&fld=".$_GET['fld'];
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=referal', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

      </table>
	
	</div>
  </div>
 <?php } else if($option=="referal_code") {
 
 if($_POST['admininsert']=="Submit"){
 $categoryObj->insertReferalcode($_POST);
}
if($_POST['admininsert']=="Update"){
   $categoryObj->updateReferalcode($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$categoryObj->getReferalcodeData($_GET['id']); 
   $hdn_in_up='class="button button_save"';
} else { 
  $hdn_value="Submit";
  $hdn_in_up='class="button button_add"';
}
 ?>

<script type="text/javascript">
function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate()
{
	var re1=/^[a-zA-Z0-9]+$/
	if(trim(document.frmCreatestate.title.value)=="")
	{ 
		alert("Please enter Title");
		document.frmCreatestate.title.value='';
		document.frmCreatestate.title.focus();
		return false;
	}
	else if(trim(document.frmCreatestate.referal_code.value)=="")
	{ 
		alert("Please enter referal code");
		document.frmCreatestate.referal_code.value='';
		document.frmCreatestate.referal_code.focus();
		return false;
	}
	else if(!re11.test(document.frmCreatestate.referal_code.value)))
	{
	    alert("Special characters are not allowed");
		document.frmCreatestate.referal_code.value='';
		document.frmCreatestate.referal_code.focus();
		return false;
	}

document.frmCreatestate.submit();
return true;
}
</script>

 <div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt=""> Add &nbsp;&nbsp;/&nbsp;&nbsp; Edit Referral Code</h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
    
    <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title:</label></td>
                <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>"/></td>
	</tr>
			  <tr><td colspan="2" height="7"></td></tr>
	
                 
				 <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Referal Code:</label></td>
                <td width="94%" align="left" valign="middle"><input name="referal_code" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->referal_code);?>"/></td>
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
						if(document.getElementById('status').options[i].value=="<?php echo $indivdata->status; ?>")
						{
						document.getElementById('status').options[i].selected=true
						}
                }			
                </script></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
	<tr>
	<td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?><input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>
	</tr>
        </table>
	</form>	
	</div>
  </div>
 <?php }?>