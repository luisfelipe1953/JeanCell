<h1>Hola</h1>
<?php include __DIR__ . '/../templates/barra.php'  ?>


<main class="contenedor">
        <h1>Administrador de bienesraices</h1>

        <h2>Productos</h2>

        <table class="tabla">
                <thead>
                        <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                        </tr>

                </thead>

                <body>
                        
                        <?php foreach ($productos as $producto) : ?>
                                <tr>
                                        <td> <p><?php echo $producto->id; ?><p> </td>
                                        <td> <p><?php echo $producto->nombre; ?><p></td>                
                                        <td> <img src="../imagenes/<?php echo $producto->imagen; ?>" class="imagen-tabla"></td>
                                        <td><p>$<?php echo $producto->precio; ?><p></td>  
                                        <td>
                                                <form method="POST" action="/productos/eliminar">
                                                        <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                                        <input type="hidden" name="tipo" value="producto">
                                                        <input type="submit" class="boton" value="Eliminar">
                                                </form>
                                                <a href="/productos/actualizar?id=<?php echo $producto->id; ?>" class="boton-verde">Actualizar</a>
                                        </td>
                                </tr>
                        <?php endforeach; ?>
                </body>



        </table>