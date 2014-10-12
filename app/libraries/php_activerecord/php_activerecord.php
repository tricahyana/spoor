<?php

require_once 'ActiveRecord.php';

class Php_activerecord {

    public function __construct() {
       
        ActiveRecord\Config::initialize(function($cfg) {
            require APP_CONFIG;
            $database = $config['database'];
            
            $cfg->set_model_directory(MODEL);
            $cfg->set_connections(array(
                "development" => $database['driver'] . '://'. $database['user'] .':'. $database['password'] .'@'. $database['host'] .'/'. $database['database']));
        });
    }
}
