<?php 

namespace Model;

class adminVentas extends ActiveRecord {
    protected static $tabla = 'ventasproductos';
    protected static $columnasDB = ['id', 'cliente', 'email', 'telefono', 'nombre', 'precio', 'cantidad'];

    public $id;
    public $cliente;
    public $email;
    public $telefono;
    public $nombre;
    public $precio;
    public $cantidad;

    function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
    }


}