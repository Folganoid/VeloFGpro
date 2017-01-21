<?php

if(isset($_SESSION['USER_ID'])) {

    function ShowContent()
    {
        echo '
			<h2 align="center">Статистика ' . $_SESSION['USER_NAME'] . '</h2>
			';
        echo $_SESSION['USER_ID'];

        $aaa = new Stat();
        $aaa->db('SELECT * FROM statdata WHERE userid = ' . $_SESSION['USER_ID'] . ' ORDER BY date DESC');

        echo '<pre>';
        print_r($aaa->result);
        echo '</pre>';
    };
}
else {
		MessageShow::set('Статистику может видеть только зарегестрированный пользователь', 1);
    	function ShowContent() {
            echo '<h2 align="center">Статистика ';
		}
};


include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


