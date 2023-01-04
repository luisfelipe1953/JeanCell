<?php

namespace Model;

class categorias extends ActiveRecord
{
  protected static $tabla = 'categorias';
  protected static $columnasDB = ['id', 'nombre_categoria', 'sub_categoria'];

  public $id;
  public $nombre_categoria;
  public $sub_categoria;
  
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->nombre_categoria = $args['nombre_categoria'] ?? '';
    $this->sub_categoria = $args['sub_categoria'] ?? '';
  }
}