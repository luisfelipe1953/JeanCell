<?php   

namespace Model;

class ventasproductos extends ActiveRecord {
    protected static $tabla  = 'ventasproductos';
    protected static $columnasDB = ['id', 'venta_id', 'producto_id', 'precio_unitario', 'cantidad', 'descargado'];

    public $id;
    public $venta_id;
    public $producto_id;
    public $precio_unitario;
    public $cantidad;
    public $descargado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->venta_id = $args['venta_id'] ?? '';
        $this->producto_id = $args['producto_id'] ?? '';
        $this->precio_unitario = $args['precio_unitario'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->descargado = $args['descargado'] ?? 1;
    }

}