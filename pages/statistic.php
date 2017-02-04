<?php


if(isset($_SESSION['USER_ID'])) {

    function ShowContent()
    {
        echo '

            <script src="/js/highcharts.js"></script>
            <script src="/js/exporting.js"></script>

			<h2 align="center">Статистика ' . $_SESSION['USER_NAME'] . '</h2>
			';
        $statOdo = new Stat();
        $statOdo->db('SELECT * FROM statdata WHERE userid = ' . $_SESSION['USER_ID'] . ' ORDER BY date DESC');
        $statYear = new Stat();
        $statYear->db('SELECT year, bike, dist FROM yeardata WHERE userid = ' . $_SESSION['USER_ID'].' ORDER BY year DESC');

        echo '
              <script src="/js/statistic.js"></script>
                <div ng-app="app">
                    <div ng-controller="MainCtrl">
                    <div class="container">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <br>
                    <h4 align="center">КИЛОМЕТРАЖ ПО ТС</h4>
                        <div class="odotable">
                        <div ng-repeat="item in OdoArr | orderBy:item[0]:true">
                        <b><table width="100%">
                            <tr class="colordarkred">
                                <td  width="70%">{{item[0]}}</td>
                                <td  width="30%" align="right">{{item[2].toFixed(2)}}км</td>
                            </tr>
                            </table></b>

                            <table width="100%">
                            <tr ng-repeat="i in item[1] | orderBy:i[0]">
                                <td width="70%">{{i[0]}}</td>
                                <td align="right" width="30%">{{i[1].toFixed(2)}}км</td>
                             </tr>
                            </table>
                            <br>
                        </div>
                     </div>

                     <h4>В среднем за год: {{avgOdo.toFixed(2)}}км</h4>
                     </div>                     
                     <div class="odototal col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <br>
                        <div id="odoTot"></div>
                     </div>
                         <br><div id="odograph" class="highcharts col-xs-12 col-sm-12 col-md-6 col-lg-6"></div>
                        </div>
                     <div class="container">
                        <h2 align="center">Расширенная статистика на текущий год</h2>
                     </div>
                     
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


