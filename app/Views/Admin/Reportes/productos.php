<!-- Content Wrapper. Contains page content -->
<!-- Views Reporte Productos
<!-- 24 Feb 2018 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Reportes
        <small>Productos</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">



                <div class="row">
                    <form action="<?php echo current_url();?>" method="POST" class="form-horizontal">
                       
                        <div class="form-group">
                            <label for="" class="col-md-1 control-label">Desde:</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio:'';?>">
                            </div>
                            <label for="" class="col-md-1 control-label">Hasta:</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="fechafin" value="<?php  echo !empty($fechafin) ? $fechafin:'';?>">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                                <a href="<?php echo base_url(); ?>reportes/productos" class="btn btn-danger">Restablecer</a>
                            </div>
                        </div>
                    </form>
                </div>
                        <div class="row">                            
                            <div class="col-md-12">
                                <table id="example" class="table table-bordered btn-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Codigo</th>
                                            <th>Nombre Producto</th>
                                            <th>Descripcion</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
				<?php if (isset($productos) && (is_array($productos) || is_object($productos))): ?>
					<?php foreach ($productos as $producto): ?>
						<?php
							$id = $producto['id'] ?? ($producto->id ?? 'N/A');
							$codigo = $producto['codigo'] ?? ($producto->codigo ?? 'N/A');
							$nombre = $producto['nombre'] ?? ($producto->nombre ?? 'N/A');
							$descripcion = $producto['descripcion'] ?? ($producto->descripcion ?? 'N/A');
							$precio = $producto['precio'] ?? ($producto->precio ?? 'N/A');
							$stock = $producto['stock'] ?? ($producto->stock ?? 'N/A');
						 ?>
							<tr>
								<td><?php echo $id;?></td>
								<td><?php echo $codigo;?></td>
								<td><?php echo $nombre;?></td>
								<td><?php echo $descripcion;?></td>
								<td><?php echo $precio;?></td>
								<td><?php echo $stock;?></td>
								<?php $dataproducto=esc($id)."*".esc($codigo)."*".esc($nombre)."*".esc($descripcion)."*".esc($precio)."*".esc($stock);?>	
							   <td>	
<button type="button" class="btn btn-info btn-view-rep-prod" data-toggle="modal" data-target="#modal-default" value="<?php echo $dataproducto;?>"><span class="fa fa-search"></span>

							</button>
					</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<p>No hay productos para mostrar.</p>
				<?php endif; ?>
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
                    <h4 class="modal-title">Información de los productos</h4>
                  </div>
                  <div class="modal-body">
                 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> Imprimir</span></button>
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