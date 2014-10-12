<?php

/**
 * Description of view
 *
 * @author tricahyana
 */
class view {

    public function __construct() {  
    }

    public function load_view($controller_name, $view_name, $view_data) {
        /*
         * Memecah data array dari controller untuk dipakai di view
         */
        foreach ($view_data as $key => $value) {
            $$key = $value;
        }

        /*
         * Menampilkan view secara otomatis berdasarkan nama method
         */
        if (file_exists(VIEW . $controller_name . "/" . $view_name . EXT)) {
            include VIEW . $controller_name . "/" . $view_name . EXT;
        } else {
            exit("View " . $controller_name . "/" . $view_name . EXT . " not Found!");
        }
    }

}
