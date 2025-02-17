        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <!-- 23 Feb 2018 -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Visualización
                <small>Panel general</small>
                </h1>
            </section>
            <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
					<?php if (isset($cantClientes)) : ?>
                        <h3><?php echo $cantClientes;?></h3>
					<?php endif ?>
                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url();?>mant/clientes" class="small-box-footer">Más info<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
					<?php if (isset($cantProductos)) : ?>
                <h3><?php echo $cantProductos;?><sup style="font-size: 20px">%</sup></h3>
					<?php endif ?>
                <p>Productos</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url();?>mant/productos" class="small-box-footer">Más info<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
					<?php if (isset($cantUsuarios)) : ?>
						<h3><?php echo $cantUsuarios;?></h3>
					<?php endif ?>
                <p>Usuarios</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url();?>admin/usuarios" class="small-box-footer">Más info<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
					<?php if (isset($cantVentas)) : ?>
						<h3><?php echo $cantVentas;?></h3>
					<?php endif ?>
                <p>Ventas</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo base_url();?>movimientos/ventas" class="small-box-footer">Más info<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reporte Anual de Ventas</h3>
                        <div class="box-tools pull-right">
                            <select name="year" id="year" class="form-control">
							<?php if (isset($years)) : ?>
                                <?php foreach($years as $year):?>
                                    <option value="<?php echo $year->year;?>"><?php echo $year->year;?></option>
                                <?php endforeach;?>
							<?php endif ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                             <!--   <div id="grafico" style="min-width:310px; height: 400px;margin: 0 auto"></ div>
                             -->
                              <div id="grafico" style="margin: 0 auto"></ div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
<!-- /.row -->
    </section>
<!-- /.content -->
</div>