<?php

/**
 * Created by PhpStorm.
 * User: fg
 * Date: 08.03.17
 * Time: 0:18
 */
class Markers extends Main
{
    public function __construct($idCell, $userid)
    {
        if (isset($_POST['enter']) && ($_POST['id_form'] == "mark") && ($userid == $_SESSION['USER_ID'])) {

            $name = static::PostSecure($_POST['markname']);
            $subname = static::PostSecure($_POST['marksubname']);
            $x = static::PostSecure($_POST['markx']);
            $y = static::PostSecure($_POST['marky']);
            $link = static::PostSecure($_POST['marklink']);
            if (substr($link, 0, 7) == "http://") {
                $link = substr($link, 7);
            }
                if (substr($link, 0, 8) == "https://") {
                    $link = substr($link, 8);
                }
            $link = "http://" . $link;
            $color = static::PostSecure($_POST['markcolor']);

            $this->db('UPDATE markers SET name = "' . $name . '", subname = "' . $subname . '", x = ' . $x . ', y = ' . $y . ', `link` = "' . $link . '", color = "' . $color . '" WHERE id = ' . $idCell . ';');
            MessageShow::set('Запись изменена', 3);
            MessageShow::get();

        };
    }
}