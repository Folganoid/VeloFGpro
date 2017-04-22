<?php
new Chat;

function ShowContent() {

	echo '<h2 align="center">Чат</h2><div class="container chat">

	<br>
	<FORM method="post" action="" NAME="formchat">
		<INPUT name="text" placeholder="Введите текст..." SIZE=40 maxlength="256" />
		
		    <input name="id_form" type="hidden" value="formchat"></input>
		    <INPUT TYPE="submit" name="enter" VALUE="Отправить"></input>
		    <INPUT TYPE="submit" name="refresh" VALUE="Обновить"></input>
	</FORM>
	<br>
';

    Chat::showContent();

    echo '

	</div>
	<br>
	
	';
};

if(isset($_SESSION['USER_LOGIN'])) {

}



include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


