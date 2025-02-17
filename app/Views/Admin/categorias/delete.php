
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <!-- 23 Feb 2018 -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Categorias
                <small>Eliminar</small>
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
                                <form action="<?php echo base_url();?>mant/categorias/borrar" method="POST">
                                    <input type="hidden" value="<?php echo $categoria->id;?>"
                                    name="idCategoria">
                                    <div class="form-group">
                                        <label  for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre"
                                               name="nombre" value="<?php echo $categoria->nombre?>">
                                               <?php if(session('errors.nombre')) : ?>
                                                    <p class="text-danger"><?= session('errors.nombre') ?></p>
                                                <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label  for="descripcion">Descripcion:</label>
                                        <input type="text" class="form-control" id="descripcion"
                                               name="descripcion"  value="<?php echo $categoria->descripcion?>">
                                               <?php if(session('errors.descripcion')) : ?>
                                                    <p class="text-danger"><?= session('errors.descripcion') ?></p> 
                                                <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
