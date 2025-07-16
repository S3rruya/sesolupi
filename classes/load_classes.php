<?php


if (file_exists("classes/config.php")) {
	//echo "1";
    include_once("classes/config.php");
} 
elseif (file_exists("../classes/config.php")) {
	//echo "2";
	include_once("../classes/config.php");
}
else {
	//echo "3";
	include_once("../../classes/config.php");
}

include_once(PATH_UPLOAD."classes/database.php");
include_once(PATH_UPLOAD."classes/gravatar.php");
include_once(PATH_UPLOAD."classes/capability.php");

//verifica mobile
include_once(PATH_UPLOAD."classes/Mobile_Detect.php");
//include_once(PATH_UPLOAD."classes/general.php");
include_once(PATH_UPLOAD."classes/send_mensages.php");
include_once(PATH_UPLOAD."classes/general.php");
include_once(PATH_UPLOAD."/includes/check_login.php");

