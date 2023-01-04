<?php include __DIR__ . '/../templates/barra.php'  ?>
<div class="contenedor">
    <h2>Buscar Compras por dia</h2>
    <div class="busqueda">
        <form class="formulario">
            <label for="fecha" style="color:black">buscar</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>" style="color:black">
        </form>
    </div>
</div>

<?php if(count($ventas) === 0){
        echo "<h2 style='color: red'> No hay ventas para esta fecha</h2>";
    }
?>
<div class="contenedor" id="ventas-admin">
    <div class="ventas">
        <?php
        $idVenta = 0;
        foreach ($ventas as $key => $venta) :
            if ($idVenta !== $venta->id) :
                    $total = 0;
        ?>  
                <li>
                    <p>Pedido: <span><?php echo $venta->id;  ?></span></p>
                    <p>Cliente: <span><?php echo $venta->cliente; ?></span></p>
                    <p>Email: <span><?php echo $venta->email; ?></span></p>
                    <p>Telefono: <span><?php echo $venta->telefono; ?></span></p>

                    <h3>Productos</h3>

                    <?php $idVenta = $venta->id;  ?>
                <?php endif; 
                    $total += $venta->precio;
                ?>
                <div class="productos">
                    <p class="producto">Producto: <span><?php echo $venta->nombre ?></span></p>
                    <p class="precio">Precio: $<span><?php echo $venta->precio ?></span></p>
                    <p class="cantidad">Cantidad: <span><?php echo $venta->cantidad ?></span></p>
                </div>
                <?php 
                    $actual = $venta-> id; 
                    $proximo = $ventas[$key + 1]-> id ?? 0; 

                    if(esUltimo($actual, $proximo)){?>
                        <p class="total">Total: $<?php echo $total;   ?></p>
                        
                        <form action="/admin/eliminarCita" method="POST">
                            <input type="hidden" name="id" value="<?php echo $venta->id;?>">
                            <input type="submit" name="eliminar" value="eliminar" class="boton">
                        </form>
                    <?php }
                ?>
                </li>
            <?php endforeach;  ?>
                    </div>
</div>


<script src='build/js/buscador.js'></script>;
