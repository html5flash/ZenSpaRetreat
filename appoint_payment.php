<?php
include_once("includes/sessions.php");
if($_SESSION['appointid']=='')
{
   header("Location:giftcertificate.php");
}
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
include("includes/header.php");

 include('model/order.class.php');



if($_POST['Submit']=='Submit' && $_POST['orderid']!='')
{
	foreach($_POST as $key=>$val)
	{
	$$key=(get_magic_quotes_gpc())?$val:addslashes($val);
	}
	$post_url = "https://secure.authorize.net/gateway/transact.dll";
	$post_values = array(
		"x_login"			=> "3R6BjaEvPJ5L",
		"x_tran_key"		=> "2X7NyUd3u6N7ht9B",
		"x_version"			=> "3.1",
		"x_delim_data"		=> "TRUE",
		"x_delim_char"		=> "|",
		"x_relay_response"	=> "FALSE",
		"x_type"			=> "AUTH_CAPTURE",
		"x_method"			=> "CC",
		"x_card_num"		=> $x_card_num,
		"x_exp_date"		=> $x_exp_month . $x_exp_year,
		"x_amount"			=> $ordertotal,
		"x_description"		=> "Transaction for Order  ID " . $orderid,
		"x_invoice_num"		=> $orderid,
		"x_first_name"		=> $x_first_name,
		"x_last_name"		=> $x_last_name,
		"x_address"			=> $x_address,
		"x_state"			=> $x_state,
		"x_zip"				=> $x_zip
	);
	
//print_r($post_values);
	$post_string = "";
	foreach( $post_values as $key => $value )
		{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
	$post_string = rtrim( $post_string, "& " );
	

	$request = curl_init($post_url); // initiate curl object
		curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
		$post_response = curl_exec($request); // execute curl post and store results in $post_response
		
	curl_close ($request); // close curl object
	
	
	$response_array = explode($post_values["x_delim_char"],$post_response);

 
	if($response_array[0]==1){
		
 	      $sql="update tb_appointments set payment_status='1' where a_id ='" .$_SESSION['appointid'] . "'";
		$res=orderClass::UpdateOrderlist($sql);
		header("Location: success.php?orderid=$orderid");
		exit;
	}
	else{
	
		
		$msg=$response_array[3];
	}

} 

	
?>
<body onLoad="MM_preloadImages('images/swap_button_15.jpg','images/swap_button_18.jpg')">
<table width="1012" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="background-image:url(images/side_02.jpg); background-repeat:repeat-y; width:6px"><img src="images/side_02.jpg" width="6" height="22" /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:246px"><img src="images/Zenspa_03.jpg" width="246" height="103" /></td>
            <td align="left" valign="top"><img src="images/online_04.jpg" width="754" height="103" /></td>
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
			
			
			<table><tr><td><b>Order Number :</b></td><td><?=$_SESSION['appointorderid']?></td></tr>
			<tr><td><b>Price  :</b></td><td><?php echo number_format($_SESSION['price'], 2, '.', '');?></td></tr>
			
			</table>
			
			
			<table width="100%"><tr><td width="70%" >

						<form name="form1" method="post" action="" onSubmit="return chkform();">
					<input type="hidden" name="pay_now" value="1">
					<input type="hidden" name="ordertotal" value="<?php echo number_format($_SESSION['price'], 2, '.', '');?>">
					<input type="hidden" name="orderid" value="<?php echo $_SESSION['appointorderid']; ?>">
                      <table border="0" cellpadding="5" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
                        <tr>
                          <td colspan="2"><strong>Pay through your credit card via Authorize.net </strong></td>
                          </tr>
						<?
						if(isset($msg)){
						?>
                        <tr>
                          <td colspan="2" style="color:#FF0000; font-weight:bold; font-size:12px;"><?=$msg?></td>
                          </tr>
						  <?
						}
						?>
                        <tr>
                          <td>Credit Card Number: </td>
                          <td><input name="x_card_num" type="text" id="x_card_num" value="<?=$x_card_num?>">
                            <font color="red"> *</font></td>
                        </tr>
                        <tr>
						
                          <td>Owner First Name (As on card):</td>
                          <td><input name="x_first_name" type="text" id="x_first_name" value="<?=$x_first_name?>">
                            <font color="red"> *</font></td>
                        </tr>
                        <tr>
                          <td>Owner Last Name (As on card):</td>
                          <td><input name="x_last_name" type="text" id="x_last_name" value="<?=$x_last_name?>">
                            <font color="red"> *</font></td>
                        </tr>
                        
						<tr>
                          <td>Credit Card Expiry Date: </td>
                          <td><select name="x_exp_month">
						  <?
						  for($i=1; $i<=12; $i++){
						  ?>
						  <option value="<?=substr('0' . $i, -2);?>" <?php if($x_exp_month==substr('0' . $i, -2)) echo "selected"; ?>><?=date('F', mktime(0, 0, 0, $i, 1, 2000));?></option>
						  <?
						  }
						  ?>
                          </select>
                            <select name="x_exp_year">
							<?
							for($i=date('Y'); $i<=date('Y')+20; $i++){
							?>
							<option value="<?=$i?>" <?php if($x_exp_year==$i) echo "selected"; ?>><?=$i?></option>
							<?
							}
							?>
                            </select>
                            <font color="red"> *</font> </td>
                        </tr>
                       <tr>
                          <td>Address: </td>
                         <td><input name="x_address" type="text" id="x_address" value="<?=$x_address?>">
                            <font color="red"> *</font></td>
                        </tr>
						<tr>
                          <td>Address1: </td>
                          <td><input name="x_address1" type="text" id="x_address1" value="<?=$x_address1?>"></td>
                        </tr>
						<tr>
                          <td>City: </td>
                          <td><input name="x_city" type="text" id="x_city" value="<?=$x_city?>">
                          <font color="red"> *</font></td>
                        </tr>
                        <tr>
                          <td>State: </td>
                          <td><input name="x_state" type="text" id="x_state" value="<?=$x_state?>">
                            <font color="red"> *</font></td>
                        </tr> <tr>
                          <td>Zip: </td>
                          <td><input name="x_zip" type="text" id="x_zip" value="<?=$x_zip?>">
                            <font color="red"> *</font></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><input type="submit" name="Submit" value="Submit"></td>
                        </tr>
                      </table>
                                        </form>
						
						</td><td valign="middle" align="left">
						<!-- (c) 2005, 2009. Authorize.Net is a registered trademark of CyberSource Corporation --> <div class="AuthorizeNetSeal"> <script type="text/javascript" language="javascript">var ANS_customer_id="cd0935f1-ebca-4a0d-b8c4-621ba24e8f4f";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> <a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">Online Payments</a> </div> 
						</td></table>
			
			
			
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
	  
	  
     