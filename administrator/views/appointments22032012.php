<?php 
include('includes/session.php');
include("model/appointment.class.php");
$contentpageObj=new appointmentsClass();

$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=1;
if($_GET['fld']=='name')
  $_GET['fld']="a_name";
  if($_GET['fld']=='')
   $_GET['fld']='created_date';
 if($_GET['ord']=='')
 $_GET['ord']='DESC';
$allpages=$contentpageObj->getAllappointmentsList($_GET['fld'],$_GET['ord'],$start,$limit);
$total=$contentpageObj->getAllappointmentsListCount();

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

if($option=='appointments')
{
?>
<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/content.jpeg" alt="">Packages Order</h1></td>
<td align="right" valign="bottom"><!--<input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=packages_insert';">--></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="20" align="center" valign="middle" style="text-align: center;">Sno</td>
			  <td width="290" align="left" valign="middle" >Order Number</td>
			   <td width="290" align="left" valign="middle" >Name</td>
			
              <td width="308" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=packages&ord=ASC&fld=name" class="up" title="up"></a>
					<a href="index.php?option=packages&ord=DESC&fld=name" class="down" title="down"></a>
					</div>
</td>
			  <td width="290" align="left" valign="middle" >Payment Status</td>
			    
		
              <td width="35" align="center" valign="middle" >View</td>
			  
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
			<td align="left" valign="middle"><?php echo $all_pages->order_number;?></td>
			<td colspan="2" align="left" valign="middle"><?php echo $all_pages->a_name ;?></td>
			<td  align="left" valign="middle"><?php echo $all_pages->a_emailid ;?></td>
			
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=view_appsorder&id=<?php echo $all_pages->a_id;?>">View</a></td>
			
			</tr>
			<?php
				$ii++; } } else{
			?>
							<tr><td colspan="6" align="center" height="100">No Records..</td></tr>
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
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=gifts', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

    </table>
	
  </div>
  </div>
   <?php } else if($option=="view_appsorder") {
   
   // include('model/order.class.php');
	
    $res=appointmentsClass::getappointmentsData($_GET['id']);
	  include('model/otherpackages.class.php');
	$res1=otherpackagesClass::getPackageData($res->a_addons);
   ?>
   <div class="box">
    <div class="heading">
      <h1><img src="allfiles/content.jpeg" alt=""> View Gift Order</h1>
    </div>
    <div class="content">
	<table width="802">
	<tr><td><b>Payment Status :</b></td><td><?php if($res->payment_status==1){echo "Completed"; }?></td></tr>
	<tr><td width="281"><b>Order Number :</b></td>
	<td width="509"><?=$res->order_number?></td>
	</tr></table>
	<br /><br />

	<table width="802">
	<tr><td width="281"><b>Full Name :</b></td>
	<td width="509"><?=$res->a_name ?></td>
	</tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Phone Number:</b></td><td><?=$res->a_phone?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Email Id :</b></td><td><?=$res->a_emailid ?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Mobile Number  :</b></td><td>$<?=$res->a_celular?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Treatment Desires :</b></td><td><?=$res->a_treatment?></td></tr>
	
	<tr><td height="10px"></td></tr>
	<tr><td><b>Add Ons :</b></td><td><?=$res1->other_title?></td></tr>

	<tr><td height="10px"></td></tr>
	<tr><td><b>Scheduled Date and Time:</b></td><td><?=$res->a_date?>  <?=$res->a_time?></td></tr>
	<tr><td height="10px"></td></tr>
	
	
	</table>
	
</div>
</div>
<?php }?>