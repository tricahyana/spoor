<?php

class Model{

    private $model_obj;
    private $model_name;

    public function __construct() {
    }

    public static function load($model) {
        $this->model_name = $model;
        $this->model_obj = create_object($model, MODEL);
        $this->model_name = $model;
        return $this->model_obj;
    }
}
