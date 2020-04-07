<?php


$envfile = '../environment.php';


$whitelist = array(
    '127.0.0.1',
    '::1'
);
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
		require_once($envfile);
}
else{
		///Local

		if (file_exists($envfile)) {
		    require_once($envfile);
		} else {

     		define("DB_PASS","");
			define("DB_NAME","jess");
			define("DB_SREVER","localhost");
			define("DB_USER","root");
	        define("SITE_BASE","http://".$_SERVER['HTTP_HOST']."/");
	        define("SITE_ADMIN","http://".$_SERVER['HTTP_HOST']."/admin/");
	        $_ENV["STAGE"]='live';
		}


		
}

?>