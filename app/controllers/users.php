<?php

class Users extends App_controller {

    function index($id) {
     echo $id;
     echo $this->params[1];
     echo $this->controller;
     echo $this->method;
     $this->view['id'] = $id;
    }

    function show() {
        $user = User::find(1);
        $this->view['id'] = $user->alamat;
    }

    function create() {
        print_r($this->params);
    }

    function _new() {}

    function update() {}

    function _edit() {}

    function delete() {}

}
