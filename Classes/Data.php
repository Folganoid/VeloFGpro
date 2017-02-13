<?php

/**
 * Created by PhpStorm.
 * User: fg
 * Date: 12.02.17
 * Time: 18:44
 */
class Data extends Main
{
    public static $tires;
    public static $tss;
    public static $yearOdo;

    function __construct($id)
    {
        $this->db("SELECT `name`, `id` FROM `tire` WHERE `userid` = '".$id."';");
        self::$tires = $this->result;
        $this->db("SELECT `name`, `id` FROM `ts` WHERE `userid` = '".$id."';");
        self::$tss = $this->result;
        $this->db("SELECT `id`, `year`, `bike`, `dist` FROM `yeardata` WHERE `userid` = '".$id."' ORDER BY `year` DESC;");
        self::$yearOdo = $this->result;

        $this->formUp();
        $this->delCell();

    }

    public static function getOptionTs() {
        foreach(self::$tss as $key=>$value){
            echo '<option value="'.$value[0].'">'.$value[0].'</option>';
        };
    }
    public static function getOptionTires() {
        foreach(self::$tires as $key=>$value){
            echo '<option value="'.$value[0].'">'.$value[0].'</option>';
        };
    }

    public static function getTs() {
        foreach(self::$tss as $key=>$value){
            echo '</td><td>'.$value[0].'</td><td><form method="POST"><button name="delts" type="submit" value="'.$value[1].'">удалить</button></form></td></tr>';
        };
    }
    public static function getTires() {
        foreach(self::$tires as $key=>$value){
            echo '<tr><td>'.$value[0].'</td><td><form method="POST"><button name="deltire" type="submit" value="'.$value[1].'">удалить</button></form></td></tr>';
        };
    }
    public static function getOdo() {
        foreach(self::$yearOdo as $key=>$value){
            echo '<tr><td class="colordarkblue">'.$value[1].'</td><td>'.$value[2].'</td><td class="colordarkred">'.$value[3].' км</td><td><form method="POST"><button name="delodo" type="submit" value="'.$value[0].'">удалить</button></form></td></tr>';
        };
    }

    private function formUp()
    {
        if (isset($_POST['enter']) && ($_POST['id_form'] == "form4")) {
            $this->db("INSERT INTO `tire` VALUES (NULL, '".static::PostSecure($_POST['form4tire'])."', ".$_SESSION['USER_ID'].");");
        };

        if (isset($_POST['enter']) && ($_POST['id_form'] == "form3")) {
            $this->db("INSERT INTO `ts` VALUES (NULL, '".static::PostSecure($_POST['form3ts'])."', ".$_SESSION['USER_ID'].");");
        };
        if (isset($_POST['enter']) && ($_POST['id_form'] == "form2")) {
            $this->db("INSERT INTO `yeardata` VALUES (NULL, ".$_SESSION['USER_ID'].", ".static::PostSecure($_POST['form2year']).", '".static::PostSecure($_POST['form2ts'])."', ".static::PostSecure($_POST['form2dist']).");");
        };



    }

    private function delCell() {
        if (isset($_POST['deltire'])) {
            $deltire = static::PostSecure($_POST['deltire']);
            $this->db("DELETE FROM `tire` WHERE `id` =".$deltire.";");
        };
        if (isset($_POST['delts'])) {
            $delts = static::PostSecure($_POST['delts']);
            $this->db("DELETE FROM `ts` WHERE `id` =".$delts.";");
        };
        if (isset($_POST['delodo'])) {
            $delodo = static::PostSecure($_POST['delodo']);
            $this->db("DELETE FROM `yeardata` WHERE `id` =".$delodo.";");
        };


    }



}