<?php

class Controller {

    private $router;
    private $controller_obj;
    private $controller_name;
    private $method_name;
    private $view_obj;

    /**
     * Memanggil controller
     * @param type $controller
     * @return type
     */
    public function load_controller($controller) {
        include CONTROLLER . "app_controller" . EXT;
        $this->controller_obj = new $controller();
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
    public function load() {
        $this->get_router();
        $method = $this->router->get_method();
        $params = $this->router->get_params();
        $controller = $this->router->get_controller();

        include CONFIG . "app" . EXT;
        /*
         * Jika method tidak dipanggil di url maka akan secara default
         * memanggil method index
         */
        if ($method == "") {
            $method = "index";
        }
        $this->method_name = $method;

        /*
         * Memerksa jika controller belum diload
         */
        if ($controller != '') {
            $this->load_controller($controller);
        }

        /*
         * Me-load fungsi-fungsi model
         */
//        $this->controller_obj->model = create_object('model', SYS);

        /**
         * Auto load library berdasarkan file config
         */
//        for ($i = 2; $i <= (count(scandir(LIBRARY)) - 1); $i++) {
//            $dir = scandir(LIBRARY)[$i];
//            /*
//             * Meng-include semua file *.(#EXT) yang terdapat didalam folder library
//             */
//            for ($j = 2; $j <= (count(glob(LIBRARY . $dir . "/*" . EXT)) - 1); $j++) {
//                $library_ = $dir . "/" . scandir(LIBRARY . $dir)[$j];
//                /*
//                 * Mencek apakah file yang dimaksud ada atau tidak
//                 */
//                if (file_exists(LIBRARY . $library_)) {
//
//                    /*
//                     * Menghilangkan extensi agar didapat nama file yang digunakan
//                     * untuk membuat objek
//                     */
//                    $library_ = str_replace(EXT, '', scandir(LIBRARY . $dir)[$j]);
//                    $library = create_object($library_, LIBRARY . $dir . "/");
//                    $this->controller_obj->$library_ = $library;
//                } else {
//                    exit("Library $library_ not Found! " . LIBRARY . $library_);
//                }
//            }
//        }

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
         * Load View
         */
        $this->view_obj = create_object("view", SYS);
        $this->view_obj->load_view($this->controller_name, $this->method_name, $this->controller_obj->view);
    }

    public function get_router() {
        $this->router = new Router();
        $this->router->load();
    }

//    public function load_view($view_data, $view_name = null) {
//        /*
//         * Memecah data array dari controller untuk dipakai di view
//         */
//        foreach ($view_data as $key => $value) {
//            $$key = $value;
//        }
//
//        /*
//         * Menampilkan view secara otomatis berdasarkan nama method
//         */
//        if (file_exists(VIEW . $this->controller_name . "/" . $this->method_name . EXT)) {
//            include VIEW . $this->controller_name . "/" . $this->method_name . EXT;
//        } else {
//            exit("View " . $this->controller_name . "/" . $this->method_name . EXT . " not Found!");
//        }
//    }
}
