<?php

namespace Controller;

error_reporting(E_ALL);
ini_set("display_errors", 1);

use MVC\Router;
use Model\productos;
use Model\ventas;
use Model\ventasproductos;


class paginasController
{
    public static function index(Router $router)
    {   
        
        $productos = productos::all();
    
        if (isset($_POST['carrito'])) {
            
            switch ($_POST['carrito']) {

                case 'agregar':

                    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                        $id = openssl_decrypt($_POST['id'], COD, KEY);
                    }
                    if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                        $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                    }
                    if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                        $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                    }
                    if (is_numeric($_POST['cantidad'])) {
                        $cantidad = $_POST['cantidad'];
                    }
                    if(isAuth()){
                        productos::addProductos($id, $nombre, $precio, $cantidad);
                    }
                    break;
            }
        }

        $router->render('paginas/index', [
            'productos' => $productos,

        ]);
    }

    public static function detalles(Router $router)
    {
        $id = validarORedireccionar('/');

        if ($id) {
            $producto = productos::find($id);
        } else {
            debuguear('error al procesar la peticion');
        }
        if (isset($_POST['carrito'])) {

            switch ($_POST['carrito']) {

                case 'agregar':

                    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                        $ID = openssl_decrypt($_POST['id'], COD, KEY);
                    }
                    if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                        $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                    }
                    if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                        $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                    }
                    if (is_numeric($_POST['cantidad'])) {
                        $cantidad = $_POST['cantidad'];
                    }
                    isAuth();
        
                    productos::addProductos($ID, $nombre, $precio, $cantidad);

                    break;
            }
        }
        $router->render('paginas/detalles', [
            'producto' => $producto,
        ]);
    }

    public static function mostrarCarrito(Router $router)
    {   
        isAuth();
        if (isset($_POST['carrito'])) {

            switch ($_POST['carrito']) {

                case 'eliminar':

                    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                        $id = openssl_decrypt($_POST['id'], COD, KEY);

                        productos::deleteProduct($id);
                    }
                    break;
            }
        }
        $router->render('paginas/mostrarCarrito', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }

    public static function pagar(Router $router)
    {

        $venta = new ventas();
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $total = 0;
            $sessionId = session_id();

            foreach ($_SESSION['carrito'] as $key => $producto) {
                $total = $total + ($producto['precio'] * $producto['cantidad']);
            }

            $venta->claveTransaccion = $sessionId;
            $venta->email = $_POST['email'];
            $venta->total = $total;
            $venta->usuario_id = $_SESSION['id'];
            
            if($_SESSION['login'] == true){
                $resultado = $venta->guardar();
                $id = $resultado['id'];
                
    
                foreach ($_SESSION['carrito'] as $key => $producto) {
                    $args = [
                        'venta_id' => $id,
                        'producto_id' => $producto['id'],
                        'precio_unitario' => $producto['precio'],
                        'cantidad' => $producto['cantidad'],
                    ];
                    $ventasproductos = new ventasproductos($args);
                    $ventasproductos->guardar();
                }
            }
        }
        $router->render('paginas/pagar', [
            'total' => $total
        ]);
    }

    public static function descuento(Router $router){
        $consulta = " SELECT productos.id, productos.precio, productos.imagen, productos.descuento, ";
        $consulta .= " categorias.nombre_categoria, productos.nombre ";
        $consulta .= " FROM ";
        $consulta .= " categorias LEFT OUTER JOIN productos ON productos.categoria_id=categorias.id ";
        $consulta .= " WHERE descuento ORDER BY descuento DESC";

        $productos = productos::SQL($consulta);
       
        $router->render('paginas/descuento', [
            'productos' => $productos
        ]);
    }
}
