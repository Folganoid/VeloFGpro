<?php


if(isset($_SESSION['USER_ID'])) {

    function ShowContent()
    {
        echo '
			<h2 align="center">Статистика ' . $_SESSION['USER_NAME'] . '</h2>
			';
        $statOdo = new Stat();
        $statOdo->db('SELECT * FROM statdata WHERE userid = ' . $_SESSION['USER_ID'] . ' ORDER BY date DESC');
        $statYear = new Stat();
        $statYear->db('SELECT year, bike, dist FROM yeardata WHERE userid = ' . $_SESSION['USER_ID'].' ORDER BY year DESC');

       /*
        echo '<div class="stattable"><table border="1">';
        foreach ($statOdo->result as $k) {
        echo    '
                <tr>
                    <td>'.$k['date'].'</td><td>'.$k['prim'].'</td><td>'.$k['time'].'</td><td>'.$k['dist'].'</td>
                    <td>'.$k['bike'].'</td><td>'.$k['temp'].'</td><td><a href="#">Подробнее...</a></td>
                </tr>
                ';
        }
        echo '</table></div><br><br>';

        */


        echo '
              <script src="/js/statistic.js"></script>
                <div ng-app="app">
                    <div ng-controller="MainCtrl">
                        
                        {{bububu}}
                                            
                    </div>    
               </div>';


?>

        <script>
            var jsonStatData = JSON.parse('<?php echo GetJSONfromArray::ArrToJson($statOdo->result); ?>');
            var jsonYearData = JSON.parse('<?php echo GetJSONfromArray::ArrToJson($statYear->result); ?>');
        </script>

<?php

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


