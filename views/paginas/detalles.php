<?php
include_once __DIR__ . '/../templates/header.php';
$precio_desc = $producto->precio - (($producto->precio * $producto->descuento) / 100);
?>

<div class="contenedor contenido-detalles">
    <div class="contenedor-detalles">
        <div class="img-detalles">
            <img src="/imagenes/<?php echo $producto->imagen; ?>" alt="imagen-producto">
        </div>
        <div class="detalles">
            <h2>detalles</h2>
            <p><?php echo $producto->nombre  ?></p>
            <?php if ($producto->descuento > 0) { ?>
                <h3 class="descuento"><?php echo $producto->descuento; ?>% descuento</h3>
                <h3 class="precio">
                    <p><del>$<?php echo number_format($producto->precio, 2, '.', ','); ?></del></p>
                    <?php echo number_format($precio_desc, 2, '.', ',');   ?>
                </h3>
            <?php } else { ?>
                <h3>$<?php echo number_format($producto->precio, 2, '.', ',');   ?></h3>
            <?php  }  ?>
            <p><?php echo $producto->descripcion;  ?></p>
            <p>disponibles: <?php echo $producto->producto_disponible;  ?></p>



            <input id="comprar_ahora" type="button" value="comprar ahora" class="boton">
            <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo openssl_encrypt($producto->id, COD, KEY) ?>">
                <input type="hidden" id="nombre" name="nombre" value="<?php echo openssl_encrypt($producto->nombre, COD, KEY)   ?>">
                <input type="hidden" id="precio" name="precio" value="<?php echo openssl_encrypt($precio_desc, COD, KEY)  ?>">
                <div class="cantidad-detalles">
                    <label for="cantidad">cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" value="1">
                </div>
                <button name="carrito" type="submit" value="agregar" class="boton-verde">agregar al carrito</button>
            </form>
        </div>
    </div>
</div>
</div>


<script src="build/js/app.js"></script>