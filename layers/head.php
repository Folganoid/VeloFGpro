<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/angular.min.js"></script>

		<title>VeloFG</title>
	</head>

	<body>


    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">VeloFG</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/statistic">Статистика</a></li>
                    <li><a href="/chat">Чат</a></li>
                    <li><a href="/map">Карта</a></li>
                    <li><a href="/items">Инвентарь</a></li>
                </ul>
                <form class="navbar-form navbar-right" name="auth" action="index.php" method="post">
                    <div class="form-group">
                        <span class="txtWhite">Вы вошли как </span>
                        <span class="txtWhite" id="lineUpLog"><?php echo Login::LoginShow(); ?></span>
                            <?php View::MenuShow() ?>
                        <input name="id_form" type="hidden" value="auth"></input>
                    </div>
                </form>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

            <?php MessageShow::get(); ?>

	<div class="container">		
			<?php ShowContent(); ?>
	</div>