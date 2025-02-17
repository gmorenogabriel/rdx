       <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <!-- 23 Feb 2018 -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Productos
                <small>Listado</small>
                </h1>
            </section>
              <style type="text/css">
				th {
					display:right   ,
					align-items:right,
					}
				.custom-width{
                    /* bottom: 0px !important; */       
					padding-left:1px !important;
					padding-right:1px !important;
                }
                /*
				.custom-padding tbody tr td{
                 clear: both;
                    padding:0px !important;
                    margin-bottom: 0px !important!;
                    margin-top: 0px !important!;
                    bottom: 0px !important;
					padding-left:1px !important;
					padding-right:1px !important;
                }*/
            </style>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
				<?php
				if(session()->getFlashdata('status'))
				{
						echo "<h5>".session()->getFlashdata('status')."</h5>";
				}
				?>
				<div class="card">
					<div class="card-header">
							<a href="<?= base_url(route_to('productos_create')) ?>"  class="btn bt-primary btn-flat"><span class="fa fa-plus"></span> Agregar Producto</a>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="align-middle text-left" style="width: 5%;">Codigo</th>
									<th class="align-middle text-left" style="width: 10%;">Nombre</th>
									<th class="text-end custom-width" style="width: 15%;">Descripcion</th>
									<th class="text-right"      style="width: 5%;">Precio</th>
									<th class="text-right"  style="width: 5%;">Stock</th>
									<th class="text-center" style="width: 5%;">Imagen</th>
									<th style="width: 10%;"><center>Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($productos as $item): ?>
								<tr>
									<td><?= $item['codigo'] ?></td>
									<td class="align-middle text-left"><?= $item['nombre'] ?></td>
									<td><?= $item['descripcion'] ?></td>
									<td class="text-right m   "><?= $item['precio'] ?></td>
									<td class="text-right"><?= $item['stock'] ?></td>
									<td><center><img src="<?= "../uploads/".$item['imagen']; ?>" height="100px" width="100px" padding-left="0" padding-rigth="0" alt="Image">
								</td>
								<td><center>
									<div class="row">
										<a href="<?= base_url('/admin/productos/edit/'   . $item['id']) ?>" class="btn btn-success btn-sm">Editar</a>
										<a href="<?= base_url('/admin/productos/borrar/' . $item['id']) ?>" class="btn btn-danger  btn-sm"> Elim </a>
									</div>
									<div class="card-header">
										<a href="<?= base_url('/mant/productos/viewplusimg/' . $item['imagen']) ?>"  class="btn bt-primary btn-flat"><span class="fa fa-plus"></span> Visualizar Producto</a>
									</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
					</div>
				</div>
			</section>
		</div>

		        <!-- /.content-wrapper -->
				<div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Información de Productos</h4>
                  </div>
                  <div class="modal-body">

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