/* =============== for Yandex Map API

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
 var a = (mapData[i][6] != "") ? "" : "hide";
 myMap.geoObjects
 .add(new ymaps.Placemark([mapData[i][2], mapData[i][3]], {
 balloonContent: '<h4 align="center">' + mapData[i][4] + '</h4><p>' + mapData[i][5] + '</p>' +
 '<dd>Координаты: ' + mapData[i][2] + ', ' + mapData[i][3] + '</dd>' +
 '<dd><a class="'+ a +'" href="' + mapData[i][6] + '" target="_blank">подробнее...</a></dd>'
 }, {
 preset: 'islands#dotIcon',
 iconColor: mapData[i][7]
 }));
 };

 });
 */

// Google Map API CODE - AIzaSyDEF7mhKBOcKf3DOomC3CPSq8htToAlZ84

var windowHeight = (window.innerHeight > 350) ? window.innerHeight - 270 : 200;
$('#map').attr('style', 'weight: 100%; height: '+ windowHeight +'px');

    function initMap() {

        var curM;
        var cntr = {lat: 51.336389, lng: 33.863056};

        if (mapData.length > 0) {
            cntr = {lat: +mapData[0][2], lng: +mapData[0][3]}
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: cntr
        });

        for (i = 0; i < mapData.length; i++) {
            window['marker' + i] = new google.maps.Marker({
                map: map,
                animation: google.maps.Animation.DROP,
                position: {lat: +mapData[i][2], lng: +mapData[i][3]},
                title: mapData[i][4],
                icon: '../img/' + mapData[i][7] + '-dot.png'
            });

            addMarker(window['marker' + i], i);
        }

        function addMarker(vr, cnt) {

            vr.addListener('click', function () {
                function toggleBounce() {
                    if (curM) window['marker' + curM].setAnimation(null);
                    if (vr.getAnimation() !== null) {
                        vr.setAnimation(null);
                    } else {
                        vr.setAnimation(google.maps.Animation.BOUNCE);
                    }
                }

                function showLocation() {
                    $('#map_info').attr('class', '');
                    $('#map_name').text(mapData[cnt][4]);
                    $('#map_notice').text(mapData[cnt][5]);
                    $('#map_cord').text(mapData[cnt][2] + ', ' + mapData[cnt][3]);
                    $('#map_link').attr('href', mapData[cnt][6]);
                    $('#map_edit').attr('href', '/markers/' + mapData[cnt][0]);
                }

                toggleBounce();
                showLocation();
                curM = cnt;
            });
        }
    }




