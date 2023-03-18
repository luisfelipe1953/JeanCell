<?php
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
define('KEY', 'appsalon');
define('COD', 'AES-128-ECB');



function validarTipoContenido($tipo)
{
    $tipos = ['producto'];

    return  in_array($tipo, $tipos);
}

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool
{
    if ($actual !== $proximo) {
        return true;
    }
    return false;
}

function redireccionar(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url}");
    }

    return $id;
}

function validarORedireccionar(string $url)
{
    if (is_numeric(openssl_decrypt($_GET['id'], COD, KEY))) {
        $id = openssl_decrypt($_GET['id'], COD, KEY);
    }
    if (!$id) {
        header("Location: ${url} ");
    }

    return $id;
}

function isAuth()
{
    if (!isset($_SESSION['login'])) {
        header('location: /login');
    }
    return true;
}

function isAdmin()
{
    if (!isset($_SESSION['admin'])) {
        header('location: /');
    }
    return true;
}


