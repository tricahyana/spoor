<?php


class Core {

    private $controller;
    private $model;
    private $router;

    public function __construct() {
    }

    public function init() {
        $this->get_router();

        $this->get_controller();
//        $this->controller->load($this->router->get_controller());
        $this->controller->load_method($this->router->get_method(), $this->router->get_params(), $this->router->get_controller());
    }

    public function get_router() {
        return $this->router = create_object("router", SYS);
    }

    public function get_controller() {
        return $this->controller = create_object("controller", SYS);
    }
}
