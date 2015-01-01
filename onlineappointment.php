<?php
include_once("includes/sessions.php");
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
include('model/gifts.class.php');
if(isset($_POST['name']))
{
    include('model/appointment.class.php');
	include('model/treatments.class.php');
	include('model/otherpackages.class.php');
	$orderid=date('ymdHis');
    $res=appointmentsClass::insertappointments($_POST,$orderid);
  //$_SESSION['price']='200.00';
  	if($res=='')
 	 {
   		$msg="You didn't continue due to some server problem.Please try again";
	 }
	 else
	 {
	    foreach($_POST as $key=>$val)  $$key=(get_magic_quotes_gpc())?$val:addslashes($val); 
					 $from = $_POST['emailid'];
					//treatment,treatmenttype,otherpacks
					  $allstates=treatmentClass::getTreatmentData($treatmenttype);  
					   $pack_id=otherpackagesClass::getPackageData($otherpacks);
					  
					$subject = "New appointment request at ZenSpaRetreat.com";
					$to="michelle@zensparetreat.com";
				
				if($package!=''){
					$sel="select * from tb_packages where package_id=".$package;
					$res=$callConfig->getRow($sel);
					$p_name=$res->package_title;
				}
					$headers = "From: " . strip_tags($from) . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
					$message = '<html><body>';
					$message .= '<table width="400px" border="0">';
					
				
					$message .= "<tr><td width='150px'><strong>Name:</strong> </td><td>" . strip_tags($name) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Phone Number:</strong> </td><td>" . strip_tags($telephone) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Email Id:</strong> </td><td>" . strip_tags($emailid) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Mobile Number:</strong> </td><td>" . strip_tags($celular) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Package:</strong> </td><td>" . strip_tags($p_name) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Package-Price:</strong> </td><td>" . strip_tags($package_price) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Treatment Type:</strong> </td><td>" . strip_tags($allstates->t_title) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Other ADDONs :</strong> </td><td>" . strip_tags($pack_id->other_title) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Secheduled Date</strong> </td><td>" . strip_tags($app_date) . "</td></tr>";
					$message .= "<tr><td width='150px'><strong>Secheduled Time:</strong> </td><td>" .$hours.":".$mints . "</td></tr>";
					$message .= "<tr><td colspan='2' height='20px'></td></tr>";
					
					$message .= "<tr><td colspan=2><strong>Thanks</strong> </td></tr>";
						$message .= "<tr><td colspan=2>" . strip_tags($name) . " </td></tr>";
					 $message .= "</table>";
					
					 $message .= "</body></html>";  ;
	      $ok=mail($to,$subject,$message,$headers);
		  header("Location:result.php");
	 }
}
include("includes/header.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZEN SPA RETREAT::Online Appointment</title>
<meta  name="description" content="Online Appoinment">
<meta  name="keywords" content="Online Appoinment">

<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<script type="text/javascript">
function getpackageprice1(p_id)
{
var url="ajax_jquery_controll.php?type=price&pakid="+id;
if(window.XMLHttpRequest)
{
 xmlhttp=new XMLHttpRequest();
}
else
{
 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
 if(xmlhttp.readyState==4 && xmlhttp.status==200)
 {
	 alert(xmlhttp.responseText);
	 
	   document.getElementById('package_price').value=xmlhttp.responseText;
	
 }
}
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}



function getpackageprice(id)
{
if (id=="")
  {
  document.getElementById("aut_div").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.frm.package_price.value=xmlhttp.responseText;
    }
  }
   
xmlhttp.open("GET","ajax_jquery_controll.php?pakid="+id,true);
xmlhttp.send();
}

function onPackageChange(id) {
	document.frm.select.selectedIndex = 0;
	document.frm.treatmenttype.selectedIndex = 0;	
	
	var result_style = document.getElementById('trTreatments').style;
	result_style.display = 'none';
	
	result_style = document.getElementById('packageAddOns').style;
	
	if(document.frm.package.selectedIndex == 0) {
		result_style.display = 'none';
	} else {
		document.frm.otherpacks.selectedIndex = 0;
		result_style.display = 'table-row';
	}
}

