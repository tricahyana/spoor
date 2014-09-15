<?php

/* $ext = ".php";
  $array = explode('/', $_SERVER['REQUEST_URI']);

  if(file_exists('app/controllers/' . $array[2] . $ext)){
  include 'app/controllers/' . $array[2] . ".php";
  $controllers = new Welcome();
  $controllers->$array[3]();
  include 'app/views/' . $array[2] . "/" . $array[3] . $ext;

  }else{
  die('Tidak ada');
  } */

class Router {

    private $url_request = Array();
    private $controllers;
    private $method;
    private $params = Array();

    /**
     * Memecah terlebih darhulu url yang diakses
     */
    public function __construct() {
        require CONFIG . "router" . EXT;

        $this->url_request = explode('/', $_SERVER['REQUEST_URI']);

        /*
         * Jika pengguna memanggil root dari website, maka akan memanggil halaman
         * default yang telah didefinisikan pada file route.php
         */
        if ($this->url_request[2] != '') {
            $this->controllers = $this->url_request[2];
        } else {
            $this->controllers = $route['_default_'];
        }

        /*
         * Menyimpan nama method dari url yang dimasukan
         */
        if (!is_null(@$this->url_request[3])) {
            $this->method = $this->url_request[3];
        } else {
            $this->method = '';
        }

        /*
         * Menyimpan paramater dari url yang dimasukan
         */
        for($i = 0; ($i+4) <= (count($this->url_request) - 1); $i++) {
            if (!is_null(@$this->url_request[($i+4)])) {
                $this->params[$i] = $this->url_request[($i+4)];
            }else{
                break;
            }
        }

        /*
         * 
         */
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->chek_route('GET');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->chek_route('POST');
        }
    }

    /**
     * Fungsi ini khusus untuk mencek route yang akan pertamakali diekseskusi 
     * oleh constructor
     */
    private function chek_route($request_method) {
        require CONFIG . "router" . EXT;

        /*
         * Untuk mencek apakah ada routing external dari file router.php di 
         * config.
         */
        foreach ($route[$request_method] as $key => $value) {
            /*
             * Jika terdapat routing external dari file route.php maka akan
             * dilakukan pengarahan file sesuai dengan yang ada di file route.php
             */
            if ($key == ($this->controllers . "/" . $this->method)) {
                $uri = explode('/', $value);
                $this->controllers = $uri[0];
                $this->method = $uri[1];
                break;
            }
        }
    }

    /**
     * Fungsi untuk mendapatkan nama dari controller yang diakses
     */
    public function get_controller() {
        return (string)$this->controllers;
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
