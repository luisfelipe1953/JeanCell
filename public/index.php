<?php 

require_once __DIR__ . '/../includes/app.php';

use Controller\adminController;
use Controller\APIController;
use Controller\buscadorController;
use Controller\categoriasController;
use Controller\LoginController;
use Controller\paginasController;
use Controller\productoController;
use MVC\Router;

$router = new Router();

//principal
$router->get('/',[paginasController::class, 'index']);
$router->post('/',[paginasController::class, 'index']);
$router->get('/detalles',[paginasController::class, 'detalles']);
$router->post('/detalles',[paginasController::class, 'detalles']);;
$router->get('/mostrarCarrito', [paginasController::class, 'mostrarCarrito']);
$router->post('/mostrarCarrito', [paginasController::class, 'mostrarCarrito']);

// descuento
$router->get('/descuento',[paginasController::class, 'descuento']);

// iniciar cesion
$router->get('/login',[LoginController::class, 'login']);
$router->post('/login',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);

// recuperar cuenta
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/recuperar',[LoginController::class, 'recuperar']);
$router->post('/recuperar',[LoginController::class, 'recuperar']);


//crear cuenta
$router->get('/crear-cuenta',[LoginController::class, 'crear']);
$router->post('/crear-cuenta',[LoginController::class, 'crear']);

// confirmacio cuenta
$router->get('/confirmar-cuenta',[LoginController::class, 'confirmar']);
$router->get('/mensaje',[LoginController::class, 'mensaje']);

//pagar 
$router->get('/pagar',[paginasController::class, 'pagar']);
$router->post('/pagar',[paginasController::class, 'pagar']);

//zona privada
$router->get('/admin',[adminController::class, 'index']);
$router->post('/admin',[adminController::class, 'index']);
$router->post('/admin/eliminarCita',[adminController::class, 'eliminarCita']);

//CRUD de productos
$router->get('/productos',[productoController::class, 'index']);
$router->get('/productos/crear',[productoController::class, 'crear']);
$router->post('/productos/crear',[productoController::class, 'crear']);
$router->get('/productos/actualizar',[productoController::class, 'actualizar']);
$router->post('/productos/actualizar',[productoController::class, 'actualizar']);
$router->post('/productos/eliminar',[productoController::class, 'eliminar']);

//buscador 
$router->get('/buscador',[buscadorController::class, 'index']);

//api
$router->get('/api/categorias',[APIController::class, 'index']);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();