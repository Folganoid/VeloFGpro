var cntr = [51.336389, 33.863056];
if (mapData[0]) cntr = [mapData[0][2], mapData[0][3]];

ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: cntr,
            zoom: 9
        }, {
            searchControlProvider: 'yandex#search'
        });

        for (i = 0; i < mapData.length; i++) {
            myMap.geoObjects
                .add(new ymaps.Placemark([mapData[i][2], mapData[i][3]], {
                    balloonContent: '<h4 align="center">' + mapData[i][4] + '</h4><p>' + mapData[i][5] + '</p>' +
                    '<dd>Координаты: ' + mapData[0][2] + ', ' + mapData[0][3] + '</dd>' +
                    '<dd><a href="' + mapData[i][6] + '" target="_blank">подробнее...</a></dd>'
                }, {
                    preset: 'islands#dotIcon',
                    iconColor: mapData[i][7]
                }));
        };

});
