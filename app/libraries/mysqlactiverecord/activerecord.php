<?php

class Activerecord {

    public function __construct() {
        require_once 'php-activerecord/ActiveRecord.php';

        ActiveRecord\Config::initialize(function($cfg) {
            $cfg->set_model_directory(MODEL);
            $cfg->set_connections(array(
                ENV => 'mysql://username:password@localhost/database_name'));
        });
    }

    public static function select() {
        
    }

}
