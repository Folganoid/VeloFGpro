<?php

class View {

	public static function MenuShow() { // вывод меню авторизации
		if(isset($_SESSION['USER_LOGIN'])) {
			echo '

				<input name="exit" type="submit" value="Выйти"></input>
				<a href="/profile">(Профиль) </a>
				
			';}
		else {
			echo '
                <a href="/register">(Регистрация) </a>
				<input size="8" placeholder="login" name="login"></input>
				<input size="8" placeholder="password" name="password"></input>
				<input name="enter" type="submit" value="Войти"></input>
				<input title="запомнить меня" type="checkbox" name="check" value="Yes" /checked></input>
			';
		};

	}
};


?>