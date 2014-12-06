<?php

function __autoload($class) {
    if (file_exists($class)) {
        include strtolower($class) . '.php';
    } elseif('test/' . strtolower($class) . '.php') {
        include 'test/' . strtolower($class) . '.php';
    }
}

class Test {

    function __construct() {
        $mulai = new Mulai();
        $mulai->test();
    }

}

$obj = new Test();
