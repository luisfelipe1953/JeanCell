<div class="contenedor">
    <h1>Nuevo Producto</h1>
    <p>Llena todos los campos para añadir un nuevo prodcuto</p>
    
    
    <?php include_once __DIR__ . '/../templates/barra.php'  ?>
    <?php include_once __DIR__ . '/../templates/alertas.php'  ?>

    
        

    <form action="/productos/crear" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include_once __DIR__ .  '/formulario.php'; ?>
        <input type="submit" class="boton" value="Guardar Producto">
    </form>
</div>