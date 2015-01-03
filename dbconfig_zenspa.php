<?php 
error_reporting(0);
define(HOSTNAME,"localhost");
define(USERNAME,"zenspaco_retreat");
define(PASSWORD,"tgbs33r!");
define(DBNAME,  "zenspaco_retreat");


###################################################################
######### TABLE CONSTANTS 
###################################################################

/********* Table Prefix *********/
define('TPREFIX', 'tb_');

/********* Table Names *********/
define('TBL_ADMIN','admin');
define('TBL_ADMINSINFO','admin_info');
define('TBL_SITESETTINGS','sitesettings');
define('TBL_RECENTACTIVITIES','recentactivities');
define('TBL_CONTENTPAGES','contentpages');
define('TBL_PACKAGES','packages');
define('TBL_PACKAGES','packages');
define('TBL_OTHERPACKAGES','otherpackages');
define('TBL_ORDER','order');
define('TBL_TEMP','temp');
define('TBL_GIFTS','gifts');
define('TBL_APPOINTMENT','appointments');
define('TBL_TREATMENT','treatments');

define('ADMINROOT','administrator');
define('STR_TO_TIME',strtotime(date("Y-m-d H:i:s")));
define('ONLY_DATE',date("Y-m-d"));
define('DATE_TIME',date("Y-m-d H:i:s"));
define('DATE_TIME_FORMAT',date("l dS F Y, H:i:s A", STR_TO_TIME));
define('DBIN','INSERT INTO ');
define('DBUP','UPDATE ');
define('DBWHR',' WHERE ');
define('DBDEL','DELETE ');
define('DBFROM',' FROM ');
define('DBSELECT',' SELECT ');
define('DBSET',' SET ');
define('HEAD_LTN','location:');
define('DB_LMT',' LIMIT ');
define('DB_ORDER',' ORDER BY ');

###################################################################
######### Physical Path Constants 
###################################################################
define(SITEROOT, 				$_SERVER['DOCUMENT_ROOT']."/");
define(LISTINGIMAGESROOT, 		SITEROOT."/images/listings");
define(UPLOADSROOT, 			SITEROOT."/uploads/");
define(USER_IMAGE_ROOT,	        SITEROOT."/images/");

###################################################################
######### Url Constants 
###################################################################
define(SITEURL, 				"http://".$_SERVER['HTTP_HOST']."/");

define(SITEPATH_URL,'http://'.$_SERVER['HTTP_HOST']);
?>