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

            $changeCell = new Stat();
            $changeCell->db('UPDATE statdata SET bike = "'.$ts.'", prim = "'.$prim.'", dist = '.$dist.', `date` = "'.$date.'", `time` = "'.$time.'", avgspd = '.$avgspd.', maxspd = '.$maxspd.', avgpls = '.$avgpls.', maxpls = '.$maxpls.', temp = "'.$temp.'", surfasf = '.$asf.', surftvp = '.$tvp.', surfgrn = '.$grnt.', srfbzd = '.$bzd.', teh = "'.$teh.'", tires = "'.$tires.'" WHERE id = '.$idCell.';');

            MessageShow::set('Вы успешно изменили запись', 3);
            MessageShow::get();
            exit();
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