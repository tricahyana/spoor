<?php

/*
 * Class yang mengatur semuayang berhubungan dengan file.
 */

class File extends Core{

    private $file_path;

    public function __construct() {

    }

    /**
     * Fungsi untuk mendapatkan path dari file controller yang akan diakses.
     * Parameter yang harus dimasukan adalah 
     *  - file_name: Nama file yang hendak diakses.
     *  - kind: Jenis file. ada beberapa jenis file yang telah ditentukan:
     *      - 'controller', Untuk mendapatkan file yang terdapat di Controllers.
     *      - 'model', Untuk mendapatkan file yang terdapat di Models.
     *      - 'library', Untuk mendapatkan file yang terdapat di Libraries.
     *      - 'view', Untuk mendapatkan file yang terdapat di Views.
     */

    public function get_file_path($file_name, $kind) {
        $folder_path = '';

        /*
         * Menentukan alamat folder file yang akan dipanggil
         */
        switch ($kind) {
            case 'controller':
                $folder_path = CONTROLLER;
                break;
            case 'model':
                $folder_path = MODEL;
                break;
            case 'library':
                $folder_path = LIBRARY;
                break;
            case 'view':
                $folder_path = VIEW;
                break;
            default :
                /*
                 * Jika salah memasukan jenis file, maka akan secara defaul
                 * menampilkan error.
                 */
                exit("Error kind of file!");
        }

        /*
         * Memeriksa apakah file yang dimaksud ada atau tidak ada.
         * jika file ditemukan, maka akan mengembalikan nilai berupa
         * alamat dari file tersebut
         */
        if (file_exists($folder_path . $file_name . EXT)) {
            $this->file_path = $folder_path . $file_name . EXT;
            return $this->file_path;
        } else {
            exit("File '" . $file_name . "' Not Found");
            return 0;
        }
    }
}
