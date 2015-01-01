<?php
include_once("includes/sessions.php");
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
include('model/gifts.class.php');
include('model/packages.class.php');

$_SESSION['price']='';
$_SESSION['gid']='';
$_SESSION['gorderid']='';
 
if(isset($_POST['recepientname']))
{
    $orderid=date('ymdHis'); 
	 
	$res=giftsClass::insertGifts($_POST,$orderid);

  	if($res=='')
 	{
		$msg="You didn't continue due to some server problem.Please try again";
	} else {
		$_SESSION['gid']=$res;
		$_SESSION['gorderid']=$orderid;
		 
		foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 			
			
		if($g_price!='' && $price=='')
			$price=$g_price;
		else
			$price=$price;


		if($package!=0)
		{
		   $packages=packagesClass::getPackageData($package);
		    $price=$packages->package_one;
			$pck_name=$packages->package_title;
		}
		
		if(count($_POST['certified'])!=0)
		{
		   $strcertified='8.50';
		   $price=$price+$strcertified;
		}
		
		if(count($_POST['Messenger'])!=0)
		{
		   $strMessenger='12.50';
		   $price=$price+$strMessenger;
		}			
		
		if(count($_POST['NextDay'])!=0)
		{
			$strNextDay='20.00';
			$price=$price+$strNextDay;		   
		} 
				
		$_SESSION['price']=$price;
		header("Location:gifts_payment.php");		
	}
}

