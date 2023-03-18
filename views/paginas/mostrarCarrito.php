<?php include_once __DIR__ . '/../templates/header.php';
$total = 0;
?>
<div class="barra">
    <p>Hola: <?php echo $nombre ?? '';  ?></p>
</div>
<section class="contenedor">
    <h2>Lista del Carrito</h2>
    <?php if(!empty($_SESSION['carrito'])){ ?>
    <div class="contedor-carrito">
    <table class="table-carrito">
        <thead>
            <tr>
                <th>nombre</th>
                <th>precio</th>
                <th>cantidad</th>
                <th>total</th>
                <th>--</th>
            </tr>   
            <?php foreach($_SESSION['carrito'] as $key => $producto):  ?>

                
            <tr class="incrementar">
                <td><?php echo $producto['nombre'];  ?></td>
                <td><?php echo $producto['precio'];  ?></td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td><?php echo number_format($producto['precio']*$producto['cantidad'],2);  ?></td>
                <td>
                    <form class="td-button"action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY) ?>">

                        <button type="submit"
                        name="carrito"
                        class="boton-rojo"
                        value="eliminar"
                        >Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php $total = $total + ($producto['precio']*$producto['cantidad']); ?>
            <?php endforeach;  ?>
            <tr>
                <td colspan="3">total</td>
                <td><?php echo number_format($total, 2)  ?></td>
            </tr>

            <tr>
                <td colspan="5">
                    <form action="/pagar" method="POST" class="formulario">
                    <div class="alerta exito">
                        <div>
                        <label for="email">Correo de contacto</label>
                        <input type="email" name="email" id="email" placeholder="Por favor escribe tu correo" required>
                        </div>
                        <small class="">
                            los productos se enviaran a este correo
                        </small>
                        <button
                        class="boton"
                        type="submit"
                        value="agregar"
                        name="carrito">
                        proceder a pagar >>
                        </button>

                    </div>
                    </form>
                   
                </td>
            </tr>
        </thead>
    </table>
    </div>
    <?php }else{?>
        <p class="alerta exito">no hay ningun producto en el carrito</p>
    <?php }  ?>
</section>
<div class="footer-fixed">
<?php include __DIR__ . '/../templates/footer.php';
?>
</div>

