<?php

class Users extends App_controller {

    function __construct() {
        
    }

    function index() {
        $data['hello'] = 'test';
        $this->view($data);
        
    }

    function show() {
        $user = User::find(1);
        $this->view['id'] = $user->alamat;
    }

    function create() {
        
    }

    function _new() {
    }

    function update() {
    }

    function _edit() {
    }

    function delete() {
    }

}
