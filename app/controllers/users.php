<?php

class Users extends App_controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $core = new User();
    }

    function show() {
        $user = User::find(1);
        $this->view['id'] = $user->id;
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
