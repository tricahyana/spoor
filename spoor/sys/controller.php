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
    public function load_controller($controller)
    {
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
    public function load()
    {
        include APP_CONFIG;
        global $properties;

        $this->get_router();
        $method = $properties['method'] = $this->router->get_method();
        $controller = $properties['controller'] = $this->router->get_controller();
        $params = $properties['parameter'] = $this->router->get_params();


        /*
         * Jika method tidak dipanggil di url maka akan secara default
         * memanggil method index
         */
        if ($method == "")
        {
            $method = "index";
        }
        $this->method_name = $method;

        /*
         * Memerksa jika controller belum diload
         */
        if ($controller != '')
        {
            $this->load_controller($controller);
        }

        /*
         * Jika tidak terdapat parameter, maka method akan langsung dipanggil
         * tanpa mengunakan parameter.
         */
        if (is_array($params))
        {
            call_user_func_array(array($this->controller_obj, $method), $params);
        }
        else
        {
            $this->controller_obj->$method();
        }

        /*
         * Load View
         */
        $this->view_obj = create_object("view", SYS);
        $this->view_obj->load_view($this->controller_name, $this->method_name, $this->controller_obj->view);
    }

    public function get_router()
    {
        $this->router = new Router();
        $this->router->load();
    }

}
