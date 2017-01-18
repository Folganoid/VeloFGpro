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

        if (file_exists(ROOTDIR.'/pages/'.$page.'.php')) {
            include ROOTDIR.'/pages/'.$page.'.php';
        }
        else include ROOTDIR.'/pages/404.php';

	}
};


?>