<?php

namespace Model;

class productos extends ActiveRecord
{
  protected static $tabla = 'productos';
  protected static $columnasDB = ['id', 'nombre', 'descripcion', 'precio', 'imagen', 'producto_disponible', 'categoria_id', 'descuento'];

  public $id;
  public $nombre;
  public $descripcion;
  public $precio;
  public $imagen;
  public $producto_disponible;
  public $categoria_id;
  public $descuento;

  public function __construct($args = [])
  {

    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->precio = $args['precio'] ?? '';
    $this->imagen = $args['imagen'] ?? '';
    $this->producto_disponible = $args['producto_disponible'] ?? null;
    $this->categoria_id = $args['categoria_id'] ?? '';
    $this->descuento = $args['descuento'] ?? '0';
  }

  public static function addProductos($id, $nombre, $precio, $cantidad)
  {

    $productos = array(
      'id' => $id,
      'nombre' => $nombre,
      'precio' => $precio,
      'cantidad' => $cantidad
    );

    // Comprobar si ya existe una sesión del carrito
    if (isset($_SESSION['carrito'])) {

      $productoRemove = false;
      foreach ($_SESSION['carrito'] as $producto) {
        if ($producto['id'] == $id) {
          echo "<script> document.addEventListener('DOMContentLoaded', function(event) {
            function alertaSwal() {
                Swal.fire({
                    title: '<h1>Error </h1>',
                    text: 'El producto ya ha sido seleccionado...',
                    icon: 'error',
                    confirmButtonText: 'OK',
                })
            }
            alertaSwal();
        });</script>";
          $productoRemove = true;
          break;
        }
      }
      if (!$productoRemove) {
        // Si el producto no está en el carrito, agregarlo utilizando array_push()
        array_push($_SESSION['carrito'], $productos);
      }
    } else {
      // Crear una nueva sesión del carrito y agregar el producto
      $_SESSION['carrito'] = array();
      array_push($_SESSION['carrito'], $productos);
    }
  }

  public static function deleteProduct($id)
  {

    $i = 0;
    foreach ($_SESSION['carrito'] as $key => $producto) {
      // se recorre el array para ver si se encuentra el producto y eliminarlo
      if ($producto['id'] == $id) {
        unset($_SESSION['carrito'][$key]);
      }
      $i++;
    }
  }

  public function validar()
  {
    if (!$this->nombre) {
      self::$alertas['error'][] = "Debes añadir un titulo ";
    }
    if (!$this->precio) {
      self::$alertas['error'][] = "El precio es obligatorio";
    }
     if (strlen($this->descripcion) < 10) {
       self::$alertas['error'][] = "La descripcion es obligatoria y debe tener al menos 10 caracteres";
     }
    if (!$this->producto_disponible) {
      self::$alertas['error'][] = "debes añadir cuantos productos hay en la tienda";
    }
    if (!$this->categoria_id) {
       self::$alertas['error'][] = "debes añadir una categoria";
    }
    if (!$this->imagen) {
       self::$alertas['error'][] = "La imagen es obligatoria";
     }
    return self::$alertas;
  }
}
