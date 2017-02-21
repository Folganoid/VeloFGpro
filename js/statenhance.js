/**
 * Created by fg on 17.02.17.
 */
$('#butchng').click(function(){
    $('.hided').attr('class', 'hided');
    $('#butchng').attr('class', 'hidedon');

});

$('#butcanc').click(function(){
    $('.hided').attr('class', 'hided hidedon');
    $('#butchng').attr('class', '');

});

$('#butdel2').click(function(){
    $('#butdel').attr('class', '');
    $('#butdel2').attr('class', 'hide');
    $('#butdel3').attr('class', '');
});

$('#butdel3').click(function(){
    $('#butdel2').attr('class', '');
    $('#butdel').attr('class', 'hide');
    $('#butdel3').attr('class', 'hide');
});
