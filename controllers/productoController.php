<?php 

namespace Controller;

use MVC\Router;
use Model\productos;
use Intervention\Image\ImageManagerStatic as Image;
use Model\categorias;

error_reporting(E_ALL);
ini_set("display_errors", 1);


class productoController {
    public static function index(Router $router) {
        isAdmin();
        $productos = productos::all();
        $categorias = categorias::all();

        $router->render('productos/index', [
            'nombre' => $_SESSION['nombre'],
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }
    public static function crear(Router $router) {
        isAdmin();

        $categorias = categorias::all();

        $productos = new productos();

        $alertas = productos::getAlertas();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $productos = new productos($_POST['producto']);
    
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            
            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['producto']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800,600);
                $productos->setimage($nombreImagen);
            }
            
            // Validar
            $alertas = $productos->validar();
    
            if(empty($alertas)) {
                // Crear la carpeta para subir imagenes
                 if(!is_dir(CARPETA_IMAGENES)) {
                     mkdir(CARPETA_IMAGENES);
                }
    
                // // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                // Guarda en la base de datos
                $productos->guardar();

                //redireccionar
                header('location: /productos'); 
                
            }
        }


        $router->render('productos/crear', [
            'nombre' => $_SESSION['nombre'],
            'producto' => $productos,
            'alertas' =>  $alertas,
            'categorias' => $categorias
        ]);
    }
    public static function actualizar(Router $router) {
        isAdmin();
        $id = redireccionar('/admin');
        $alertas = productos::getalertas();
        $productos = productos::find($id);
        $categorias = categorias::all();

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['producto'];
    
            $productos->sincronizar($args);
    
            $alertas = $productos->validar();
    
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            
            if ($_FILES['producto']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800, 600);
                    $productos->setimage($nombreImagen);
            }
            // Revisar que el array de alertas este vacio
    
            if (empty($alertas)) {
                    if ($_FILES['producto']['tmp_name']['imagen']) {
                      //guardar imagen
                      $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
                    $productos->guardar();
                    // Insertar en la base de datos

                    header('location: /productos'); 
                    //redireccionar
            }
    }

        $router->render('productos/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'producto' => $productos,
            'alertas' =>  $alertas,
            'categorias' => $categorias
        ]);
    }
    public static function eliminar(Router $router) {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
            if ($id) {
                    $tipo = $_POST['tipo'];
                    
                    if (validarTipoContenido($tipo)) {
                        $producto = productos::find($id);
                        $producto->borrarImagen(CARPETA_IMAGENES . $nombreImagen);
                        $producto->eliminar();
                    }
                    header("Location:" . $_SERVER['HTTP_REFERER']);
            }
    }
    }
}