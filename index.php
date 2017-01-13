<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);


session_start();

require_once 'config.php';

function __autoload($classname) {
    $filename = __DIR__."/classes/". $classname .".php";
    require_once($filename);
};



	Login::IfCookieExist();
	Login::EntExButton();
	
	new Route;

?>
