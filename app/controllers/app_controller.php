<?php

Class App_controller {

    public function __construct() {
        global $properties;
        $this->params = $properties['parameter'];
        $this->controller = $properties['controller'];
        $this->method = $properties['method'];
    }
    
    public function view($variable){
        return $this->view = $variable;
    }

}
