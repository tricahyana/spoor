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
$route['_default_'] = 'users/show';
$route['GET']['users/tampil'] = "users/index";

resources(['users', 'article', 'news'], $route);
