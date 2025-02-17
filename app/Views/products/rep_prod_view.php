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
				<?php if(!empty($productos)):?>
					<?php foreach($productos as $producto):?>		

						<b>   Codigo 		:</b><?php echo $producto->codigo;?><br>
						<b>   Nombre 		:</b><?php echo $producto->nombre;?><br>
						<b>   Descripción	:</b><?php echo $producto->descripcion;?><br>
	<!--
					<b>Precio		:</b><?php echo $producto->precio;?><br>
					<b>Stock		:</b><?php echo $producto->stock;?><br>
					<b>Categoria	:</b><?php echo $producto->categoria;?></br>
	-->				
					<?php endforeach;?>
				<?php endif;?>
			</div>	
	<!--
		</div>	
		<div class="col-xs-6">	
			<b>COMPROBANTE</b><br>
			<b>Tipo de Comprobante:</b><?php echo $producto->tipocomprobante;?><br>
			<b>Serie:</b><?php echo $producto->serie;?><br>
			<b>Nro de Comprobante:</b><?php echo $producto->num_documento;?><br>
			<b>Fecha:</b><?php echo $producto->fecha;?>
	-->
		</div>
	</b>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th align="right">Codigo</th>
					<th>Nombre</th>
					<th text-align="right">Precio</th>
					<th text-align="right">Stock</th>
					<th text-align="right">Categoría</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $producto->codigo;?></td>
					<td><?php echo $producto->nombre;?></td>
					<!-- <td><?php echo $detalle->precio;?></td>-->
					<td align="right"><?php echo number_format($producto->precio, 2, ",", "."); ?></td>
					<td align="center"><?php echo $producto->stock; ?></td>
					<td align="left"><?php echo $producto->categoria;?></td>
					</td>

				</tr>
			</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
</div>