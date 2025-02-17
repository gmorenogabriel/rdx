<!-- app/Views/carrito/metodo_pago.php -->
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
    <form action="<?= base_url('mant/carrito/finalizarCompra') ?>" method="POST" class="btn btn-success" >Finalizar Compra 1</a>
                       <!-- <form action="< ? = base_url('mant/carrito/finalizarCompra') ?>" class="btn btn-success" method="POST">Finalizar Compra</a> -->
                            <?php if( session()->getFlashdata("error")):?>
                                <div class="alert" alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button> $session->getFlashdata('item');
                                    <p><i class="icon fa fa-ban"></i><?php echo $session->getFlashdata("error"); ?></p>
                                </div>
                            <?php endif;?>
<!-- <form action="< ? = base_url('mant/carrito/finalizarCompra/') ?>" class="btn btn-success" method="POST">Finalizar Compra</a> -->
    <h3>Seleccione la forma de pago</h3>

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

    <div class="form-group">
        <label for="forma_pago">Forma de Pago</label>
        <select name="forma_pago" id="forma_pago" class="form-control" required>
            <option value="" disabled selected>Seleccione una opción</option>
            <option value="Tarjeta">Tarjeta de Crédito/Débito</option>
            <option value="Efectivo">Efectivo</option>
            <option value="Transferencia">Transferencia Bancaria</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Finalizar Compra 2</button>
</form>