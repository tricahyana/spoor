<?php

class Tests extends Application{

    function welcome() {
        $this->view['data'] = Test::nama_saya();
    }
}