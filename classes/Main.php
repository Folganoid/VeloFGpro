<?php

class Main {
	public function db($str) {  // Выполнение запроса $str
		$pdo = new PDO(SQL, USER, PASS);
        $pdo->query("SET NAMES utf8");
				$stmt = $pdo->prepare($str);
				$stmt->execute();
				$this->result = $stmt->fetchAll();
		$pdo = null;
	}

	public static function GenPass($log, $pass) { // Генерирование пароля.
		return md5('dog'.md5('321'.$pass.'123').md5('678'.$log.'890'));
	}

	public static function PostSecure($str) { // Защита полей ввода.
		return nl2br(htmlspecialchars(trim($str), ENT_QUOTES), false);
	}

};

?>