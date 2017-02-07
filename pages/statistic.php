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
              <script src="/js/calendar.js"></script>
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
                     <h4 align="right">Всего лет учтено: <b class="colordarkblue">{{OdoArr.length}}</b></h4>
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

                    <h4><b>{{cell.namets}}</b></h4>
                    <div class="otboynik"></div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <h7>&nbsp;</h7>
                        <table class="statdisttable" width="100%">
                            <tr><td width="60%" align="left">Пройденная дистанция</td><td width="40%"><b class="colordarkred">{{cell.dist.toFixed(2)}}км</b></td></tr>
                            <tr><td align="left">Средняя дистанция</td><td><b class="colordarkred">{{cell.avgdist.toFixed(2)}}км</b></td></tr>
                            <tr><td align="left">Всего выездов</td><td><b class="colorblack">{{cell.count}}</b></td></tr>
                            <tr><td align="left">Общее время</td><td><b class="colordarkblue">{{cell.time[0]+"ч "+cell.time[1]+"м "+cell.time[2]+"с"}}</b></td></tr>
                            <tr><td align="left">Среднее время</td><td><b class="colordarkblue">{{cell.avgtime[0]+":"+cell.avgtime[1]+":"+cell.avgtime[2]}}</b></td></tr>
                        </table>
                        <br>
                        <table class="statdisttable" width="100%">
                            <tr><td width="30%" align="left">Асфальт</td><td width="60%"><div class="surfbarasf" style="width: {{cell.surfaceperc[0]}}%"></div></td><td  width="30%"><b class="colordarkred">{{cell.surfacedist[0].toFixed(2)}}км</b></td></tr>
                            <tr><td align="left">Тв.покр.</td><td><div class="surfbarasf" style="width: {{cell.surfaceperc[1]}}%"></div></td><td><b class="colordarkred">{{cell.surfacedist[1].toFixed(2)}}км</b></td></tr>
                            <tr><td align="left">Грунт</td><td><div class="surfbarasf" style="width: {{cell.surfaceperc[2]}}%"></div></td><td><b class="colordarkred">{{cell.surfacedist[2].toFixed(2)}}км</b></td></tr>
                            <tr><td align="left">Бездорожье</td><td><div class="surfbarasf" style="width: {{cell.surfaceperc[3]}}%"></div></td><td><b class="colordarkred">{{cell.surfacedist[3].toFixed(2)}}км</b></td></tr>
                        </table>
                        
                        </div>    
                        
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <h7>&nbsp;</h7>
                        <table class="statdisttable" width="100%">
                            <tr><td align="left">Общая средняя</td><td><b class="colordarkred">{{cell.avgspd.toFixed(2)}}км/ч</b></td></tr>
                            <tr title="{{cell.maxavgspd[1]}} - {{cell.maxavgspd[2]}}, {{cell.maxavgspd[4]}}"><td align="left">Максимальная средняя</td><td><b class="colordarkred">{{cell.maxavgspd[0].toFixed(2)}}км/ч</b></td></tr>
                            <tr title="{{cell.maxpls[1]}} - {{cell.maxpls[2]}}, {{cell.maxpls[4]}}"><td align="left">Максимальный пульс</td><td><b class="colorpurple">{{(cell.maxpls[0] > 0) ? cell.maxpls[0] : "-"}}{{(cell.maxpls[0] > 0) ? "уд/мин" : ""}}</b></td></tr>
                            <tr><td align="left">Средний пульс</td><td><b class="colorpurple">{{(cell.avgpls > 0) ? cell.avgpls.toFixed(0): "-"}}{{(cell.avgpls > 0) ? "уд/мин" : ""}}</b></td></tr>
                            <tr title="{{cell.maxspd[1]}} - {{cell.maxspd[2]}}, {{cell.maxspd[4]}}"><td align="left">Максимальная скорость</td><td><b class="colordarkred">{{cell.maxspd[0].toFixed(2)}}км/ч</b></td></tr>
                        </table>
                        <br>
                            <table class="statdisttable" width="100%">
                            <tr><td align="left"><b>Последнее ТО - <span class="colordarkblue">{{cell.tehnote[2]}}</span></b></td><td><b class="colordarkred">{{cell.tehnote[1]}}км</b></td></tr>
                            </table>
                            <p align="justify">{{cell.tehnote[0]}}</p>
                            
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h7>&nbsp;</h7>
                        <table width="100%" class="monthtable">
                                <tr ><td width="20%" align="left">Январь</td><td width="10%"><b class="colorblack">{{cell.monthcount[0]}}</b></td><td width="20%" class="colordarkred"><b>{{cell.monthdist[0].toFixed(2)}}км</b></td><td width="50%"><div class="monthbar" style="width: {{cell.monthperc[0]}}%;"></div</td></tr>
                                <tr><td align="left">Февраль</td><td><b class="colorblack">{{cell.monthcount[1]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[1].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[1]}}%;"></div</td></tr>
                                <tr><td align="left">Март</td><td><b class="colorblack">{{cell.monthcount[2]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[2].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[2]}}%;"></div</td></tr>
                                <tr><td align="left">Апрель</td><td><b class="colorblack">{{cell.monthcount[3]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[3].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[3]}}%;"></div</td></tr>
                                <tr><td align="left">Май</td><td><b class="colorblack">{{cell.monthcount[4]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[4].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[4]}}%;"></div</td></tr>
                                <tr><td align="left">Июнь</td><td><b class="colorblack">{{cell.monthcount[5]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[5].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[5]}}%;"></div</td></tr>
                                <tr><td align="left">Июль</td><td><b class="colorblack">{{cell.monthcount[6]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[6].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[6]}}%;"></div</td></tr>
                                <tr><td align="left">Авуст</td><td><b class="colorblack">{{cell.monthcount[7]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[7].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[7]}}%;"></div</td></tr>
                                <tr><td align="left">Сентябрь</td><td><b class="colorblack">{{cell.monthcount[8]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[8].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[8]}}%;"></div</td></tr>
                                <tr><td align="left">Октябрь</td><td><b class="colorblack">{{cell.monthcount[9]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[9].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[9]}}%;"></div</td></tr>
                                <tr><td align="left">Ноябрь</td><td><b class="colorblack">{{cell.monthcount[10]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[10].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[10]}}%;"></div</td></tr>
                                <tr><td align="left">Декабрь</td><td><b class="colorblack">{{cell.monthcount[11]}}</b></td><td class="colordarkred"><b>{{cell.monthdist[11].toFixed(2)}}км</b></td><td><div class="monthbar" style="width: {{cell.monthperc[11]}}%;"></div></td></tr>
                        </table>
                        </div>
                        <h7>&nbsp;</h7>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <h4 align="center" title="{{cell.last[4]}} - {{cell.last[5]}}">Последний выезд:<br><span class="colordarkblue">{{cell.last[0]}}</span></h4>
                            <table class="lasttable" width="100%">
                            <tr><td align="left" width="55%">Дистанция</td><td style="color: {{cell.last[7][0]}};" width="5%">{{cell.last[7][1]}}</td><td width="40%"><b class="colordarkred">{{cell.last[1]}}км</b></td></tr>
                            <tr><td align="left">Средняя скорость</td><td style="color: {{cell.last[8][0]}};">{{cell.last[8][1]}}</td><td><b class="colordarkred">{{cell.last[2]}}<br>км/ч</b></td></tr>
                            <tr><td align="left">Средний пульс</td><td style="color: {{cell.last[9][0]}};">{{(cell.last[3] > 0) ? cell.last[9][1] : ""}}</td><td><b class="colorpurple">{{(cell.last[3] > 0) ? cell.last[3] : "-"}}<br>{{(cell.last[3] > 0) ? "уд/мин" : ""}}</b></td></tr>
                            <tr><td align="left">Забортная температура</td><td></td><td><b>{{cell.last[6]}}°С</b></td></tr>
                            </table>
                        </div>
                               
                     </div>
                                                                                                  
                    </div>
    <div class="otboynik"></div>                    
                    <div class="container">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h7>&nbsp;</h7>
                        <b><h4 align="center" class="colordarkblue">КАЛЕНДАРЬ</h4></b>
                        
                        <br>
                        <table id="calendar2">
                          <thead>
                            <tr><td>‹<td colspan="5"><td>›
                            <tr><td>Пн<td>Вт<td>Ср<td>Чт<td>Пт<td>Сб<td>Вс
                          <tbody>
                        </table>
                        <b><h4 align="center" class="colorpurple">ПУЛЬСОВЫЕ ЗОНЫ</h4></b>
                <table class="statdisttable" width="100%">
                    <tr style="color: #220A29;"><td align="left"><b>5я зона: </b></td><td>{{(plsZones[0]+5*plsZones[1]).toFixed(0)}} - {{(plsZones[0]+4*plsZones[1]).toFixed(0)}}</td><td>уд/мин</td><td align="right">Максимальная нагрузка</td></tr>
                    <tr style="color: #2F0B3A;"><td align="left"><b>4я зона: </b></td><td>{{(plsZones[0]+4*plsZones[1]).toFixed(0)}} - {{(plsZones[0]+3*plsZones[1]).toFixed(0)}}</td><td>уд/мин</td><td align="right">Анаэробная нагрузка</td></tr>
                    <tr style="color: #4C0B5F;"><td align="left"><b>3я зона: </b></td><td>{{(plsZones[0]+3*plsZones[1]).toFixed(0)}} - {{(plsZones[0]+2*plsZones[1]).toFixed(0)}}</td><td>уд/мин</td><td align="right">Аэробная нагрузка</td></tr>
                    <tr style="color: #6A0888;"><td align="left"><b>2я зона: </b></td><td>{{(plsZones[0]+2*plsZones[1]).toFixed(0)}} - {{(plsZones[0]+1*plsZones[1]).toFixed(0)}}</td><td>уд/мин</td><td align="right">Легкая нагрузка</td></tr>
                    <tr style="color: #8904B1;"><td align="left"><b>1я зона: </b></td><td>{{(plsZones[0]+plsZones[1]).toFixed(0)}} - {{plsZones[0].toFixed(0)}}</td><td>уд/мин</td><td align="right">Очень легкая нагрузка</td></tr>
                </table>
                        </div>
                        <h7>&nbsp;</h7>
                        <div id="distgraph" class="col-xs-12 col-sm-8 col-md-8 col-lg-8"></div>
                    </div>  
    <h7>&nbsp;</h7>
    <div class="otboynik"></div>
    <h7>&nbsp;</h7>
                     <div class="container">
                        <div id="plschart" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>
                        <div id="avgspdchart" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>
                    </div>
    <h7>&nbsp;</h7>
    <div class="otboynik"></div>
                    <div class="container">
                        <h7>&nbsp;</h7>
                        <h2 align="center">Таблица данных</h2>
                            <table class="totaltable" border="1">
                            <tr class="tablehead"><td>Дата</td><td>ТС</td><td>Описание</td><td>Время</td><td>Дистанция</td><td>Темп.</td><td>Ссылка</td><td>ТО</td></tr>
                                <tr ng-repeat="cell in statData">
                                    <td width="10%" class="colordarkblue"><b>{{cell[9]}}</b></td>
                                    <td  width="15%">{{cell[3]}}</td>
                                    <td width="40%">{{cell[14]}}</td>
                                    <td  width="10%">{{cell[2]}}</td>
                                    <td width="8%" class="colordarkred cellright"><b>{{cell[1]}}км</b></td>
                                    <td width="7%"  class="cellright">{{cell[16]}}°С</td>
                                    <td width="8%"><a href="/statistic/{{cell[0]}}">Показать</a></td>
                                    <td width="2%" title="{{cell[15]}}"><b style="color: red;">{{(cell[15] != "") ? "!" : ""}}</b></td>
                                </tr>
                            </table>                        
                        </div>
                        
                        <div class="container">
                        <h7>&nbsp;</h7>
                        <h2 align="center">Технический дневник</h2>
                            <table class="tehtable" border="1">
                            <tr class="tablehead"><td>Дата</td><td>ТС</td><td>Описание</td><td>Дистанция</td></tr>
                                <tr ng-repeat="cell in tehArr">
                                    <td width="10%"><b class="colordarkblue">{{cell[0]}}</b></td>
                                    <td width="15%">{{cell[2]}}</td>
                                    <td width="67%" align="justify">{{cell[1]}}</td>
                                    <td width="8%" class="cellright colordarkred"><b>{{cell[3].toFixed(2)}}км</b></td>
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
            var brthYear = '<?php echo $_SESSION['USER_BYEAR']; ?>';
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


