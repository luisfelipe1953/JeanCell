<div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
        <h1 class="nombre-pagina">Olvide el Password</h1>
        <p class="descripcion-pagina">Restablece tu password escribiendo tu email a continuacion</p>

        <?php 
            include_once __DIR__ . '/../templates/alertas.php';  
        ?>

        <form class="formulario" method="POST">
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Tu E-mail">
            </div>

            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>

        <div class="acciones">
            <a href="/login">¿Ya tienes una cuenta? Inicia Sesion</a>
            <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
        </div>
    </div>
</div>
</div>