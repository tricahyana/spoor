<?php

class Router {

    private $url_request = Array();
    private $controller;
    private $method;
    private $params = Array();

    public function __construct() {
        $this->load();
    }

    /**
     * Memecah terlebih darhulu url yang diakses
     */
    public function load() {
        require CONFIG . "router" . EXT;

        $this->_get_url_request();

        $this->_set_controller();

        $this->_set_method();

        $this->_set_param();

        /*
         * Jika ternyata terdapat settingan di route maka akan merubah
         * method name dan class name
         */
        $this->_check_route($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Fungsi ini khusus untuk mencek route yang akan pertamakali diekseskusi 
     * oleh constructor
     */
    private function _check_route($request_method) {
        require CONFIG . "router" . EXT;

        /*
         * Untuk mencek apakah ada routing external dari file router.php di 
         * config.
         */
        if (isset($route[$request_method])) {
            foreach ($route[$request_method] as $key => $value) {
                /*
                 * Jika terdapat routing external dari file route.php maka akan
                 * dilakukan pengarahan file sesuai dengan yang ada di file route.php
                 */
                if ($key == ($this->controllers . "/" . $this->method)) {
                    $uri = explode('/', $value);
                    $this->_set_controller($uri[0]);
                    $this->_set_method($uri[1]);
                    break;
                }
            }
        }
    }

    private function _get_url_request() {
        $this->url_request = explode('/', $_SERVER['REQUEST_URI']);
    }

    /**
     * Jika pengguna memanggil root dari website, maka akan memanggil halaman
     * default yang telah didefinisikan pada file route.php.
     * <br>
     * Jika parameter $controller diisi, maka akan meload controller
     * berdasarkan controller yang dipanggil jika tidak maka akan meload
     * controller dari url
     */
    private function _set_controller($controller = null) {
        if ($controller == null) {
            if ($this->url_request[2] != '') {
                $this->controller = $this->url_request[2];
            } else {
                $uri = explode('/', $route['_default_']);
                $this->controller = $uri[0];
                $this->method = (isset($uri[1])) ? $uri[1] : "";
            }
        } else {
            $this->controller = $controller;
        }
    }

    /**
     * Menyimpan nama method dari url yang dimasukan
     * Jika parameter $method diisi, maka akan meload method
     * berdasarkan method yang dipanggil jika tidak maka akan meload
     * method dari url
     */
    private function _set_method($method = null) {
        if (is_null($method)) {
            if (!is_null(@$this->url_request[3])) {
                $this->method = $this->url_request[3];
            } else {
                $this->method = '';
            }
        } else {
            $this->method = $method;
        }
    }

    /**
     * Menyimpan paramater dari url yang dimasukan
     */
    private function _set_param() {
        for ($i = 0; ($i + 4) <= (count($this->url_request) - 1); $i++) {
            if (!is_null(@$this->url_request[($i + 4)])) {
                $this->params[$i] = $this->url_request[($i + 4)];
            } else {
                break;
            }
        }
    }

    /**
     * Fungsi untuk mendapatkan nama dari controller yang diakses
     */
    public function get_controller() {
        return $this->controller;
    }

    /**
     * Fungsi untuk mendapatkan nama dari method yang diakses
     */
    public function get_method() {
        return $this->method;
    }

    /**
     * Fungsi untuk mendapatkan parameter
     */
    public function get_params() {
        return $this->params;
    }

}
