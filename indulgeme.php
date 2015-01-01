<?php
include_once("includes/sessions.php");
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
$_SESSION['oid']='';
$_SESSION['orderid']='';
if(isset($_POST['tofullname']))
{
	if(!isset($_POST['price']))
	{
		$msg="There is browser problem.Please remove cookies in your browser and try again";
	}
	else 
	{
		include('model/order.class.php');
		$orderid=date('ymdHis');
		$res=orderClass::insertTempOrder($_POST,$orderid);
	  if($res=='')
	  {
	   
	   $msg="You didn't continue due to some server problem.Please try again";
		}
		else
		{
		  $_SESSION['oid']=$res;
		  $_SESSION['orderid']=$orderid;
		  header("Location:package_payment.php");
		}
	}
}
include('model/packages.class.php');
include('model/otherpackages.class.php');
$res_addons=otherpackagesClass::getAllotherpackagesList('other_id','ASC','','','ADD-ONS');
$res_upgrade=otherpackagesClass::getAllotherpackagesList('other_id','ASC','','','Upgrade');
$totalprice_count=sizeof($res_addons)+sizeof($res_upgrade);
$pack=packagesClass::getPackageData('4');
if($pack->meta_title!='')
$metatitle=$pack->meta_title;
else
$metatitle="ZEN SPA RETREAT::Indulge Me Package";
if($pack->meta_title!='')
$metatitle=$pack->meta_title;
else
$metatitle="ZEN SPA RETREAT:: Relax Me Package";

if($pack->meta_desc!='')
$metadesc=$pack->meta_desc;
else
$metadesc="ZEN SPA RETREAT";

if($pack->meta_keywords!='')

 $metakeywords=$pack->meta_keywords;
else
$metakeywords="ZEN SPA RETREAT";

