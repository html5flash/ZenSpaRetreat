<?php
class userClass
{ 
 function checkMemberLogin()
 {
    global $callConfig;
	$where="us_name='".$_POST['txt_username']."' and password='".$callConfig->passwordEncrypt($_POST['txt_pwd'])."' and status='Active'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_ADMIN,'*',$where,'','','');
	$row=$callConfig->getRow($query);
	if($row->user_id!="")
	{
	$_SESSION['frnt_mid']=$row->user_id;
	$_SESSION['frnt_musername']=$row->us_name;
	$_SESSION['frnt_memail']=$row->email;
	$_SESSION['frnt_lastlogin']=$row->lastlogin;
	$_SESSION['memberjoinedon']=$row->createdon;
	$cartupdattion=userClass::cartitemsUpdatedToUserAccount();
	$cntfilledornot=userClass::checkShippingBillingaddresFilleed();
	 if($cntfilledornot!=0 && $_POST['red']=="confirm")
	 {
	   $url="onlinestoreconfirm.php";
	 }
	 else
	 {
	    $url="userprofile.php?err=Please fill all required fields";
	 }
	/*if($_POST['red']=="confirm"){
	  if($cntfilledornot!=0)
	  {
	  	$url="onlinestoreconfirm.php";
	  }
	  else
	  {
		 $url="userprofile.php?act=confirm&fillmsg=fillall";
	  }
	}
	else {
	$url="userprofile.php";
	}*/
	header("location:".$url);
	exit;
	}
	else
	{
	header("location:login.php?ferr=Login failed, please enter correct details");
	exit;
	}
 } 
 
    function userAuthentication()
	{
		if($_SESSION['frnt_mid']!="")
		{
			header("location:index.php");
		}
	}
	
	 function checkShippingBillingaddresFilleed()
	{ 
	global $callConfig;
	$where="b_firstname!='' and b_lastname!='' and b_country!='' and b_state!='' and b_address!='' and s_firstname!='' and s_lastname!='' and s_country!='' and s_state!='' and s_address!='' and userid='".$_SESSION['frnt_mid']."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_ADMINSINFO,'*',$where,'','','');
	return $callConfig->getCount($query);
	}
	
	
 function get_userfirst_datails($tablename,$where)
 {
    global $callConfig;
	$query=$callConfig->selectQuery($tablename,'*',$where,'','','');
	return $callConfig->getRow($query);
 } 
 
