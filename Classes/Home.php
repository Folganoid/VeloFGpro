<?php

/**
 * Created by PhpStorm.
 * User: fg
 * Date: 08.03.17
 * Time: 17:40
 */
class Home extends Main
{
    public $userList;

    public function __construct() {
        $this->db("SELECT login FROM `users` ORDER BY login;");
        $this->userList = $this->result;
    }

    public function getUsers() {
        foreach($this->userList as $key=>$value) {
            echo '<dd><a class="userLink" href="/profile/'.$value[0].'">'.$value[0].'</a></dd>';
        }


    }

}