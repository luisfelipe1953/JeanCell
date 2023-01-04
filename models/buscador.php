<?php   

namespace Model;

class buscador extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'busqueda', 'nombre', 'precio', 'imagen','descuento'];

    public $id;
    public $busqueda;
    public $nombre;
    public $precio;
    public $imagen;
    public $descuento;
  

    function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->busqueda = $args['busqueda'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descuento = $args['descuento'] ?? '';
    
    }
}