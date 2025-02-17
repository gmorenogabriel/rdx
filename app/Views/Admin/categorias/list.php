        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <!-- 23 Feb 2018 -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <?= lang('App.category.title') ?>
                <small><?= lang('App.category.list') ?></small>
                </h1>
            </section>
              <style type="text/css">
                #example1 tbody tr td{
                    clear: both;
                    padding:0px !important;
                    margin-bottom: 0px !important!;
                    margin-top: 0px !important!;
                    margin-auto;
                    bottom: 0px !important;
                }
            </style>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if( $permisos->insert == 1 ):?>
                                     <!--  <a href="< ? php echo base_url(route_to('categorias_create')); ? >" class="btn bt-primary btn-flat"><span class="fa fa-plus"></span> Agregar Categoria</a> -->
                                    <a href="<?php echo base_url('mant/categorias/crear');?>" class="btn bt-primary btn-flat"><span class="fa fa-plus"></span> <?= lang('App.category.add') ?> - <?php echo lang('App.category.title') ?></a> 
                                <?php endif;?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered btn-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?= lang('App.category.name') ?></th>
                                            <th><?= lang('App.category.description') ?></th>
                                            <th><?= lang('App.category.choices') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty(esc($categorias))):?>
                                        <?php foreach($categorias as $categoria):?>
                                            <tr>
                                                <td align="center"><?php echo $categoria->id;?></td>
                                                <td><?php echo esc($categoria->nombre);?></td>
                                                <td><?php echo esc($categoria->descripcion);?></td>
                                                <?php $datacategoria=esc($categoria->id)."*".esc($categoria->nombre)."*".esc($categoria->descripcion); ?>
                                                <td>
                                                <?php if(esc($permisos->read) == 1):?>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-info btn-view-categoria"  data-toggle="modal" data-target="#modal-default" value="<?php echo json_decode( json_encode($datacategoria), true);?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                 <?php endif;?>
<?php if( esc($permisos->update) == 1):?>
            <a href="<?php echo base_url()?>mant/categorias/editar/<?php echo esc($categoria->id);?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
<?php endif;?>
<?php if( esc($permisos->delete) == 1 ):?>
            <a href="<?php echo base_url()?>mant/categorias/borrar/<?php echo esc($categoria->id);?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
<?php endif;?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                    </tbody>


                                </table>

                                <label for=""><?= lang('App.category.showing' , [10]); ?></label>
                    </div>

                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
            <!-- /.content-wrapper -->
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?= lang('App.category.information') ?></h4>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                   <!-- Comentamos botón SAVE Changes
                   <button type="button" class="btn btn-primary">Save changes</button>
                   -->
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
