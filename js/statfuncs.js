function unique(arr) { // отсеивает уникальные значения
    var obj = {};

    for (var i = 0; i < arr.length; i++) {
        var str = arr[i];
        obj[str] = true; // запомнить строку в виде свойства объекта
    }

    return Object.keys(obj); // или собрать ключи перебором для IE8-
};

function highChartOdo(arr) { // график наката по годам
    Highcharts.chart('odograph', {
        colors: ['darkred', 'darkblue', 'darkgreen', 'BlueViolet ', 'Chocolate', 'DarkSlateGrey', 'Red ', 'DimGrey', 'Blue', 'Green'],
        chart: {
            type: 'spline'
        },
        title: {
            text: 'КИЛОМЕТРАЖ',
            x: -20 //center
        },
        subtitle: {
            text: 'ПО ГОДАМ',
            x: -20
        },
        xAxis: {
            categories: arr[1]
        },
        yAxis: {
            title: {
                text: false
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
        series: arr[0]
    });
};

function highChartTotalOdo(arr) {

    Highcharts.setOptions({
        colors: ['darkred']
    });

    $('#distgraph').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'ОБЩИЙ НАКАТ'
        },
        subtitle: {
            text: 'Годовая диаграмма (Дистанция / Дата)'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Дата'
            }
        },
        yAxis: {
            title: {
                text: 'Километры'
            },
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} км'
        },

        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },

        series: [{
            name: 'Расстояние',
            // Define the data points. All series have a dummy year
            // of 1970/71 in order to be compared on the same x axis. Note
            // that in JavaScript, months start at 0 for January, 1 for February etc.
            data: arr
        }]
    });
};

function pulsechart(arr) {
    $('#plschart').highcharts({
        colors: ['darkred', 'darkblue', 'darkgreen', '#4C0B5F', '#2E2E2E', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
        chart: {
            type: 'spline'
        },
        title: {
            text: 'СРЕДНИЙ ПУЛЬС'
        },
        subtitle: {
            text: 'Годовая диаграмма (Средний пульс / Дата)'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Дата'
            }
        },
        yAxis: {
            title: {
                text: 'Ударов в минуту'
            },
            min: 100
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} уд/мин'
        },

        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },

        series: arr
    });
};


function avgsSpeedChart(arr) {
    $('#avgspdchart').highcharts({
        colors: ['darkred', 'darkblue', 'darkgreen', 'BlueViolet ', 'Chocolate', 'DarkSlateGrey', 'Red ', 'DimGrey', 'Blue', 'Green'],
        chart: {
            type: 'spline'
        },
        title: {
            text: 'СРЕДНЯЯ СКОРОСТЬ'
        },
        subtitle: {
            text: 'Годовая диаграмма (Средняя скорость / Дата)'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Дата'
            }
        },
        yAxis: {
            title: {
                text: 'Скорость (км/ч)'
            },
            min: 10
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} км/ч'
        },

        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },

        series: arr
    });
};

function highChartOdoTotal(arr) { // график общего наката по тс
    Highcharts.chart('odoTot', {

        colors: ['darkred'],

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
                rotation: -90,
                style: {
                    fontSize: '8px',
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
            data: arr,
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
};

function timeInSec(str) {
    var hr = +str.substr(0,2);
    var min = +str.substr(3,2);
    var sec = +str.substr(6,2);
    return sec+min*60+hr*3600;
};

function secInTime(cnt) {
    var sec = (cnt%60);
    var min = ((cnt-sec)/60)%60;
    var hr = (cnt-sec-min*60)/3600;

    if(+sec < 10) {sec = "0"+sec};
    if(+min < 10) {min = "0"+min};
    if(+hr < 10) {hr = "0"+hr};
    return [hr, min, (sec+"").substr(0,2)];
};