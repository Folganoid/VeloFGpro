<?php
new Profile();

function ShowContent()
{
    if(isset(Route::$url_parts[1])) {

        echo '<h2 align="center">Профиль ' . Route::$url_parts[1] . '</h2><br>';

            $userGet = new Profile();
            $user = $userGet->getUserInfo(Route::$url_parts[1]);

            if (isset($user[0])) {

                echo '

            <table class="profiletable">
            <tr><td>Логин: </td><td><b>' . $user[0]['login'] . '</b></td></tr>
            <tr><td>Имя: </td><td><b>' . $user[0]['name'] . '</b></td></tr>
            <tr><td>Email: </td><td><b>' . $user[0]['email'] . '</b></td></tr>
            <tr><td>Год рождения: </td><td><b class="colordarkblue">' . $user[0]['year'] . '</b></td></tr>
            <tr><td>Дата регистрации: </td><td><b class="colordarkblue">' . $user[0]['date'] . '</b></td></tr>
        </table> 
              <br><br>
              <a class="userLink" href="/statistic/' . Route::$url_parts[1] . '">Посмотреть статистику</a>
              <br>
              <a class="userLink" href="/map/' . Route::$url_parts[1] . '">Посмотреть карту</a>
        
        ';
            }
            else {
                MessageShow::set("Пользователь не найден!", 1);
                MessageShow::get();
            }


    }
    else {

        if (isset($_SESSION['USER_ID'])) {

            echo '
	
	<h2 align="center">Ваш профиль</h2>

	';
            echo '
	    <FORM method="post" id="formpd" action="" NAME="prof">
        <table class="profiletable">
            <tr><td>Логин: </td><td>' . $_SESSION['USER_LOGIN'] . '</td></tr>
            <tr><td>Имя: </td><td>' . $_SESSION['USER_NAME'] . '</td><td><input value="' . $_SESSION['USER_NAME'] . '"  size="15" placeholder="name" name="name" pattern="[A-za-z0-9А-Яа-я]{3,15}" title="3-15 букв или цифр" required></input></td></tr>
            <tr><td>Email: </td><td>' . $_SESSION['USER_EMAIL'] . '</td><td><input value="' . $_SESSION['USER_EMAIL'] . '"  size="20" type="email" placeholder="email" name="email" required></input></td></tr>
            <tr><td>Год рождения: </td><td>' . $_SESSION['USER_BYEAR'] . '</td><td><input value="' . $_SESSION['USER_BYEAR'] . '" size="4" placeholder="1995" name="year" pattern="[0-9]{4,4}" required></input></td></tr>
            <tr><td></td><td>Изменить пароль:</td><td><input size="15" placeholder="pass" name="pass1" pattern="[A-za-z-0-9]{5,15}" type="password" title="5-15 латинских букв или цифр"></input></td></tr>
            <tr><td></td><td>Подтвердить пароль:</td><td><input size="15" placeholder="pass" name="pass2" pattern="[A-za-z-0-9]{5,15}" type="password" title="5-15 латинских букв или цифр"></input></td></tr>
            <tr><td>Дата регистрации: </td><td>' . $_SESSION['USER_DATEREG'] . '</td></tr>
        </table><br>
                <input name="id_form" type="hidden" value="prof"></input>
    			<INPUT TYPE="submit" name="enter" VALUE="Изменить личные данные"></input>
    	</FORM>
            ';
        } else {
            MessageShow::set("Нет доступа к аккаунту!", 1);
            MessageShow::get();
        }
    }
}

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


