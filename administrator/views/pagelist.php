<?php 
include('includes/session.php');
include("model/contentpages.class.php");
$contentpageObj=new contentpagesClass();
if($_POST['admininsert']=="Submit")
{
   $contentpageObj->insertcontentPage($_POST);
}
if($_POST['admininsert']=="Update")
{
   $contentpageObj->updatecontentPage($_POST);
}
if(isset($_GET['id']) && $_GET['id']!="")
{
   $hdn_value="Update";
   $indivdata=$contentpageObj->getContentPageData($_GET['id']); 
   $hdn_in_up='class="button button_save"';
}
else
{ 
  $hdn_value="Submit";
  $hdn_in_up='class="button button_add"';
}
if($_GET['action']=="delete")
{
   $contentpageObj->contentpageDelete($_GET['id']);
}
$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=1;
$allpages=$contentpageObj->getAllContentPagesList($_GET['fld'],$_GET['ord'],$start,$limit);
$total=$contentpageObj->getAllContentPagesListCount();
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


<!--<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		/*template_external_list_url : "tinymce/examples/lists/template_list.js",
		external_link_list_url : "tinymce/examples/lists/link_list.js",
		external_image_list_url : "tinymce/examples/lists/image_list.js",
		media_external_list_url : "tinymce/examples/lists/media_list.js",*/

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],
         // Extended valid elements
         extended_valid_elements : "iframe[src|width|height|name|align|frameborder]",
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>-->
<?php
if($option!="com_pagelist_insert")
{
?>
<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/content.jpeg" alt=""> Content Pages</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_pagelist_insert';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="20" align="center" valign="middle" style="text-align: center;">Sno</td>
			   <td width="290" align="left" valign="middle" >title</td>
              <td width="808" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_pagelist&ord=ASC&fld=title" class="up" title="up"></a>
					<a href="index.php?option=com_pagelist&ord=DESC&fld=title" class="down" title="down"></a>
					</div>
</td>
			 
			  <td width="43" align="center" valign="middle" >status</td>
              <td width="35" align="center" valign="middle" >Edit</td>
			  <td width="35" align="center" valign="middle" >Delete</td>
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
			<td colspan="2" align="left" valign="middle"><?php echo $all_pages->title;?></td>
			<td align="center" valign="middle"><?php echo $all_pages->status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_pagelist_insert&id=<?php echo $all_pages->page_id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_pagelist&action=delete&id=<?php echo $all_pages->page_id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
			  </td>
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
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_pagelist', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

    </table>
	
  </div>
  </div>
   <?php } else {?>
   <div class="box">
    <div class="heading">
      <h1><img src="allfiles/content.jpeg" alt=""> Add Page &nbsp;&nbsp;/&nbsp;&nbsp; Edit Page</h1>
    </div>
    <div class="content">
	<form action="index.php?option=com_pagelist_insert" method="post" id="frmCreateListing" name="frmCreateListing" class="middle_form" onsubmit="return validate();" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title:</label></td>
                <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>" style="width:800px;"/></td>
			  </tr>
			  <tr><td colspan="2" height="7"></td></tr>
			  <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title Slug:</label></td>
                <td width="94%" align="left" valign="middle"><input name="title_slug" class="text_large required" type="text" value="<?php echo $indivdata->title_slug;?>" style="width:800px;"/><br />
                <small>Usefull for SEO Friendly URLs, please separate keywords with  space&nbsp;&nbsp; (OR) &nbsp;&nbsp;- </small></td>
			  </tr>
			  <tr><td colspan="2" height="7"></td></tr>
			  <?php /*?><tr>
                <td align="left" valign="top" class="caption-field"><label class="title">Content:</label></td>
                <td align="left" valign="middle" class="caption-field"><textarea name="content" id="content_matter" cols="150" rows="20"><?php echo  stripslashes($indivdata->content);?></textarea></td>
				</tr>
				 <tr><td colspan="2" height="7"></td></tr><?php */?>
				   <tr>
                <td align="left" valign="top" class="caption-field"><label class="title">Content:</label></td>
				<td align="left" valign="middle" class="caption-field"> 
				<?
				include 'fckeditor/fckeditor.php'; 
				$sBasePath = 'fckeditor/' ;//to change in web root
				$oFCKeditor = new FCKeditor('content') ;  //name of the form-field to be generated
				$oFCKeditor->BasePath	= $sBasePath ;
				$oFCKeditor->Value		= $indivdata->content ;//the matter that may be in db
				$oFCKeditor->Height=400;
				$oFCKeditor->Width=900;
				$oFCKeditor->Create() ;
				?>	
                </td>
				</tr>
				 <tr><td colspan="2" height="7"></td></tr>
				
				<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Page Title:</label></td>
                <td width="94%" align="left" valign="middle"><input name="page_title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->page_title);?>" style="width:800px;"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
              <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Meta Keyword:</label> </td>
                <td width="94%" align="left" valign="middle"><input name="meta_keyword" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->meta_keyword);?>" style="width:800px;"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
			  <tr>
                <td width="6%" align="left" class="caption-field"> <label class="title">Meta Description:</label> </td>
                <td width="94%" align="left" valign="middle"><input name="meta_desc"  class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->meta_desc);?>" style="width:800px;"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
				<tr>
                <td align="left" class="caption-field"><label class="title">Status :</label> </td>
                <td align="left" valign="middle" class="caption-field">
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
                </script></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
	<tr>
	<td align="left" valign="middle" colspan="2"><input name="hdn_page_id" type="hidden" value="<?php echo $indivdata->page_id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><input <?php echo $hdn_in_up;?> type="submit" value="">
	</td>
	</tr>
        </table>
		</form>
</div>
</div>
<?php }?>