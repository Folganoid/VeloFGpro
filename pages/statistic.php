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
                    <h5>&nbsp;</h5>
                    <h4 align="center">КИЛОМЕТРАЖ</h4>
                     <h6 align="center">ПО ГОДАМ И ТС</h6>
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

                     <h4 align="right">В среднем за год: <b class="colordarkred">{{(avgOdo) ? avgOdo.toFixed(2) : "0"}}км</b></h4>
                     </div>                     
                     <div class="odototal col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <h7>&nbsp;</h7>
                        <div id="odoTot"></div>
                     </div>
                        <h7>&nbsp;</h7>
                         <div id="odograph" class="highcharts col-xs-12 col-sm-12 col-md-6 col-lg-6"></div>
                        </div>

                       <div class="container">
                            <h2 align="center">Расширенная статистика на {{curYear}} год</h2>


                    <div class="row" ng-repeat="cell in statEnhanced">

                    <h3><b>{{cell.namets}}</b></h3>
                    <div class="otboynik"></div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <dd>Пройденная дистанция - {{cell.dist.toFixed(2)}}км</dd>
                            <dd>средняя дистанция - {{cell.avgdist.toFixed(2)}}км</dd>
                            <dd>Всего выездов - {{cell.count}}</dd>
                            <dd>Общее время - {{cell.time[0]+":"+cell.time[1]+":"+cell.time[2]}}</dd>
                            <dd>среднее время - {{cell.avgtime[0]+":"+cell.avgtime[1]+":"+cell.avgtime[2]}}</dd>
                            <dd>Асфальт - {{cell.surfacedist[0].toFixed(2)}}км ({{cell.surfaceperc[0].toFixed(2)}})%</dd>
                            <dd>Тв. покрытие - {{cell.surfacedist[1].toFixed(2)}}км ({{cell.surfaceperc[1].toFixed(2)}})%</dd>                            
                            <dd>Грунт - {{cell.surfacedist[2].toFixed(2)}}км ({{cell.surfaceperc[2].toFixed(2)}})%</dd>
                            <dd>Бездорожье - {{cell.surfacedist[3].toFixed(2)}}км ({{cell.surfaceperc[3].toFixed(2)}})%</dd>                            
                        
                        
                        </div>    
                        
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <dd>Общая средняя - {{cell.avgspd.toFixed(2)}}км/ч</dd>
                            <dd title="{{cell.maxavgspd[1]}} - {{cell.maxavgspd[2]}}, {{cell.maxavgspd[4]}}">максимальная средняя - {{cell.maxavgspd[0].toFixed(2)}}км/ч</dd>
                            <dd title="{{cell.maxpls[1]}} - {{cell.maxpls[2]}}, {{cell.maxpls[4]}}">максимальный пульс - {{cell.maxpls[0]}}уд/мин</dd>
                            <dd>Средний пульс - {{cell.avgpls.toFixed(0)}}уд/мин</dd>
                            <dd title="{{cell.maxspd[1]}} - {{cell.maxspd[2]}}, {{cell.maxspd[4]}}">Максимальная скорость - {{cell.maxspd[0].toFixed(2)}}км/ч</dd>
                            <dd>последнее ТО - {{cell.tehnote[2]}} - {{cell.tehnote[1]}}км назад</dd>
                            <dd>{{cell.tehnote[0]}}</dd>
                            
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <dd>Январь({{cell.monthcount[0]}}) ({{cell.monthdist[0].toFixed(2)}}км) - ({{cell.monthperc[0]}}%)</dd>
                                <dd>Февраль({{cell.monthcount[1]}}) ({{cell.monthdist[1].toFixed(2)}}км) - ({{cell.monthperc[1]}}%)</dd>
                                <dd>Март({{cell.monthcount[2]}}) ({{cell.monthdist[2].toFixed(2)}}км) - ({{cell.monthperc[2]}}%)</dd>
                                <dd>Апрель({{cell.monthcount[3]}}) ({{cell.monthdist[3].toFixed(2)}}км) - ({{cell.monthperc[3]}}%)</dd>
                                <dd>Май({{cell.monthcount[4]}}) ({{cell.monthdist[4].toFixed(2)}}км) - ({{cell.monthperc[4]}}%)</dd>
                                <dd>Июнь({{cell.monthcount[5]}}) ({{cell.monthdist[5].toFixed(2)}}км) - ({{cell.monthperc[5]}}%)</dd>
                                <dd>Июль({{cell.monthcount[6]}}) ({{cell.monthdist[6].toFixed(2)}}км) - ({{cell.monthperc[6]}}%)</dd>
                                <dd>Авуст({{cell.monthcount[7]}}) ({{cell.monthdist[7].toFixed(2)}}км) - ({{cell.monthperc[7]}}%)</dd>
                                <dd>Сентябрь({{cell.monthcount[8]}}) ({{cell.monthdist[8].toFixed(2)}}км) - ({{cell.monthperc[8]}}%)</dd>
                                <dd>Октябрь({{cell.monthcount[9]}}) ({{cell.monthdist[9].toFixed(2)}}км) - ({{cell.monthperc[9]}}%)</dd>
                                <dd>Ноябрь({{cell.monthcount[10]}}) ({{cell.monthdist[10].toFixed(2)}}км) - ({{cell.monthperc[10]}}%)</dd>
                                <dd>Декабрь({{cell.monthcount[11]}}) ({{cell.monthdist[11].toFixed(2)}}км) - ({{cell.monthperc[11]}}%)</dd>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <h4 title="{{cell.last[4]}} - {{cell.last[5]}}">Последний выезд: {{cell.last[0]}}</h4>
                            <dd>Дистанция - {{cell.last[1]}}км</dd>
                            <dd>Средняя скорость - {{cell.last[2]}} км/ч</dd>
                            <dd>Средний пульс - {{cell.last[3]}}уд/мин</dd>
                            <dd>Температура: {{cell.last[6]}} град.С</dd>

                        </div>
                               
                     </div>
                                                                                                  
                    </div>
                        
                        <div class="container">
                        <h2 align="center">Таблица данных</h2>
                            <table border="1" width="100%" style="text-align: center;">
                                <tr ng-repeat="cell in statData">
                                    <td>{{cell[9]}}</td>
                                    <td>{{cell[3]}}</td>
                                    <td>{{cell[14]}}</td>
                                    <td>{{cell[2]}}</td>
                                    <td>{{cell[1]}}</td>
                                    <td>{{cell[16]}}</td>
                                    <td><a href="/statistic/{{cell[0]}}">Показать</a></td>
                                </tr>
                            </table>                        
                        </div>
                        
                        <div class="container">
                        <h2 align="center">Технический дневник</h2>
                            <table border="1" width="100%" style="text-align: center;">
                                <tr ng-repeat="cell in tehArr">
                                    <td>{{cell[0]}}</td>
                                    <td>{{cell[2]}}</td>
                                    <td>{{cell[1]}}</td>
                                    <td>{{cell[3]}}</td>
                                </tr>
                            </table>                        
                        </div>
                    
                    
                </div>
               </div>
              <h4>&nbsp;</h4>
               ';


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
            echo '<h2 align="center">Статистика</h2> ';
		}
};


include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


