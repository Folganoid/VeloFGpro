<?php


class MessageShow { //создает полосу сообщений

    public static function set($text = '', $num = 0)
    {

        if ($num == 1) {
            $_SESSION['MESSAGE'] = '<div class="message" style="background-color: red;"> ОШИБКА: '.$text.'</div>';

        }
        else if ($num == 2) {
            $_SESSION['MESSAGE'] = '<div class="message" style="background-color: orange;">ПРЕДУПРЕЖДЕНИЕ: '.$text.'</div>';
        }
        else if ($num == 3) {
            $_SESSION['MESSAGE'] = '<div class="message" style="background-color: green;">ИНФОРМАЦИЯ: '.$text.'</div>';
        }
        else {
            $_SESSION['MESSAGE'] = '<div class="message">&nbsp;</div>';
        }
    }

    public static function get() {
        if(!isset($_SESSION['MESSAGE'])) self::set();
        echo $_SESSION['MESSAGE'];
        self::set();
    }
};

?>