<?php


function ShowContent() {

    $ps = new Home;

	echo '
	
	<br>
	<div class="container">
	
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		
		<h2 align="center">Присоединяйся !</h2>
		<br>
				<h4><ul>
				<li>Создай аккаунт</li> 
				<li>Документируй поездки;</li>
				<li>Наматывай километраж;</li>
				<li>Cледи за железом с помощью технического дневника;</li>
				<li>Отмечай интересные места на карте;</li>
				<li>Делись с друзьями достижениями;</li>
				<li>Флуди в чатике;</li>
				<li>Наглядная статистика, поможет планировать тренировки.</li>
			</ul></h4>
			<br>
				<h4 align="center">Активные пользователи:</h4>	
			<br>
				<div class="datatable">
			';

		$ps->getUsers();

			echo '
				</div>
		</div>	
	
	
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
    
  		<div class="carousel-inner" role="listbox">
    		<div class="item active">
      			<img src="/img/foto1.jpg">
    		</div>

    		<div class="item">
      			<img src="/img/foto2.jpg">
    		</div>

		    <div class="item">
      			<img src="/img/foto3.jpg">
    		</div>

    		<div class="item">
      			<img src="/img/foto4.jpg">
    		</div>
  		</div>
		</div>
		
		
		</div>

	</div>
	
	';
};

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';

?>

