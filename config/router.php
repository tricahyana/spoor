<?php

/*
 * File ini berisi konfigurasi route.
 * $route['_dafault_'] merupakan route default ketika user mengakses root dari
 * website. wajib diisi!
 * 
 * Untuk menambahkan route baru ketikan 
 *      $route['#request_method']['#route'] = #controller yang akan dipanggil
 */

/*
 * Wajib diisi!
 * 
 * Halaman default ketika user mengakses root website
 */
$route['_default_'] = 'users/index';

$route['GET']['users/tampil'] = "users/index";

$route['GET']['users/get'] = "users/create";

resources(['users', 'article', 'news'], $route);
