<!-- app/Views/carrito/ver_carrito.php -->

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
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>
<!--  <form action="< ? php echo base_url();?>mant/carrito/agregarAlCarrito" method="POST">  -->
<h2>Carrito de Compras</h2>

<?php if (!empty($carrito)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total Compra</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carrito as $productoId => $producto): ?>
                <tr>
                    <td><?= esc($producto['nombre']) ?></td>
                    <td><?= esc($producto['cantidad']) ?></td>
                    <td><?= esc($producto['precio']) ?></td>
                    <td><?= esc($producto['cantidad']) * esc($producto['precio']) ?></td>
                    <td>
            <!--
                      < ? php d($productoId); ?>
                      < ? php dd($producto['id']); ?>
            -->
                        <a href="<?= base_url('mant/carrito/eliminarProducto/').$producto['id'] ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

        </div>
    </div>
    <a href="<?= base_url('mant/carrito/vaciarCarrito') ?>" class="btn btn-warning">Vaciar Carrito</a>

    <a href="<?= base_url('mant/carritoproductos') ?>" class="btn btn-info">Seguir comprando</a>

    <!-- Botón para finalizar la compra -->
    <a href="<?= base_url('mant/carrito/metodoPago') ?>" class="btn btn-success">ir al Metodo de Pago</a>
    <!-- <a href="< ? = base_url('mant/carrito/finalizarCompra/') ?>" class="btn btn-success">Finalizar Compra</a> -->
<?php else: ?>
    <p>No hay productos en el carrito.</p>
    <a href="<?= base_url('mant/carritoproductos') ?>" class="btn btn-info">Volver a la Tienda</a>
<?php endif; ?>