  function userRegisteration($post)
	{
	global $callConfig;
	$fieldnames=array('us_name'=>$post['user_name'],'`password`'=>$callConfig->passwordEncrypt($post['user_pwd']),'email'=>$post['user_email'],'roletype'=>'level2','status'=>'Inactive');
	$res=$callConfig->insertRecord(TPREFIX.TBL_ADMIN,$fieldnames);
	if($res!="")
	{
	    $fieldnames2=array('userid'=>$res,'username'=>$post['user_name'],'b_firstname'=>$post['b_firstname'],'b_lastname'=>$post['b_lastname'],'b_country'=>$post['b_country'],'b_state'=>$post['b_state'],'b_address'=>mysql_real_escape_string($post['b_address']),'b_city'=>$post['b_city'],'b_zipcode'=>$post['b_zipcode'],'b_fax'=>$post['b_fax'],'b_phoneno'=>$post['b_phoneno'],'s_firstname'=>$post['s_firstname'],'s_lastname'=>$post['s_lastname'],'s_country'=>$post['s_country'],'s_state'=>$post['s_state'],'s_address'=>mysql_real_escape_string($post['s_address']),'s_city'=>$post['s_city'],'s_zipcode'=>$post['s_zipcode'],'s_fax'=>$post['s_fax'],'s_phoneno'=>$post['s_phoneno']);
	    $callConfig->insertRecord(TPREFIX.TBL_ADMINSINFO,$fieldnames2);
		contentpagesClass::recentActivities('User registered successfully on >> '.DATE_TIME_FORMAT.'','g');
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: The Super Teens <info@thesuperteens.com>' . "\r\n";
		$urllink=$callConfig->passwordEncrypt($res);
		//$message="Click <a href='http://themedia3.com/superteens/useractivation.php?activationid=$urllink'>Here<a/> for activate the account";
		$message='<table width="750" border="0" cellspacing="3" cellpadding="3" style="border:1px solid #eeeeee">
		<tr>
		<td align="left" valign="middle"><strong>Your registeration is completed successfully</strong></td>
		</tr>
		<tr>
		<td align="left" valign="middle">Username :: '.$post['user_name'].'</td>
		</tr>
		<tr>
		<td align="left" valign="middle">Password :: '.$post['user_pwd'].'</td>
		</tr>
		<tr>
		<td align="left" valign="middle"><strong>Please click  the below link to activate your account</strong></td>
		</tr>
		<tr>
		<td align="left" valign="middle"><a href=http://themedia3.com/superteens/useractivation.php?activationid=$urllink">Click Here<a/></td>
		</tr>
		<tr>
		<td height="55" align="left" valign="middle">Thank You,<br />
		Support Team, The Superteens</td>
		</tr>
		<tr>
		<td></td>
		</tr>
		</table>';
		mail($post['user_email'],"The Super Teens User Registeration",$message,$headers);
		$callConfig->headerRedirect("registeration.php?err=User registered successfully, please check your mail for activation link");
	}
	else
	{
		$callConfig->headerRedirect("registeration.php?ferr=User registeration failed");
	}
	}
	
	function userDataEditing($post)
	{
	global $callConfig;
	$fieldnames=array('us_name'=>$post['user_name'],'email'=>$post['user_email']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_ADMIN,$fieldnames,'user_id',$_SESSION['frnt_mid']);
	if($res==1)
	{
		$fieldnames2=array('username'=>$post['user_name'],'b_firstname'=>$post['b_firstname'],'b_lastname'=>$post['b_lastname'],'b_country'=>$post['b_country'],'b_state'=>$post['b_state'],'b_address'=>mysql_real_escape_string($post['b_address']),'b_city'=>$post['b_city'],'b_zipcode'=>$post['b_zipcode'],'b_fax'=>$post['b_fax'],'b_phoneno'=>$post['b_phoneno'],'s_firstname'=>$post['s_firstname'],'s_lastname'=>$post['s_lastname'],'s_country'=>$post['s_country'],'s_state'=>$post['s_state'],'s_address'=>mysql_real_escape_string($post['s_address']),'s_city'=>$post['s_city'],'s_zipcode'=>$post['s_zipcode'],'s_fax'=>$post['s_fax'],'s_phoneno'=>$post['s_phoneno']);
		$callConfig->updateRecord(TPREFIX.TBL_ADMINSINFO,$fieldnames2,'userid',$_SESSION['frnt_mid']);
		//contentpagesClass::recentActivities($_SESSION['frnt_musername'].' >> account details updated successfully on >> '.DATE_TIME_FORMAT.'','g');       
		if($post['act']=="confirm")
		{
			$callConfig->headerRedirect("onlinestoreconfirm.php");
			exit;
		}
		$cntfilledornot=userClass::checkShippingBillingaddresFilleed();
		if($cntfilledornot!=0)
		{
			$callConfig->headerRedirect("onlinestoreconfirm.php");
			exit;
		}
		else
		{
		    $callConfig->headerRedirect("userprofile.php?err=Your account details updated successfully");
			exit;
		}
	}
		else
		{
		    $callConfig->headerRedirect("userprofile.php?ferr=Your account details updation failed");
			exit;
		}
	}
	
