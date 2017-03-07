<?php

if (isset($_SESSION['USER_ID'])) {
    new Data($_SESSION['USER_ID']);

    function ShowContent()
    {
        echo '

    <script src="/js/data.js"></script>

	<h2 align="center">Управление данными</h2>
	
	<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
	
	<FORM method="post" action="" id="form1" NAME="form1">
    <h3 align="center">ДОБАВИТЬ РАСШИРЕННУЮ СТАТИСТИКУ </h3>
    <TABLE>
        <TR><TD>Транспортное средство<span class="colordarkred">*</span>: </TD>
            <TD><select id="form1ts" name="form1ts">';
        Data::getOptionTs();
        echo '
                </select>
            </TD>
        </TR>
        <TR><TD class="colordarkblue">Дата<span class="colordarkred">*</span>:</TD>
            <TD>
            <INPUT id="form1day" name="form1day" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" required>:
            <select id="form1month" name="form1month" required>
                <option id="form1m0" value="0">Январь</option>
                <option id="form1m1" value="1">Февраль</option>
                <option id="form1m2" value="2">Март</option>
                <option id="form1m3" value="3">Апрель</option>
                <option id="form1m4" value="4">Май</option>
                <option id="form1m5" value="5">Июнь</option>
                <option id="form1m6" value="6">Июль</option>
                <option id="form1m7" value="7">Август</option>
                <option id="form1m8" value="8">Сентябрь</option>
                <option id="form1m9" value="9">Октябрь</option>
                <option id="form1m10" value="10">Ноябрь</option>
                <option id="form1m11" value="11">Декабрь</option>
            </select>:
            <INPUT id="form1year" name="form1year" SIZE=4 maxlength="4" pattern="[0-9]{4}" value="" required>
            </TD>
        </TR>
        <TR><TD>Описание<span class="colordarkred">*</span>:</TD>
             <TD><INPUT name="form1name" SIZE="25" maxlength="50" required></TD></TR>
        <TR><TD class="colordarkred">Дистанция<span class="colordarkred">*</span>:</TD>
            <TD><INPUT id="form1dist" name="form1dist" size=6 maxlength="6" pattern="\d+(\.\d{1,2})?" placeholder="0.00" required>км</TD></TR>
        <TR><TD class="colordarkblue">Время<span class="colordarkred">*</span>:</TD>
            <TD><INPUT id="form1hr" name="form1hr" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" placeholder="00" required>ч <INPUT id="form1min" name="form1min" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" placeholder="00" required>мин <INPUT id="form1sec" name="form1sec" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" placeholder="00" required>сек</TD></TR>
        <TR><TD>Средняя скорость<span class="colordarkred">*</span>:</TD>
            <TD><INPUT id="form1avgspd" name="form1avgspd" SIZE=5 maxlength="6" pattern="\d+(\.\d{1,2})?" placeholder="0.00" required>км/ч</TD></TR>
        <TR><TD>Макс.скорость:</TD>
            <TD><INPUT name="form1maxspd" SIZE=5 maxlength="6" pattern="\d+(\.\d{1,2})?" placeholder="0.00">км/ч</TD></TR>
        <TR><TD class="colorpurple">Средний пульс:</TD>
            <TD><INPUT name="form1avgpls" SIZE=3 maxlength="3" pattern="[0-9]{0,3}" placeholder="0">уд/мин</TD></TR>
        <TR><TD class="colorpurple">Макс.пульс:</TD>
            <TD><INPUT name="form1maxpls" SIZE=3 maxlength="3" pattern="[0-9]{0,3}" placeholder="0">уд/мин</TD></TR>
        <TR><TD>Температура<span class="colordarkred">*</span>:</TD>
            <TD><INPUT name="form1temp" SIZE=7 maxlength="10" placeholder="+1...+10" required>&#186;C</TD></TR>
        <TR><TD>Асфальт<span class="colordarkred">*</span>:</TD>
            <TD><INPUT id="form1asf" name="form1asf" SIZE=3 maxlength="3" pattern="[0-9]{1,3}">%</TD></TR>
        <TR><TD>Твердое покрытие<span class="colordarkred">*</span>:</TD>
            <TD><INPUT id="form1tvp" name="form1tvp" SIZE=3 maxlength="3" pattern="[0-9]{1,3}">%</TD></TR>
        <TR><TD>Грунт<span class="colordarkred">*</span>:</TD>
            <TD><INPUT id="form1grnt" name="form1grnt" SIZE=3 maxlength="3" pattern="[0-9]{1,3}">%</TD></TR>
        <TR><TD>Бездорожье<span class="colordarkred">*</span>:</TD>
            <TD><INPUT id="form1bzd" name="form1bzd" SIZE=3 maxlength="3" pattern="[0-9]{1,3}">% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b id="sumsrf"></b></TD></TR>
        <TR><TD>Резина:</TD>
            <TD><select name="form1tire">';
        Data::getOptionTires();
        echo '
                </select>
            </TD>
        </TR>
        <TR><TD>Технические примечания: </TD>
            <TD><input name="form1content" size="25" maxlength="256"></input></TD></TR>
    </TABLE>
       <!-- Кнопки готовности и сброса -->
    <div>
    <input name="id_form" type="hidden" value="form1"></input>
    <INPUT TYPE="submit" name="enter" VALUE="добавить"></input> 
    <INPUT TYPE="reset" VALUE="Сброс"></input>
    </div>
  </FORM>
  <p><b><span class="colordarkred">*</span> - Обязательно к заполнению.</b></p>
  
  <div class="otboynik"></div>
  
          <br>
            <div class="row">
       		<h4 align="center">ДОБАВИТЬ МАРКЕР НА КАРТУ</h4>
       		<FORM method="post" action="/data" NAME="form5">
       		<table>
       		    <tr><td>Наименование<span class="colordarkred">*</span>:</td>
       		    <td><INPUT name="form5name" SIZE="25" maxlength="30" required></INPUT></td></tr>   		
       		    <tr><td>Описание:</td>
       		    <td><INPUT name="form5subname" SIZE="25" maxlength="100"></INPUT></td></tr>
                <tr><td>Координаты<span class="colordarkred">*</span>:</td>
       		    <td><INPUT name="form5x" SIZE="10" maxlength="15" pattern="\d{1,2}(\.\d+)?"required></INPUT>, <INPUT name="form5y" SIZE="10" maxlength="15" pattern="\d{1,2}(\.\d+)?" required></INPUT></td></tr>
                <tr><td>Ссылка на внешний ресурс:</td>
       		    <td><INPUT name="form5link" SIZE="30" placeholder="http://"></INPUT></td></tr>
                <tr><td>Цвет маркера<span class="colordarkred">*</span>:</td>
       		    <td><select name="form5color" required>
                <option style="color: black;" value="black">Черный</option>
                <option style="color: red;" value="red">Красный</option>
                <option style="color: blue;" value="blue">Синий</option>
                <option style="color: purple;" value="purple">Пурпурный</option>
                <option style="color: green;" value="green">Зеленый</option>
                <option style="color: orange;" value="orange">Оранжевый</option>
                <option style="color: grey;" value="grey">Серый</option>
                </select></td></tr>
       		</table>
       		        <input name="id_form" type="hidden" value="form5"></input>
    				<INPUT TYPE="submit" name="enter" VALUE="Добавить"></input> 
    				<INPUT TYPE="reset" VALUE="Сброс"></input>
			</FORM>
            <div class="datatable">
			<table align="left">';
        Data::getMarkers();
        echo '
		</table>
		</div>
		<div class="otboynik"></div>
		</div>
  
  </div>
  
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
	<div class="row">
    <h3 align="center">ДОБАВИТЬ ГОДОВОЙ НАКАТ</h3>
	<FORM method="post" action="/data" id="form2" NAME="form2">
    <TABLE>
        <TR><TD>Транспортное средство<span class="colordarkred">*</span>: </TD>
            <TD><select name="form2ts">';
        Data::getOptionTs();
        echo '
                </select>
            </TD>
        </TR>
        <TR><TD><b class="colordarkblue">Год<span class="colordarkred">*</span></b> / <b class="colordarkred">Дистанция<span class="colordarkred">*</span></b></TD>
            <TD><INPUT name="form2year" SIZE=4 maxlength="4" pattern="[0-9]{4}" placeholder="год" required> / <INPUT name="form2dist" size=8 maxlength="8" pattern="\d+(\.\d{2})?" placeholder="0.00" required>км</TD></TR>
        </TABLE>
            <div>
            	<input name="id_form" type="hidden" value="form2"></input>
    			<INPUT TYPE="submit"  name="enter" VALUE="Добавить"></input> 
    			<INPUT TYPE="reset" VALUE="Сброс"></input>
    		</div>
        </FORM>	
        <div class="datatable">
        <table align="left">';
        Data::getOdo();
        echo '
		</table>
		</div>
		<div class="otboynik"></div>
		</div>
        <br>
            <div class="row">
       		<h4>ДОБАВИТЬ ТС</h4>
       		<FORM method="post" action="/data" NAME="form3">
       		<INPUT name="form3ts" SIZE="25" maxlength="50" required></INPUT>
       		        <input name="id_form" type="hidden" value="form3"></input>
    				<INPUT TYPE="submit" name="enter" VALUE="Добавить"></input> 
    				<INPUT TYPE="reset" VALUE="Сброс"></input>

			</FORM>
            <div class="datatable">
			<table align="left">';
        Data::getTs();
        echo '
		</table>
		</div>
		<div class="otboynik"></div>
		</div>
		<br>
		<div class="row">
       		<h4>ДОБАВИТЬ РЕЗИНУ</h4>
       		<FORM method="post" action="/data" NAME="form4">
       		<INPUT name="form4tire" SIZE="25" maxlength="50" required></INPUT>
       		        <input name="id_form" type="hidden" value="form4"></input>
    				<INPUT TYPE="submit" name="enter" VALUE="Добавить"></input> 
    				<INPUT TYPE="reset" VALUE="Сброс"></input>
			</FORM>
            <div class="datatable">
			<table align="left">';
        Data::getTires();
        echo '
		</table>
		</div>
		<div class="otboynik"></div>
        </div>
        
	
	</div>
  
  
  </div>
  
<script>fillCells();</script>

	';
    };
}
else {
    function ShowContent()
    {
        echo '<h2 align="center">Управление данными</h2>';
			MessageShow::set("Только зарегистрированные пользователи, могут управлять данными", 1);
        	MessageShow::get();
	};
};

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';

?>


