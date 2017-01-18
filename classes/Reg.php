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
		
			$this->db("SELECT `login`, `email` FROM `users` WHERE `login` = '".$lg."' OR `email` = '".$eml."';");

				if (isset($this->result[0]['login'])) echo 'Такой логин или пароль уже занят'; 
				else if ($pass1 != $pass2) echo 'Пароли не совпадают';		
				else {
			
			$this->db("INSERT INTO `users` (`id`, `login`, `name`, `pass`, `date`, `email`, `rank`) VALUES (NULL, '".$lg."', '".$nm."', '".$pass1."', NOW(), '".$eml."', 0);");
		
		echo 'Данные зарегистрированы.';
				setcookie('c1', $pass1, strtotime('+30 days'), '/');
				setcookie('c2', $lg, strtotime('+30 days'), '/');
		exit(header('Location: /'));

		};
	};
}

};



?>