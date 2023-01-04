<?php include __DIR__ . '/../templates/header.php';

?>

<section class="contenedor-color">
    <div class="contenedor contenedor-categorias">
        <div class="categorias-container" id="categorias-container">
            <div class="flex">
                 <p>Categorias</p>
                <img src="/build/img/flecha-abajo.svg" alt="flecha hacia abajo">
            </div>
            <div class="display">

            </div>
        </div>
        <a class="titulo-descuento" href="/descuento">Ofertas</a>
        <a class="titulo-descuento">Ayuda</a>

    </div>
</section>

<section class="slider">
    <div class="slider-contenedor">
        <img class="slider-arrow" src="build/img/flecha.svg" alt="flecha right" id="before">
        <div class="slider-body slider-body-show" data-id="1">
            <a href="#oferta1" class="slider-img1 imgs">

            </a>
        </div>
        <div class="slider-body" data-id="2">
            <a href="#oferta2" class="slider-img2 imgs">

            </a>
        </div>
        <div class="slider-body" data-id="3">
            <a href="#oferta2" class="slider-img3 imgs">

            </a>
        </div>

        <img class="slider-arrow" src="build/img/leftflecha.svg" alt="flecha left" id="next">
    </div>
</section>

<?php include_once __DIR__ . '/listado.php';  ?>

<script src="build/js/app.js"></script>