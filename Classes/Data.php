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
    public static $id;

    function __construct($id)
    {
        self::$id = $id;
        $this->Reload();
        $this->formUp();
        $this->delCell();
    }

    public function Reload() {
        $this->db("SELECT `name`, `id` FROM `tire` WHERE `userid` = '".self::$id."';");
        self::$tires = $this->result;
        $this->db("SELECT `name`, `id` FROM `ts` WHERE `userid` = '".self::$id."';");
        self::$tss = $this->result;
        $this->db("SELECT `id`, `year`, `bike`, `dist` FROM `yeardata` WHERE `userid` = '".self::$id."' ORDER BY `year` DESC;");
        self::$yearOdo = $this->result;
        echo '<script>$("#form1").load("#form1"); </script>';
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
            MessageShow::set('Резина '.static::PostSecure($_POST['form4tire']).' успешно добавлена', 3);
            $this->Reload();
        };

        if (isset($_POST['enter']) && ($_POST['id_form'] == "form3")) {
            $this->db("INSERT INTO `ts` VALUES (NULL, '" . static::PostSecure($_POST['form3ts']) . "', " . $_SESSION['USER_ID'] . ");");
            MessageShow::set('Транспортное средство '.static::PostSecure($_POST['form3ts']).' успешно добавлено', 3);
            $this->Reload();
        };
        if (isset($_POST['enter']) && ($_POST['id_form'] == "form2")) {
            if(isset($_POST['form2ts'])) $ts2 = static::PostSecure($_POST['form2ts']);
            else $ts2 = "";

            if ($ts2 == "") {
                MessageShow::set('Добавьте транспортное средство', 1);
                MessageShow::get();
            }
            else {
                $this->db("INSERT INTO `yeardata` VALUES (NULL, " . $_SESSION['USER_ID'] . ", " . static::PostSecure($_POST['form2year']) . ", '" . static::PostSecure($_POST['form2ts']) . "', " . static::PostSecure($_POST['form2dist']) . ");");
                MessageShow::set('Годовая статистика успешно добавлена', 3);
                $this->Reload();
            }
        };
        if (isset($_POST['enter']) && ($_POST['id_form'] == "form1")) {
            if(isset($_POST['form1ts'])) $ts = static::PostSecure($_POST['form1ts']);
                else $ts = "";
            $name = static::PostSecure($_POST['form1name']);
            $dist = static::PostSecure($_POST['form1dist']);
            $hr = static::PostSecure($_POST['form1hr']);
            $min = static::PostSecure($_POST['form1min']);
            $sec = static::PostSecure($_POST['form1sec']);
            $time = $hr . ":" . $min . ":" . $sec;
            $avgspd = static::PostSecure($_POST['form1avgspd']);
            $date = static::PostSecure($_POST['form1year']) . "-" . (+static::PostSecure($_POST['form1month']) + 1) . "-" . static::PostSecure($_POST['form1day']);
            $maxspd = static::PostSecure($_POST['form1maxspd']);
            $avgpls = static::PostSecure($_POST['form1avgpls']);
            $maxpls = static::PostSecure($_POST['form1maxpls']);
            $temp = static::PostSecure($_POST['form1temp']);
            $asf = +static::PostSecure($_POST['form1asf']);
            $tvp = +static::PostSecure($_POST['form1tvp']);
            $grnt = +static::PostSecure($_POST['form1grnt']);
            $bzd = +static::PostSecure($_POST['form1bzd']);
            $teh = static::PostSecure($_POST['form1content']);
            if(isset($_POST['form1tire'])) $ts = static::PostSecure($_POST['form1tire']);
                else $tire = "";

            if (!$avgpls) $avgpls = 0;
            if (!$maxspd) $maxspd = 0;
            if (!$maxpls) $maxpls = 0;
            if (!$asf) $asf = 0;
            if (!$tvp) $tvp = 0;
            if (!$grnt) $grnt = 0;
            if (!$bzd) $bzd = 0;
            if (!$tire) $tire = "";


            if ($ts == "") {
                MessageShow::set('Добавьте транспортное средство', 1);
                MessageShow::get();
            }
            else {
                if (!checkdate(static::PostSecure($_POST['form1month']), static::PostSecure($_POST['form1day']), static::PostSecure($_POST['form1year']))) {
                    MessageShow::set('Указана некорректная дата', 1);
                    MessageShow::get();

                } else {
                    if ((+static::PostSecure($_POST['form1min']) > 59) OR (+static::PostSecure($_POST['form1min']) < 0) OR (+static::PostSecure($_POST['form1sec']) > 59) OR (+static::PostSecure($_POST['form1sec']) < 0)) {
                        MessageShow::set('Указано некорректное время', 1);
                        MessageShow::get();
                    } else {
                        if ($asf + $tvp + $grnt + $bzd != 100) {
                            MessageShow::set('Сумма процентов покрытия не равняется 100', 1);
                            MessageShow::get();
                        }
                        else {

                        $this->db("INSERT INTO `statdata` VALUES (NULL, " . $dist . ", '" . $time . "', '" . $ts . "', " . $avgspd . ", " . $maxspd . ", " . $avgpls . ", " . $maxpls . ", '" . $tire . "', '" . $date . "', " . $asf . ", " . $tvp . ", " . $grnt . ", " . $bzd . ", '" . $name . "', '" . $teh . "', '" . $temp . "', " . $_SESSION['USER_ID'] . ");");
                        MessageShow::set('Статистика успешно добавлена', 3);
                        $this->Reload();
                        }
                    }

                }
            }
        };

    }

    private function delCell() {
        if (isset($_POST['deltire'])) {
            $deltire = static::PostSecure($_POST['deltire']);
            $this->db("DELETE FROM `tire` WHERE `id` =".$deltire.";");
            MessageShow::set('Данные удалены!', 2);
            $this->Reload();
        };
        if (isset($_POST['delts'])) {
            $delts = static::PostSecure($_POST['delts']);
            $this->db("DELETE FROM `ts` WHERE `id` =".$delts.";");
            MessageShow::set('Данные удалены!', 2);
            $this->Reload();
        };
        if (isset($_POST['delodo'])) {
            $delodo = static::PostSecure($_POST['delodo']);
            $this->db("DELETE FROM `yeardata` WHERE `id` =".$delodo.";");
            MessageShow::set('Данные удалены!', 2);
            $this->Reload();
        };


    }



}