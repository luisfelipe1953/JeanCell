<?php

namespace Controller;

use MVC\Router;
use Model\buscador;

class buscadorController
{
    public static function index(Router $router)
    {
        if (isset($_GET['enviar'])) {
            $busqueda = trim(($_GET['busqueda']));
            $palabras = explode(' ', $busqueda);
            $busqueda = implode('%', $palabras);
            if(empty($busqueda)){
                $busqueda = 'null';
            }

            $categoria = $_GET['categoria'] ?? 'null';

            $consulta =  "SELECT productos.id, productos.precio, productos.imagen, productos.descuento, categorias.nombre_categoria, ";
            $consulta .=  "productos.nombre FROM categorias ";
            $consulta .=  "LEFT OUTER JOIN productos ";
            $consulta .=  "ON productos.categoria_id=categorias.id ";
            $consulta .= " WHERE (nombre_categoria LIKE '%${categoria}%') OR concat(' ',nombre, nombre_categoria, descripcion) LIKE '%${busqueda}%'";

            $productos = buscador::SQL($consulta);

        }

        $router->render('templates/buscador', [
            'productos' => $productos
        ]);
    }
}
