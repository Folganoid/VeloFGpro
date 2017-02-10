<?php

class Login extends Main { // проверка авторизации по БД.

	public $result; // времянка с логином - паролем

	public function __construct($login, $pass) { //вытаскиваем из базы логин/пароль

		$this->db("SELECT * FROM `users` WHERE `login` = '".$login."' AND `pass` = '".$pass."'");

	}	

	public function WriteCookies() { //записываем сессию и куки.
			if (isset($this->result[0]['login'])) {
                    $_SESSION['USER_ID'] = $this->result[0]['id'];
					$_SESSION['USER_LOGIN'] = $this->result[0]['login'];
                    $_SESSION['USER_NAME'] = $this->result[0]['name'];
                    $_SESSION['USER_DATEREG'] = $this->result[0]['date'];
                    $_SESSION['USER_EMAIL'] = $this->result[0]['email'];
                    $_SESSION['USER_RANK'] = $this->result[0]['rank'];
                    $_SESSION['USER_BYEAR'] = $this->result[0]['year'];

					if (isset($_POST['check'])) {
						setcookie('c1', static::GenPass(static::PostSecure($_POST['login']), static::PostSecure($_POST['password'])), strtotime('+30 days'), "/");
						setcookie('c2', static::PostSecure($_POST['login']), strtotime('+30 days'), "/");
                        MessageShow::set('Вы вошли как '.$_SESSION['USER_LOGIN'], 3);
					};
					unset($this->result); // обнуляем
			}
			else {
				$_SESSION = array(); // обнуляем
			};
	}

	public static function EntExButton() { // обработка кнопочек вход - выход
		if (isset($_POST['enter']) && ($_POST['id_form'] == "auth")) {
			static::CheckLogPassByDB(static::PostSecure($_POST['login']), static::PostSecure($_POST['password']));
            if(!isset($_SESSION['USER_ID'])) {
                MessageShow::set('Логин или пароль введены неверно !', 2);
            };
		}
		else if(isset($_POST['exit']) && ($_POST['id_form'] == "auth")) {
			setcookie('c1', "", time() - 3600, "/");
			setcookie('c2', "", time() - 3600, "/");
			$_SESSION = array();
		}
	}

	public static function LoginShow() { //Показываем текущий логин
		if (isset($_SESSION['USER_LOGIN'])) return $_SESSION['USER_LOGIN'];
		return 'гость';
	}
	
	public static function IfCookieExist() {
		if (isset($_COOKIE['c2']) && isset($_COOKIE['c1'])) {
			$id = new Login(static::PostSecure($_COOKIE['c2']), static::PostSecure($_COOKIE['c1']));
			$id->WriteCookies();
		};
	}
	public static function CheckLogPassByDB($log, $pass) { // проверка по базе логина-пароля.
		$id = new Login($log, static::GenPass($log, $pass));
		$id->WriteCookies();
	}

};

?>