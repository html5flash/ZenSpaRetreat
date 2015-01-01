<?php 
include('../dbconfig.php');
include('includes/dbconnection.php');
global $callConfig;
include("model/forum.class.php");
$forumObj=new fourmClass();

if($_POST['type']=="subcatdrop")
{
?>
<select name="fscid" id="fscid" class="select_large required">
<option value="">-- Select --</option>
<?php 
if($_POST['fcid']!="")
{
$allmaincategorydrop=$forumObj->getAllForumCategoryList($_POST['fcid'],'fcid','ASC',$start,$limit);
foreach($allmaincategorydrop as $maincategory)
{
?>
<option value="<?=$maincategory->fcid?>"><?=stripslashes($maincategory->title)?></option>
<?php
}
}
?>
</select>
<?php
}
?>