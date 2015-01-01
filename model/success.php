<?php
include_once("includes/sessions.php");

include('dbconfig.php');
include('administrator/includes/dbconnection.php');
include("includes/header.php");

 include('model/order.class.php');
	
    $res=orderClass::getTempData($_SESSION['oid']);
	 $strpackages=implode(",", $_POST['packages']);
	$other_pack=explode(",",$res->order_otherpackages);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Zen spa Retreatments</title>

<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body onLoad="MM_preloadImages('images/swap_button_15.jpg','images/swap_button_18.jpg')">
<table width="1012" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="background-image:url(images/side_02.jpg); background-repeat:repeat-y; width:6px"><img src="images/side_02.jpg" width="6" height="22" /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:246px"><a href="<?php echo DEFAULT_URL; ?>"><img src="images/Zenspa_03.jpg" width="246" height="103" border="0" /></a></td>
            <td align="left" valign="top"><img src="images/Zenspa_04.jpg" width="754" height="103" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top">
		
		
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" style="background-image: url(images/Zenspa_bg_18.jpg); background-repeat:repeat-y; width:246px;"><p>&nbsp;</p>
              <p>&nbsp;</p>
              <?php include("includes/side.php"); ?>
			  
			  </td>
            <td align="left" valign="top" style="width:22px; background-image:url(images/side_inner_bg_14.jpg); background-repeat:repeat-y; background-position:left top"><img src="images/Zenspa_bg_10.jpg" width="22" height="329" /></td>
            <td align="left" valign="top" style="background-image:url(images/Zenspa_bg_11.jpg); background-repeat:repeat-x; padding:15px">
			
			<!-- Content -->
			
			<table>
			<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Thanks for your order. <br><br><b>Your Order Number is :</b><?=$_GET['orderid']?>
			
			 <?php
			 $msg='<table width="600px" border="1" cellspacing="3" bordercolor="#000000" cellpadding="0" style="border-collapse: collapse">
             	<tr bgcolor="#000000" >
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
           '.$res->order_packagename.'
			 </td>
                <td valign="middle" align="right" class="cart" style="padding-right:10px;">$'.$res->order_price.'</td>
				 <td valign="middle" align="right" class="cart" style="padding-right:10px;">$0.00</td>
             
                <td  align="right" valign="middle" class="cart" style="padding-right:10px;" >$'.$res->order_price.'</td>
                
				
              </tr>';
			 
			 
			  $total=0;
			  $total=$total+$res->order_price;
			  if($res->is_certified!='0.00')
			     $total=$total+$res->is_certified;
				  if($res->is_messanger!='0.00')
			  $total=$total+$res->is_messanger;
				 
			  $dis_total=0;
			  include('model/otherpackages.class.php');
			  for($i=0;$i<sizeof($other_pack);$i++)
			  {
			   	 if($other_pack[$i]!=''){
			 		 $other_pack1=explode("_",$other_pack[$i]);
				 }
			    if(count($other_pack1)>0 && $other_pack[$i]!='') {
			
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
					 
					 $msg= $msg.'<tr>
                
                <td  valign="middle" align="left" style="padding:5px;">'.$res_upgrade->other_title.' ( '.$res_upgrade->other_type.')
			 </td>
                <td valign="middle" align="right" class="cart" style="padding-right:10px;">$ '.$other_pack1['1'].'</td>
              <td valign="middle" align="right" class="cart" style="padding-right:10px;">$'.$dis.'</td>
                <td  align="right" valign="middle" class="cart" style="padding-right:10px;">$'.number_format($price,2).'</td>
                </tr>';
              
			 }} 
			 
			 $msg= $msg.' <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                 Total:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($total+$dis_total, 2, '.', '').'</b>&nbsp;</td>
              </tr>
			    <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Discount Price:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($dis_total, 2, '.', '').'</b>&nbsp;</td>
              </tr>';
			  
			    if($res->is_certified!='0.00') { 
			   $msg= $msg.'<tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Delivery by Certified Mail:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($res->is_certified, 2, '.', '').'</b>&nbsp;</td>
              </tr>';
			    }
			    
			   if($res->is_messanger!='0.00') { 
			    $msg= $msg.'<tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
               Delivery by Messenger :&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($res->is_messanger, 2, '.', '').'</b>&nbsp;</td>
              </tr>';
			    }
			   
			  $msg= $msg.' <tr>
                <td colspan="3" align="right" valign="middle" height="25" class="cart"><b>
                Grand Total:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($total, 2, '.', '').'</b>&nbsp;</td></tr></table>';
			echo $msg;
			
			 $subject = "Zenspa Package Order";
					$from="meloenvias@gmail.com";
					$to=$res->buyer_emailid;
					
					$headers = "From: " . strip_tags($from) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					 $ok=mail($to,$subject,$msg,$headers);
			  ?>
			
			
			
			
			</td></tr>
			
			</table>
			
			
			
			
			
			
			
			<!-- Content -->
			
			
			
			
			</td>
            <td align="right" valign="top" style="width:22px; background-repeat:repeat-y; background-image:url(images/side_inner_bg_15.jpg); background-position:right top"><img src="images/Zenspa_bg_13.jpg" width="22" height="329" /></td>
          </tr>
          <tr>
            <td align="left" valign="top" style="background-image: url(images/Zenspa_bg_18.jpg); background-repeat:repeat-y; width:246"><img src="images/zenspa_bw_20.jpg" width="246" height="435" /></td>
            <td align="left" valign="top" style="width:22px"><img src="images/zenspa_bw_21.jpg" width="22" height="435" /></td>
            <td align="left" valign="top"  style="background-image:url(images/zenspa_bw_22.jpg); height:435px; width:710px"></td>
            <td align="right" valign="top" style="width:22px"><img src="images/zenspa_bw_23.jpg" width="22" height="435" /></td>
          </tr>
        </table>
		
		
		
		
		
		
		</td>
      </tr>
	  
	  <!-- Footer -->
	  
	   <?php include("includes/footer.php"); ?>
	  
	  
     