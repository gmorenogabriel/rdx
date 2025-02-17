<!-- app/Views/carrito/compra_finalizada.php -->
 
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<!-- 12 Set 2024 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?= lang('App.product.title') ?>
        <small><?= lang('App.product.endshop') ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                       <form action="<?= base_url('mant/carrito/finalizarCompra') ?>" class="btn btn-success" method="POST">

 <!-- Mostrar mensaje de éxito si existe -->
 <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <!-- Mostrar mensaje de error si existe -->
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>
<!--                             < ? php if( session()->getFlashdata("error")):?>
                                <div class="alert" alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button> $session->getFlashdata('item');
                                    <p><i class="icon fa fa-ban"></i>< ? php echo $session->getFlashdata("error"); ?></p>
                                </div>
                            < ? php endif;?>
-->
    <!--  <form action="< ? php echo base_url();?>mant/carrito/agregarAlCarrito" method="POST"> -->
                            <h2>Compra Finalizada</h2>

                            <?php if (!empty($productos)): ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($productos as $producto): ?>
                                            <tr>
                                                <td><?= esc($producto['nombre']) ?></td>
                                                <td><?= number_format($producto['precio'], 2) ?> $</td>
                                                <td><?= esc($producto['cantidad']) ?></td>
                                                <td><?= number_format($producto['precio'] * $producto['cantidad'], 2) ?> $</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                                            <td><strong><?= number_format($total, 2) ?> $</strong></td>
                                        </tr>
                                    </tbody>

                                </table>
<!-- ************************************ -->
   <h3>Seleccione la forma de pago</h3>


    <div class="form-group">
        <label for="forma_pago">Forma de Pago</label>
        <select name="forma_pago" id="forma_pago" class="form-control" required>
            <option value="" disabled selected>Seleccione una opción</option>
            <option value="Tarjeta">Tarjeta de Crédito/Débito</option>
            <option value="Efectivo">Efectivo</option>
            <option value="Transferencia">Transferencia Bancaria</option>
        </select>
    </div>


<!--  --------------*************************  -->
                        <div class="form-group">
                                <a href="<?= base_url();?>mant/carritoproductos" class="btn btn-primary">Volver a la tienda</a>

                                <!-- <a href="< ? = base_url();?>mant/carrito/finalizarCompra" class="btn btn-info">Finalizar la Compra</a> -->
                                <button type="submit" class="btn btn-success btn-flat"><?= lang('App.product.endshop') ?></button>
                        </div>
                        <p>Gracias por tu compra. El total de tu pedido es: $<?= number_format($total, 2); ?></p>

                            <?php else: ?>
                                <p>No se han encontrado productos en la compra.</p>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
                <!-- /.content -->

                <!-- /.content-wrapper -->

    <!-- Incluye JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


