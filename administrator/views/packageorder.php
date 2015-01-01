<?php 
include('includes/session.php');
include("model/order.class.php");
$contentpageObj=new orderClass();

$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=1;
if($_GET['fld']=='name')
  $_GET['fld']="buyer_name";
  if($_GET['fld']=='')
   $_GET['fld']='ordered_date';
 if($_GET['ord']=='')
 $_GET['ord']='DESC';
$allpages=$contentpageObj->getAllorderList($_GET['fld'],$_GET['ord'],$start,$limit);
$total=$contentpageObj->getAllorderListCount();

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

if($option!="view_order")
{
$sel_set="select * from ".TPREFIX.TBL_SITESETTINGS;
$rs_set=$callConfig->getRow($sel_set);
	

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
			  <td width="290" align="left" valign="middle" >Package Name</td>
			    <td width="290" align="left" valign="middle" >Authorize Response</td>
			    
			  <td width="43" align="center" valign="middle" >status</td>
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
			<td colspan="2" align="left" valign="middle"><?php echo $all_pages->buyer_name;?></td>
			<td  align="left" valign="middle"><?php echo $all_pages->order_packagename;?></td>
			<td  align="left" valign="middle"><?php echo $all_pages->authorize_response;?></td>
			
			<td align="center" valign="middle"><?php echo $all_pages->status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=view_order&id=<?php echo $all_pages->order_id;?>">View</a></td>
			
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
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=packageorder', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

    </table>
	
  </div>
  </div>
   <?php } else if($option=="view_order") {
   
   // include('model/order.class.php');
	
    $res=orderClass::getOrderData($_GET['id']);
	//print_r($res);
	 $strpackages=implode(",", $_POST['packages']);
	$other_pack=explode(",",$res->order_otherpackages);
   ?>
   <div class="box">
    <div class="heading">
      <h1><img src="allfiles/content.jpeg" alt=""> View Order</h1>
    </div>
    <div class="content">
	<table width="802">
	<tr><td width="281"><b>Order Number :</b></td>
	<td width="509"><?=$res->order_number?></td>
	</tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Payment Status :</b></td><td><?php if($res->payment_status==1){echo "Completed"; }?></td></tr>
	</table>
	<br /><br />
	<table width="98%" border="1" cellspacing="3" bordercolor="green" cellpadding="0" style="border-collapse: collapse">
                          
                      
                  		   <tr bgcolor="green" >
    
                <td  align="center" height="25"><b>
                <font face="Arial" size="2" color="#FFFFFF">Package Name</font></b></td>
             
                <td   align="center"><b>
                <font face="Arial" size="2" color="#FFFFFF">Price</font></b></td>
				<td   align="center"><b>
                <font face="Arial" size="2" color="#FFFFFF">Discount</font></b></td>
                <td  align="center"><b>
                <font face="Arial" size="2" color="#FFFFFF">Total</font></b></td>
				
            </tr>              
	         <tr>
                
                <td  valign="middle" align="left" style="padding:5px;">
           <?=$res->order_packagename?>
			 </td>
                <td valign="middle" align="right" class="cart" style="padding-right:10px;">$<?=$res->order_price?></td>
				 <td valign="middle" align="right" class="cart" style="padding-right:10px;">$0.00</td>
             
                <td  align="right" valign="middle" class="cart" style="padding-right:10px;" >$<?=$res->order_price?></td>
                
				
      </tr>
              <?php
			  $total=0;
			  $total=$total+$res->order_price;
			  $dis_total=0;
			  if($res->is_certified!='0.00'){
			     $total=$total+$res->is_certified;
				  if($res->is_messanger!='0.00')
			     $total=$total+$res->is_messanger;
				 if($res->is_nextday!='0.00')
			     $total=$total+$res->is_nextday;
			  include('model/otherpackages.class.php');
			  
			  for($i=0;$i<sizeof($other_pack);$i++)
			  {
			  
			  if($res_upgrade->other_type!='')
			 		$other_pack1=explode("_",$other_pack[$i]);
			   		 if(sizeof( $other_pack1)>0) {
			
					 $res_upgrade=otherpackagesClass::getPackageData($other_pack1['0']);
					 if($res_upgrade->other_type=='ADD-ONS')
					 { 
					  $dis=($other_pack1['1']*15)/100;
					   $dis_total= $dis_total+$dis;
					  $price=$other_pack1['1']-$dis;
					 }
					 else
					 {
					   $dis='0.00';
					   $price=$other_pack1['1']-$dis;
					 }
					 $total=$total+$price; 
					 
			  ?>
              
			   <tr>
                
                <td  valign="middle" align="left" style="padding:5px;">
          		 <?=$res_upgrade->other_title?>(<?=$res_upgrade->other_type?>)
			 </td>
                <td valign="middle" align="right" class="cart" style="padding-right:10px;">$<?=$other_pack1['1']?></td>
              <td valign="middle" align="right" class="cart" style="padding-right:10px;">$<?=$dis?></td>
                <td  align="right" valign="middle" class="cart" style="padding-right:10px;">$<?=number_format($price,2)?></td>
                
				
              </tr>
              
			  <?php } }} ?>
			  
			   
			    <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Discount Price:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?=number_format($dis_total, 2, '.', '')?></b>&nbsp;</td>
              </tr>
			   <?php  if($res->is_certified!='0.00') { ?>
			   <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Delivery by Certified Mail:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?=number_format($res->is_certified, 2, '.', '')?></b>&nbsp;</td>
              </tr>
			   <?php }?>
			    
			   <?php  if($res->is_messanger!='0.00') { ?>
			   <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
               Delivery by Messenger :&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?=number_format($res->is_messanger, 2, '.', '')?></b>&nbsp;</td>
              </tr>
			   <?php }?>
			   
			   <?php  if($res->is_nextday!='0.00') { ?>
			   <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
               Next Day Service :&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?=number_format($res->is_nextday, 2, '.', '')?></b>&nbsp;</td>
              </tr>
			   <?php }?>
			   
			    <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Sub Total:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?=number_format($total+$dis_total, 2, '.', '')?></b>&nbsp;</td>
              </tr>
			 
			    <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                State Tax:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?php    echo number_format($res->govt_tax, 2, '.', '');?></b>&nbsp;</td>
              </tr>
			     <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Municipal Tax:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?php  
			   echo number_format($res->local_tax, 2, '.', '');
			   ?></b>&nbsp;</td>
              </tr>
			  <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Grand Total:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $<?=number_format($total+$res->govt_tax+$res->local_tax, 2, '.', '')?></b>&nbsp;</td>
              </tr>
              
            	
         
          
            	
          
</table>
	<br /><br />
	<table width="802">
	<tr><td width="281"><b>To (Full Name) :</b></td>
	<td width="509"><?=$res->fullname?></td>
	</tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>From :</b></td><td><?=$res->from_user?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Buyer Full Name :</b></td><td><?=$res->buyer_name?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Buyer Phone Number :</b></td><td><?=$res->buyer_phone?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Buyer Email Id :</b></td><td><?=$res->buyer_emailid?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Buyer Message :</b></td><td><?=$res->buyermessage?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>PickUp Location :</b></td><td><?=$res->pickup_location?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Delivery by Certified Mail :</b></td><td>$<?=$res->is_certified?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Delivery by Certified Mail Address:</b></td><td><?=$res->cretified_mesage?></td></tr><br />
	<tr><td height="10px"></td></tr>
	<tr><td><b>Delivery by Messenger  :</b></td><td>$<?=$res->is_messanger ?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Delivery by Messenger Address:</b></td><td><?=$res->messager_msg?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Next Day Service :</b></td><td>$<?=$res->is_nextday ?></td></tr>
	<tr><td height="10px"></td></tr>
	<tr><td><b>Next Day Delivery Address:</b></td><td><?=$res->nextday_msg?></td></tr>

	
	</table>
	
</div>
</div>
<?php }?>