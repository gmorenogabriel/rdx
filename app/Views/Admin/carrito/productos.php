<!-- app/Views/carrito/productos.php -->

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<!-- 12 Set 2024 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?= lang('App.product.title') ?>
        <small><?= lang('App.product.modify') ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if( session()->getFlashdata("error")):?>
                            <div class="alert" alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">&times;</button> $session->getFlashdata('item');
                                <p><i class="icon fa fa-ban"></i><?php echo $session->getFlashdata("error"); ?></p>
                            </div>
                        <?php endif;?>
                        <div class="card">
                            <div class="card-header">
                                 <!--    <a href="< ? = base_url(route_to('productos_create')) ?>"  class="btn bt-primary btn-flat"><span class="fa fa-plus"></span> Agregar Producto</a> -->
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <h2>Lista de Productos</h2>

    <!--       <form action="< ? = route('carrito/agregarAlCarrito') ? >" method="post"> -->
    <form action="<?php echo base_url();?>mant/carrito/agregarAlCarrito" method="POST">
    <table class="table">
        <thead>
            <tr>
                <th>Seleccionar</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th class="text-center" style="width: 5%;">Imagen</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>

            <tr class="<?= ($producto['stock'] == 0) ? 'text-danger' : ''; ?>">
                <td>
                    <!-- Checkbox para seleccionar el producto -->
                    <input type="checkbox" name="productos[<?= $producto['id'] ?>][seleccionado]" class="producto-checkbox" data-id="<?= $producto['id'] ?>" <?= $producto['stock'] == 0 ? 'disabled' : '' ?>>
                </td>
                <td class="align-middle text-left"><?= esc($producto['nombre']) ?></td>
                <td class="align-middle text-left"><?= esc($producto['precio']) ?></td>
                <td>
                    <?= $producto['stock'] > 0 ? $producto['stock'] : '<span class="text-danger">Sin Stock</span>' ?>
                </td>
                <td><center><img src="<?= "../uploads/".$producto['imagen']; ?>" height="100px" width="100px" padding-left="0" padding-rigth="0" alt="Image">
                </td>
                <td>
                    <!-- Campo para ingresar la cantidad, deshabilitado por defecto o si no hay stock -->
                    <input type="number" name="productos[<?= $producto['id'] ?>][cantidad]" class="cantidad-input" data-id="<?= $producto['id'] ?>" min="1" max="<?= $producto['stock'] ?>" disabled>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botón deshabilitado por defecto -->
    <button type="submit" class="btn btn-primary" id="agregar-carrito-btn" disabled>Agregar al Carrito</button>

   <!-- Botón para revisar el carrito, redirige a la página del carrito -->
   <a href="<?= base_url();?>mant/carrito/ver" class="btn btn-success mt-3" id="revisar-carrito-btn">Revisar Carrito</a>

</form>

<!-- JavaScript para habilitar/deshabilitar la cantidad y el botón de agregar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxs = document.querySelectorAll('.producto-checkbox');
        const agregarCarritoBtn = document.getElementById('agregar-carrito-btn');

        // Función para habilitar/deshabilitar el botón y el campo cantidad
        function verificarSeleccion() {
            let habilitarBoton = false;

            checkboxs.forEach(function(checkbox) {
                const productoId = checkbox.dataset.id;
                const cantidadInput = document.querySelector('.cantidad-input[data-id="'+productoId+'"]');
                const stock = parseInt(cantidadInput.getAttribute('max'));

                // Solo habilitar cantidad si el checkbox está seleccionado y el stock es mayor a 0
                if (checkbox.checked && stock > 0) {
                    cantidadInput.disabled = false;
                    cantidadInput.value = cantidadInput.value || 1; // Asegurar que tenga un valor mínimo
                } else {
                    cantidadInput.disabled = true;
                    cantidadInput.value = ''; // Limpiar si no está seleccionado
                }

                // Verificar si hay algún checkbox seleccionado y con cantidad válida
                if (checkbox.checked && parseInt(cantidadInput.value) > 0) {
                    habilitarBoton = true;
                }
            });

            // Habilitar o deshabilitar el botón según la selección
            agregarCarritoBtn.disabled = !habilitarBoton;
        }

        // Manejar el cambio en los checkboxes
        checkboxs.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                verificarSeleccion();
            });
        });

        // Manejar el cambio en los inputs de cantidad
        document.querySelectorAll('.cantidad-input').forEach(function(input) {
            input.addEventListener('input', function() {
                verificarSeleccion();
            });
        });
    });
</script>
                    <!-- /.box-body -->
                    </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

