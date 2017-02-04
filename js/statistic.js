angular
    .module('app',[])

    .controller('MainCtrl', function($scope){
        $scope.curYear = 2016;
        $scope.yearData = jsonYearData;
        $scope.statData = jsonStatData;

        for ( i=0; i < $scope.statData.length; i++ ) { // объединяет две базы в  общий массив одо
            var exist = 0;
            for ( z=0; z < $scope.yearData.length; z++ ) {
                if(($scope.statData[i][9].slice(0,4) == $scope.yearData[z][0]) && ($scope.statData[i][3] == $scope.yearData[z][1])) {
                    $scope.yearData[z][2] = +$scope.yearData[z][2] + +$scope.statData[i][1];
                    exist = 1;
                }
            };
            if (exist == 0) $scope.yearData.push([$scope.statData[i][9].slice(0,4), $scope.statData[i][3], $scope.statData[i][1]]);
        };


        $scope.OdoArr = createOdoArr($scope.yearData);
        $scope.highCh = (createHighChartsOdo($scope.OdoArr));
        $scope.odoTotal = [];

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

        Highcharts.chart('odoTot', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'КИЛОМЕТРАЖ'
            },
            subtitle: {
                text: 'ПО КАЖДОМУ ТС'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: false
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Общий накат составляет: <b>{point.y:.1f} км</b>'
            },
            series: [{
                name: 'ТС',
                data: $scope.odoTotal,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });


        Highcharts.chart('odograph', { // график общего наката

            //colors: ['darkred', 'darkblue', 'darkgreen', '#800080', '#808000','#008ab2' ,'#b25c00' ],

            title: {
                text: 'КИЛОМЕТРАЖ',
                x: -20 //center
            },
            subtitle: {
                text: 'ПО ГОДАМ',
                x: -20
            },
            xAxis: {
                categories: $scope.highCh[1]
            },
            yAxis: {
                title: {
                    text: 'Километры'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' км'
            },
            series: $scope.highCh[0]
        });

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

        function createHighChartsOdo(arr) { // создает массив под график
            var tmpArr = [];
            var tmpArrX = [];
            var tmpArrNames = [];

            for ( i = 0 ; i < arr.length ; i++ ) {
                tmpArrX.push(arr[i][0]);
                for ( z = 0 ; z< arr[i][1].length ; z++ ) {
                }
            };

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
                        if(tmpArr[i].name == arr[s][1][z][0]) tmpArr[i].data[s] = +arr[s][1][z][1];
                        sum += +arr[s][1][z][1];
                    }
                    tmpArr[tmpArr.length-1].data[s] = sum;
                }
            }

            return [tmpArr, tmpArrX];
        };

        function unique(arr) { // отсеивает уникальные значения
            var obj = {};

            for (var i = 0; i < arr.length; i++) {
                var str = arr[i];
                obj[str] = true; // запомнить строку в виде свойства объекта
            }

            return Object.keys(obj); // или собрать ключи перебором для IE8-
        };

    });