<!-- Estoy ahora en Views/Auth/Register.php
     tomamos la base de views/Front/Home.php para no trabajar el doble
-->
<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Editar Categoría - <?=$category->name ?>
<?= $this->endSection() ?>

<?=$this->section('content')?>
<form action="<?=base_url(route_to('categories_update'))?>" method="POST">

<div class="field">
  <label class="label">Nombre de la Categoría</label>
  <div class="control">
    <input class="input" name="name" value="<?=old('name') ?? $category->name ?>" type="text" placeholder="Text input">
    <input class="input" name="id" value="<?=$category->id ?>" type="hidden" placeholder="Text input">    
  </div>
  <p class="help is-danger">
    <?=session('errors.name')?>
  </p>    
</div>
<div class="field">
<div class="control">
  <input type="submit" class="button is-dark" value="Guardar">
</div>
</div>

</form>
<?php if (isset($pager)):?>
<div class="pagination justify-content-center mb-4">
	<?= $pager->Links() ?>
</div>
<?php endif; ?>
<!-- ------------------
	Inicio Java Script
	-------------------
-->
<!--
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
-->
<?= $this->endSection() ?>
