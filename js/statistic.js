angular
    .module('app',[])

    .controller('MainCtrl', function($scope){
        $scope.curYear = new Date().getFullYear();
        $scope.yearData = jsonYearData;
        $scope.statData = jsonStatData;
        $scope.yearsList = [];

        (function () { // объединяет две базы в  общий массив одо и выборка годов
        for ( i=0; i < $scope.statData.length; i++ ) {
            var exist = 0;
            for ( z=0; z < $scope.yearData.length; z++ ) {
                if(($scope.statData[i][9].slice(0,4) == $scope.yearData[z][0]) && ($scope.statData[i][3] == $scope.yearData[z][1])) {
                    $scope.yearData[z][2] = +$scope.yearData[z][2] + +$scope.statData[i][1];
                    exist = 1;
                }
            };
            if (exist == 0) $scope.yearData.push([$scope.statData[i][9].slice(0,4), $scope.statData[i][3], $scope.statData[i][1]]);
            $scope.yearsList.push($scope.statData[i][9].slice(0,4));
        }
            $scope.yearsList.push($scope.curYear);
            $scope.yearsList = unique($scope.yearsList);
        })();

        $scope.OdoArr = createOdoArr($scope.yearData);
        $scope.highCh = (createHighChartsOdo($scope.OdoArr));
        $scope.odoTotal = [];

        highChartOdo($scope.highCh);

        (function () { // создает одо список по всем годам
            for (i = 0; i<$scope.highCh[0].length; i++) {
                var dataArr = $scope.highCh[0][i].data;
                var result = dataArr.reduce(function(sum, current) {
                    return +sum + +current;
                }, 0);
                $scope.odoTotal.push([$scope.highCh[0][i].name, result]);
            }
        })();

        $scope.avgOdo = +$scope.odoTotal[$scope.odoTotal.length-1][1] / +$scope.highCh[1].length;
        $scope.tehArr = getTehArr();
        $scope.statEnhanced = getStatByTS($scope.curYear);


        highChartOdoTotal($scope.odoTotal);
        highChartTotalOdo(odoChart($scope.curYear));
        pulsechart(createChartAvgPls());
        avgsSpeedChart(createChartAvgSpd());

        $scope.plsZones = pulseZ();
        tehCorr();

        $scope.$watch("curYear", function () {

            $scope.statEnhanced = getStatByTS($scope.curYear);
            highChartTotalOdo(odoChart($scope.curYear));
            pulsechart(createChartAvgPls());
            avgsSpeedChart(createChartAvgSpd());
            $scope.plsZones = pulseZ();
            tehCorr();
        });

        $scope.validYear = function(x){
            var tmpY;
            for (i=0; i<$scope.yearsList.length; i++) {
                if ($scope.yearsList[i] == $scope.curYear) tmpY = i;
            };
            if (($scope.yearsList[tmpY+1]) && x == 1) $scope.curYear = $scope.yearsList[tmpY+1]
            else if (($scope.yearsList[tmpY-1]) && x == 0) $scope.curYear = $scope.yearsList[tmpY-1]
            else $scope.curYear = $scope.yearsList[tmpY];
        };

        function pulseZ(){
            res = (220 - ($scope.curYear - brthYear))/2;
            mod = res / 5;
            return [res, mod];
        };

        function createChartAvgPls() {
            var chartArr = [];
            for ( i = 0; i < $scope.statEnhanced.length-1; i++) {
                var obj = {name: $scope.statEnhanced[i].namets};
                var data = [];

                for( z=0;z<$scope.statData.length;z++) {
                    if(($scope.statData[z][3] == obj.name) && ($scope.statData[z][6] != 0) && ($scope.statData[z][9].substr(0,4) == $scope.curYear)) {
                        var yr = +$scope.statData[z][9].substr(0,4);
                        var m = +$scope.statData[z][9].substr(5,2);
                        var d = +$scope.statData[z][9].substr(8,2);
                        data.push([Date.UTC(yr, m-1, d), +$scope.statData[z][6]]);
                    };
                };
                obj.data = data;
                chartArr.push(obj);
            };
            return chartArr;
        };

        function createChartAvgSpd() {
            var chartArr = [];
            for ( i = 0; i < $scope.statEnhanced.length-1; i++) {
                var obj = {name: $scope.statEnhanced[i].namets};
                var data = [];

                for( z=0;z<$scope.statData.length;z++) {
                    if(($scope.statData[z][3] == obj.name) && ($scope.statData[z][4] != 0) && ($scope.statData[z][9].substr(0,4) == $scope.curYear)) {
                        var yr = +$scope.statData[z][9].substr(0,4);
                        var m = +$scope.statData[z][9].substr(5,2);
                        var d = +$scope.statData[z][9].substr(8,2);
                        data.push([Date.UTC(yr, m-1, d), +$scope.statData[z][4]]);
                    };
                };
                obj.data = data;
                chartArr.push(obj);
            };
            return chartArr;
        };

        function createOdoArr(arr) { //создает массив для таблицы наката по годам
            var obj = {};
            for (var i = 0; i < arr.length; i++) {
                var str = arr[i][0];
                obj[str] = true;
            }
            uniq = Object.keys(obj); // отсев уникальных значений

            var Arr1 = [];

            for ( i=0 ; i<uniq.length ; i++ ) { // наполняет километраж
                var Arr2 = [];
                var total = 0;

                for (z=0; z<arr.length; z++) {
                    if(uniq[i] == arr[z][0]) {
                        Arr2.push([arr[z][1], +arr[z][2]]);
                        total += +arr[z][2];
                    };
                };

                Arr1.push([uniq[i], Arr2, +total]);
            };
            return Arr1;
        };

        function getTehArr() {
            tehArray = [];
            for (var i = 0; i < $scope.statData.length; i++) {

                if ($scope.statData[i][15] != "") {
                    position = i;
                    var dist = 0;
                    var ts = $scope.statData[i][3];
                    for (z = 0; z < position; z++) {
                        if ($scope.statData[z][3] == ts) {
                            dist += +$scope.statData[z][1];
                        }
                    }
                    tehArray.push([$scope.statData[i][9], $scope.statData[i][15], $scope.statData[i][3], dist]);
                };

            };
            return tehArray;
        };

        function createHighChartsOdo(arr) { // создает массив под график
            var tmpArr = [];
            var tmpArrX = [];
            var tmpArrNames = [];
            for ( i = 0 ; i < arr.length ; i++ ) {
                tmpArrX.push(arr[i][0]);
                for ( z = 0 ; z< arr[i][1].length ; z++ ) {
                }
            }
            for ( i = 0 ; i < arr.length ; i++ ) {
                for ( z = 0 ; z < arr[i][1].length ; z++ ) {
                    tmpArrNames.push(arr[i][1][z][0]);
                }
            }
            tmpArrNames = unique(tmpArrNames);
            tmpArrNames.push('Всего');
            for ( i = 0 ; i < tmpArrNames.length ; i++ ) {
                var tmpObj = {
                    name: tmpArrNames[i],
                    data: new Array(arr.length+1).join(0).split("")
                };
                tmpArr.push(tmpObj);
            }
          for ( i = 0 ; i < tmpArr.length ; i++ ) {
                for ( s = 0 ; s < arr.length; s++ ) {
                    var sum = 0;
                    for (z = 0; z < arr[s][1].length; z++) {
                        if(tmpArr[i].name == arr[s][1][z][0]) tmpArr[i].data[s] = +arr[s][1][z][1].toFixed(2);
                        sum += +arr[s][1][z][1];
                    }
                    tmpArr[tmpArr.length-1].data[s] = sum;
                }
            }
            return [tmpArr, tmpArrX];
        }

        function getStatByTS(year) { // создает масив объектов под расширенную статистику

            var currentyear = year;
            var arrTs = [];
            var tmpArr10 = [];

            for (i = 0; i < $scope.OdoArr.length; i++) {
                if (currentyear == $scope.OdoArr[i][0]) arrTs = $scope.OdoArr[i][1];
            };
                if (arrTs.length == 0) return false; // если по году нет данных

            for (z = 0; z < arrTs.length; z++) {
                var psh = getStat(arrTs[z][0]);
                if (psh.dist > 0) tmpArr10.push(psh);
            }
            tmpArr10.push(getStat('ВСЕГО'));

            function getStat(ts) { //собирает объект расширенной статистики по тс

                var tmpObj = {
                    namets: ts,
                    count: 0,
                    dist: 0,
                    time: 0,
                    avgtime: 0,
                    maxspd: [0, '', '', '#', ''],
                    avgdist: 0,
                    avgspd: 0,
                    maxpls: [0, '', '', '#', ''],
                    maxavgspd: [0, '', '', '#', ''],
                    avgpls: [0, 0],
                    tehnote: ["", 0, "", ""],
                    monthcount: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    monthdist: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    monthperc: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    surfaceperc: [0, 0, 0, 0],
                    surfacedist: [0, 0, 0, 0],
                    last: ["", 0, 0, 0, "", "", "", [], [], []]
                };

                for (i = 0; i < $scope.statData.length; i++) {
                    if (($scope.statData[i][9].slice(0, 4) == currentyear) && (($scope.statData[i][3] == ts) || (ts == "ВСЕГО"))) {

                        tmpObj.count++;
                        if (tmpObj.count == 1) {
                            tmpObj.last[0] = $scope.statData[i][9];
                            tmpObj.last[1] = $scope.statData[i][1];
                            tmpObj.last[2] = $scope.statData[i][4];
                            tmpObj.last[3] = $scope.statData[i][6];
                            tmpObj.last[4] = $scope.statData[i][14];
                            tmpObj.last[5] = $scope.statData[i][3];
                            tmpObj.last[6] = $scope.statData[i][16];
                        }

                        tmpObj.dist += +$scope.statData[i][1];
                        tmpObj.time += timeInSec($scope.statData[i][2]);
                        if (tmpObj.maxspd[0] < +$scope.statData[i][5]){
                            tmpObj.maxspd[0] = +$scope.statData[i][5];
                            tmpObj.maxspd[1] = $scope.statData[i][9];
                            tmpObj.maxspd[2] = $scope.statData[i][14];
                            tmpObj.maxspd[3] = $scope.statData[i][0];
                            tmpObj.maxspd[4] = $scope.statData[i][3];
                        }
                        if (tmpObj.maxpls[0] < +$scope.statData[i][7]) {
                            tmpObj.maxpls[0] = +$scope.statData[i][7];
                            tmpObj.maxpls[1] = $scope.statData[i][9];
                            tmpObj.maxpls[2] = $scope.statData[i][14];
                            tmpObj.maxpls[3] = $scope.statData[i][0];
                            tmpObj.maxpls[4] = $scope.statData[i][3];
                        }
                        if (tmpObj.maxavgspd[0] < +$scope.statData[i][4]) {
                            tmpObj.maxavgspd[0] = +$scope.statData[i][4];
                            tmpObj.maxavgspd[1] = $scope.statData[i][9];
                            tmpObj.maxavgspd[2] = $scope.statData[i][14];
                            tmpObj.maxavgspd[3] = $scope.statData[i][0];
                            tmpObj.maxavgspd[4] = $scope.statData[i][3];
                        }
                        if ($scope.statData[i][6] != 0) {
                            tmpObj.avgpls[0] += +$scope.statData[i][6];
                            tmpObj.avgpls[1]++;
                        }
                        tmpObj.monthdist[+$scope.statData[i][9].slice(5, 7) - 1] += +$scope.statData[i][1];
                        tmpObj.monthcount[+$scope.statData[i][9].slice(5, 7) - 1]++;
                        tmpObj.surfacedist[0] += +$scope.statData[i][1] / 100 * +$scope.statData[i][10];
                        tmpObj.surfacedist[1] += +$scope.statData[i][1] / 100 * +$scope.statData[i][11];
                        tmpObj.surfacedist[2] += +$scope.statData[i][1] / 100 * +$scope.statData[i][12];
                        tmpObj.surfacedist[3] += +$scope.statData[i][1] / 100 * +$scope.statData[i][13];
                    }
                }


                tmpObj.avgtime = secInTime(tmpObj.time / tmpObj.count);
                tmpObj.time = secInTime(tmpObj.time);
                tmpObj.avgdist = tmpObj.dist / tmpObj.count;
                tmpObj.avgspd = (tmpObj.dist * 3600 / timeInSec(tmpObj.time[0] + ':' + tmpObj.time[1] + ':' + tmpObj.time[2])).toFixed(2);
                tmpObj.avgpls = tmpObj.avgpls[0] / tmpObj.avgpls[1];

                var distmax = Math.max.apply(null, tmpObj.monthdist);
                for (i = 0; i < tmpObj.monthdist.length; i++) {
                    tmpObj.monthperc[i] = tmpObj.monthdist[i] * 100 / distmax;
                }

                for (i = 0; i < tmpObj.surfacedist.length; i++) {
                    tmpObj.surfaceperc[i] = tmpObj.surfacedist[i] * 100 / tmpObj.dist;
                }

                (tmpObj.last[1] > tmpObj.avgdist) ? (tmpObj.last[7] = ['green', '▲']) : (tmpObj.last[1] == tmpObj.avgdist) ? (tmpObj.last[7] = ['#cc7a00', '⊗']) : (tmpObj.last[7] = ['red', '▼']);
                (tmpObj.last[2] > tmpObj.avgspd) ? (tmpObj.last[8] = ['green', '▲']) : (tmpObj.last[2] == tmpObj.avgspd) ? (tmpObj.last[8] = ['#cc7a00', '⊗']) : (tmpObj.last[8] = ['red', '▼']);
                (tmpObj.last[3] > tmpObj.avgpls) ? (tmpObj.last[9] = ['red', '▲']) : (tmpObj.last[3] == tmpObj.avgpls) ? (tmpObj.last[9] = ['#cc7a00', '⊗']) : (tmpObj.last[9] = ['green', '▼']);
                return tmpObj;
            };
        return tmpArr10;
        };

        function tehCorr() {
            var cnt = 0;
        for (i = 0; i < $scope.statEnhanced.length-1; i++) {
            for (z=0; z<$scope.tehArr.length; z++) {
                if ($scope.statEnhanced[i].namets == $scope.tehArr[z][2]) {
                    $scope.statEnhanced[i].tehnote = [$scope.tehArr[z][1], $scope.tehArr[z][3], $scope.tehArr[z][0], $scope.tehArr[z][2]];
                    cnt++;
                    if(cnt == 1) $scope.statEnhanced[$scope.statEnhanced.length-1].tehnote = [$scope.tehArr[z][1], $scope.tehArr[z][3], $scope.tehArr[z][0], $scope.tehArr[z][2]];
                    break;
                }
            }
        };
        };

        function odoChart(cyear) {
            var data = [];
            var date;
            for(i=0;i<$scope.statData.length;i++) {
                if ($scope.statData[i][9] != date) {
                    var yr = +$scope.statData[i][9].substr(0,4);
                    if (yr != cyear) continue;
                    var m = +$scope.statData[i][9].substr(5,2);
                    var d = +$scope.statData[i][9].substr(8,2);
                    data.push([Date.UTC(yr, m-1, d), +$scope.statData[i][1]]);
                    date = $scope.statData[i][9];
                }
                else {
                    data[data.length-1][1] += +$scope.statData[i][1];
                }
            };
            return data;
        };

    });