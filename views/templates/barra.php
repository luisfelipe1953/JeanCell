<div class="contenedor barra">
    <p>Hola: <?php echo $nombre ?? '';  ?></p>

    <?php if(isset($_SESSION['admin'])):  ?>
        <div class="navegacion-admin">
            <a class="boton-verde" href="/admin">Ver pedidos</a>
            <a class="boton-verde" href="/productos">Ver Productos</a>
            <a class="boton-verde" href="/productos/crear">Agregar un Producto</a>
        </div>
    <?php endif;  ?>
</div>

