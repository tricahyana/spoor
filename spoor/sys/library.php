<?php

/**
 * Description of library
 *
 * @author tricahyana
 */
class library {

    private $library_name;
    private $library_obj;

    public function __construct() {
        
    }

    public function load($library) {
        $this->library_name = $library;
        $this->library_obj = create_object($library, LIBRARY . $library . "/");
        $this->library_name = $library;
        return $this->library_obj;
    }

}
