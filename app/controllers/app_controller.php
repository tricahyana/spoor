<?php

Class App_controller {

    public $view = Array();
    public $library;

    public function __construct() {

//
//        /*
//         * Auto load model 
//         */
//        for ($i = 2; $i <= (count(scandir(MODEL)) - 1); $i++) {
//            $result = scandir(MODEL)[$i];
//
//            if (file_exists(MODEL . $result)) {
//                include MODEL . $result;
//            } else {
//                exit("Model $result not Found! " . MODEL . $result);
//            }
//        }
//        $this->load_library();
//        set_include_path('')
//        spl_autoload_extensions(".php"); // comma-separated list
//        spl_autoload_register();
    }

    public function load_library() {
        include APP_CONFIG;
        $this->library = create_object('library', SYS);

        foreach ($config['library']['auto_load'] as $value) {
            $this->$value = $this->library->load($value);
        }
    }
    
    public function view($variable){
        return $this->view[key($variable)] = $variable;
    }

}