function onTreatmentChange(cat,id,cond,divs) {
	document.frm.package.selectedIndex = 0;
	document.frm.otherpacks.selectedIndex = 0;
	
	var result_style = document.getElementById('packageAddOns').style;
	result_style.display = 'none';
	
	result_style = document.getElementById('trTreatments').style;	
	
	if(document.frm.select.selectedIndex == 0){
		result_style.display = 'none';
	} else {
		result_style.display = 'table-row';
	}	
	
	if(cat == "treatment") {
		country_sel(cat,id,cond,divs);
	} else {
		// do nothing
	}
}
</script>
</head>

<body>
<script language="JavaScript" src="calendar_db.js"></script>
<script language="JavaScript" src="ajax.js"></script>

	<link rel="stylesheet" href="calendar.css">
<table width="1012" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="background-image:url(images/side_02.jpg); background-repeat:repeat-y; width:6px"><img src="images/side_02.jpg" width="6" height="22" /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:246px"><a href="<?php echo DEFAULT_URL; ?>"><img src="images/Zenspa_03.jpg" width="246" height="103"  border="0" /></a></td>
            <td align="left" valign="top"><img src="images/online_04.jpg" width="754" height="103" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top" style="background-image: url(images/Zenspa_bg_18.jpg); background-repeat:repeat-y; width:246px;"><p>&nbsp;</p>
              <p>&nbsp;</p>
			  <?php include("includes/side.php"); ?>
			  
            </td>
            <td align="left" valign="top" style="width:22px; background-image:url(images/side_inner_bg_14.jpg); background-repeat:repeat-y; background-position:left top"><img src="images/Zenspa_bg_10.jpg" width="22" height="329" /></td>
            <td align="left" valign="top" style="background-image:url(images/Zenspa_bg_11.jpg); background-repeat:repeat-x; padding:15px">
			
				<form action="" name="frm" method="post" onSubmit="return validate()">
				
			<table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#000000">
              <tr>
                <td width="28%" align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Name</td>
                <td width="72%" align="left" valign="middle"><input name="name" type="text" class="form" id="name" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle"><span class="greentext">*</span><span class="bigtext">Telephone</span></td>
                <td align="left" valign="middle"><input name="telephone" type="text" class="form" id="telephone" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Email</td>
                <td align="left" valign="middle"><input name="emailid" type="text" class="form" id="emailid" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle" class="bigtext">&nbsp;Celular</td>
                <td align="left" valign="middle"><input name="celular" type="text" class="form" id="celular" /></td>
              </tr>
			   <tr>
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Packages</td>
                <td align="left" valign="middle">
				<!--select name="package" id="package"  onchange="getpackageprice(this.value);"-->
				<select name="package" id="package"  onchange="onPackageChange(this.value);">
				
				<option value="0">Select</option>
				<?php  $packages=giftsClass::gatpackages();
					foreach($packages as $package_s)
						{			  
						?>
						<option value="<?=$package_s->package_id?>"><?php echo $package_s->package_title ; ?></option>
					<?php  } ?>
               </select>
			  </td>
              </tr>
			   <!--tr>
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Package price</td>
                <td align="left" valign="middle">
				<div id="package_price">
				<input name="package_price" type="text"  id="package_price" value=""  readonly=""/>
				</div>
			  </td>
              </tr-->
              <tr>
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Treatment Category</td>
                <td align="left" valign="middle"><select name="treatment" id="select" onchange="onTreatmentChange('treatment',this.value,'showstate','statediv');">
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
			  <tr id="trTreatments" class="hide">			   
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Treatments</td>
                <td align="left" valign="middle">
				<div id="statediv">
				<!--select name="treatmenttype" id="treatmenttype" onchange="country_sel('state',this.value,'showtown','citydiv');" -->
				<select name="treatmenttype" id="treatmenttype" onchange="" >
                  <option value="0">Select</option>
                    </select>
				</div></td>
              </tr>
			  
			   <!--tr>
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Price</td>
                <td align="left" valign="middle"><div id="citydiv"><input name="price" type="text" class="form" id="price"   readonly=""/></div></td>
              </tr-->
              <tr id="packageAddOns" class="hide">
                <td align="left" valign="middle" class="bigtext">&nbsp;Package Add Ons</td>
                <td align="left" valign="middle"><select name="otherpacks" id="otherpacks">
                  <option value="0">Select</option>
				  <?php
				  include('model/packages.class.php');
