<?php

class Route { // Роутинг.

    public static $url_parts;

	public function Correct_path($path){ // проверка строки запроса.
    	if(!preg_match("/^([0-9a-zA-Z\/][0-9a-zA-Z\_\/\-\\\]*)$/i",$path)) return false;
    	else return true;
	}

	public function __construct() {
		$url = $_SERVER['REQUEST_URI'];

			if ($_SERVER['REQUEST_URI'] == "/") $page = 'home';
			else {
				$page = substr($_SERVER['REQUEST_URI'], 1);

					if(!$this->Correct_path($url)){
                        MessageShow::set('Неправильная ссылка', 1);
					}

				self::$url_parts = explode("/", $page);

			};

        if (file_exists(ROOTDIR.'/pages/'.$page.'.php')) include ROOTDIR.'/pages/'.$page.'.php';
        else if (file_exists(ROOTDIR.'/pages/'. self::$url_parts[0].'.php')) {
            include ROOTDIR.'/pages/'.self::$url_parts[0].'.php';
        }
        else {
            MessageShow::set('Ссылка не существует!', 1);
            include ROOTDIR . '/pages/home.php';
        }
	}
};


?>