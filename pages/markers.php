<?php
/**
 * Created by PhpStorm.
 * User: fg
 * Date: 07.03.17
 * Time: 23:47
 */

if (isset($_SESSION['USER_ID'])) {
    new Markers(Route::$url_parts[1], $_SESSION['USER_ID']);
    function ShowContent()
    {

        echo '<h2 align="center">Редактировать маркер</h2>';

        $mark = new Stat();
        $mark->db('SELECT * FROM markers WHERE id = "' . Route::$url_parts[1] . '";');

        if (!isset($mark->result[0])) {
            MessageShow::set('Данные не найдены', 1);
            MessageShow::get();
            exit();
        } else if ($_SESSION['USER_ID'] != $mark->result[0]['userid']) {
            MessageShow::set('Нет доступа', 1);
            MessageShow::get();
            exit();
        } else {

            echo '
        
            <FORM method="post" action="" NAME="mark">
                <TABLE>
              <TR><TD>Наменование<span class="colordarkred">*</span>: </TD>
                    <TD><input name="markname" value="' . $mark->result[0]['name'] . '" SIZE="25" maxlength="30" required></input></TD>
              </TR>
              <TR><TD>Описание: </TD>
                    <TD><input name="marksubname" value="' . $mark->result[0]['subname'] . '" SIZE="25" maxlength="100"></input></TD>
               </TR>
               <TR><TD>Координаты<span class="colordarkred">*</span>: </TD>
                    <TD><input name="markx" value="' . $mark->result[0]['x'] . '" SIZE="10" maxlength="15" pattern="\d{1,2}(\.\d+)?" required></input>, <input name="marky" value="' . $mark->result[0]['y'] . '" SIZE="10" maxlength="15" pattern="\d{1,2}(\.\d+)?" required></input></TD>
               </TR>
              <TR><TD>Ссылка: </TD>
                    <TD><input name="marklink" value="' . $mark->result[0]['link'] . '" SIZE="30" placeholder="http://"></input></TD>
               </TR>
               <TR><TD>Цвет<span class="colordarkred">*</span>: </TD>
                    <TD><select name="markcolor" required>
                <option style="color: black;" value="black">Черный</option>
                <option style="color: red;" value="red">Красный</option>
                <option style="color: blue;" value="blue">Синий</option>
                <option style="color: purple;" value="purple">Пурпурный</option>
                <option style="color: green;" value="green">Зеленый</option>
                <option style="color: orange;" value="orange">Оранжевый</option>
                <option style="color: grey;" value="grey">Серый</option>
                </select></td></TD>
               </TR>
               
        </TABLE>
            <div>
            <br>
            	<input name="id_form" type="hidden" value="mark"></input>
    			<INPUT TYPE="submit"  name="enter" VALUE="Изменить данные"></input> 

    		</div>
        </FORM>
        ';
        }
    }
}
else {
    function ShowContent(){
        echo '<h2 align="center">Редактировать маркер</h2>';
    };
    MessageShow::set('Нет доступа', 1);
    MessageShow::get();
}

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>
