<?php
include_once("includes/sessions.php");
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
include('model/treatments.class.php');

if(!empty($_GET['cat'])&& $_GET['cat']=="treatment")
{

	if(!empty($_GET['cond'])&&$_GET['cond']=="showstate")
	{ /*id  country  state  dateofupdate Table: state  */ ?>
	
	
	 <select name="treatmenttype" class="text" id='treatmenttype'  onchange="country_sel('state',this.value,'showtown','citydiv');"  style="width:200px;"  >
					
			<option value="0">Choose</option>
				   <?php
				 
				   $allstates=treatmentClass::getAlltreatmentListByCID($_GET['id']);

						foreach($allstates as $all_pages)
						{
						  // $id="( $ ".$all_pages->t_price ." ) ".$all_pages->t_title;
						  
							echo "<option value=\"$all_pages->t_id\">$all_pages->t_title</option>";
						}
				   ?>			   
			 </select>    <?php }
}


if(!empty($_GET['cat'])&& $_GET['cat']=="state")
{

if(!empty($_GET['cond'])&&$_GET['cond']=="showtown")
{ 
 $allstates=treatmentClass::getTreatmentData($_GET['id']);  
?> 
<input name="g_price" type="text" class="form" id="g_price" size="10"  readonly="" value="<?=$allstates->t_price?>"/>
				   
              <?php }
}


?>