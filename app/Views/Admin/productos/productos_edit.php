<!-- Estoy ahora en Views/Auth/Register.php
	tomamos la base de views/Front/Home.php para no trabajar el doble
-->
<?= $this->extend('Admin/layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-md-7">
			<div class="card shadow">
				<div class="card-header">
					<h5> Modificar Productos 
						<a href="<?= base_url('/admin/productos') ?>" class="btn btn-danger btn-sm float-end">Regresar</a>
					</h5>
				</div>
				<div class="card-body">					
					<form action="<?= base_url('/admin/productos/actualizar/'.$producto['id']) ?>" method="POST" enctype="multipart/form-data">
						<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-2">
									<label>Código de Producto</label>
									<input type="text" name="codigo"  value="<?= $producto['codigo'] ?>" class="form-control" required placeholder="Ingrese código de producto">
								</div>
							</div>												
							<div class="col-md-6">
								<div class="form-group mb-2">
									<label>Nombre del Producto</label>
									<input type="text" name="nombre" value="<?= $producto['nombre'] ?>"  class="form-control" required placeholder="Ingrese nombre producto">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-2">
									<label>Descripción</label>
									<textarea name="descripcion" value="<?= $producto['descripcion'] ?>" class="form-control" required placeholder="Ingrese descripción" rows="3"><?= $producto['descripcion'] ?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-2">
									<label>Precio</label>
									<input type="text" name="precio" value="<?= $producto['precio'] ?>" class="form-control" required placeholder="Ingrese precio">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-2">
									<label>Stock</label>
									<input type="text" name="stock" value="<?= $producto['stock'] ?>" class="form-control" required placeholder="Ingrese Stock">
								</div>							
							</div>
							<div class="col-md-12">
								<div class="form-group mb-2">
									<label>Imagen</label>
									<input type="file" name="imagen" class="form-control"/>
								</div>
							</div>
							<div class="col-md-12">
								<hr>
								<button type="submit" class="btn btn-primary px-4 float-end"> Actualizar</button>
							</div>
						</div>		
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<img src="<?= base_url('../uploads/'.$producto['imagen']) ?>" class="w-100" alt="Imagen de Producto">
		</div>
	</div>
</div>		

<?= $this->endSection() ?>
