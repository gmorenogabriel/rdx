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
		<b align="center">PRODUCTO</b1><br>
	</div>		
		<div class="col-xs-12 text-left"></div>
			<div class="row"></div> 
				<?php if (isset($productos) && (is_array($productos) || is_object($productos))): ?>
					<?php foreach ($productos as $producto): ?>
						<?php
								$codigo = $producto['codigo'] ?? ($producto->codigo ?? 'N/A');
								$nombre = $producto['nombre'] ?? ($producto->nombre ?? 'N/A');
								$descripcion = $producto['descripcion'] ?? ($producto->descripcion ?? 'N/A');
								$precio = $producto['precio'] ?? ($producto->precio ?? 'N/A');
								$stock = $producto['stock'] ?? ($producto->stock ?? 'N/A');
							?>
							// Asegurarte de que cada producto tenga los campos necesarios antes de usarlos.
							<b>   Codigo 		:</b><?php echo $codigo;?><br>
							<b>   Nombre 		:</b><?php echo $nombre;?><br>
							<b>   Descripción	:</b><?php echo $descripcion;?><br>
							<b>   Precio		:</b><?php echo $descripcion;?><br>
							<b>   stock			:</b><?php echo $stock;?><br>
	
		
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
					<th align="right">Codigo</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th text-align="right">Precio</th>
					<th text-align="right">Stock</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $codigo;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $descripcion;?></td>					
					<td align="right"><?php echo number_format($precio, 2, ",", "."); ?></td>
					<td align="center"><?php echo $stock; ?></td>
					</td>

				</tr>
			</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
</div>