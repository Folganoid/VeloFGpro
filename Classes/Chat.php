<?php
/**
 * Created by PhpStorm.
 * User: fg
 * Date: 28.02.17
 * Time: 18:32
 */

class Chat extends Main
{

    public static $content;

    public function __construct()
    {
        $this->getContent();
        $this->addToDB();
    }

    private function getContent() {
        $this->db("SELECT * FROM `chat` ORDER BY `time` DESC LIMIT 100;");
        self::$content = $this->result;
    }

    private function addToDB() {
        if (isset($_POST['enter']) && ($_POST['id_form'] == "formchat") && isset($_SESSION['USER_LOGIN'])) {
            $this->db("INSERT INTO `chat` VALUES (NULL, '" . $_SESSION['USER_LOGIN'] . "', NOW(), '" . static::PostSecure($_POST['text']) . "');");
            $this->getContent();
        }
        else if (isset($_POST['enter']) && ($_POST['id_form'] == "formchat")) {
            MessageShow::set('Только зарегестрированные пользователи могут отправлять сообщения.', 1);
        };
    }

    public static function showContent() {
        echo '<table class="chattable">';
        foreach(self::$content as $key=>$value){
            echo '<tr><td><span class="colordarkblue">['.$value[2].']</span> : <b class="colordarkred">'.$value[1].' - </b></td><td style="text-align: justify; white-space: normal;">'.$value[3].'</td></tr>';
        };
        echo '</table>';
    }
}