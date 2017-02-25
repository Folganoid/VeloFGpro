<?php

/**
 * Created by PhpStorm.
 * User: fg
 * Date: 17.02.17
 * Time: 23:25
 */
class StatDataChange extends Main
{
    public function __construct($id, $uid, $idCell)
    {

        if (isset($_POST['change']) AND $id == $uid) {
            $ts = static::PostSecure($_POST['bike']);
            $prim = static::PostSecure($_POST['prim']);
            $dist = static::PostSecure($_POST['dist']);
            $date = static::PostSecure($_POST['date']);
                $year = substr($date, 0, 4);
                $month = substr($date, 5, 2);
                $day = substr($date, 8, 2);
            $time = static::PostSecure($_POST['time']);
            $avgspd = static::PostSecure($_POST['avgspd']);
            $maxspd = static::PostSecure($_POST['maxspd']);
            $avgpls = static::PostSecure($_POST['avgpls']);
            $maxpls = static::PostSecure($_POST['maxpls']);
            $temp = static::PostSecure($_POST['temp']);
            $asf = +static::PostSecure($_POST['surfasf']);
            $tvp = +static::PostSecure($_POST['surftvp']);
            $grnt = +static::PostSecure($_POST['surfgrnt']);
            $bzd = +static::PostSecure($_POST['surfbzd']);
            $teh = static::PostSecure($_POST['teh']);
            $tires = static::PostSecure($_POST['tires']);


            if (+$asf + +$tvp + +$grnt + +$bzd != 100) {
                MessageShow::set('Сумма значений дорожного покрытия не равняется 100%', 1);
                MessageShow::get();
            }
            else if(!checkdate($month, $day, $year)){
                MessageShow::set('Введена некорректная дата', 1);
                MessageShow::get();
            }

            else {
                $changeCell = new Stat();
                $changeCell->db('UPDATE statdata SET bike = "' . $ts . '", prim = "' . $prim . '", dist = ' . $dist . ', `date` = "' . $date . '", `time` = "' . $time . '", avgspd = ' . $avgspd . ', maxspd = ' . $maxspd . ', avgpls = ' . $avgpls . ', maxpls = ' . $maxpls . ', temp = "' . $temp . '", surfasf = ' . $asf . ', surftvp = ' . $tvp . ', surfgrn = ' . $grnt . ', srfbzd = ' . $bzd . ', teh = "' . $teh . '", tires = "' . $tires . '" WHERE id = ' . $idCell . ';');
                MessageShow::set('Вы успешно изменили запись', 3);
                echo '<script>location.href="/statenhance/'.$idCell.'";</script>';
            }
        }
        if (isset($_POST['change']) AND $id != $uid) {
            MessageShow::set('Вы не можете изменить эту запись', 1);
            MessageShow::get();
        }
        if (isset($_POST['delete']) AND $id == $uid) {

            $deleteCell = new Stat();
            $deleteCell->db('DELETE FROM statdata WHERE id = '.$idCell.';');
            MessageShow::set('Вы успешно удалили запись', 3);
            MessageShow::get();

        }
        if (isset($_POST['delete']) AND $id != $uid) {
            MessageShow::set('Вы не можете удалить эту запись', 1);
            MessageShow::get();
        }

    }
}