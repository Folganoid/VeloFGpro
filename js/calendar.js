window.onload = function() {
    var arrCal = [];

    for (i=0; i<jsonStatData.length; i++) {
        arrCal.push([+jsonStatData[i][9].substring(0,4), +jsonStatData[i][9].substring(5,7)-1, +jsonStatData[i][9].substring(8,10)]);
    };

    function Calendar2(id, year, month) {
        var Dlast = new Date(year,month+1,0).getDate(),
            D = new Date(year,month,Dlast),
            DNlast = new Date(D.getFullYear(),D.getMonth(),Dlast).getDay(),
            DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
            calendar = '<tr>',
            month=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
        if (DNfirst != 0) {
            for(var  i = 1; i < DNfirst; i++) calendar += '<td>';
        }else{
            for(var  i = 0; i < 6; i++) calendar += '<td>';
        }

        function valid(dt) {
            for (x=0; x<arrCal.length;x++) {
                if (dt == arrCal[x][2] && D.getFullYear() == arrCal[x][0] && D.getMonth() == arrCal[x][1]) {
                    return x;
                }
            };
            return false;
        };

        for(var  i = 1; i <= Dlast; i++) {

            if ((valid(i) === 0) || (valid(i))){
                calendar += '<td class="today" title="'+jsonStatData[valid(i)][14]+' ('+jsonStatData[valid(i)][1]+' км)"><a style="text-decoration: none; color: white; outline: none;" href="/statistic/'+jsonStatData[valid(i)][0]+'" Target="_blank"><div>' + i +'</div></a></td>';
            }else{
                calendar += '<td>' + i;
            }
            if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
                calendar += '<tr>';
            }
        };

        for(var  i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
        document.querySelector('#'+id+' tbody').innerHTML = calendar;
        document.querySelector('#'+id+' thead td:nth-child(2)').innerHTML = month[D.getMonth()] +' '+ D.getFullYear();
        document.querySelector('#'+id+' thead td:nth-child(2)').dataset.month = D.getMonth();
        document.querySelector('#'+id+' thead td:nth-child(2)').dataset.year = D.getFullYear();
        if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {  // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
            document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
        }
    }
    Calendar2("calendar2", new Date().getFullYear(), new Date().getMonth());
// переключатель минус месяц
    document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(1)').onclick = function() {
        Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)-1);
    }
// переключатель плюс месяц
    document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(3)').onclick = function() {
        Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)+1);
    }
}/**
 * Created by fg on 07.02.17.
 */
