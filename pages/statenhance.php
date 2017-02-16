<?php

function ShowContent() {
    echo '
	
	<h2 align="center">Расширенная статистика</h2>
		

	';

    $statNum = new Stat();
    $statNum->db('SELECT * FROM statdata WHERE id = "'.Route::$url_parts[1].'";');

    if (!isset($statNum->result[0])) {
        MessageShow::set('Данные не найдены', 1);
        MessageShow::get();
        exit();
    }

    echo '<pre>'.print_r($statNum).'</pre>';

};

//if(isset($_SESSION['USER_ID'])) {}


include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>