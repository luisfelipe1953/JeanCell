<?php

namespace Controller;

use Model\adminVentas;
use Model\ventas;
use MVC\Router;

class adminController
{
    public static function index(Router $router)
    {
        session_start();
        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        
        if(!checkdate( $fechas[1], $fechas[2], $fechas[0])){
            header("Location: /404");
        }

        $consulta = "SELECT ventas.id, CONCAT(usuarios.nombre,' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, productos.nombre, productos.precio, ventasproductos.cantidad  ";
        $consulta .= " FROM ventas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON ventas.usuario_id=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN ventasproductos ";
        $consulta .= " ON ventasproductos.venta_id=ventas.id ";
        $consulta .= " LEFT OUTER JOIN productos ";
        $consulta .= " ON productos.id=ventasproductos.producto_id ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $ventas = adminVentas::SQL($consulta);


        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'ventas' => $ventas,
            'fecha' => $fecha
        ]);
    }

    public static function eliminarCita(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $venta = ventas::find($id);
            $venta->eliminar();
            header("Location:" . $_SERVER['HTTP_REFERER']);

        }
    }
}