	function updateUserStatusActivatuionkey($uid)
	{
	global $callConfig;
	$fieldnames=array('status'=>'Active');
	$res=$callConfig->updateRecord(TPREFIX.TBL_ADMIN,$fieldnames,'user_id',$callConfig->passwordDecrypt($uid));
	if($res==1)
	{
		contentpagesClass::recentActivities($_SESSION['frnt_mid'].' >> account Activated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("useractivation.php?err=Your account activated successfully");
	}
	else
	{
		$callConfig->headerRedirect("useractivation.php?ferr=Your account activation failed");
	}
	}
	
	
	function userForgotpassword($uname){
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_ADMIN,'password,email',"us_name='".$uname."' ",'','','');
	$row=$callConfig->getRow($query);
	if($row->email!="" && $row->password!="")
	{
		$message='<table width="750" border="0" cellspacing="3" cellpadding="3" style="border:1px solid #eeeeee">
		<tr>
		<td align="left" valign="middle"><strong>Your login details are given please check once</strong></td>
		</tr>
		<tr>
		<td align="left" valign="middle">Username :: '.$uname.'</td>
		</tr>
		<tr>
		<td align="left" valign="middle">Password :: '.$callConfig->passwordDecrypt($row->password).'</td>
		</tr>
		<tr>
		<td height="55" align="left" valign="middle">Thank You,<br />
		Support Team, The Superteens</td>
		</tr>
		<tr>
		<td></td>
		</tr>
		</table>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: The Super Teens <info@thesuperteens.com>' . "\r\n";
		if(mail($row->email,"The Super Teens Forgot Password",$message,$headers))
		{
		  $callConfig->headerRedirect("forgotpassword.php?ferr=Password sent to your mail Address, please check your mail");
		  exit;
		}
		else
		{
		   $callConfig->headerRedirect("forgotpassword.php?ferr=Mail sending mailed, please try again or contact administrator");
		   exit;
		}
		
	}
	 else
	 {
	 	 $callConfig->headerRedirect("forgotpassword.php?ferr=Your entered username not match with our database");	
		 exit;
	 }
	}
	
	
	
	function userPasswordChanging($post){
	global $callConfig;
	$whr="us_name='".$post['txt_username']."' and `password`='".$callConfig->passwordEncrypt($post['txt_oldpwd'])."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_ADMIN,'*',$whr,'','','');
	$row=$callConfig->getRow($query);
	if($row->email!="" && $row->user_id!="")
	{
	    $fieldnames=array('password'=>$callConfig->passwordEncrypt($post['txt_newpwd']));
	    $res=$callConfig->updateRecord(TPREFIX.TBL_ADMIN,$fieldnames,'user_id',$row->user_id);
		if($res==1)
		{
		  session_destroy();
		  $callConfig->headerRedirect("login.php?ferr=Password changed successfully");
		  exit;
		}
		else
		{
		   $callConfig->headerRedirect("userchangepassword.php?ferr=Password changing failed.");
		   exit;
		}
		
	}
	 else
	 {
	 	 $callConfig->headerRedirect("userchangepassword.php?ferr=Your entered username and password not match with our database");	
		 exit;
	 }
}
   
   
 
 
 
 
 
	
	
	 function subscriberInsert($post)
	{
	global $callConfig;
	$fieldnames=array('emailid'=>$post['emailid']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_SUBSCRIBERS,$fieldnames);
	if($res!="")
	{
		contentpagesClass::recentActivities('User Subscribed successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?snwserr=User Subscribed successfully#ltr");
	}
	else
	{
		contentpagesClass::recentActivities('User Subscription failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?fnwserr=User Subscription failed#ltr");
	}
	}
	
	function cartitemsUpdatedToUserAccount()
	{
		global $callConfig;
		$fieldnames=array('session_userid'=>$_SESSION['frnt_mid']); 
		$res=$callConfig->updateRecord(TPREFIX.TBL_CART,$fieldnames,'temprandid',$_SESSION['CART_TEMP_RANDOM']);
	}
	
}
?>