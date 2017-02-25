<?php

function ShowContent() {

    $statNum = new Stat();
    $statNum->db('SELECT * FROM statdata WHERE id = "'.Route::$url_parts[1].'";');

    if (!isset($statNum->result[0])) {
        MessageShow::set('Данные не найдены', 1);
        MessageShow::get();
        exit();
    }

    if(isset($_SESSION['USER_ID'])) $igUsr = $_SESSION['USER_ID'];
    else $igUsr = 0;

    $nameUser = new Stat();
    $nameUser->db('SELECT `login` FROM users WHERE id = "'.$statNum->result[0]['userid'].'";');

    echo '

    <style>
        input {
            font-size: 10px;
            margin: 0;
        }
    </style>


    <form method="post" action="" id="change" NAME="change">
        <div class="row">
        <h2 align="center">Расширенная статистика <b>'.$nameUser->result[0]['login'].'</b></h2>
        <h2 align="center"><b class="colordarkblue">'.$statNum->result[0]['date'].'</b><input name="date" class="hided hidedon" size="10" value="'.$statNum->result[0]['date'].'" required></input></h2>
        <h3 align="center">'.$statNum->result[0]['prim'].'<input name="prim" class="hided hidedon" value="'.$statNum->result[0]['prim'].'" required></input></h3>
        <table width="100%">
            <tr>
                <td><h3><b>'.$statNum->result[0]['bike'].'</b><input name="bike" class="hided hidedon" value="'.$statNum->result[0]['bike'].'" required></input></h3></td>
                <td class="'.(($statNum->result[0]['userid'] != $igUsr) ? 'hide': '').'" align="right">
                    <input name="change" class="hided hidedon" type="submit" value="Подтвердить изменение"></input>
                    <b class="hided hidedon" id="butcanc">Отмена</b>
                    <b id="butchng">Изменить </b><br>
                    <input class="hide" name="delete" id="butdel" type="submit" value="Подтвердите удаление записи!"></input>
                    <b id="butdel2">Удалить</b> <b class="hide" id="butdel3">Отмена</b>
                </td>
            </tr>
        </table>
        <div class="otboynik"></div>
        <br>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <table class="tablestatenhance">
            <tr class="colordarkred"><td>Дистанция</td><td>-</td><td align="right">'.$statNum->result[0]['dist'].'км <input name="dist" class="hided hidedon" size="10" value="'.$statNum->result[0]['dist'].'" pattern="\d+(\.\d{1,2})?" required></input></td></tr>
            <tr class="colordarkblue"><td>Время в движении</td><td>-</td><td align="right">'.$statNum->result[0]['time'].' <input name="time" class="hided hidedon" size="10" value="'.$statNum->result[0]['time'].'" pattern="\d+:[0-5][0-9]:[0-5][0-9]" required></input></td></tr>
            <tr><td>Средняя скорость</td><td>-</td><td align="right">'.$statNum->result[0]['avgspd'].'км/ч <input name="avgspd" class="hided hidedon" size="10" value="'.$statNum->result[0]['avgspd'].'" pattern="\d+(\.\d{1,2})?" required></input></td></tr>
            <tr><td>Максимальная скорость</td><td>-</td><td align="right">'.$statNum->result[0]['maxspd'].'км/ч <input name="maxspd" class="hided hidedon" size="10" value="'.$statNum->result[0]['maxspd'].'" pattern="\d+(\.\d{1,2})?" required></input></td></tr>
            <tr class="colorpurple"><td>Средний пульс</td><td>-</td><td align="right">'.$statNum->result[0]['avgpls'].'уд/мин <input name="avgpls" class="hided hidedon" size="10" value="'.$statNum->result[0]['avgpls'].'" maxlength="3" pattern="[0-9]{1,3}" required></input></td></tr>
            <tr class="colorpurple"><td>Максимальный пульс</td><td>-</td><td align="right">'.$statNum->result[0]['maxpls'].'уд/мин <input name="maxpls" class="hided hidedon" size="10" value="'.$statNum->result[0]['maxpls'].'" maxlength="3" pattern="[0-9]{1,3}" required></input></td></tr>
            <tr><td>Забортная температура</td><td>-</td><td align="right">'.$statNum->result[0]['temp'].'°С <input name="temp" class="hided hidedon" size="10" value="'.$statNum->result[0]['temp'].'" maxlength="10" required></input></td></tr>
        </table>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h4 class="colorblack">Дорожное покрытие:</h4>
        <table  class="tablestatenhance">
            <tr><td>Асфальт</td><td>-</td><td align="right">'.$statNum->result[0]['surfasf'].'% <input name="surfasf" class="hided hidedon" size="10" value="'.$statNum->result[0]['surfasf'].'" maxlength="3" pattern="[0-9]{1,3}" required></input></td></tr>
            <tr><td>Твердое покрытие</td><td>-</td><td align="right">'.$statNum->result[0]['surftvp'].'% <input name="surftvp" class="hided hidedon" size="10" value="'.$statNum->result[0]['surftvp'].'" maxlength="3" pattern="[0-9]{1,3}" required></input></td></tr>
            <tr><td>Грунт</td><td>-</td><td align="right">'.$statNum->result[0]['surfgrn'].'% <input name="surfgrnt" class="hided hidedon" size="10" value="'.$statNum->result[0]['surfgrn'].'" maxlength="3" pattern="[0-9]{1,3}" required></input></td></tr>
            <tr><td>Бездорожье</td><td>-</td><td align="right">'.$statNum->result[0]['srfbzd'].'% <input name="surfbzd" class="hided hidedon" size="10" value="'.$statNum->result[0]['srfbzd'].'" maxlength="3" pattern="[0-9]{1,3}" required></input></td></tr>
        </table>
        </div>
        <br>
        </div>
        <div class="otboynik"></div>
            <br>
        <div class="row">
        <h4>Резина - '.$statNum->result[0]['tires'].'<input name="tires" class="hided hidedon" value="'.$statNum->result[0]['tires'].'"></input></h4>
        <h4>Технические заметки - '.$statNum->result[0]['teh'].'</h4>
        <input name="teh" class="hided hidedon" size="40" value="'.$statNum->result[0]['teh'].'"></input>
        </div>
                
    </form>
        </div>
<script src="/js/statenhance.js"></script>
        
    ';

    new StatDataChange($statNum->result[0]['userid'], ($_SESSION['USER_ID'] ?? 0), $statNum->result[0]['id']);
};

//if(isset($_SESSION['USER_ID'])) {}


include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;


?>