<?php
		if($_SESSION['roletype']=="level1")
		{
		header("Location:index.php?option=com_noaccess");
		exit();
		}
?>