<?php

class Controller extends Core {

    private $controller_obj;
    private $controller_name;
    private $method_name;

    /**
     * Memanggil controller
     * @param type $controller
     * @return type
     */
    public function load($controller) {
        include CONTROLLER . "application" . EXT;
        $this->controller_obj = create_object($controller, CONTROLLER);
        $this->controller_name = $controller;
        return $this->controller_obj;
    }

    /**
     * Menjalankan method pada controller.
     * Parameter:
     *  - 'method', Adalah nama mathod yang hendak dieksekusi
     *  - 'params', Adalah parameter dari method dalam bentuk 'array'
     *  - 'controller (optional)', Adalah nama controller dari method yang akan 
     *      dieksekusi jika sebelumnya tidak memanggil fungsi load()
     */
    public function load_method($method, $params, $controller = '') {
        $this->method_name = $method;

        /*
         * Memerksa jika controller belum diload
         */
        if ($controller != '') {
            $this->load($controller);
        }

        /*
         * Me-load fungsi-fungsi model
         */
        $this->controller_obj->model = create_object('model', SYS);

        /*
         * Auto load model berdasarkan file config
         */
        include CONFIG . "app" . EXT;
        for ($i = 2; $i <= (count(scandir(MODEL)) - 1); $i++) {
            $result = str_replace('.php', '', scandir(MODEL)[$i]);

            if (file_exists(MODEL . $result . EXT)) {
                $model = create_object($result, MODEL);
                $this->controller_obj->$result = $model;
            } else {
                exit("Model $result not Found! " . MODEL . $result . EXT);
            }
        }

        /*
         * Jika tidak terdapat parameter, maka method akan langsung dipanggil
         * tanpa mengunakan parameter.
         */
        if (is_array($params)) {
            call_user_func_array(array($this->controller_obj, $method), $params);
        } else {
            $this->controller_obj->$method();
        }

        /*
         * Memecah data array dari controller untuk dipakai di view
         */
        foreach ($this->controller_obj->view as $key => $value) {
            $$key = $value;
        }

        /*
         * Menampilkan view secara otomatis berdasarkan nama method
         */
        if (file_exists(VIEW . $this->controller_name . "/" . $this->method_name . EXT)) {
            include VIEW . $this->controller_name . "/" . $this->method_name . EXT;
        } else {
            exit("View " . $this->controller_name . "/" . $this->method_name . EXT . " not Found!");
        }
    }

}
