<?php 
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); // Crea una nueva instancia de Dotenv
$dotenv->safeLoad(); // Carga el archivo .env de forma segura

require 'funciones.php';
require 'database.php';


// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);