<?php

if(isset(Route::$url_parts[1])) {

//    echo Route::$url_parts[1];

    function ShowContent()
    {
        echo '

            <script src="/js/highcharts.js"></script>
            <script src="/js/exporting.js"></script>

			<h2 align="center">Статистика ' . Route::$url_parts[1] . '</h2>
			<div class="littlestat"><b>Посмотреть чужую статистику: </b>
			<input id="enteruserstat" size="8" placeholder="login" pattern="[A-za-z-0-9]{3,15}"></input>
            <button id="butuserstat"> Перейти </button>
            </div>
            <script>$(\'#butuserstat\').click(function(){
              document.location.href = "/statistic/" + $(\'#enteruserstat\').val();
            });</script>
			';
        $statID = new Stat();
        $statID->db('SELECT id, year FROM users WHERE login = "'.Route::$url_parts[1].'";');

        if (!isset($statID->result[0])) {
            MessageShow::set('Пользователь не найден', 1);
            MessageShow::get();
            exit();
        }

        $statOdo = new Stat();
        $statOdo->db('SELECT * FROM statdata WHERE userid = ' . $statID->result[0][0] . ' ORDER BY date DESC');
        $statYear = new Stat();
        $statYear->db('SELECT year, bike, dist FROM yeardata WHERE userid = ' . $statID->result[0][0] .' ORDER BY year DESC');

        echo '
              <script src="/js/statistic.js"></script>
              <script src="/js/calendar.js"></script>
              <script src="/js/statfuncs.js"></script>
                <div ng-app="app">
                    <div ng-cloak ng-controller="MainCtrl">
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
                            <h2 align="center">Расширенная статистика на <span class="colordarkblue butY" ng-click="validYear(0)">◄</span><b class="colordarkblue"> {{curYear}} </b><span class="colordarkblue butY" ng-click="validYear(1)">►</span> год</h2>


                    <div class="row" ng-repeat="cell in statEnhanced">

                    <h4><b>{{cell.namets}}</b></h4>
                    <div class="otboynik"></div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <h7>&nbsp;</h7>
                        <table class="statdisttable" width="100%">
                            <tr><td width="60%" align="left" class="colordarkred"><b>Дистанция</b></td><td width="40%"><b class="colordarkred">{{cell.dist.toFixed(2)}}км</b></td></tr>
                            <tr><td align="left">Общее время</td><td><b class="colordarkblue">{{cell.time[0]+"ч "+cell.time[1]+"м "+cell.time[2]+"с"}}</b></td></tr>
                            <tr><td align="left">Средняя дистанция</td><td><b class="colordarkred">{{cell.avgdist.toFixed(2)}}км</b></td></tr>
                            <tr><td align="left">Среднее время</td><td><b class="colordarkblue">{{cell.avgtime[0]+":"+cell.avgtime[1]+":"+cell.avgtime[2]}}</b></td></tr>
                            <tr class="colorblack"><td align="left">Всего выездов</td><td><b>{{cell.count}}</b></td></tr>
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
                            <tr><td align="left">Общая средняя</td><td><b class="colordarkred">{{cell.avgspd}}км/ч</b></td></tr>
                            <tr title="{{transDate(cell.maxavgspd[1])}} - {{cell.maxavgspd[2]}}, {{cell.maxavgspd[4]}}"><td align="left">Макс. средняя</td><td><b class="colordarkred">{{cell.maxavgspd[0].toFixed(2)}}км/ч</b></td></tr>
                            <tr title="{{transDate(cell.maxpls[1])}} - {{cell.maxpls[2]}}, {{cell.maxpls[4]}}"><td align="left" class="colorpurple"><b>Макс. пульс</b></td><td><b class="colorpurple">{{(cell.maxpls[0] > 0) ? cell.maxpls[0] : "-"}}{{(cell.maxpls[0] > 0) ? "уд/мин" : ""}}</b></td></tr>
                            <tr><td align="left" class="colorpurple"><b>Средний пульс</b></td><td><b class="colorpurple">{{(cell.avgpls > 0) ? cell.avgpls.toFixed(0): "-"}}{{(cell.avgpls > 0) ? "уд/мин" : ""}}</b></td></tr>
                            <tr title="{{transDate(cell.maxspd[1])}} - {{cell.maxspd[2]}}, {{cell.maxspd[4]}}"><td align="left">Макс. скорость</td><td><b class="colordarkred">{{(cell.maxspd[0] > 0) ? (cell.maxspd[0].toFixed(2)) : ""}}{{(cell.maxspd[0] > 0) ? "км/ч" : "-"}}</b></td></tr>
                        </table>
                        <br>
                            <table class="statdisttable" width="100%" title="{{cell.tehnote[3]}}">
                            <tr><td align="left"><b>Посл.ТО (<span class="colordarkblue">{{transDate(cell.tehnote[2])}}</span>)</b></td><td><b class="colordarkred">{{cell.tehnote[1].toFixed(2)}}км</b></td></tr>
                            </table>
                            <dd><b>{{(cell.tehnote[3] != cell.namets) ? cell.tehnote[3] :""}}</b></dd>
                            <p align="justify">{{cell.tehnote[0]}}</p>
                            
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h7>&nbsp;</h7>
                        <table width="100%" class="monthtable">
                                <tr class="{{(cell.monthcount[0] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" width="15%" align="left">Январь</td><td width="10%" class="monthcnt">{{cell.monthcount[0]}}</td><td width="25%" class="monthdst">{{cell.monthdist[0].toFixed(2)}}км</td><td width="50%"><div class="monthbar" style="width: {{cell.monthperc[0]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[1] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Февраль</td><td class="monthcnt">{{cell.monthcount[1]}}</td><td class="monthdst">{{cell.monthdist[1].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[1]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[2] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Март</td><td class="monthcnt">{{cell.monthcount[2]}}</td><td class="monthdst">{{cell.monthdist[2].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[2]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[3] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Апрель</td><td class="monthcnt">{{cell.monthcount[3]}}</td><td class="monthdst">{{cell.monthdist[3].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[3]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[4] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Май</td><td class="monthcnt">{{cell.monthcount[4]}}</td><td class="monthdst">{{cell.monthdist[4].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[4]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[5] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Июнь</td><td class="monthcnt">{{cell.monthcount[5]}}</td><td class="monthdst">{{cell.monthdist[5].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[5]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[6] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Июль</td><td class="monthcnt">{{cell.monthcount[6]}}</td><td class="monthdst">{{cell.monthdist[6].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[6]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[7] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Август</td><td class="monthcnt">{{cell.monthcount[7]}}</td><td class="monthdst">{{cell.monthdist[7].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[7]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[8] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Сентябрь</td><td class="monthcnt">{{cell.monthcount[8]}}</td><td class="monthdst">{{cell.monthdist[8].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[8]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[9] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Октябрь</td><td class="monthcnt">{{cell.monthcount[9]}}</td><td class="monthdst">{{cell.monthdist[9].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[9]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[10] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Ноябрь</td><td class="monthcnt">{{cell.monthcount[10]}}</td><td class="monthdst">{{cell.monthdist[10].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[10]}}%;"></div></td></tr>
                                <tr class="{{(cell.monthcount[11] > 0) ? \'cellmonth\' : \'colorgrey\'}}"><td class="monthmonth" align="left">Декабрь</td><td class="monthcnt">{{cell.monthcount[11]}}</td><td class="monthdst">{{cell.monthdist[11].toFixed(2)}}км</td><td><div class="monthbar" style="width: {{cell.monthperc[11]}}%;"></div></td></tr>
                        </table>
                        </div>
                        <h7>&nbsp;</h7>
                        <div align="center" class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <h4 class="colorblack" title="{{cell.last[4]}} - {{cell.last[5]}}">Последний выезд
                            <dd>{{(cell.last[5] != cell.namets) ? cell.last[5] : ""}}</dd>
                            <dd><span class="colordarkblue">{{transDate(cell.last[0])}}</span></dd></h4>
                            <table class="lasttable">
                            <tr title="Пройденная дистанция относительно общей средней дистанции"><td><span class="colorblack glyphicon glyphicon-road"></span></td><td style="color: {{cell.last[7][0]}};">{{cell.last[7][1]}}</td><td><b class="colordarkred">{{cell.last[1]}}км</b></td></tr>
                            <tr title="Средняя скорость относительно общей средней скорости"><td align="left"><span class="colorblack glyphicon glyphicon-dashboard"></span></td><td style="color: {{cell.last[8][0]}};">{{cell.last[8][1]}}</td><td><b class="colordarkred">{{cell.last[2]}}км/ч</b></td></tr>
                            <tr title="Средний пульс относительно общего среднего пульса"><td align="left"><span class="colorblack glyphicon glyphicon-heart"></span></td><td style="color: {{cell.last[9][0]}};">{{(cell.last[3] > 0) ? cell.last[9][1] : ""}}</td><td><b class="colorpurple">{{(cell.last[3] > 0) ? cell.last[3] : "-"}}{{(cell.last[3] > 0) ? "уд/мин" : ""}}</b></td></tr>
                            <tr title="Забортная температура"><td align="left"><span class="colorblack glyphicon glyphicon-asterisk"></span></td><td></td><td><b>{{cell.last[6]}}°С</b></td></tr>
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
                    <tr style="color: #220A29;"><td align="left"><b>5я зона: </b></td><td><span title="Максимально допустимый пульс" style="color: red;"><b>{{(plsZones[0]+5*plsZones[1]).toFixed(0)}}</b></span> - {{(plsZones[0]+4*plsZones[1]).toFixed(0)}}</td><td>уд/мин</td><td align="right">Максимальная нагрузка</td></tr>
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
                            <div align="left">
                            <input ng-model="$ctrl.query" placeholder="Фильтр"></input>
                            <span> Всего записей: <b class="colorblack">{{ filtered.length }}</b></span>
                            </div>   
                            <div class="trimtable">
                            <table class="totaltable" border="1">
                            <tr class="tablehead"><td>Дата</td><td>ТС</td><td>Описание</td><td>Время</td><td>Дистанция</td><td>Темп.</td><td>Ссылка</td><td>ТО</td></tr>
                                <tr ng-repeat="cell in statData | filter:$ctrl.query as filtered">
                                    <td width="10%" class="colordarkblue"><b>{{transDate(cell[9])}}</b></td>
                                    <td  width="15%">{{cell[3]}}</td>
                                    <td width="40%">{{cell[14]}}</td>
                                    <td  width="10%">{{cell[2]}}</td>
                                    <td width="8%" class="cellright"><b class="colordarkred">{{cell[1]}}км</b></td>
                                    <td width="7%"  class="cellright">{{cell[16]}}°С</td>
                                    <td width="8%"><a href="/statenhance/{{cell[0]}}">Показать</a></td>
                                    <td width="2%" title="{{cell[15]}}"><b style="color: red;">{{(cell[15] != "") ? "🛠" : ""}}</b></td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        
                        <div class="container">
                        <h7>&nbsp;</h7>
                        <h2 align="center">Технический дневник</h2>
                            <div align="left">
                                <input ng-model="$ctrl.query2" placeholder="Фильтр"></input>
                                <span> Всего записей: <b class="colorblack">{{ filtered2.length }}</b></span>
                            </div>
                            <div class="trimtable">
                            <table class="tehtable" border="1">
                            <tr class="tablehead"><td>Дата</td><td>ТС</td><td>Описание</td><td>Дистанция</td></tr>
                                <tr ng-repeat="cell in tehArr | filter:$ctrl.query2 as filtered2">
                                    <td width="10%"><b class="colordarkblue">{{transDate(cell[0])}}</b></td>
                                    <td width="15%">{{cell[2]}}</td>
                                    <td width="67%" align="justify">{{cell[1]}}</td>
                                    <td width="8%" class="cellright"><b class="colordarkred">{{cell[3].toFixed(2)}}км</b></td>
                                </tr>
                            </table>               
                            </div>
                        </div>
                    
                    
                </div>
               </div>
               ';
?>

        <script>
            var jsonStatData = JSON.parse('<?php echo GetJSONfromArray::ArrToJson($statOdo->result); ?>');
            var jsonYearData = JSON.parse('<?php echo GetJSONfromArray::ArrToJson($statYear->result); ?>');
            var brthYear = '<?php echo $statID->result[0][1]; ?>';
        </script>

<?php

    };
}
else {
		MessageShow::set('Введите логин пользователя, для просмотра статистики.', 2);
    	function ShowContent() {
            echo '<h2 align="center">Статистика</h2> 
                <div align="center"><b>Введите логин пользователя: </b><input id="enteruserstat" size="8" pattern="[A-za-z-0-9]{3,15}" placeholder="login"></input>
                <button id="butuserstat"> Просмотреть </button>
                </div>
                <script>$(\'#butuserstat\').click(function(){
                   document.location.href = "/statistic/" + $(\'#enteruserstat\').val();
                });</script>

            
            
            ';
		}
};


include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


