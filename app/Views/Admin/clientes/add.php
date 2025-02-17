<!-- =============================================== -->
<!-- Content Wrapper. Contains page content          -->
<!-- views\admin\clientes\add.php                  -->
<!-- 24 Feb 2018                                     -->
<!-- =============================================== -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= lang('App.employee.title') ?>
    <small><?= lang('App.employee.add') ?></small>
    </h1>
</section>
  <!-- Main content -->
    <section class="content">
<!-- Default box -->
<div class="box box-solid">
<div class="box-body">
        <!-- <div class="row"> -->
<div class="col-xs-12">
<!--
    < ? php if($this->session->flashdata("error")): ? >
    <div class="alert" alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">&times;</button>
        <p><i class="icon fa fa-ban"></i>< ? php echo $this->session->flashdata("error"); ? ></p>
    </div>
    < ? php endif; ? >
    -->
    <form action="<?php echo base_url('mant/clientes/store');?>" method="POST" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="nombre" class="col-xs-2 control-label"><?= lang('App.employee.names') ?>:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nombres" name="nombres" value="<?= old('nombres') ?>">
                        <!-- <span class="help-block bs-danger"><?= session('errors.nombres') ?></span> -->
                         <?php if(session('errors.nombres')) : ?>
                            <p class="text-danger"><?= session('errors.nombres') ?></p>
                         <?php endif; ?>
                    </div>
          </div>
        <!--  ----------------------------------------------------------------------------- -->
        <!--  ----------------------------------------------------------------------------- -->
        <div class="form-group">
            <label for="apellidos" class="col-xs-2 control-label"><?= lang('App.employee.surnames') ?>:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= old('apellidos') ?>">
                    <?php if(session('errors.apellidos')) : ?>
                        <p class="text-danger"><?= session('errors.apellidos') ?></p>
                    <?php endif; ?>
                </div>
        </div>
        <!--  ----------------------------------------------------------------------------- -->
        <!--  ----------------------------------------------------------------------------- -->
          <div class="form-group">
            <label for="telefono" class="col-xs-2 control-label"><?= lang('App.employee.phone') ?>:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?= old('telefono') ?>">
                    <?php if(session('errors.telefono')) : ?>
                        <p class="text-danger"><?= session('errors.telefono') ?></p>
                    <?php endif; ?>
                </div>
        </div>
        <!--  ----------------------------------------------------------------------------- -->
        <!--  ----------------------------------------------------------------------------- -->
        <div class="form-group">
            <label for="direccion" class="col-xs-2 control-label"><?= lang('App.employee.address') ?>:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?= old('direccion') ?>">
                    <?php if(session('errors.direccion')) : ?>
                        <p class="text-danger"><?= session('errors.direccion') ?></p>
                    <?php endif; ?>
                </div>
        </div>
        <!--  ----------------------------------------------------------------------------- -->
        <!--  ----------------------------------------------------------------------------- -->  
        <div class="form-group">
            <label for="email" class="col-xs-2 control-label"><?= lang('App.employee.email') ?>:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= old('email') ?>">
                    <?php if(session('errors.email')) : ?>
                        <p class="text-danger"><?= session('errors.email') ?></p>
                    <?php endif; ?>
                </div>
        </div>
        <!--  ----------------------------------------------------------------------------- -->
        <!--  ----------------------------------------------------------------------------- -->          
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-flat"><?= lang('App.employee.save') ?></button>
        </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
        <!-- /.content-wrapper -->