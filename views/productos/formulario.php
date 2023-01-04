<fieldset>
    <legend>Informacion del producto</legend>

    <label for="nombre">nombre</label>
    <input type="text" name="producto[nombre]" id="nombre" placeholder="nombre" value="<?php echo s($producto->nombre); ?>">

    <label for="precio">Precio:</label>
    <input type="number" placeholder="precio:" name="producto[precio]" id="precio" value="<?php echo s($producto->precio); ?>">

    <label for="image">Imagen: </label>
    <input type="file" placeholder="image" accept="image.jpg, image.png" name="producto[imagen]">
    <?php if($producto->imagen):  ?>
      <img src="/imagenes/<?php echo $producto->imagen;  ?>" class="imagen-small">
    <?php endif;  ?>
    <label for="descripcion">Descripcion</label>
    <textarea name="producto[descripcion]" id="descripcion"><?php echo s($producto->descripcion); ?></textarea>

    <label for="disponibles">Disponibles:</label>
    <input type="number" name="producto[producto_disponible]" id="disponibles" placeholder="Disponibles:" min="1" max="999" value="<?php echo s($producto->producto_disponible); ?>">

    <select name="producto[categoria_id]"  id="categoria">
            <option selected value="">--seleccione--</option>
        <?php foreach($categorias as $categoria):  ?>
            <option
            <?php echo $producto->categoria_id === $categoria->id ? 'selected' : '';   ?>
            value="<?php echo s($categoria->id);?>" > <?php echo s($categoria->nombre_categoria)?></option>
        <?php endforeach;  ?>
    </select>

    <label for="descuento">descuento:</label>
    <input type="number" name="producto[descuento]" id="descuento" placeholder="descuento:" min="0" max="100" value="<?php echo s($producto->descuento); ?>" >
</fieldset>