include("includes/header.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZEN SPA RETREAT</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta  name="description" content="Give the Gift of Total Relaxation in a pampering retreat for body, mind and soul to emerge truly transformed from head to toe. ">
<meta  name="keywords" content="Gift of Total Relaxation,Gifts,Certificates,pampering retreat  for body, mind">
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
<script language="JavaScript" src="ajax.js"></script>
</head>

<body onload="MM_preloadImages('images/swap_button_15.jpg','images/swap_button_18.jpg')">
<table width="1012" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" valign="top" style="background-image:url(images/side_02.jpg); background-repeat:repeat-y; width:6px"><img src="images/side_02.jpg" width="6" height="22" /></td>
		<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td style="width:246px"><a href="<?php echo DEFAULT_URL; ?>"><img src="images/Zenspa_03.jpg" width="246" height="103" border="0" /></a></td>
								<td align="left" valign="top"><img src="images/spa-gift-certificates_04.jpg" width="754" height="103" /></td>
							</tr>
						</table></td>
				</tr>
				<tr>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="left" valign="top" style="background-image: url(images/Zenspa_bg_18.jpg); background-repeat:repeat-y; width:246px;"><p>&nbsp;</p>
									<p>&nbsp;</p>
									<?php include("includes/side.php"); ?></td>
								<td align="left" valign="top" style="width:22px; background-image:url(images/side_inner_bg_14.jpg); background-repeat:repeat-y; background-position:left top"><img src="images/Zenspa_bg_10.jpg" width="22" height="329" /></td>
								<td align="left" valign="top" bgcolor="#FFFFFF" style="background-image:url(images/Zenspa_bg_11.jpg); background-repeat:repeat-x; padding:15px"><p class="greentext">Give the Gift of Total Relaxation in a pampering retreat for body, mind and soul to emerge truly transformed from head to toe.</p>
									<?php if($msg!=''){echo $msg;} ?>
									<form action="" name="frm" method="post" onSubmit="return validate()">
										<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
											<tr>
												<td align="left" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#000000">
														<tr>
															<td align="left" valign="middle" class="greentext"><span class="greentext">*</span> Please Select Gift Value</td>
														</tr>
														<tr>
															<td align="left" valign="top" class="bigtext"><table width="65%" border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td width="20" align="left" valign="top"><input type="radio" name="price" id="price" value="100" onclick="check_availablity('frm','price','package');" /></td>
																		<td align="left" valign="middle" class="orangetext">$100</td>
																		<td width="20" align="left" valign="top"><input type="radio" name="price" id="price" value="200" onclick="check_availablity('frm','price','package');"/></td>
																		<td align="left" valign="middle"><span class="orangetext">$200</span></td>
																		<td width="20" align="left" valign="top"><input type="radio" name="price" id="price" value="300" onclick="check_availablity('frm','price','package');"/></td>
																		<td align="left" valign="middle"><span class="orangetext">$300</span></td>
																		<td width="20" align="left" valign="top"><input type="radio" name="price" id="price" value="400" onclick="check_availablity('frm','price','package');"/></td>
																		<td align="left" valign="middle"><span class="orangetext">$400</span></td>
																		<td width="20" align="left" valign="top"><input type="radio" name="price" id="price" value="500" onclick="check_availablity('frm','price','package');"/></td>
																		<td align="left" valign="middle"><span class="orangetext">$500</span></td>
																	</tr>
																</table></td>
														</tr>
														<tr>
															<td width="28%" align="left" valign="middle" class="greentext"> Or select the Package </td>
														</tr>
														<tr>
															<td width="28%" align="left" valign="middle" class="bigtext"> Packages</td>
														</tr>
														<tr>
															<td align="left" valign="middle" class="greentext"><select name="package" id="package" onchange="filldata1(this.value);"  >
																	<option value="0">Select</option>
																	<?php 
					 $packages=giftsClass::gatpackages();
					foreach($packages as $package_s)
					{			  
				    ?>
																	<option value="<?php echo $package_s->package_id;  ?>"><?php echo $package_s->package_title ; ?>($ <?php echo $package_s->package_one ; ?>)</option>
																	<?php  } ?>
																</select></td>
														</tr>
														<tr>
															<td width="28%" align="left" valign="middle" class="greentext"> Or select the desired treatment </td>
														</tr>
														<tr>
															<td width="28%" align="left" valign="middle" class="bigtext"> Treatment Category</td>
														</tr>
														<tr>
															<td align="left" valign="middle" class="greentext"><select name="treatment" id="treatment"  onchange="filldata(this.value);">
																	<option value="0">Select</option>
																	<option value="1">Body Massage</option>
																	<option value="2">Body Zen Stone Therapies</option>
																	<option value="3">Body Exfoliations</option>
																	<option value="4">Body Wraps</option>
																	<option value="5">body Zen Signature Therapies</option>
																	<option value="6">Facial Skin Therapies</option>
																	<!--option value="7">Facial Skin Boosters </option-->
																	<option value="8">Facial Zen Signature Therapies</option>
																	<option value="9">Face & Body Waxing</option>
																	<option value="10">Hands & Feet Nail Care</option>
																	<option value="11">Vip Spa Suites</option>
																	<option value="12">Hair Care Hair Studio</option>
																</select></td>
														</tr>
														<tr id="trTreatments_1" class="hide">
															<td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Treatments</td>
														</tr>
														<tr id="trTreatments_2" class="hide">
															<td align="left" valign="middle"><div id="statediv">
																	<select name="treatmenttype" id="treatmenttype" onchange="onTreatmentChange();" >
																		<option value="0">Select</option>
																	</select>
																</div></td>
														</tr>
														<tr id="trTreatmentsPrice_1" class="hide">
															<td align="left" valign="middle" class="bigtext"><span class="greentext">*</span> Price</td>
														</tr>
														<tr id="trTreatmentsPrice_2" class="hide">
															<td align="left" valign="middle"><div id="citydiv">
																	<input name="g_price" type="text" class="form" id="g_price"   readonly=""/>
																</div></td>
														</tr>
													</table></td>
												<td align="right" valign="top"><img src="images/gift-certificate_03.png" width="358" height="279" /></td>
											</tr>
											<tr>
												<td colspan="2" align="left" valign="top" style="padding-top:20px; padding-bottom:20px"><span class="bigtext"></span></td>
											</tr>
										</table>
										<table width="80%" border="0" cellpadding="2" cellspacing="0">
											<tr>
												<td align="left" valign="middle" class="bigtext" ><font color="red">*</font>&nbsp;Buyer's Complete Name:</td>
											</tr>
											<tr>
												<td align="left" valign="top"><input name="buyersfullname" type="text" class="form" id="buyersfullname" /></td>
											</tr>
											<tr>
												<td width="28%" align="left" valign="middle" class="bigtext"><span class="greentext">*</span> Buyer's Email</td>
											</tr>
											<tr>
												<td align="left" valign="middle" class="greentext"><input name="emailid" type="text" class="form" id="emailid" /></td>
											</tr>
											<tr>
												<td align="left" valign="middle" class="bigtext" ><font color="red">*</font>&nbsp;Buyer's Telephone:</td>
											</tr>
											<tr>
												<td align="left" valign="top"><input name="buyerstelephone" type="text" class="form" id="buyerstelephone" /></td>
											</tr>
											<tr>
												<td align="left" valign="middle" class="bigtext" ><font color="red">*</font>&nbsp;Gift Certificate's From Name:</td>
											</tr>
											<tr>
												<td align="left" valign="top"><input name="from" type="text" class="form" id="from" /></td>
											</tr>
											<tr>
												<td align="left" valign="middle"><span class="greentext">*</span><span class="bigtext">Gift Certificate Recipient Name</span></td>
											</tr>
											<tr>
												<td align="left" valign="middle" class="bigtext"><input name="recepientname" type="text" class="form" id="recepientname" /></td>
											</tr>
											<tr>
												<td align="left" valign="top" class="bigtext"><span class="greentext">*</span>Gift Certificate Message</td>
											</tr>
											<tr>
												<td align="left" valign="top" class="bigtext"><textarea name="message" cols="45" rows="5" class="form2" id="message"></textarea></td>
											</tr>
											<?php /*?><tr>
                    <td align="left" valign="top" class="bigtext" ><font color="red">*</font>&nbsp;Message:</td></tr>
                  <tr>
                    <td align="left" valign="top"><textarea name="other_message" cols="45" rows="5" class="form2" id="other_message"></textarea></td>
                  </tr><?php */?>
											<!--<tr>
                    <td align="left" valign="middle"><span class="bigtext" >Store Pick Up Location:<br />
                      </span>*Ignore if requesting certificate by mail</td></tr>
                  <tr>
                    <td align="left" valign="top">
					<select name="location" id="location">
					<option value="0">Select</option>
						<option value="Condado">Condado</option>
						<option value="San Patricio">San Patricio</option>
						<option value="Mayaguez">Mayaguez</option>
					
                    </select>
                    </td>
                  </tr>-->
										</table>
										<table style="background-color:#FFFFFF">
											<tr>
												<td align="left" valign="top"><p>If you are planning to claim this certificate in our facility, skip the next step and press continue.</p>
													<p>If you prefer, this certificate can be delivered by mail or by messenger, if this is the case, please provide the suitable address below and press continue.</p></td>
											</tr>
										</table>
										<table width="100%" border="0" cellpadding="2" cellspacing="0" style="background-color:#FFFFFF">
											<tr>
												<td  align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td align="left" valign="top"><input type="checkbox" name="certified" id="certified" value="1" />
																US Certified Mail - $8.50 (Allow 5-7 business days. Delays may occur.)<br />
																Provide Recipient's Postal Address:<br />
																*only available monday through friday</td>
														</tr>
													</table></td>
											</tr>
											<tr>
												<td align="left" valign="top"><textarea name="certified_msg" cols="45" rows="5" class="form2" id="certified_msg" ></textarea></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td  align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td align="left" valign="top"><input type="checkbox" name="Messenger" id="Messenger" value="1" />
																Messenger Service - $12.50 (Metropolitan Area Only). Orders after 12pm will be delivered next day.<br />
																Provide Recipient's Physical Address and Telephone Number<br />
																*only available monday through friday </td>
														</tr>
													</table></td>
											</tr>
											<tr>
												<td align="left" valign="top"><textarea name="Messenger_msg" cols="45" rows="5" class="form2" id="Messenger_msg"></textarea></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td  align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td align="left" valign="top"><input type="checkbox" name="NextDay" id="NextDay" value="1" />
																Next Day Service - $20.00. (PR & USA) Order must be placed before 11:00am to ensure next day arrival.<br />
																Provide Recipient's Postal Address and Telephone Number<br />
																*only available monday through friday </td>
														</tr>
													</table></td>
											</tr>
											<tr>
												<td align="left" valign="top"><textarea name="NextDay_msg" cols="45" rows="5" class="form2" id="NextDay_msg"></textarea></td>
											</tr>
										</table>
										<table width="100%">
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td colspan="2" align="center" valign="top"><span class="greentext">
													<input type="image" src="images/continue_41.gif" width="126" height="38" border="0" />
													</span></td>
											</tr>
										</table>
									</form></td>
								<td align="right" valign="top" style="width:22px; background-repeat:repeat-y; background-image:url(images/side_inner_bg_15.jpg); background-position:right top"><img src="images/Zenspa_bg_13.jpg" width="22" height="329" /></td>
							</tr>
							<tr>
								<td align="left" valign="top" style="background-image: url(images/Zenspa_bg_18.jpg); background-repeat:repeat-y; width:246"><img src="images/zenspa_bw_20.jpg" width="246" height="435" /></td>
								<td align="left" valign="top" style="width:22px"><img src="images/zenspa_bw_21.jpg" width="22" height="435" /></td>
								<td align="left" valign="top"  style="background-image:url(images/zenspa_bw_22.jpg); height:435px; width:710px"></td>
								<td align="right" valign="top" style="width:22px"><img src="images/zenspa_bw_23.jpg" width="22" height="435" /></td>
							</tr>
						</table></td>
				</tr>
				<?php include("includes/footer.php"); ?>
<script>
function validate() 
{    
    var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    if (!checkRadio('frm', 'price') && (document.frm.treatment.value == '0') && (document.frm.package.value == '0')) {
        alert("Please select either gift value or treatment desires or package");
        
        return false;    
    } 
    else if (checkRadio('frm', 'price') && document.frm.treatment.value != '0') {
        alert("Please select either gift value or categories only");
        document.frm.treatmenttype.focus();
        return false;
    
    } 
    else if (document.frm.treatment.value != '0' && document.frm.treatmenttype.value == '0') 
    {
        
        alert("Please select treatment types");
        return false;
    } 
    else if (checkRadio('frm', 'price') && document.frm.treatmenttype.value != '0') {
        alert("Please select either gift value or categories only");
        document.getElementById('treatmenttype').options['0'].selected = true;
        document.getElementById('package').options['0'].selected = false;
        document.getElementById('g_price').value = '';
        document.frm.package.value == '0'
        return false;
    
    } 
    else if (document.frm.buyersfullname.value == '') 
    {
        alert("Please enter buyer full name");
        document.frm.buyersfullname.focus();
        return false;
    } 
    else if (document.frm.emailid.value == '') 
    {
        alert("Please enter buyer email id");
        document.frm.emailid.focus();
        return false;
    } 
    else if (!document.frm.emailid.value.match(emailRegEx)) 
    {
        alert('Please enter valid email address');
        document.frm.emailid.focus();
        return false;
    } 
    else if (document.frm.buyerstelephone.value == '') 
    {
        alert("Please enter buyer telephone number");
        document.frm.buyerstelephone.focus();
        return false;
    } 
    else if (document.frm.from.value == '') 
    {
        alert("Please enter from name");
        document.frm.from.focus();
        return false;
    } 
    else if (document.frm.recepientname.value == '') 
    {
        alert("Please enter recepient name");
        document.frm.recepientname.focus();
        return false;
    } 
    
    
    
    
    
    else if (document.frm.message.value == '') 
    {
        alert("Please enter your message");
        document.frm.message.focus();
        return false;
    }
    if (document.getElementById('certified').checked == true) 
    {
        if (document.frm.certified_msg.value == '') 
        {
            alert("Please enter certified address");
            document.frm.certified_msg.focus();
            return false;
        }
    
    }
    if (document.getElementById('Messenger').checked == true) 
    {
        if (document.frm.Messenger_msg.value == '') 
        {
            alert("Please enter messenger address");
            document.frm.Messenger_msg.focus();
            return false;
        }
    }
	
	if (document.getElementById('NextDay').checked == true) 
    {
        if (document.frm.NextDay_msg.value == '') 
        {
            alert("Please enter next day delivery address");
            document.frm.NextDay_msg.focus();
            return false;
        }
    }
    
    return true;
}
function checkRadio(frmName, rbGroupName) {
    var radios = document[frmName].elements[rbGroupName];
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            return true;
        }
    }
    return false;
}

