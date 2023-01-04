

<div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
        <h1 class="nombre-pagina">Crear Cuenta</h1>
        <p class="descripcion-pagina">Completa todos los campos para crear una cuenta</p>

        <?php 
            include_once __DIR__ . '/../templates/alertas.php';
        ?>


        <form class="formulario" method="POST">
            <div class="campo">
                <label for="nombre">nombre</label>
                <input type="nombre" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s( $usuarios->nombre ); ?>">
            </div>
            <div class="campo">
                <label for="apellido">Apellido</label>
                <input type="apellido" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s( $usuarios->apellido ); ?>">
            </div>
            <div class="campo">
                <label for="telefono">Telefono</label>
                <input type="telefono" id="telefono" name="telefono" placeholder="Tu Telefono" value="<?php echo s( $usuarios->telefono );?>">
            </div>
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Tu E-mail" value="<?php echo s( $usuarios->email ); ?>">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu Password" > 
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>

        <div class="acciones">
            <a href="/login">¿Ya tienes una cuenta? Inicia Sesion</a>
            <a href="/olvide">¿Olvidaste tu Contraseña?</a>
        </div>
    </div>
</div>
</div>