include("includes/header.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$metatitle?></title>
<meta  name="description" content="<?=$metadesc?>">
<meta  name="keywords" content="<?=$metakeywords?>">
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
			<script>
					function validate()
			{
			var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			  if(document.frm.tofullname.value=='')
			  {
			     alert("Please Enter Full Name of the Person To Whom You Want to Send");
				 document.frm.tofullname.focus();
				 return false;
			  }
			  else if(document.frm.from.value=='')
			  {
			     alert("Please Enter From ");
				 document.frm.from.focus();
				 return false;
			  }
			   else if(document.frm.buyersfullname.value=='')
			  {
			     alert("Please Enter Buyer Full Name ");
				 document.frm.buyersfullname.focus();
				 return false;
			  }
			   else if(document.frm.buyerstelephone.value=='')
			  {
			     alert("Please Enter Buyer Telephone Number ");
				 document.frm.buyerstelephone.focus();
				 return false;
			  }
			   else if(document.frm.buyersemailid.value=='')
			  {
			     alert("Please Enter Buyer Email Id");
				 document.frm.buyersemailid.focus();
				 return false;
			  }
			else  if(!document.frm.buyersemailid.value.match(emailRegEx))
	{
		alert('Please enter valid Email address.');
		document.frm.buyersemailid.focus();
		return false;
	}
			   else if(document.frm.message.value=='')
			  {
			     alert("Please Enter Your message ");
				 document.frm.message.focus();
				 return false;
			  }
			/* if(document.getElementById('certified').checked==false && document.getElementById('Messenger').checked==false)
			  {
			  
					 alert("Please Select Store Pickup or Delivered By certified or Delivered By  Messenger ");
					 return false;
			  }*/
			
			  if(document.getElementById('certified').checked==true)
			  {
			    if(document.frm.certified_msg.value=='')
				  {
					 alert("Please Enter Certified address ");
					 document.frm.certified_msg.focus();
					 return false;
				  }
				//  alert("hi");
				
			  }
			    if(document.getElementById('Messenger').checked==true)
			  {
			    if(document.frm.Messenger_msg.value=='')
				  {
					 alert("Please Enter Messanger address ");
					 document.frm.Messenger_msg.focus();
					 return false;
				  }
			  }
			  
			  if(document.getElementById('nextday').checked==true)
	{
		if(document.frm.nextday_msg.value=='')
		{
			alert("Please enter next day delivery address ");
			document.frm.nextday_msg.focus();
			return false;
		}
	}
	
			  return true;
			}
			function UpdateCost() {
			  var sum = 0;
			  var gn, elem;
			   var gn1, elem1;
			  for (j=0; j<2; j++) {
				gn1 = 'price'+j;
				elem1= document.getElementById(gn1);
				
				if (elem1.checked == true) { sum += Number(elem1.value); }
			  }
			 
			  var gn, elem;
			
			  for (i=0; i<<?=$totalprice_count?>; i++) {
				gn = 'packages'+i;
				elem = document.getElementById(gn);
				var str=elem.value;
				var splitval=str.split('_');
				
				if (elem.checked == true) { sum += Number(splitval[1]); }
			  }
			  document.getElementById('total').value =sum.toFixed(2);
			} 
			</script>
			<form action="" name="frm" method="post" onSubmit="return validate()">
<input type="hidden" name="hdname" value="Indulge me">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top"><span class="bigtext">Package</span><br />
                  <span class="greentext"><?=$pack->package_title?></span></td>
              </tr>
			  <tr><td style="color:red;"><?php 
			  if($msg!='')
			  {
			    echo $msg;
			  }
			  
			  ?></td></tr>
              <tr>
                <td align="left" valign="top" style="padding-top:10px; padding-bottom:10px"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="10%" align="left" valign="top" class="bigtext">For One</td>
                    <td width="50%" align="left" valign="top" class="bigtext"> For Two</td>
                    <td width="40%" align="left" valign="top" class="bigtext">Total</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10%" align="left" valign="middle"><input name="price" type="radio" id="price0" value="<?=$pack->package_one?>" checked="checked"  onclick="UpdateCost()"/></td>
                        <td align="left" valign="middle" class="orangetext">$<?=$pack->package_one?></td>
                      </tr>
                    </table></td>
                    <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="4%" align="left" valign="middle"><input name="price" type="radio" id="price1" value="<?=$pack->package_two?>" onClick="UpdateCost()"/></td>
                        <td align="left" valign="middle" class="orangetext">$<?=$pack->package_two?></td>
                      </tr>
                    </table></td>
                    <td align="left" valign="middle" style="background-image:url(images/total_15.png);background-repeat:no-repeat;width:126px;height:30px;padding-left:8px;">
				$<input type="text" size="12" height="30px" value="<?=$pack->package_one?>" name="total" id="total" style="border:0px;" readonly="" />
					</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top"><table width="70%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="left" valign="top" style="padding-bottom:5px"><span class="greentext">ADD-ONS for Spa Packages</span><br />
                      <span class="boldtext">Receive a 15% *Savings on your additional spa treatment</span></td>
                  </tr>
				  <?php
				   $i=0;
				 if(sizeof($res_addons)>0){
					
					foreach($res_addons as $addons)
					{
					?>
                  <tr>
                    <td align="left" valign="top" style="background-image:url(images/grey-line_19.gif); background-repeat:repeat-x"><img src="images/grey-line_19.gif" width="8" height="1" /></td>
                  </tr>
				  
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td width="5%" align="left" valign="middle"><input type="checkbox" name="packages[]" id="packages<?=$i?>" value="<?php echo $addons->other_id;?>_<?php echo $addons->other_price;?>"  onclick="UpdateCost()"/></td>
                        <td width="75%" align="left" valign="middle" class="bigtext"><?php echo $addons->other_title;?></td>
                        <td width="20%" align="left" valign="middle" class="orangetext">$<?php echo $addons->other_price;?> </td>
                      </tr>
                    </table></td>
                  </tr>
                 <?php
				 $i=$i+1; } } 
			?>
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top" style="padding-top:20px; padding-bottom:20px"><table width="70%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="left" valign="top" style="padding-bottom:5px"><span class="greentext">UPGRADE for Spa Packages</span><br />
                        <span class="boldtext">Swedish Massage or Deep-Pore Cleansing Facial to any of the following Spa treatments at an additional cost</span></td>
                  </tr>
				  <?php
				 
			if(sizeof($res_upgrade)>0){
					
					foreach($res_upgrade as $upgrade)
					{
					
					?>
                  <tr>
                    <td align="left" valign="top" style="background-image:url(images/grey-line_19.gif); background-repeat:repeat-x"><img src="images/grey-line_19.gif" width="8" height="1" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td width="5%" align="left" valign="middle"><input type="checkbox"  name="packages[]" id="packages<?=$i?>"  value='<?php echo $upgrade->other_id;?>_<?php echo $upgrade->other_price;?>' onClick="UpdateCost()" /></td>
                          <td width="75%" align="left" valign="middle" class="bigtext"><?php echo $upgrade->other_title;?></td>
                          <td width="20%" align="left" valign="middle" class="orangetext">$<?php echo $upgrade->other_price;?></td>
                        </tr>
                    </table></td>
                  </tr>
                  <?php
				$i=$i+1; } } 
			?>
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top" style="background-image:url(images/grey-line_19.gif); background-repeat:repeat-x"><img src="images/grey-line_19.gif" width="8" height="1" /></td>
              </tr>
              <tr>
                <td align="left" valign="top" style="padding:18px"><table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                    <td width="45%" align="right" valign="middle" class="boldtext"><font color="red">*</font>&nbsp;To (Full Name):</td>
                    <td align="left" valign="top"><input name="tofullname" type="text" class="form" id="tofullname" /></td>
                  </tr>
                  <tr>
                    <td width="45%" align="right" valign="middle" class="boldtext"><font color="red">*</font>&nbsp;From:</td>
                    <td align="left" valign="top"><input name="from" type="text" class="form" id="from" /></td>
                  </tr>
                  <tr>
                    <td width="45%" align="right" valign="middle" class="boldtext"><font color="red">*</font>&nbsp;Buyer's Complete Name:</td>
                    <td align="left" valign="top"><input name="buyersfullname" type="text" class="form" id="buyersfullname" /></td>
                  </tr>
                  <tr>
                    <td width="45%" align="right" valign="middle" class="boldtext"><font color="red">*</font>&nbsp;Buyer's Telephone:</td>
                    <td align="left" valign="top"><input name="buyerstelephone" type="text" class="form" id="buyerstelephone" /></td>
                  </tr>
                  <tr>
                    <td width="45%" align="right" valign="middle" class="boldtext"><font color="red">*</font>&nbsp;Buyer's Email:</td>
                    <td align="left" valign="top"><input name="buyersemailid" type="text" class="form" id="buyersemailid" /></td>
                  </tr>
                  <tr>
                    <td width="45%" align="right" valign="top" class="boldtext"><font color="red">*</font>&nbsp;Message:</td>
                    <td align="left" valign="top"><textarea name="message" cols="45" rows="5" class="form2" id="message"></textarea></td>
                  </tr>
                  <!--<tr>
                    <td width="45%" align="right" valign="middle"><span class="boldtext">Store Pick Up Location:<br />
                      </span>*Ignore if requesting certificate by mail</td>
                    <td align="left" valign="top">
					<select name="location" id="location">
					<option value="0">Select</option>
						<option value="Condado">Condado</option>
						<option value="San Patricio">San Patricio</option>
						<option value="Mayaguez">Mayaguez</option>
					
                    </select>
                    </td>
                  </tr>-->
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top"><p>If you are planning to claim this certificate in our facility, skip the next step and press continue.</p>
                  <p>If you prefer, this certificate can be delivered by mail or by messenger, if this is the case, please provide the suitable address below and press continue.</p></td>
              </tr>
              <tr>
                <td align="left" valign="top" style="padding-bottom:10px; padding-top:10px; padding-left:18px; padding-right:18px"><table width="100%" border="0" cellpadding="2" cellspacing="0">
                  <tr>
                  	<td width="45%" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  		<tr>
                  			<td align="right" valign="top"><strong>US Certified Mail - $8.50 </strong>                  				<input type="checkbox" name="certified" id="certified" value="1"/></td>
                  			</tr>
                  		<tr>
                  			<td align="right" valign="top"> (Allow 5-7 business days. Delays may occur.)<br />
                  				Provide Recipient's Postal Address:<br />
                  				*only available monday through friday</td>
                  			</tr>
                  		</table></td>
                  	<td align="left" valign="top"><textarea name="certified_msg" cols="45" rows="5" class="form2" id="certified_msg"></textarea></td>
                  	</tr>
                  <tr>
                  	<td height="10" colspan="2" align="right" valign="middle">&nbsp;</td>
                  	</tr>
                  <tr>
                  	<td width="45%" height="87" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  		<tr>
                  			<td align="right" valign="top"><strong>Messenger Service - $12.50 </strong>                  				<input type="checkbox" name="Messenger" id="Messenger" value="1"/></td>
                  			</tr>
                  		<tr>
                  			<td align="right" valign="top"> (Metropolitan Area Only). <br />
                  				Orders after 12pm will be delivered next day.<br />
                  				Provide Recipient's Physical Address and Telephone Number<br />
                  				*only available monday through friday </td>
                  			</tr>
                  		</table></td>
                  	<td align="left" valign="top"><textarea name="Messenger_msg" cols="45" rows="5" class="form2" id="Messenger_msg"></textarea></td>
                  	</tr>
                  <tr>
                  	<td height="10" colspan="2" align="right" valign="middle">&nbsp;</td>
                  	</tr>
                  <tr>
                  	<td height="100" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  		<tr>
                  			<td align="right" valign="top"><strong>Next Day Service - $20.00. (PR &amp; USA)</strong>
                  				<input type="checkbox" name="nextday" id="nextday" value="1"/></td>
                  			</tr>
                  		<tr>
                  			<td align="right" valign="top"> Order must be placed before 11:00am to ensure next day arrival.<br />
                  				Provide Recipient's Postal Address and Telephone Number<br />
                  				*only available monday through friday </td>
                  			</tr>
                  		</table></td>
                  	<td align="left" valign="top"><textarea name="nextday_msg" cols="45" rows="5" class="form2" id="nextday_msg"></textarea></td>
                  	</tr>
                  
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="bigtext" style="padding-bottom:20px">Please allow a few moments to process your payment options. Do not click more than once.</td>
              </tr>
              <tr>
                <td align="center" valign="top"><input type="image" src="images/continue_41.gif" width="126" height="38" border="0" /></td>
              </tr>
            </table>
			
			</form>
			
			
			
			
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
	  
	  
     