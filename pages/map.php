<?php

if(isset(Route::$url_parts[1])) {

	function ShowContent()
	{
    	echo '

			<h2 align="center">Карта ' . Route::$url_parts[1] . '</h2>
			<div class="littlestat"><b>Посмотреть чужую карту: </b>
			<input id="enteruserstat" size="8" placeholder="login" pattern="[A-za-z-0-9]{3,15}"></input>
            <button id="butuserstat"> Перейти </button>
            </div>
            <script>$(\'#butuserstat\').click(function(){
              document.location.href = "/map/" + $(\'#enteruserstat\').val();
            });</script>
			';

    		$statID = new Stat();
    		$statID->db('SELECT id FROM users WHERE login = "'.Route::$url_parts[1].'";');

    	if (!isset($statID->result[0])) {
        	MessageShow::set('Пользователь не найден', 1);
        	MessageShow::get();
        	exit();
    	}

    	$mapStat = new Stat();
	   	$mapStat->db('SELECT * FROM markers WHERE userid = ' . $statID->result[0][0]);

        ?>
		<script>
            var mapData = JSON.parse('<?php echo GetJSONfromArray::ArrToJson($mapStat->result); ?>');
		</script>

        <?php

        echo '
        <div id="map"></div>
        <script src="/js/map.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEF7mhKBOcKf3DOomC3CPSq8htToAlZ84&callback=initMap" async defer></script>
        
        <div id="map_info" class="hide">
        <dd><b id="map_name"></b></dd>
        <dd>Примечание: <span id="map_notice"></span></dd>
        <dd>Координаты: <span class="colordarkred" id="map_cord"></span></dd>
        <dd>Ссылка: <a id="map_link" href="#">Перейти...</a></dd>
        </div>
                
        ';

    	/*
    	 * for Yandex Map API
    	 *
    	 * echo '
			<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
			<script src="/js/map.js"></script>

			<div id="map" style=""></div>
			<script>$("#map").attr("style", "width: 100%; height: " + (+window.innerHeight - 200) + "px");</script>
		';*/

        }
    }

else {

    MessageShow::set('Введите логин пользователя, для просмотра карты.', 2);
    function ShowContent()
    {
        echo '<h2 align="center">Карта</h2> 
                <div align="center"><b>Введите логин пользователя: </b><input id="enteruserstat" size="8" placeholder="login" pattern="[A-za-z-0-9]{3,15}"></input>
                <button id="butuserstat"> Просмотреть </button>
                </div>
                <script>$(\'#butuserstat\').click(function(){
                   document.location.href = "/map/" + $(\'#enteruserstat\').val();
                });</script>

            
            
            ';

    }
}

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


