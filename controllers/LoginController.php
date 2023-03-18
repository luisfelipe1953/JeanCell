<?php

namespace Controller;

error_reporting(E_ALL);
ini_set("display_errors", 1);

use Classes\email;
use EmptyIterator;
use Model\usuarios;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new usuarios($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                $usuarios = usuarios::where('email', $auth->email);
                if($usuarios){

                    if($usuarios->comprobarPasswordAndVerificado($auth->password)){
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                    
                        $_SESSION['id'] = $usuarios->id;
                        $_SESSION['nombre'] = $usuarios->nombre . " " . $usuarios->apellido;
                        $_SESSION['email'] = $usuarios->email;
                        $_SESSION['login'] = true;

                        if($usuarios->admin == "1"){   
                            $_SESSION['admin'] = $usuarios->admin ?? null;
                            header('location: /admin');
                            exit;
                        }else{
                            $_SESSION['usuario'] = $usuarios->nombre;
                            header('location: /');
                            exit;
                        }
                    }
                }else{
                    $usuarios = usuarios::setAlerta('error', 'usuario no encontrado');
                }
            }
        }
        
        $alertas = usuarios::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            
        ]);
    }
    public static function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $_SESSION = [];

        header('location: /');
    }
    public static function olvide(Router $router)
    {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $auth = new usuarios($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuarios = usuarios::where('email', $auth->email);
                

                if($usuarios && $usuarios->confirmado === "1"){
                    //crear token
                    $usuarios->crearToken();
                    $usuarios->guardar();

                    // enviar instrucciones
                    $email = new email($usuarios->email, $usuarios->nombre, $usuarios->token);
                    $email->enviarInstrucciones();

                    //alerta exito
                    usuarios::setAlerta('exito', 'revisa tu email');
                }else{
                    $usuarios = usuarios::setAlerta('error', 'el usuario no existe o no esta confirmado');
                    
                }
            }


        }
        $alertas = usuarios::getAlertas();
        $router->render('auth/olvide', [
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router){
        $error = false;
        $token = s($_GET['token']);
        $alertas = [];

        $usuarios = usuarios::where('token', $token);

        if(empty($usuarios)){
            usuarios::setAlerta('error', 'Token no valido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = new usuarios($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuarios->password = null;
                $usuarios->password = $password->password;
                $usuarios->hashPassword();
                $usuarios->token = null;

                $resultado = $usuarios->guardar();

                if($resultado){
                    header('location: /login');
                }
                debuguear($usuarios);
                
            }
        }

        $alertas = usuarios::getAlertas();
        $router->render('auth/recuperar-cuenta',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    
    public static function crear(Router $router)
    {
        $usuarios = new usuarios();
        $alertas = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarios->sincronizar($_POST);
            $alertas = $usuarios->validar();
            if (empty($alertas)) {
                $resultado = $usuarios->existeUsuario();
                
                if($resultado->num_rows){
                    $alertas = usuarios::getAlertas();
                }else{
                    $usuarios->hashPassword();
                    
                    $usuarios->crearToken();

                    $email = new email($usuarios->email, $usuarios->nombre, $usuarios->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuarios->guardar();

                    if($resultado){
                        header('location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta', [
            'alertas' => $alertas,
            'usuarios' => $usuarios
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje', []);
    }
    public static function confirmar(Router $router){
        $alertas = [];

        $token = s($_GET['token']);

        $usuarios = usuarios::where('token', $token);

        if(empty($usuarios)){
            usuarios::setAlerta('error', 'Token no valido');
        }else{
            $usuarios->confirmado = "1";
            $usuarios->token = '';
            $usuarios->guardar();
            usuarios::setAlerta('exito', 'Cuenta comprobada correctamente');
        }

        $alertas = usuarios::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}
