<?php 

namespace Controller;

use Model\categorias;

class APIController {
    public static function index() {
        $categorias = categorias::all();
        echo json_encode($categorias);
    }
}