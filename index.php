<?php

/*
 * Mendefinisikan apakah aplikasi ini dalam tahap yang mana.
 * Pilihannya:
 *  - development
 *  - production
 */
define("ENV", "development");

/*
 * Mendefinisikan Extensi dari file yang akan diload diantaranya Controller, View,
 * Model dan file-file lain yang digunakan di Spoor
 */
define("EXT", ".php");

/*
 * Nama root folder dari Controller, View, Model dan Library
 */
define("APP", "app/");

/*
 * Nama folder tempat menyimpan file-file controller
 */
define("CONTROLLER", APP . "controllers/");

/*
 * Nama folder tempat menyimpan file-file model
 */
define("MODEL", APP . "models/");

/*
 * Nama folder tempat menyimpan file-file view
 */
define("VIEW", APP . "views/");

/*
 * Nama folder tempat menyimpan file-file library
 */
define("LIBRARY", APP . "libraries/");

/*
 * Nama folder tempat menyimpan file-file config
 */
define("CONFIG", "config/");

/*
 * Nama folder tempat menyimpan file-file config
 */
define("APP_CONFIG", CONFIG . "app" . EXT);

/*
 * Nama root foler dari file-file system Spoor
 */
define("SYS", "spoor/sys/");

include CONFIG . 'const' . EXT;
include SYS . "common" . EXT;
include SYS . "controller" . EXT;

if (!php_sapi_name() == 'cli')
{
    $controller = new Controller();
    $controller->load();
}








