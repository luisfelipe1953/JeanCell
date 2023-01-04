<header class="header">
    <div class="contenedor contenido-header">
        <a href="/"><img class="logo" src="build/img/jean cell.jpeg" alt="logo"></a>
        <form class="lupa" method="GET" action="/buscador">
                    <input type="search" placeholder="buscar" name="busqueda">
                    <button type="submit" name="enviar"><img src="/build/img/loupe_79257.svg" alt="icono busqueda"></button>
            </form>
        
        <nav class="navegacion-principal"> 
            <a href="/mostrarCarrito">
                <img src="build/img/carrito.svg" alt="carrito icono">
                <span id="numero_carrito" class="numero_carrito">
                   (<?php echo (empty($_SESSION['carrito']))? 0 : count($_SESSION['carrito']);  ?>)
                </span>
            </a>
            <?php if (isset($_SESSION['login'])) {  ?>
                <a href="/logout">Cerrar Sesion</a>
            <?php } else {  ?>
                <a href="/login">Iniciar Session</a>
            <?php } ?>
        </nav>
    </div>
</header>