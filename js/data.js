/**
 * Created by fg on 14.02.17.
 */

function fillCells() {
    var curDate = new Date;
    curDate.getFullYear();
    $('#form1day').attr('value', curDate.getDate());
    $('#form1year').attr('value', curDate.getFullYear());


    $('#form1m'+curDate.getMonth()).attr('selected', 'selected');

    $('#form1asf').focus(function(){sumPercs();});
    $('#form1asf').focusout(function(){sumPercs();});
    $('#form1tvp').focus(function(){sumPercs();});
    $('#form1tvp').focusout(function(){sumPercs();});
    $('#form1grnt').focus(function(){sumPercs();});
    $('#form1grnt').focusout(function(){sumPercs();});
    $('#form1bzd').focus(function(){sumPercs();});
    $('#form1bzd').focusout(function(){sumPercs();});

    $('#form1avgspd').focus(function(){
        avgSpdIn();
    });
}

function sumPercs(){
    $('#sumsrf').text(+$('#form1asf').val() + +$('#form1tvp').val() + +$('#form1grnt').val() + +$('#form1bzd').val() + '%');
    if ($('#sumsrf').text() == '100%') $('#sumsrf').attr('style', 'color: green;');
    else $('#sumsrf').attr('style', 'color: red;');
};

function avgSpdIn() {
    if ((+$("#form1dist").val()>0) && ((+$("#form1hr").val()>0) || (+$("#form1min").val()>0) || (+$("#form1sec").val()>0))) {
        var sec = $("#form1sec").val();
        var min = $("#form1min").val();
        var hr = $("#form1hr").val();
        var dst = $("#form1dist").val();
        res = dst /(+sec+ +min*60 + +hr*3600)*3600;
        $("#form1avgspd").val(res.toFixed(2));
    };
};