function checkRadioChecked(frmName, rbGroupName) {
    var radios = document[frmName].elements[rbGroupName];
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            radios[i].checked = false;
        }
    }

}

function filldata(id) 
{
    document.getElementById('treatmenttype').selectedIndex = 0;
    
    var result_style = document.getElementById('trTreatmentsPrice_1').style;
    result_style.display = 'none';
    
    result_style = document.getElementById('trTreatmentsPrice_2').style;
    result_style.display = 'none';
    
    if (document.getElementById('treatment').selectedIndex == 0) {
        
        var result_style = document.getElementById('trTreatments_1').style;
        result_style.display = 'none';
        
        result_style = document.getElementById('trTreatments_2').style;
        result_style.display = 'none';
    
    } else {
        var result_style = document.getElementById('trTreatments_1').style;
        result_style.display = 'table-row';
        
        result_style = document.getElementById('trTreatments_2').style;
        result_style.display = 'table-row';
    
    }
    
    checkRadioChecked('frm', 'price');
    document.getElementById('package').value = 0;
    country_sel_1('treatment', id, 'showstate', 'statediv');
}

function onTreatmentChange() {    
    var result_style_1 = document.getElementById('trTreatmentsPrice_1').style;
    var result_style_2 = document.getElementById('trTreatmentsPrice_2').style;

    // clear the price field
    document.getElementById('g_price').value = '';
    
    if (document.getElementById('treatmenttype').selectedIndex == 0) {
        result_style_1.display = 'none';
        result_style_2.display = 'none';
    } else {
        result_style_1.display = 'table-row';
        result_style_2.display = 'table-row';
        country_sel('state', document.getElementById('treatmenttype').value, 'showtown', 'citydiv');
    }
}

