<?php

class Users extends App_controller {

    function index() {}

    function show() {
        $user = User::find(1);
        $this->view['id'] = $user->alamat;
    }

    function create() {}

    function _new() {}

    function update() {}

    function _edit() {}

    function delete() {}

}
