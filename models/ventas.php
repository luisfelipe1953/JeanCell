<?php 

namespace Model;

class ventas extends ActiveRecord {

    protected static $tabla = 'ventas';
    protected static $columnasDB = ['id', 'usuario_id', 'claveTransaccion', 'paypalDatos', 'fecha', 'email', 'total', 'status'];

    public $id;
    public $usuario_id;
    public $claveTransaccion;
    public $paypalDatos;
    public $fecha;
    public $email;
    public $total;
    public $status;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? '';
        $this->claveTransaccion = $args['claveTransaccion'] ?? '';
        $this->paypalDatos = $args['paypalDatos'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->email = $args['email'] ?? '';
        $this->total =  $args['total'] ?? '';
        $this->status =  $args['status'] ?? '';
      
    }
    

}
