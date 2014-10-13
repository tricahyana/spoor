<?php

/**
 * Berfungsi sebagai pembuat objek dari sebuah class.
 * <br>
 * Parameter $path digunakan untuk mengarahkan dimana letak folder dari file tersebut.
 * Jika file yang dimaksud berada satu folder dengan file pengeksekusinya maka 
 * parameter ini tidak perlu diisi. 
 */
function create_object($class, $path) {
    if (file_exists($path . $class . EXT)) {
        include $path . $class . EXT;
        if (class_exists($class)) {
            return new $class();
        } else {
            exit("No Class " . ucfirst($class) . " Found!");
        }
    } else {
        exit("No File " . $class . EXT . " Found  in " . $path . "!");
    }
}

/*
 * Berfungsi untuk mendapatkan route CRUD secara otomatis 
 */

function resources($controller, &$route) {
    $route['GET'][$controller . '/'] = $controller . '/index';
    $route['GET'][$controller . '/$1'] = $controller . '/show/$1';
}

function __autoload($class) {
    $class = strtolower($class);

    if (file_exists(SYS . $class . EXT)) {
        include SYS . $class . EXT;
    } elseif (file_exists(LIBRARY . $class . '/' . $class . EXT)) {
        include LIBRARY . $class . '/' . $class . EXT;
    } elseif (file_exists(CONTROLLER . $class . EXT)) {
        include CONTROLLER . $class . EXT;
    } else {
        require MODEL . $class . EXT;
    }
}

function is_common_loaded() {
    return 'true';
}
