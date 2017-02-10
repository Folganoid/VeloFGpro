<?php

function ShowContent() {
	echo '
	
	<h2 align="center">Управление данными</h2>
	
	<FORM method="post" action="" id="form1" NAME="form1">

    <h3 align="center">ДОБАВИТЬ В БД</h3>
    <TABLE>
        <TR><TD>Пароль:</TD>
            <TD><INPUT TYPE="password" id="formpass" SIZE=10 maxlength="10"></TD></TR>
        <TR style="color: #610B0B;"><TD>Велосипед:</TD>
            <TD><select id="formbike">
                  <option ng-repeat="itm in jsonData[0]" value="{{itm}}">{{itm}}</option>
                </select>
            </TD>
        </TR>
        <TR style="color: #0B0B61;"><TD>Дата:</TD>
            <TD><INPUT id="formday" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="{{curDay}}">:<INPUT id="formmonth" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="{{curMonth}}">:<INPUT id="formyear" SIZE=4 maxlength="4" pattern="[0-9]{4}" value="{{curYear}}"></TD></TR>
        <TR><TD>Описание:</TD>
             <TD><TEXTAREA id="formname" ROWS=2 COLS=30></TEXTAREA></TD></TR>
        <TR><TD>Дистанция:</TD>
            <TD><INPUT id="formdist" size=6 maxlength="6" pattern="\d+(\.\d{2})?" value="0.00">км</TD></TR>
        <TR style="color: #0B0B61;"><TD>Время:</TD>
            <TD><INPUT id="formhr" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="00">ч <INPUT id="formmin" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="00">мин <INPUT id="formsec" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="00">сек</TD></TR>
        <TR><TD>Средняя скорость:</TD>
            <TD><INPUT id="formavgspd" onclick="avgSpdIn()" SIZE=5 maxlength="6" pattern="\d+(\.\d{2})?" value="0.00">км/ч</TD></TR>
        <TR><TD>Макс.скорость:</TD>
            <TD><INPUT id="formmaxspd" SIZE=5 maxlength="6" pattern="\d+(\.\d{2})?" value="0.00">км/ч</TD></TR>
        <TR style="color: #4C0B5F;"><TD>Средний пульс:</TD>
            <TD><INPUT id="formavgpls" SIZE=3 maxlength="3" pattern="[0-9]{2,3}" value="0">уд/мин</TD></TR>
        <TR style="color: #4C0B5F;"><TD>Макс.пульс:</TD>
            <TD><INPUT id="formmaxpls" SIZE=3 maxlength="3" pattern="[0-9]{2,3}" value="0">уд/мин</TD></TR>
        <TR style="color: #0B3B17;"><TD>Температура:</TD>
            <TD><INPUT id="formtemp" SIZE=7 maxlength="10" value="+1...+10">&#186;C</TD></TR>
        <TR><TD>Асфальт:</TD>
            <TD><INPUT id="formasf" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">%</TD></TR>
        <TR><TD>Твердое покрытие:</TD>
            <TD><INPUT id="formtvp" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">%</TD></TR>
        <TR><TD>Грунт:</TD>
            <TD><INPUT id="formgrnt" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">%</TD></TR>
        <TR><TD>Бездорожье:</TD>
            <TD><INPUT id="formbzd" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b id="sumsrf"></b></TD></TR>
        <TR style="color: #610B0B;"><TD>Покрышки:</TD>
            <TD><select id="formtires">
                  <option ng-repeat="item in jsonData[2]" value="{{item}}">{{item}}</option>
                </select>
            </TD>
        </TR>
        <TR><TD>Технические примечания:</TD>
            <TD><TEXTAREA id="formcontent" ROWS=2 COLS=30></TEXTAREA></TD></TR>
    </TABLE>
       <!-- Кнопки готовности и сброса -->
    <div>
    <INPUT TYPE="button" VALUE="Готово" onClick="complete();"></input> 
    <INPUT TYPE="reset" VALUE="Сброс"></input>
    </div>
  </FORM>
		

	';
};

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


