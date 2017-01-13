<?php

class Route { // Роутинг.

	public function Correct_path($path){ // проверка строки запроса.
    	if(!preg_match("/^([0-9a-zA-Z\/][0-9a-zA-Z\_\/\-\\\]*)$/i",$path)) return false;
    	else return true;
	}

	public function __construct() {
		$url = $_SERVER['REQUEST_URI'];

			if ($_SERVER['REQUEST_URI'] == "/" ) $page = 'home';
			else {
				$page = substr($_SERVER['REQUEST_URI'], 1);

					if(!$this->correct_path($url)){
    					exit('error URL');
					}

				$url_parts = explode("/", $page);

			};

		if ($page == 'home') include ROOTDIR.'/pages/home.php';
		else if ($page == 'register') include ROOTDIR.'/pages/register.php';
		else if ($page == 'statistic') include ROOTDIR.'/pages/statistic.php';
		else if ($page == 'chat') include ROOTDIR.'/pages/chat.php';
		else if ($page == 'map') include ROOTDIR.'/pages/map.php';
		else if ($page == 'items') include ROOTDIR.'/pages/items.php';
		else if ($page == 'profile') include ROOTDIR.'/pages/profile.php';
		else include ROOTDIR.'/pages/404.php';
	}
};


?>