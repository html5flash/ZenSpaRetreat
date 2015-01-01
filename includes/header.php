<?php
if (!defined("SITE_FOLDER")) define(SITE_FOLDER, ""); //Should be changed
if ((!$_SERVER["HTTPS"]) || ($_SERVER["HTTPS"] == "off")) {
		define(HTTPS_MODE, "off");
		if (!defined("DEFAULT_URL")) define(DEFAULT_URL, "http://".$_SERVER["HTTP_HOST"].SITE_FOLDER);
	} else {
		define(HTTPS_MODE, "on");
		if (!defined("DEFAULT_URL")) define(DEFAULT_URL, "https://".$_SERVER["HTTP_HOST"].SITE_FOLDER);
	}
?>
