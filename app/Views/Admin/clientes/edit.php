
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <!-- 23 Feb 2018 -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <?= lang('App.employee.title') ?>
                <small><?= lang('App.employee.modify') ?></small>
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
                                <form action="<?php echo base_url();?>mant/clientes/update" method="POST">
                                    <input type="hidden" value="<?php echo $cliente->id;?>"
                                    name="idCliente">
                                    <div class="form-group">
                                        <label  for="nombres"><?= lang('App.employee.names') ?>:</label>
                                        <input type="text" class="form-control" id="nombres"
                                               name="nombres" value="<?php echo $cliente->nombres?>">
                                               <?php if(session('errors.nombres')) : ?>
                                                    <p class="text-danger"><?= session('errors.nombres') ?></p>
                                                <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label  for="apellidos"><?= lang('App.employee.surnames') ?>:</label>
                                        <input type="text" class="form-control" id="apellidos"
                                               name="apellidos"  value="<?php echo $cliente->apellidos?>">
                                               <?php if(session('errors.apellidos')) : ?>
                                                    <p class="text-danger"><?= session('errors.apellidos') ?></p> 
                                                <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label  for="telefono"><?= lang('App.employee.phone') ?>:</label>
                                        <input type="text" class="form-control" id="telefono"
                                               name="telefono"  value="<?php echo $cliente->telefono?>">
                                               <?php if(session('errors.telefono')) : ?>
                                                    <p class="text-danger"><?= session('errors.telefono') ?></p> 
                                                <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label  for="direccion"><?= lang('App.employee.address') ?>:</label>
                                        <input type="text" class="form-control" id="direccion"
                                               name="direccion"  value="<?php echo $cliente->direccion?>">
                                               <?php if(session('errors.direccion')) : ?>
                                                    <p class="text-danger"><?= session('errors.direccion') ?></p> 
                                                <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label  for="ruc"><?= lang('App.employee.ruc') ?>:</label>
                                        <input type="text" class="form-control" id="ruc"
                                               name="ruc"  value="<?php echo $cliente->ruc?>">
                                               <?php if(session('errors.ruc')) : ?>
                                                    <p class="text-danger"><?= session('errors.ruc') ?></p> 
                                                <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label  for="empresa"><?= lang('App.employee.enterprise') ?>:</label>
                                        <input type="text" class="form-control" id="empresa"
                                               name="empresa"  value="<?php echo $cliente->empresa?>">
                                               <?php if(session('errors.empresa')) : ?>
                                                    <p class="text-danger"><?= session('errors.empresa') ?></p> 
                                                <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label  for="email"><?= lang('App.employee.email') ?>:</label>
                                        <input type="text" class="form-control" id="email"
                                               name="email"  value="<?php echo $cliente->email?>">
                                               <?php if(session('errors.email')) : ?>
                                                    <p class="text-danger"><?= session('errors.email') ?></p> 
                                                <?php endif; ?>
                                    </div>

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
