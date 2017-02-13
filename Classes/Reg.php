<?php

class Reg extends Main{

public $result; // времянка с логином - паролем

public function __construct() {

	if (isset($_POST['enter']) && ($_POST['id_form'] == "reg")) {

		$lg = static::PostSecure($_POST['login']);
		$nm = static::PostSecure($_POST['name']);
		$pass1 = static::GenPass($lg, static::PostSecure($_POST['pass1']));
		$pass2 = static::GenPass($lg, static::PostSecure($_POST['pass2']));
		$eml = static::PostSecure($_POST['email']);
        $yr = static::PostSecure($_POST['year']);
		
			$this->db("SELECT `login`, `email` FROM `users` WHERE `login` = '".$lg."' OR `email` = '".$eml."';");

				if (isset($this->result[0]['login'])) {
				    MessageShow::set('Такой логин или пароль уже занят', 2);
                    MessageShow::get();
                }
				else if ($pass1 != $pass2) {
				    MessageShow::set('Пароли не совпадают', 1);
                    MessageShow::get();
                }
                else if(($yr < 1900) OR ($yr > date("Y"))) {
                    MessageShow::set('Некорректный год рождения', 1);
                    MessageShow::get();
                }
				else {
			
			$this->db("INSERT INTO `users` (`id`, `login`, `name`, `pass`, `date`, `email`, `rank`, `year`) VALUES (NULL, '".$lg."', '".$nm."', '".$pass1."', NOW(), '".$eml."', 0, ".$yr.");");

                MessageShow::set('Регистрация прошла успешно.', 3);
                setcookie('c1', $pass1, strtotime('+30 days'), "/");
				setcookie('c2', $lg, strtotime('+30 days'), "/");
                exit(header("Location: /"));
		        };
	};
}
};

?>