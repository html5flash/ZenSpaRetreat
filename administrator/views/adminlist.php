<?php 
include('includes/session.php');
if($_GET['action']=="delete"){
   $userObj->adminuserDelete($_GET['id']);
}
if($_POST['bulksubmit']=="Apply"){
   $userObj->adminusersBulkAction($_POST);
}
if($_POST['admininsert']=="Submit"){
   $userObj->insertAdminUser($_POST);
}
if($_POST['admininsert']=="Update"){
   $userObj->updateAdminUser($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$userObj->getAdminUserData($_GET['id']); 
   $hdn_in_up='class="button button_save"';
} else { 
  $hdn_value="Submit";
  $hdn_in_up='class="button button_add"';
}
$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=25;
if($_GET['fld']!="")
$fldname=$_GET['fld'];
else
$fldname="user_id";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="ASC";
$allusers=$userObj->getAllAdminUsersList('senior,level1',$fldname,$orderby,$start,$limit);
$total=$userObj->getAllAdminUsersListCount('senior,level1');
?>
<script type="text/javascript">
function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate()
{
		
		var name=trim(document.frmCreateAdmin.name.value);
			if(name.length<1)
			{
				alert("Please Enter User Name");
				document.frmCreateAdmin.name.focus();
				return false;
		    }
			
			var password=trim(document.frmCreateAdmin.password.value);
			if(password.length<1)
			{
				alert("Please Enter Password");
				document.frmCreateAdmin.password.focus();
				return false;
		    }		
			
		
			var email=trim(document.frmCreateAdmin.email.value);
			if(email.length<1)
			{
				alert("Please Enter Email");
				document.frmCreateAdmin.email.focus();
				return false;
			}	
			
			var emailreg=/^[a-zA-Z0-9\.\_]+@[a-zA-Z0-9\.\_]+\.[a-zA-Z0-9\.]+$/		
			if(document.frmCreateAdmin.email.value.search(emailreg) == -1){
				alert("Please Enter Valid Email");
				document.frmCreateAdmin.email.focus();
				return false;
			}

}

</script>
<?php
if($option!="com_adminlist_insert"){
?>
<div class="box">
<div class="heading"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/users.jpeg" alt="">Admin Users</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_adminlist_insert';"></td>
</tr>
</table>
</div>
<div class="content">
		<form method="post" name="adminForm" id="adminForm" action="" onsubmit="if(document.getElementById('bulkaction').value=='bulktrash')confirm('Are you sure you want to delete selected records?'); return true;">
		<?php /*?><table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
		<thead>
		<tr>
		<td width="11%" align="left" valign="middle">
		<select name="bulkaction" id="bulkaction" class="select_small required" style="text-transform:none; width:130px; height:26px;">
		<option value="">--Bulk Actions--</option>
		<option value="Active">Active</option>
		<option value="Inactive">Inactive</option>
		<option value="bulktrash">Move to Trash</option>
		</select>
		</td>
		<td width="89%" align="left" valign="middle"><input type="submit" name="bulksubmit" value="Apply"/></td>
		</tr>
		</thead>
		</table><?php */?>
	 
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="38" align="left" valign="middle" style="text-align: center;"><?php /*?><input type="checkbox" name="check" id="check" value="All" onClick="checkAlluncheckAll('adminForm', 'list')"/><?php */?>sno</td>
			   <td width="88" align="left" valign="middle" >Username</td>
              <td width="158" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_adminlist&ord=ASC&fld=us_name" class="up" title="up"></a>
					<a href="index.php?option=com_adminlist&ord=DESC&fld=us_name" class="down" title="down"></a>
			  </div></td>
              <td width="110" align="left" valign="middle" >password</td>
			  <td width="105" align="left" valign="middle" >&nbsp;</td>
			  <td width="194" align="left" valign="middle" >email</td>
			  <td width="165" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_adminlist&ord=ASC&fld=email" class="up" title="up"></a>
					<a href="index.php?option=com_adminlist&ord=DESC&fld=email" class="down" title="down"></a></div></td>
			 <td width="65" align="left" valign="middle" >Role</td>
			  <td width="165" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_adminlist&ord=ASC&fld=roletype" class="up" title="up"></a>
			  <a href="index.php?option=com_adminlist&ord=DESC&fld=roletype" class="down" title="down"></a></div></td>
			  <td width="35" align="center" valign="middle" >status</td>
              <td width="32" align="center" valign="middle" >Edit</td>
			  <td width="76" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
					$ii=0;
					foreach($allusers as $all_users){
					?>
			<tr height="22">
			<td align="center" valign="middle">
			<?php /*?><?php if($all_users->user_id!="1"){
			?>
			<input type="checkbox" name="list[]" id="list" value="<?php echo $all_users->user_id; ?>" />
			<?php }else{
			?>
						<input type="checkbox" disabled="disabled">
						<?php }?><?php */?>
						<?php echo ($ii+1);?>			</td>
			<td colspan="2" align="left" valign="middle"><?php echo $all_users->us_name;?></td>
			<td colspan="2" align="left" valign="middle">* * * * * * *</td>
			<td colspan="2" align="left" valign="middle" ><?php echo $all_users->email;?></td>
			<td  colspan="2" align="left" valign="middle">
			<?php 
			if($all_users->roletype=="level1")
			echo "Level 1 Administrator";
			else if($all_users->roletype=="level2")
			echo "Level 2 Administrator";
			else
			echo "Senior Level Administrator";
			?></td>
			<td align="center" valign="middle"><?php echo $all_users->status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_adminlist_insert&id=<?php echo $all_users->user_id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle"><?php 
						if($all_users->user_id!="1"){
						?>
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_adminlist&action=delete&id=<?php echo $all_users->user_id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
						<?php 
						}else{
						echo "No privileges";
						}
						?></td>
			</tr>
			<?php
					$ii++;
							}
							?>
			</tbody>
						<tr><td colspan="12" align="left"><?php if($total>$limit){
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['ord']!="")
			$param.="&ord=".$_GET['ord'];
			if($_GET['ord']!="")
			$param.="&fld=".$_GET['fld'];
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_adminlist', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		
      </table>
	 </form>
	</div>
  </div>
   <?php } else {?>
   <div class="box">
    <div class="heading">
      <h1><img src="allfiles/users.jpeg" alt=""> Add Admin &nbsp;&nbsp;/&nbsp;&nbsp; Edit Admin</h1>
    </div>
    <div class="content">
	<form action="index.php?option=com_adminlist_insert" method="post" id="frmCreateAdmin" name="frmCreateAdmin" class="middle_form" onsubmit="return validate();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td width="26%" align="left" valign="middle"><label class="title">User Name: </label></td>
	<td width="74%" align="left" valign="middle"><input name="name" id="name" class="text_large required" type="text" value="<?php echo $indivdata->us_name?>">&nbsp;&nbsp;<span id="uname_error" style="display:none;">Please Enter Username</span></td>
	</tr>
	<tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">Password : </label></td>
	<td align="left" valign="middle"><input name="password" id="password" class="text_large required" type="password" value="<?php echo $callConfig->passwordDecrypt($indivdata->password);?>">&nbsp;&nbsp;<span id="password_error" style="display:none;">Please Enter Password</span></td>
	</tr>
	<tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">Email : </label></td>
	<td align="left" valign="middle"><input name="email" id="email" class="text_large required" type="text" value="<?php echo $indivdata->email?>">&nbsp;&nbsp;<span id="email_error" style="display:none;">Please Enter Email</span></td>
	</tr>
	<tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<?php 
	if($indivdata->user_id!="1"){
	?>
	<tr>
	<td align="left" valign="middle"><label class="title">Role Type : </label></td>
	<td align="left" valign="middle">
	<select name="roletype" id="roletype" class="select_large required">
	<option value="senior">Senior Level Administrators</option>
	<option value="level1">Level 1 Administrator</option>
	<!--<option value="level2">Level 2 Administrator</option>-->
	</select>
	<script type="text/javascript">
                for(var i=0;i<document.getElementById('roletype').length;i++)
                {
						if(document.getElementById('roletype').options[i].value=="<?php echo $indivdata->roletype; ?>")
						{
						document.getElementById('roletype').options[i].selected=true
						}
                }			
                </script>
	</td>
	</tr>
	<tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">Status : </label></td>
	<td align="left" valign="middle">
	<select name="status" id="status" class="select_large required">
	<option value="Active">Active</option>
	<option value="Inactive">Inactive</option>
	</select>
	<script type="text/javascript">
                for(var i=0;i<document.getElementById('status').length;i++)
                {
						if(document.getElementById('status').options[i].value=="<?php echo $indivdata->status; ?>")
						{
						document.getElementById('status').options[i].selected=true
						}
                }			
                </script>
	</td>
	</tr>
	<tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td align="left" valign="middle" colspan="2"><input name="hdn_user_id" type="hidden" value="<?php echo $indivdata->user_id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><input <?php echo $hdn_in_up;?> type="submit" value="">
	</td>
	</tr>
	</table>
	</form>
</div>
</div>
	 <?php }?>