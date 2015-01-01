<?php 
include('includes/session.php');
include("model/gifts.class.php");
$contentpageObj=new giftsClass();

$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=1;
if($_GET['fld']=='name')
  $_GET['fld']="g_name";
  if($_GET['fld']=='')
   $_GET['fld']='created_date';
 if($_GET['ord']=='')
 $_GET['ord']='DESC';
$allpages=$contentpageObj->getAllgiftsList($_GET['fld'],$_GET['ord'],$start,$limit);
$total=$contentpageObj->getAllgiftsListCount();

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

if($option!="view_giftsorder")
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
			   <td width="290" align="left" valign="middle" >Buyer Name</td>
			
              <td width="308" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=packages&ord=ASC&fld=name" class="up" title="up"></a>
					<a href="index.php?option=packages&ord=DESC&fld=name" class="down" title="down"></a>
					</div>
</td>
			  <td width="290" align="left" valign="middle" >Email Id</td>
			    
		
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
			<td colspan="2" align="left" valign="middle"><?php echo $all_pages->buyer_name ;?></td>
			<td  align="left" valign="middle"><?php echo $all_pages->g_emailid ;?></td>
			
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=view_giftsorder&id=<?php echo $all_pages->g_id;?>">View</a></td>
			
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
   <?php } else if($option=="view_giftsorder") {
   
   // include('model/order.class.php');
	
    $res=giftsClass::getGiftsData($_GET['id']);
	  include('model/treatments.class.php');
	
	$allstates=treatmentClass::getTreatmentData($res->g_treatmenttype);;  
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

	<tr><td><b>Price  :</b></td><td>$<?=$res->g_price?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Message :</b></td><td><?=$res->g_message?></td></tr>
	<tr><td height="10px"></td></tr>
	
	
	<tr><td><b>Treatment Desires Types :</b></td><td><?=$allstates->t_title?></td></tr>
	<tr><td height="10px"></td></tr>
	

	<tr><td><b>Receipient Name :</b></td><td><?=$res->g_recepientname?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr>
	  <td><b>Buyer's Email Id :</b></td>
	  <td><?=$res->g_emailid ?></td></tr>
	<tr><td height="10px"></td></tr>
	
	<tr><td><b>From :</b></td><td><?=$res->from_user?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Buyer Full Name :</b></td><td><?=$res->buyer_name?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Buyer Phone Number :</b></td><td><?=$res->buyer_phone?></td></tr>
	<tr><td height="10px"></td></tr>
	
	<tr><td><b>Buyer Message :</b></td><td><?=$res->buyermessage?></td></tr>
	<tr><td height="10px"></td></tr>
	<?php /*?><tr><td><b>PickUp Location :</b></td><td><?=$res->pickup_location?></td></tr>
	<tr><td height="10px"></td></tr><?php */?>
	<tr><td><b>Delivery by Certified Mail :</b></td><td>$<?=$res->is_certified?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Delivery by Certified Mail Address:</b></td><td><?=$res->cretified_mesage?></td></tr><br />
<tr><td height="10px"></td></tr>
	<tr><td><b>Delivery by Messenger  :</b></td><td>$<?=$res->is_messanger ?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Delivery by Messenger Address:</b></td><td><?=$res->messager_msg?></td></tr>
	
	
	
	
	
	
	</table>
	
</div>
</div>
<?php }?>