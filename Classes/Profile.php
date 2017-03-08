<?php

/**
 * Created by PhpStorm.
 * User: fg
 * Date: 28.02.17
 * Time: 20:51
 */
class Profile extends Main
{
    public function __construct()
    {

        if (isset($_POST['enter']) && ($_POST['id_form'] == "prof")) {
            $name = static::PostSecure($_POST['name']);
            $login = $_SESSION['USER_LOGIN'];
            $email = static::PostSecure($_POST['email']);
            $year = static::PostSecure($_POST['year']);

            if($_POST['pass1'] != $_POST['pass2']) {
                    MessageShow::set('Пароли не совпадают', 1);
                    MessageShow::get();
            }
            else if(strlen($_POST['pass1']) > 0) {
                $pass = self::GenPass($login, static::PostSecure($_POST['pass1']));
                $this->addDb($name, $email, $year, $pass);
                MessageShow::set('Данные измененны', 3);
                $id = new Login($login, $pass);
                $id->WriteCookies();
                echo '<script>$("#formpd").load("#formpd");</script>';


            }
            else {
                $pass = $_SESSION['USER_PASS'];
                $this->addDb($name, $email, $year, $pass);
                MessageShow::set('Данные измененны', 3);
                $id = new Login($login, $pass);
                $id->WriteCookies();
                echo '<script>$("#formpd").load("#formpd");</script>';


            }
        }
    }

    private function addDb($name, $email, $year, $pass) {
        $this->db('UPDATE users SET `name` = "'.$name.'", `email` = "'.$email.'", `year` = '.$year.', `pass`="'.$pass.'" WHERE id = '.$_SESSION['USER_ID'].';');
    }

    public function getUserInfo($login) {
        $this->db("SELECT * FROM `users` WHERE login = '".$login."';");
        return $this->result;

    }

}