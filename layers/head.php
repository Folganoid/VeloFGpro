<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery-2.2.2.js"></script>
    <script src="/js/common.js"></script>

		<title>PHP test</title>
	</head>

	<body>
		<div class="container authLine">
				<div class="col-xs-12 col-md-6 menuCenter txtWhite">
					<a href="/">Главная</a> |
					<a href="/statistic">Статистика</a> | 
					<a href="/chat">Чат</a> |
					<a href="/map">Карта</a> |
					<a href="/items">Инвентарь</a> |
				</div>

		 		<form style="text-align: right;" class="col-xs-12 col-md-6" name="auth" action="index.php" method="post">
		 			<span>Вы вошли как </span><span id="lineUpLog"><?php echo Login::LoginShow(); ?></span>
					<?php View::MenuShow() ?>
					<input name="id_form" type="hidden" value="auth"></input>
				</form>
		
		</div>
            <?php MessageShow::get(); ?>
		<br>
			<br>

<div class="container">
	<div class="row">
  		<div class="col-xs-12 col-md-8">.col-xs-12 .col-md-8</div>
  		<div class="col-xs-12 col-md-4">.col-xs-6 .col-md-4</div>
	</div>
</div>
	
	<div class="container">		
			<?php ShowContent(); ?>
	</div>