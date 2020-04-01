<?php

// database constant






$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    
    // Server



if(stristr($_SERVER['HTTP_HOST'], "escortscalendar.com")) {

	define("DB_PASS","ePixel1!");
		define("DB_NAME","letusscr_mnc");
		define("DB_SREVER","c02.tmdcloud.eu");
		define("DB_USER","letusscr_mnc");
		define("SITE_BASE","https://".$_SERVER['HTTP_HOST']."/");
	   

}else{
		define("DB_PASS","ePixel1!");
		define("DB_NAME","letusscr_mnc");
		define("DB_SREVER","c02.tmdcloud.eu");
		define("DB_USER","letusscr_mnc");
		define("SITE_BASE","https://".$_SERVER['HTTP_HOST']."/");
}


}
else{

	///Local
define("DB_PASS","");
define("DB_NAME","jess");
define("DB_SREVER","localhost");
define("DB_USER","root");
define("SITE_BASE","http://".$_SERVER['HTTP_HOST']."/chrlie/");
}

?>