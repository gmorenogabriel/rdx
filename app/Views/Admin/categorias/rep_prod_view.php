<!-- 25 Feb 2018 -->
<div class="row">
	<div class="col-xs-12 text-center">
		<b>productos la Sin Rival</b><br>
		Estancia Chica 2218 <br>
		Tel. 2901 96 67 <br>
		Email:yonybravo@gmail.com
	</div>
</div> <br>
<div class="row">
	<div class="col-xs-12 text-center">
		<b align="center">CATEGORIA</b1><br>
	</div>		
		<div class="col-xs-12 text-left"></div>
			<div class="row"></div> 
				<?php if (isset($categorias) && (is_array($categorias) || is_object($categorias))): ?>
					<?php foreach ($categorias as $categoria): ?>
						<?php
								$id = $categoria->id;
								$nombre = $categoria->nombre;
								$descripcion = $categoria->descripcion;
							?>
							// Asegurarte de que cada producto tenga los campos necesarios antes de usarlos.
							<b>   Id 		:</b><?php echo $id;?><br>
							<b>   Nombre 	:</b><?php echo $nombre;?><br>
							<b>   Descripcion:</b><?php echo $telefono;?><br>	
		
					<?php endforeach; ?>
				<?php else: ?>
					<p>No hay productos para mostrar.</p>
				<?php endif; ?>
			</div>	
		</div>
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th align="right">Id</th>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Descripcion</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $id;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $descripcion;?></td>	
				</tr>
			</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
</div>