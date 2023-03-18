<section class="contenedor" style="text-align: center;">
    <h2>¡Paso Final!</h2>
    <div>
        <p>Ya se agendo su compra</p>
        <p style="font-weight: 700;">el envio llegara en menos de 24 horas o una semana, algun problema comuniquese a este correo correo@correo.com</p>
    </div>
    <div class="flex pagar-botones">
        <a href="/mostrarCarrito" class="boton-rojo">Volver</a>
    </div>


</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        alertaSwal();
    });


    function alertaSwal() {
        Swal.fire({
            title: '<h1>Exito </h1>',
            text: 'Gracias por su compra',
            icon: 'success',
            confirmButtonText: 'OK',
        });
    }
</script>"