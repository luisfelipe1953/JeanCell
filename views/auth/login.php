<div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
        <h1 class="nombre-pagina">Login</h1>
        <p class="descripcion-pagina">Inicia sesion con tus datos</p>

        <?php 
            include_once __DIR__ . '/../templates/alertas.php';  
        ?>

        <form class="formulario" method="POST">
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Tu E-mail">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">
            </div>

            <input type="submit" class="boton" value="iniciar sesion">
        </form>

        <div class="acciones">
            <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
            <a href="/olvide">¿Olvidaste tu Contraseña?</a>
        </div>
    </div>
</div>