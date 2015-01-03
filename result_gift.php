<?php
include_once("includes/sessions.php");
include("includes/header.php");
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
include("includes/header.php");
include('model/order.class.php');
include('model/gifts.class.php');
$res=giftsClass::getGiftsData($_SESSION['gid']);
include('model/treatments.class.php');

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
            <td style="width:246px"><img src="images/Zenspa_03.jpg" width="246" height="103" /></td>
            <td align="left" valign="top"><img src="images/thankyou_04.jpg" width="754" height="103" /></td>
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
			<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
			
			
			Your order was completed. <br><br><b>Your order number is :</b><?=$_GET['orderid']?><br /><br /><br />
			An email has been sent with the purchase details.<br /><br />
			<a href='<?=DEFAULT_URL?>/'>Return Home</a>
			
			<?php
			$result=giftsClass::getGiftsData($_SESSION['gid']);

			 if(sizeof($res)>0)
			 {
			 $msg1='<table width="700px" border="0" cellspacing="3" cellpadding="0" style="border-collapse: collapse"><tr><td>Hello  '.$res->buyer_name.', </td></tr>
			 <tr style="height:10px;"><td>&nbsp;</td></tr>
			 <tr><td>Thank you for your recent purchase at ZenspaRetreat.com! Below are your purchase details. <br><br>If you have any questions regarding this order, please feel free
to contact us and we will be happy to assist.Below are your order details.</td></tr>
 <tr style="height:10px;"><td>&nbsp;</td></tr>
 <tr><td>Buyer\'s Full Name  :'.$res->buyer_name.'</td></tr> <tr><td>&nbsp;</td></tr>
			  <tr><td>Buyer\'s Email  :'.$res->g_emailid.'</td></tr> <tr><td>&nbsp;</td></tr>
				<tr><td>Buyer\'s Telephone :'.$res->buyer_phone.'</td></tr> <tr><td>&nbsp;</td></tr>
			
			   <tr><td>Gift Certificate\'s From Name :'.$res->from_user.'</td></tr><tr><td>&nbsp;</td></tr>
			    	<tr><td>Gift Certificate Recipient Name :'.$res->g_recepientname.'</td></tr><tr><td>&nbsp;</td></tr>
			    <tr><td>Gift Certificate Message:'.$res->g_message.'</td></tr> <tr><td>&nbsp;</td></tr>


			  <tr><td>Your Order Number is:'.$_GET['orderid'].'<br></td></tr>
			   <tr><td>Products : </td></tr>
			 </table><br>';
			  $msg3='<table width="700px" border="0" cellspacing="3" cellpadding="0" style="border-collapse: collapse"><tr><td>Dear Admin, </td></tr>
			 <tr><td>'.$res->buyer_name.' has purchased a gift certificate at Zen Spa Retreat. Below are the details.</td></tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td>Customer Order Number is:'.$_GET['orderid'].'<br></td></tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td>Buyer\'s Full Name  :'.$res->buyer_name.'</td></tr> <tr><td>&nbsp;</td></tr>
			  <tr><td>Buyer\'s Email  :'.$res->g_emailid.'</td></tr> <tr><td>&nbsp;</td></tr>
				<tr><td>Buyer\'s Telephone :'.$res->buyer_phone.'</td></tr> <tr><td>&nbsp;</td></tr>
			
			   <tr><td>Gift Certificate\'s From Name :'.$res->from_user.'</td></tr><tr><td>&nbsp;</td></tr>
			    	<tr><td>Gift Certificate Recipient Name :'.$res->g_recepientname.'</td></tr><tr><td>&nbsp;</td></tr>
			    <tr><td>Gift Certificate Message:'.$res->g_message.'</td></tr> <tr><td>&nbsp;</td></tr>';
				/*<tr><td>Buyer\'s Message :'.$res->buyermessage.'</td></tr> <tr><td>&nbsp;</td></tr>*/
				if($res->pickup_location!=0) {
				$msg3=$msg3.' <tr><td>Store Pick Up Location:'.$_GET['orderid'].'</td></tr>';
				 }
				
			 
			 $msg='<table width="600px" border="1" cellspacing="3" bordercolor="#000000" cellpadding="0" style="border-collapse: collapse">
             	<tr bgcolor="#000000" >
                <td  align="center" height="25"><b>
                <font face="Arial" size="2" color="#FFFFFF">Certificate Details</font></b></td>
             
                <td   align="center"><b>
                <font face="Arial" size="2" color="#FFFFFF">Price</font></b></td>
				
                <td  align="center"><b>
                <font face="Arial" size="2" color="#FFFFFF">Total</font></b></td>
				
            </tr>  ';           
	    
			  
			  if($result->g_treatmenttype!=0)
			{
			    $treatments=treatmentClass::getTreatmentData($result->g_treatmenttype);  
				$price=$treatments->t_price;
				 $msg= $msg.'<tr><td valign="middle" align="left" style="padding:5px;">'.$treatments->t_title.'  </td><td align="right">$'.$treatments->t_price.'</td><td align="right">$'.$treatments->t_price.'&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
				 
			   
			}
			else if($result->g_package!="")
			{
				$price=$result->g_price;
			     $msg= $msg."<tr><td> ".$result->g_package." Package : </td><td  align='right'>$".$result->g_price."</td></tr>";
				 $msg= $msg.'<tr><td width="100%" colspan="2" height="10px"></td></tr>';
			}
			else
			{
			   $price=$result->g_price;
			    $msg= $msg."<tr><td>Flat fee  </td ><td align='right'>$".$result->g_price."</td><td align='right'>$".$result->g_price."&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
				
			}
		
			 
			  $total=0;
			  $total=$total+$price;
			  if($result->is_certified!='0.00')
			  {
			     $total=$total+$result->is_certified;
				 $msg3=$msg3.'<tr><td>Delivery by Certified Mail Address :'.$res->cretified_mesage.'</td></tr> <tr><td>&nbsp;</td></tr>';
			  }
				  if($result->is_messanger!='0.00')
				  {
			  $total=$total+$result->is_messanger;
			  				 $msg3=$msg3.'<tr><td>Delivery by Messenger  Address :'.$res->messager_msg.'</td></tr> <tr><td>&nbsp;</td></tr>';
			  }
				 
			  $dis_total=0;
			 
			 $msg3=$msg3.'</table><br>';
			 
			
			   
			  
			    if($res->is_certified!='0.00') { 
			   $msg= $msg.'<tr>
                <td colspan="2" align="right" valign="middle" height="25" class="cart"><b>
                Delivery by Certified Mail:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($res->is_certified, 2, '.', '').'</b>&nbsp;</td>
              </tr>';
			    }
			    
			   if($res->is_messanger!='0.00') { 
			    $msg= $msg.'<tr>
                <td colspan="2" align="right" valign="middle" height="25" class="cart"><b>
               Delivery by Messenger :&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($res->is_messanger, 2, '.', '').'</b>&nbsp;</td>
              </tr>';
			    }
			    $msg= $msg.' <tr>
                <td colspan="2" align="right" valign="middle" height="25" class="cart"><b>
               Sub Total:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($total, 2, '.', '').'</b>&nbsp;</td></tr>';
			
			 $msg= $msg.' <tr>
                <td colspan="2" align="right" valign="middle" height="25" class="cart"><b>
                State tax:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($res->govt_tax, 2, '.', '').'</b>&nbsp;</td></tr>';
			   
			  $msg= $msg.' <tr>
                <td colspan="2" align="right" valign="middle" height="25" class="cart"><b>
               Municipal Tax:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($res->local_tax, 2, '.', '').'</b>&nbsp;</td></tr>';
			
			  $msg= $msg.' <tr>
                <td colspan="2" align="right" valign="middle" height="25" class="cart"><b>
                Grand Total:&nbsp;</b> </td>
                <td align="right" valign="middle" class="cart" style="padding-right:10px;"><b>
               $'.number_format($total+$res->local_tax+$res->govt_tax, 2, '.', '').'</b>&nbsp;</td></tr></table>';
			
			 $msg2='<br><table width="700px" border="0" cellspacing="3" cellpadding="0" style="border-collapse: collapse"><tr><td>Sincerely, </td></tr>
			 <tr><td>- Zen Spa Retreat</td></tr> <tr><td height="10px">&nbsp;</td></tr>
			 <tr><td>Sheraton Convention Center Hotel & Casino</td></tr>
			 <tr><td>200 Convention Blvd.</td></tr>
			 <tr><td>San Juan, PR 00901</td></tr>
			 <tr><td>t. 787.522.8433</td></tr>
			 <tr><td>t. 787.522.8456</td></tr>
			 <tr><td>TOLL FREE 1.877.ZEN.SPA.0 </td></tr>
			 </table>';
			 
			 $subject = "Thank you for your order at Zen Spa Retreat";
					//$from="meloenvias@gmail.com";
					
					$from="michelle@zensparetreat.com";
					//$from="vijaya@themedia3.com";
					 $to=$res->g_emailid;
					
					$headers = "From: " . strip_tags($from) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
					//sending email to client
					$ok=mail($to,$subject,$msg1.$msg.$msg2,$headers);
						
					//sending email to admin
					$ok=mail('michelle@zen-spa.com,meloenvias@gmail.com',"Customer Gift Certificate Order at Zensparetreat.com", $msg3.$msg.$msg2,$headers);
					
					//testing 
					$testEmail = "singh_gopal1981@yahoo.com";
					$ok=mail($testEmail,'Client:'.$subject,$msg1.$msg.$msg2,$headers);
					$ok=mail($testEmail,"Admin:Customer Gift Certificate Order at Zensparetreat.com", $msg3.$msg.$msg2,$headers);
					
					//echo $ok=mail('vijayalakshmivulli@gmail.com',"Customer Gift Certificate Order at Zensparetreat.com", $msg3.$msg.$msg2,$headers);
					// $ok=mail($from,"Customer Gift Certificate Order at Zensparetreat.com", $msg3.$msg.$msg2,$headers);
					$res2=orderClass::OrderDelete($_SESSION['oid']);
					$_SESSION['oid']='';
					$_SESSION['orderid']='';
					
					
				}
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
	  
	  
     