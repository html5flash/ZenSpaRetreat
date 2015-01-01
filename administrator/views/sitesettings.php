<?php 
include('includes/session.php');
if($_POST['submit']=="sitesettings")
{
$res=sitesettingsClass::sitesettings($_POST);
}
?>
<div class="box">
    <div class="heading">
      <h1><img src="allfiles/category.png" alt="">Site settings</h1>
    </div>
    <div class="content">
      <form action="index.php?option=com_sitesettings" method="post" id="frmCreateListing" class="middle_form" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="left" valign="middle"><p><label class="title">Theme</label></p></td>
    <td width="86%" align="left" valign="middle">
	<select name="theme_selection" id="theme_selection" class="select_large required" >
	<option value="darkblue">Blue</option>
	<option value="green">Light Green</option>
	<option value="darkgreen">Dark Green</option>
	<option value="brown">Brown</option>
	<option value="pink">Pink</option>
	</select><script type="text/javascript">
                for(var i=0;i<document.getElementById('theme_selection').length;i++)
                {
						if(document.getElementById('theme_selection').options[i].value=="<?php echo $site_settings_disp->theme_selection; ?>")
						{
						document.getElementById('theme_selection').options[i].selected=true
						}
                }			
                </script>
	</td>
  </tr>
  <tr>
    <td height="10" colspan="2" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td width="14%" align="left" valign="top"><label class="title">Admin Page Title</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="title" size="24" value="<?php echo stripslashes($site_settings_disp->title); ?>" class="text_large" ><br /><small>Browser Title</small></td>
  </tr>
    <tr>
    <td height="5" colspan="2" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td width="14%" align="left" valign="middle"><p><label class="title">Site Logo</label></p></td>
    <td width="86%" align="left" valign="middle">
      <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td width="23%"><input type="file" name="site_image" size="24"></td>
          <td width="77%"><?php if($site_settings_disp->site_image!="")
	{
	?>
	<img src="../uploads/site/<?php echo $site_settings_disp->site_image; ?>" style="width:185px; height:79px;" />
	<input type="hidden" name="hdn_site_image" size="24" value="<?php echo $site_settings_disp->site_image; ?>">
	<?php
	}
	?></td>
        </tr>
      </table>
	
	</td>
  </tr>
  <tr>
    <td height="5" colspan="2" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td width="14%" align="left" valign="top"><label class="title">No Of Records Per Page</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="noofrecords" size="24" value="<?php echo $site_settings_disp->noofrecords; ?>" class="text_large" ><br /><small>If it is zero it takes the default LIMIT from the code</small></td>
  </tr>
    <tr>
    <td height="10" colspan="2" align="left" valign="middle"></td>
  </tr>
   <tr>
    <td width="14%" align="left" valign="top"><label class="title">Municipal Tax</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="local_tax" size="24" value="<?php echo $site_settings_disp->local_tax; ?>" class="text_large" maxlength="3" >%</td>
  </tr>
    <tr>
    <td height="10" colspan="2" align="left" valign="middle"></td>
  </tr>
 <tr>
    <td width="14%" align="left" valign="top"><label class="title">State Tax</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="govt_tax" size="24" value="<?php echo $site_settings_disp->govt_tax; ?>" class="text_large" maxlength="3" >%</td>
  </tr>
    <tr>
    <td height="10" colspan="2" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td width="14%" align="left" valign="middle"><label class="title">Google Analytics Code</label></td>
    <td width="86%" align="left" valign="middle">
	<textarea name="googleanalytics" id="googleanalytics" class="textarea_install"><?php echo  stripslashes($site_settings_disp->googleanalytics);?></textarea></td>
  </tr>
    <tr>
    <td height="10" colspan="2" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td width="14%" align="left" valign="middle"><label class="title">Footer</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="footer_txt" value="<?php echo stripslashes($site_settings_disp->footer_txt); ?>" class="text_large" style="width:600px;"></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><p><label class="title">&nbsp;</label><input value="sitesettings" type="hidden"  name="submit"><input value="" class="button button_save" type="submit"  name="submitbutton"></p></td>
    <td align="left" valign="middle">&nbsp;</td>
  </tr>
</table>
</form>
    </div>
  </div>