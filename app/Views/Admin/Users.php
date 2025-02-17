<!-- Estoy ahora en Views/Auth/Register.php
	tomamos la base de views/Front/Home.php para no trabajar el doble
-->
<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Lista de Usuarios
<?= $this->endSection() ?>

<?=$this->section('content')?>
<!--
	<div class="field">
    <a class="button is-dark" href="<?=base_url(route_to('categories_create'))?>">Agregar nueva Categoría</a>
	</div>
-->
<div class="row">
	<a class="button is-dark" href="<?= base_url(route_to('posts')) ?>">Regresar</a>
</div>	
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
	<thead>
		<tr class="bg-info">
			<th>Id</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Grupo</th>
			<th>Creado</th>
			<th>Actualizado</th>
			<th>Acciones</th>      
		</tr>
	</thead>
	<tbody>  
		
		<!--
			Verificamos si es un Array o un Objeto 
		-->
	<?php if(is_object($datos)): ?>
	<!-- Getting an Object
		 getResultObject()
	-->
        <?php foreach($datos->getResult() as $v): ?>  
		<tr>
			<td><?=$v->id ?></td>
			<td><?=$v->username ?></td>
			<td><?=$v->email ?></td>
			<td><?=$v->group ?></td>
			<td><?=$v->created_at->format('d-m-Y') ?></td>
			<td><?=$v->updated_at->humanize() ?></td>
			<td><a href="<?=$v->getEditLink() ?>">Editar</a> | <a href="<?= $v->getDeleteLink() ?>">Eliminar</a></td>
			
		</tr>
		<?php endforeach; ?>
		
		<?php endif ?>		
		
		<?php if(is_Array($datos)): ?>
		<!--	Getting an Array of Array
			< ? php log.message("Es un Object, " . $this->clase) ?>
		 -->
			<?php foreach ($datos as $v) : ?>
			<tr>		   
				<td><?= $v['id'] ?></td>
				<td><?= $v['username'] ?></td>
				<td><?= $v['email'] ?></td>
				<td><?= $v['group'] ?></td>
				<td><?= $v['created_at']?></td>
				<td><?= $v['updated_at']?></td>
				<td>Ver</td>
			</tr>
			<!--	<td><a href="< ? =$v['getEditLink()']?>">Editar</a> | <a href="< ? = $v['getDeleteLink()']?>">Eliminar</a></td> -->
			
			<?php endforeach; ?>
			
			<?php endif ?>		
		</tbody>
	</table>
	<?php if (isset($pager)):?>
	<div class="pagination justify-content-center mb-4">		
		<?= $pager->Links() ?>
	</div>
	<?php endif; ?>
	<!-- ------------------
		Inicio Java Script 
		-------------------
	-->
	<script src="<?php echo base_url(); ?>js/jquery-3.7.1.min.js"></script>
	<script src="<?php echo base_url(); ?>js/sweetalert2.all.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert2.min.css">
	
	<script type="text/javascript">
		$(document).ready(function () {	
			console.log("Hello World 1 - s2Icono ");
			<?php if(isset($s2Icono)) { ?>		
				<?php if($s2Icono == 'success') { ?>
					console.log("Hello World 1 " + $s2Icono);
					Swal.fire({
						position: 'top-end',
						title: "<?= session()->getFlashdata('success') ?>",
						text:  "<?= session()->getFlashdata('s2Texto') ?>",
						icon:  "<?= session()->getFlashdata('s2Icono') ?>",
						toast: "<?= session()->getFlashdata('s2Toast') ?>",
						showConfirmButton: false,
						background: '#E0FFFF',
						timer: 2000,
					});	
				<?php } ?>
				
				<?php if($s2Icono == 'success') { ?>
					console.log("Hello World 1 " + $s2Icono);
					Swal.fire({
						position: 'top-end',
						title: '<?php echo $s2Titulo; ?>',
						text: '<?php echo $s2Texto; ?>',
						icon: '<?php echo $s2Icono; ?>',
						toast: '<?php echo $s2Toast; ?>',
						showConfirmButton: false,
						background: '#E0FFFF',
						timer: 2000,
					});	
				<?php } ?>
				
				<?php if($s2Icono == 'error') { ?>
					console.log("s2Icono == error");
					Swal.fire({
						title: '<?php echo $s2Titulo; ?>',
						text: '<?php echo $s2Texto; ?>',
						icon: '<?php echo $s2Icono; ?>',
						confirmButtonColor: '#dd6b55',
						//footer: '<a href><?php echo $s2Footer; ?></a>',
						//footer: '<a href>Why do I have this issue?</a>'
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					});
				<?php } ?>
			<?php } ?>	 
		</script>	
	<?= $this->endSection() ?>	