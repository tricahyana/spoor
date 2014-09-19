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
        include CONFIG . "app" . EXT;

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

        /**
         * Auto load library berdasarkan file config
         */
        for ($i = 2; $i <= (count(scandir(LIBRARY)) - 1); $i++) {
            $dir = scandir(LIBRARY)[$i];
            /*
             * Meng-include semua file *.(#EXT) yang terdapat didalam folder library
             */
            for ($j = 2; $j <= (count(glob(LIBRARY . $dir . "/*" . EXT)) - 1); $j++) {
                $library_ = $dir . "/" . scandir(LIBRARY . $dir)[$j];
                /*
                 * Mencek apakah file yang dimaksud ada atau tidak
                 */
                if (file_exists(LIBRARY . $library_)) {
                    /*
                     * Menghilangkan extensi agar didapat nama file yang digunakan
                     * untuk membuat objek
                     */
                    //die ($library_) . "<br>";
                    $library_ = str_replace(EXT, '', scandir(LIBRARY . $dir)[$j]);
                    $library = create_object($library_, LIBRARY . $dir . "/");
                    $this->controller_obj->$library_ = $library;
                } else {
                    exit("Library $library_ not Found! " . LIBRARY . $library_);
                }
            }
        }


        /*
         * Auto load model berdasarkan file config
         */
        for ($i = 2; $i <= (count(scandir(MODEL)) - 1); $i++) {
            $result = scandir(MODEL)[$i];

            if (file_exists(MODEL . $result)) {
                include MODEL . $result;
            } else {
                exit("Model $result not Found! " . MODEL . $result);
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
