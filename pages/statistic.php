<?php

if(isset($_SESSION['USER_ID'])) {

    function ShowContent()
    {
        echo '
			<h2 align="center">Статистика ' . $_SESSION['USER_NAME'] . '</h2>
			';
        $aaa = new Stat();
        $aaa->db('SELECT * FROM statdata WHERE userid = ' . $_SESSION['USER_ID'] . ' ORDER BY date DESC');

        /*echo '<pre>';
        print_r($aaa->result);
        */echo '</pre>';

        echo '<div class="stattable"><table border="1">';
        foreach ($aaa->result as $k) {
        echo    '
                <tr>
                    <td>'.$k['date'].'</td><td>'.$k['prim'].'</td><td>'.$k['time'].'</td><td>'.$k['dist'].'</td>
                    <td>'.$k['bike'].'</td><td>'.$k['temp'].'</td><td><a href="#">Подробнее...</a></td>
                </tr>
                ';
        }
        echo '</table></div>';



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


