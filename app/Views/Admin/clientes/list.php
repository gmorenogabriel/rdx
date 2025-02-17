        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <!-- 23 Feb 2018 -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <?= lang('App.employee.title') ?>
                <small><?= lang('App.employee.list') ?></small>
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
                                    <a href="<?php echo base_url('mant/clientes/crear');?>" class="btn bt-primary btn-flat"><span class="fa fa-plus"></span><?= lang('App.client.add') ?> - <?= lang('App.client.client') ?></a> 
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
                                            <th><?= lang('App.employee.names') ?></th>
                                            <th><?= lang('App.employee.surnames') ?></th>
                                            <th><?= lang('App.employee.phone') ?></th>
                                            <th><?= lang('App.employee.address') ?></th>
                                            <th><?= lang('App.employee.ruc') ?></th>
                                            <th><?= lang('App.employee.enterprise') ?></th>
                                            <th><?= lang('App.employee.email') ?></th>
                                            <th><?= lang('App.employee.choices') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($clientes)):?>
                                        <?php foreach($clientes as $cliente):?>
                                            <tr>
                                                <td align="center"><?php echo $cliente->id;?></td>
                                                <td><?php echo esc($cliente->nombres);?></td>
                                                <td><?php echo esc($cliente->apellidos);?></td>
                                                <td><?php echo esc($cliente->telefono);?></td>
                                                <td><?php echo esc($cliente->direccion);?></td>
                                                <td><?php echo esc($cliente->ruc);?></td>
                                                <td><?php echo esc($cliente->empresa);?></td>
                                                <td><?php echo esc($cliente->email);?></td>
                                                <?php $datacliente=esc($cliente->id)."*".esc($cliente->nombres).esc($cliente->apellidos)."*".esc($cliente->telefono)."*".esc($cliente->direccion)."*".esc($cliente->ruc)."*".esc($cliente->empresa)."*".esc($cliente->email);?>
                                                <td>
                                                <?php if(esc($permisos->read) == 1):?>
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-info btn-view-cliente"  data-toggle="modal" data-target="#modal-default" value="<?php echo $datacliente;?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                 <?php endif;?>
<?php if($permisos->update == 1):?>
            <a href="<?php echo base_url()?>mant/clientes/editar/<?php echo esc($cliente->id);?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
<?php endif;?>
<?php if( $permisos->delete == 1 ):?>
            <a href="<?php echo base_url()?>mant/clientes/borrar/<?php echo esc($cliente->id);?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
<?php endif;?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                    </tbody>


                                </table>
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
                    <h4 class="modal-title">Información del Cliente</h4>
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