include('model/otherpackages.class.php');
$res_addons=otherpackagesClass::getAllotherpackagesList('other_id','ASC','','','ADD-ONS');
$res_upgrade=otherpackagesClass::getAllotherpackagesList('other_id','ASC','','','Upgrade');
 if(sizeof($res_addons)>0){
					
					foreach($res_addons as $addons)
					{
?>
<option value="<?php echo $addons->other_id;?>"><?php echo $addons->other_title;?>  Add-Ons</option>
<?php } } 
if(sizeof($res_upgrade)>0){
					
					foreach($res_upgrade as $upgrade)
					{

?>
      <option value="<?php echo $upgrade->other_id;?>"><?php echo $upgrade->other_title;?>  Upgrade</option>
<?php } }  ?>          </select></td>
              </tr>
              <tr>
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Appointment Date                  </td>
                <td align="left" valign="middle"><input name="app_date" type="text" class="form" id="app_date" />
                 <script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'frm',	
		// input name
		'controlname': 'app_date'
	});

	</script><br />(Note:Please Enter yyyy-mm-dd format)
				 
				 </td>
              </tr>
              <tr>
                <td align="left" valign="middle" class="bigtext"><span class="greentext">*</span>Appointment Hour(H:M)</td>
                <td align="left" valign="top"><select name="hours" id="hours">
                 <?php
				 for($i=0;$i<24;$i++)
				 {
				 if(strlen($i)==1)
				  	 $i="0".$i;
				    echo  '<option value="'.$i.'">'.$i.'</option>';
				 }
				  ?>
				  
                                </select>
                  <select name="mints" id="mints">
                  <?php
				 for($i=0;$i<60;$i++)
				 {
				     if(strlen($i)==1)
				  	 $i="0".$i;
				    echo  '<option value="'.$i.'">'.$i.'</option>';
				 }
				  ?>
                  </select></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="greentext">*Required Fields</td>
                <td align="left" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="greentext">&nbsp;</td>
                <td align="left" valign="top">
				<input type="image" name="submit" src="images/send_41.gif" width="126" height="38" border="0" />
				
				</td>
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
        </table></td>
      </tr>
   
   <?php include("includes/footer.php"); ?>
   <script>
			function validate()
			{
			
			
			var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
			  if(document.frm.name.value=='')
			  {
			     alert("Please enter full name");
				 document.frm.name.focus();
				 return false;
			  }
			  else if(document.frm.telephone.value=='')
			  {
			     alert("Please enter phone number");
				 document.frm.telephone.focus();
				 return false;
			  }
			 
			   else if(document.frm.emailid.value=='')
			  {
			     alert("Please enter buyer email id");
				 document.frm.emailid.focus();
				 return false;
			  }
				else  if(!document.frm.emailid.value.match(emailRegEx))
				{
					alert('Please enter valid email address');
					document.frm.emailid.focus();
					return false;
				}
				
			   else if(document.frm.treatment.value=='0' && document.frm.package.value=='0')
			  {
			     alert("Please select either a package or a treatment");
				 document.frm.treatment.focus();
				 return false;
			  }
			  else if(document.frm.treatment.value!='0' && document.frm.treatmenttype.value=='0')
			  {
			     alert("Please select your desired treatment");
				 document.frm.treatmenttype.focus();
				 return false;
			  }
			  
			    else if(document.frm.app_date.value=='')
			  {
			     alert("Please select a date for your appointment");
				 document.frm.app_date.focus();
				 return false;
			  }
			     else if(document.frm.hours.value=='00')
			  {
			     alert("Please select a time for your appointment");
				 document.frm.hours.focus();
				 return false;
			  }
			  //from,buyersfullname,buyerstelephone,buyersemailid,message,location
			}
		
			</script>
   