function filldata1(id) 
{
	var result_style_1 = document.getElementById('trTreatmentsPrice_1').style;
	result_style_1.display = 'none';

	var result_style_2 = document.getElementById('trTreatmentsPrice_2').style;
	result_style_2.display = 'none';

	var result_style_3 = document.getElementById('trTreatments_1').style;
	result_style_3.display = 'none';

	var result_style_4 = document.getElementById('trTreatments_2').style;
	result_style_4.display = 'none'; 
 
    if (id != 0) 
    {
        checkRadioChecked('frm', 'price');
    }
    document.getElementById('treatment').options['0'].selected = true;
    document.getElementById('treatmenttype').options['0'].selected = true;
    
    document.getElementById('g_price').value = '';
}

function check_availablity(frmName, rbGroupName) 
{
	var result_style_1 = document.getElementById('trTreatmentsPrice_1').style;
	result_style_1.display = 'none';

	var result_style_2 = document.getElementById('trTreatmentsPrice_2').style;
	result_style_2.display = 'none';

	var result_style_3 = document.getElementById('trTreatments_1').style;
	result_style_3.display = 'none';

	var result_style_4 = document.getElementById('trTreatments_2').style;
	result_style_4.display = 'none'; 
	
    var radios = document[frmName].elements[rbGroupName];
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            document.getElementById('treatment').options['0'].selected = true;
            document.getElementById('treatmenttype').options['0'].selected = true;
            
            document.getElementById('package').value = 0;
            document.getElementById('g_price').value = '';
        
        }
    }
}
</script>