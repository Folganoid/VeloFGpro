<?php

if (isset($_SESSION['USER_ID'])) {
    new Data($_SESSION['USER_ID']);

    function ShowContent()
    {
        echo '

	<h2 align="center">Управление данными</h2>
	
	<div class="container">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	
	<FORM method="post" action="" id="form1" NAME="form1">
    <h3 align="center">ДОБАВИТЬ РАСШИРЕННУЮ СТАТИСТИКУ </h3>
    <TABLE>
        <TR><TD>Транспортное средство: </TD>
            <TD><select id="form1ts" name="form1ts">';
        Data::getOptionTs();
        echo '
                </select>
            </TD>
        </TR>
        <TR><TD>Дата:</TD>
            <TD><INPUT id="form1day" name="form1day" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="">:<INPUT id="form1month" name="form1month" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="">:<INPUT id="form1year" name="form1year" SIZE=4 maxlength="4" pattern="[0-9]{4}" value=""></TD></TR>
        <TR><TD>Описание:</TD>
             <TD><TEXTAREA name="form1name" ROWS=2 COLS=30></TEXTAREA></TD></TR>
        <TR><TD>Дистанция:</TD>
            <TD><INPUT name="form1dist" size=6 maxlength="6" pattern="\d+(\.\d{2})?" value="0.00">км</TD></TR>
        <TR><TD>Время:</TD>
            <TD><INPUT id="form1hr" name="form1hr" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="00">ч <INPUT id="form1min" name="form1min" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="00">мин <INPUT id="form1sec" name="form1sec" SIZE=2 maxlength="2" pattern="[0-9]{1,2}" value="00">сек</TD></TR>
        <TR><TD>Средняя скорость:</TD>
            <TD><INPUT name="form1avgspd" SIZE=5 maxlength="6" pattern="\d+(\.\d{2})?" value="0.00">км/ч</TD></TR>
        <TR><TD>Макс.скорость:</TD>
            <TD><INPUT name="form1maxspd" SIZE=5 maxlength="6" pattern="\d+(\.\d{2})?" value="0.00">км/ч</TD></TR>
        <TR><TD>Средний пульс:</TD>
            <TD><INPUT name="form1avgpls" SIZE=3 maxlength="3" pattern="[0-9]{2,3}" value="0">уд/мин</TD></TR>
        <TR><TD>Макс.пульс:</TD>
            <TD><INPUT name="form1maxpls" SIZE=3 maxlength="3" pattern="[0-9]{2,3}" value="0">уд/мин</TD></TR>
        <TR><TD>Температура:</TD>
            <TD><INPUT name="form1temp" SIZE=7 maxlength="10" value="+1...+10">&#186;C</TD></TR>
        <TR><TD>Асфальт:</TD>
            <TD><INPUT id="form1asf" name="form1asf" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">%</TD></TR>
        <TR><TD>Твердое покрытие:</TD>
            <TD><INPUT id="form1tvp" name="form1tvp" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">%</TD></TR>
        <TR><TD>Грунт:</TD>
            <TD><INPUT id="form1grnt" name="form1grnt" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">%</TD></TR>
        <TR><TD>Бездорожье:</TD>
            <TD><INPUT id="form1bzd" name="form1bzd" SIZE=3 maxlength="3" pattern="[0-9]{1,3}" value="0">% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b id="sumsrf"></b></TD></TR>
        <TR><TD>Резина:</TD>
            <TD><select name="form1tires">';
        Data::getOptionTires();
        echo '
                </select>
            </TD>
        </TR>
        <TR><TD>Технические примечания: </TD>
            <TD><TEXTAREA name="form1content" ROWS=2 COLS=30></TEXTAREA></TD></TR>
    </TABLE>
       <!-- Кнопки готовности и сброса -->
    <div>
    <input name="id_form" type="hidden" value="form1"></input>
    <INPUT TYPE="submit" name="enter" VALUE="добавить"></input> 
    <INPUT TYPE="reset" VALUE="Сброс"></input>
    </div>
  </FORM>
  
  </div>
  
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<div class="row">
	<FORM method="post" action="/data" id="form2" NAME="form2">
    <h3 align="center">ДОБАВИТЬ ГОДОВОЙ НАКАТ</h3>
    <TABLE>
        <TR><TD>Транспортное средство: </TD>
            <TD><select name="form2ts">';
        Data::getOptionTs();
        echo '
                </select>
            </TD>
        </TR>
        <TR><TD><b class="colordarkblue">Год</b> / <b class="colordarkred">Дистанция</b></TD>
            <TD><INPUT name="form2year" SIZE=4 maxlength="4" pattern="[0-9]{4}" placeholder="год"> / <INPUT name="form2dist" size=8 maxlength="8" pattern="\d+(\.\d{2})?" placeholder="0.00км"></TD></TR>
        </TABLE>
            <div>
            	<input name="id_form" type="hidden" value="form2"></input>
    			<INPUT TYPE="submit"  name="enter" VALUE="Добавить"></input> 
    			<INPUT TYPE="reset" VALUE="Сброс"></input>
    		</div>
        </FORM>	
        <br>
        <div class="datatable">
        <table align="left">';
        Data::getOdo();
        echo '
		</table>
		</div>
		</div>
        <br>
            <div class="row">
       		<h4>ДОБАВИТЬ ТС</h4>
       		<FORM method="post" action="/data" NAME="form3">
       		<INPUT name="form3ts" SIZE="20"></INPUT>
       		        <input name="id_form" type="hidden" value="form3"></input>
    				<INPUT TYPE="submit" name="enter" VALUE="Добавить"></input> 
    				<INPUT TYPE="reset" VALUE="Сброс"></input>

			</FORM>
			<br>
            <div class="datatable">
			<table align="left">';
        Data::getTs();
        echo '
		</table>
		</div>
		</div>
		<br>
		<div class="row">
       		<h4>ДОБАВИТЬ РЕЗИНУ</h4>
       		<FORM method="post" action="/data" NAME="form4">
       		<INPUT name="form4tire" SIZE="20"></INPUT>
       		        <input name="id_form" type="hidden" value="form4"></input>
    				<INPUT TYPE="submit" name="enter" VALUE="Добавить"></input> 
    				<INPUT TYPE="reset" VALUE="Сброс"></input>
			</FORM>
			<br>
            <div class="datatable">
			<table align="left">';
        Data::getTires();
        echo '
		</table>
		</div>
        </div>
        
	
	</div>
  
  
  </div>
  
		

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


