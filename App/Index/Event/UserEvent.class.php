<?php
namespace Index\Event;
use Think\Action;

class UserEvent {
    public function login(){
        echo 'login event';
    }
    public function logout(){
        echo 'logout event';
    }
}