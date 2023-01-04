<section class="explorar-categorias">
    <div class="contenedor">
        <h2>Productos</h2>
        <div class="contenedor-ofertas">
            <?php foreach ($productos as $producto) : ?>
                <?php $precio_desc = $producto->precio - (($producto->precio * $producto->descuento) / 100); ?>
                <div class="ofertas">
                    <a href="/detalles?id=<?php echo openssl_encrypt($producto->id, COD, KEY) ?>">
                        <img src="/imagenes/<?php echo $producto->imagen; ?>" alt="imagen-producto">
                        <div class="informacion">
                            <div>
                                <p class="nombre"><?php echo $producto->nombre  ?></p>
                            </div>
                            <div>
                                <?php if ($producto->descuento > 0) { ?>
                                    <p class="descuento"><?php echo $producto->descuento; ?>% off</p>
                                    <div>
                                        <p><del>$<?php echo number_format($producto->precio, 0,) ?></del></p>
                                        <p class="precio-oferta">$<?php echo number_format($precio_desc, 0,);   ?></p>
                                    </div>
                                    

                                <?php } else { ?>
                                    <p class="precio-oferta">$<?php echo number_format($producto->precio, 0)   ?></p>
                                <?php  }  ?>
                            </div>
                        </div>
                    </a>
                    <form method="POST">
                        <input type="hidden" id="id" name="id" value="<?php echo openssl_encrypt($producto->id, COD, KEY) ?>">
                        <input type="hidden" id="nombre" name="nombre" value="<?php echo openssl_encrypt($producto->nombre, COD, KEY)   ?>">
                        <input type="hidden" id="precio" name="precio" value="<?php echo openssl_encrypt($precio_desc, COD, KEY)  ?>">
                        <div class="incrementar">
                            <label for="cantidad">cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" value="1">
                        </div>
                        <div class="botones-compra">
                            <input id="comprar_ahora" type="button" value="WhatsApp" class="boton">
                            <button name="carrito" type="submit" value="agregar" class="boton-verde">Agregar</button>
                        </div>
                    </form>


                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>