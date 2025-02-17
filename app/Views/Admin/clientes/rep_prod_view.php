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
		<b align="center">CLIENTE</b1><br>
	</div>		
		<div class="col-xs-12 text-left"></div>
			<div class="row"></div> 
				<?php if (isset($clientes) && (is_array($clientes) || is_object($clientes))): ?>
					<?php foreach ($clientes as $cliente): ?>
						<?php
								$id = $cliente->id;
								$nombre = $cliente->nombre;
								$telefono = $cliente->telefono;
								$direccion = $cliente->direccion;
								$ruc = $cliente->ruc;
								$empresa = $cliente->empresa;
							?>
							// Asegurarte de que cada producto tenga los campos necesarios antes de usarlos.
							<b>   Id 		:</b><?php echo $id;?><br>
							<b>   Nombre 		:</b><?php echo $nombre;?><br>
							<b>   Telefono	:</b><?php echo $telefono;?><br>
							<b>   Direccion	:</b><?php echo $direccion;?><br>
							<b>   Ruc		:</b><?php echo $ruc;?><br>
							<b>   Empresa			:</b><?php echo $empresa;?><br>
	
		
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
					<th>Direccion</th>
					<th text-align="right">Ruc</th>
					<th text-align="right">Empresa</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $id;?></td>
					<td><?php echo $nombre;?></td>
					<td><?php echo $telefono;?></td>	
					<td><?php echo $direccion;?></td>	
					<td align="right"><?php echo number_format($ruc, 2, ",", "."); ?></td>
					<td align="center"><?php echo $empresa; ?></td>
					</td>

				</tr>
			</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
</div>