<?php 
include('includes/session.php');
include("model/treatments.class.php");
$contentpageObj=new treatmentClass();

if($_GET['action']=="delete")
{
   $contentpageObj->TreatmentDelete($_GET['id']);
}
$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=1;
$allpages=$contentpageObj->getAlltreatmentList($_GET['fld'],$_GET['ord'],$start,$limit);
$total=$contentpageObj->getAlltreatmentListCount();
?>
<script type="text/javascript">
function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate(){
		   var title=trim(document.frmCreateListing.title.value);
		  if(document.frmCreateListing.cid.value=='0')
		   {
		    alert("Please Select Treatment Type");
			document.frmCreateListing.cid.focus();
			return false;
		   }
			else if(title.length<1)
			{
				alert("Please Enter Title");
				document.frmCreateListing.title.focus();
				return false;
		    }
			else if(document.frmCreateListing.price.value=='')
			{
				alert("Please Enter Price");
				document.frmCreateListing.price.focus();
				return false;
		    }
			
		return true;	
}

</script>

<?php
if($option!="treatment_insert")
{
?>
<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/content.jpeg" alt="">Packages</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=treatment_insert';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="20" align="center" valign="middle" style="text-align: center;">Sno</td>
			   <td width="290" align="left" valign="middle" >Treatments</td>
			   <td width="590" align="left" valign="middle" >title</td>
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
			<td  align="left" valign="middle"><?php 
			$os = array("Body Massage", "Body Zen Stone Therapies", "Body Exfoliations", "Body Wraps","body Zen Sidnature Therapies","Facial Skin Therapies","Facial Skin Boosters","Facial Zen Signature Therapies","Face & Body Waxing","Hands & Feet Nail Care","Vip Spa Suites","Hair Care Hair Studio");
			 $j=($all_pages->c_id)-1;
echo $os[$j];
			
			?></td>
			<td  align="left" valign="middle"><?php echo $all_pages->t_title;?></td>
			<td  align="left" valign="middle">$<?php echo $all_pages->t_price;?></td>
			<td align="center" valign="middle"><?php echo $all_pages->status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=treatment_insert&id=<?php echo $all_pages->t_id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=treatment&action=delete&id=<?php echo $all_pages->t_id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
			  </td>
			</tr>
			<?php
				$ii++; } } else{
			?>
							<tr><td colspan="6" align="center" height="100">No Records..</td></tr>
			<?php 
			}
			?>
			</tbody>
						<tr><td colspan="6" align="left"><?php if($total>$limit)
			{
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['ord']!="")
			$param.="&ord=".$_GET['ord'];
			if($_GET['ord']!="")
			$param.="&fld=".$_GET['fld'];
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=treatment', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

    </table>
	
  </div>
  </div>
   <?php } else {
	   if($_POST['admininsert']=="Submit")
{
   $contentpageObj->insertTreatment($_POST);
}
if($_POST['admininsert']=="Update")
{
	//print_r($_POST);
  $contentpageObj->updateTreatment($_POST);
}
if(isset($_GET['id']) && $_GET['id']!="")
{
   $hdn_value="Update";
   $indivdata=$contentpageObj->getTreatmentData($_GET['id']); 
   $hdn_in_up='class="button button_save"';
}
else
{ 
  $hdn_value="Submit";
  $hdn_in_up='class="button button_add"';
}
	   
	   ?>
   <div class="box">
    <div class="heading">
      <h1><img src="allfiles/content.jpeg" alt=""> Add Package &nbsp;&nbsp;/&nbsp;&nbsp; Edit Package</h1>
    </div>
    <div class="content">
	<form action="" method="post" id="frmCreateListing" name="frmCreateListing" class="middle_form" onsubmit="return validate();" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Treatment Category:</label></td>
                <td width="94%" align="left" valign="middle">
				<select name="cid" id="cid">
				<option value="0">Select</option>
				<option value="1">Body Massage</option>
				<option value="2">Body Zen Stone Therapies</option>
				<option value="3">Body Exfoliations</option>
				<option value="4">Body Wraps</option>
				<option value="5">body Zen Sidnature Therapies</option>
				<option value="6">Facial Skin Therapies</option>
				<option value="7">Facial Skin Boosters </option>
				<option value="8">Facial Zen Signature Therapies</option>
				<option value="9">Face & Body Waxing</option>
				<option value="10">Hands & Feet Nail Care</option>
				<option value="11">Vip Spa Suites</option>
				<option value="12">Hair Care Hair Studio</option>
				</select>
				<script type="text/javascript">
                for(var i=0;i<document.getElementById('cid').length;i++)
                {
						if(document.getElementById('cid').options[i].value=="<?php echo $indivdata->c_id; ?>")
						{
						document.getElementById('cid').options[i].selected=true
						}
                }			
                </script>
				
				</td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Treatment Titles:</label></td>
                <td width="94%" align="left" valign="middle">
				<textarea name="title" rows="5" cols="40"><?php echo  stripslashes($indivdata->t_title);?></textarea>
				</td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
				
				<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Price For One:</label></td>
                <td width="94%" align="left" valign="middle"><input name="price" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->t_price);?>" style="width:800px;" maxlength="13"/></td>
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
	<td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->t_id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><input <?php echo $hdn_in_up;?> type="submit" value="">
	</td>
	</tr>
    
   
    
        </table>
		</form>
</div>
</div>
<?php }?>