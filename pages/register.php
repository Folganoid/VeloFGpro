<?php

function ShowContent() {
	echo '
	
	<h2 align="center">Регистрация</h2>
		<br>
			<div align="center">
				<form name="reg" action="/register" method="post">
					<table>
						<tr>
							<td><input size="15" placeholder="name" name="name" pattern="[A-za-z0-9А-Яа-я]{3,15}" title="3-15 букв или цифр" required></input></td>
							<td> - введите свое имя</td>
						</tr>
						<tr>
							<td><input size="15" placeholder="login" name="login" pattern="[A-za-z-0-9]{3,15}" title="3-15 латинских букв или цифр" required></input></td>
							<td> - введите логин</td>
						</tr>
						<tr>
							<td><input size="15" placeholder="pass" name="pass1" pattern="[A-za-z-0-9]{5,15}" type="password" title="5-15 латинских букв или цифр" required></input></td>
							<td> - введите пароль</td>
						</tr>						
						<tr>
							<td><input size="15" placeholder="confirm pass" name="pass2" pattern="[A-za-z-0-9]{5,15}" type="password" title="5-15 латинских букв или цифр" required></input></td>
							<td> - подтвердите пароль</td>
						</tr>
						<tr>
							<td><input size="20" type="email" placeholder="email" name="email" required></input></td>
							<td> - введите эл.почту</td>
						</tr>					
					</table>
						<br>
							<input name="enter" type="submit" value="отправить"></input>
							<input type="reset" value="сбросить"></input>
							<input name="id_form" type="hidden" value="reg"></input>

				</form>
			
			</div>

	';
};

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


