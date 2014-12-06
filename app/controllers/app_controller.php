<?php

Class App_controller {

    public $view = Array();

    public function __construct() {
    }
    
    public function view($variable){
        return $this->view = $variable;
    }

}
