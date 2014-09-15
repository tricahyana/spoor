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