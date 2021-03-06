<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/img/f.ico" type="image/x-icon">
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
                <a class="navbar-brand" href="/"><img src="/img/velo.png" /></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php if (isset($_SESSION['USER_LOGIN'])) echo '/statistic'.'/'.$_SESSION['USER_LOGIN']; else echo '/statistic' ?>">Статистика</a></li>
                    <li><a href="/chat">Чат</a></li>
                    <li><a href="<?php if (isset($_SESSION['USER_LOGIN'])) echo '/map'.'/'.$_SESSION['USER_LOGIN']; else echo '/map' ?>">Карта</a></li>
                    <li><a href="/data">Данные</a></li>
                </ul>
                <form class="navbar-form navbar-right" name="auth" action="" method="post">
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
        <h2>&nbsp;</h2>
			<?php ShowContent(); ?>
	</div>