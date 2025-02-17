<!-- =============================================== -->
<!-- Content Wrapper. Contains page content          -->
<!-- views\admin\categorias\add.php                  -->
<!-- 24 Feb 2018                                     -->
<!-- =============================================== -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= lang('App.category.title') ?>
    <small><?= lang('App.category.add') ?></small>
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
    <form action="<?php echo base_url('mant/categorias/store');?>" method="POST" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="nombre" class="col-xs-2 control-label"><?= lang('App.category.name') ?>:</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre') ?>">
                        <!-- <span class="help-block bs-danger"><?= session('errors.nombre') ?></span> -->
                         <?php if(session('errors.nombre')) : ?>
                        <p class="text-danger"><?= session('errors.nombre') ?></p>
                         <?php endif; ?>
                    </div>
                    <!--  <p class="alert" alert-danger aler-sismissible"><?= session('errors.nombre') ?></p>  -->
                    <!-- <p class="help is-danger"><?= session('errors.nombre') ?></p> -->
            </div>
        <div class="form-group">
            <label for="descripcion" class="col-xs-2 control-label"><?= lang('App.category.description') ?>:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= old('descripcion') ?>">
                    <?php if(session('errors.descripcion')) : ?>
                        <p class="text-danger"><?= session('errors.descripcion') ?></p>
                    <?php endif; ?>
                </div>

                <!-- <p class="help is-danger"><?= session('errors.descripcion') ?></p> -->
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-flat"><?= lang('App.category.save') ?></button>
        </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
        <!-- /.content-wrapper -->