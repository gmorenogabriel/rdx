<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Lista de Articulos
<?php echo CodeIgniter\CodeIgniter::CI_VERSION; ?>
<?php echo config('App')->appTimezone; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--  Prueba de mensajes
    < ? php if (isset($_SESSION['msgToast'])): ?>
    <div class="alert alert-warning" role="alert">
        < ? = $_SESSION['msgToast']['s2Texto']; ?>
    </div>
< ? php endif;?>
 -->

<div class="container">
  <section class="section">
    <div class="field">
      <a class="button is-dark" href="<?= base_url(route_to('posts_create')) ?>">Agregar Articulos</a>
	  	<a class="button is-dark" href="<?= base_url(route_to('posts')) ?>">Regresar</a>
    </div>

    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
      <thead>
        <tr class="bg-info">
          <th>Id</th>
          <th>Titulo</th>
          <th>Descripcion</th>
          <th>Autor</th>
          <th>Publicado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
		<?php foreach ($datos as $v) : ?>
		<tr>		   
			<td><?= $v['id'] ?></td>
			<td><?= $v['title'] ?></td>
			<td><?= $v['body'] ?></td>
			<td><?= $v['author'] ?></td>
			<td><?= $v['published_at']?></td>
		
			 <td>Ver</td>
		</tr>
        <?php endforeach; ?>
       </tbody>
     </table>
	 <?php isset($datos) ? 'vino' : 'falso vino' ?>
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
console.log("Hello World 1 - setFlashdata ");
<?php if(isset($s2Icono)) { ?>	
    <?php if($s2Icono == 'success') { ?>
		 console.log("Hello World 1 " + $s2Icono);
			Swal.fire({
				position: 'top-end',
				title: "<?= session()->getFlashdata('success') ?>",
				text:  "<?= session()->getFlashdata('s2Texto') ?>",
				icon:  "<?= session()->getFlashdata('s2Icono') ?>",
			//	toast: "<?= session()->getFlashdata('s2Toast') ?>",
				showConfirmButton: false,
				background: '#E0FFFF',
				timer: 2000,
			});
    <?php } ?>

    <?php if( $s2Icono == 'error'  || $s2Icono == 'warning'){ ?>
			console.log('sweetalert -> Swal -> NoToast -> error/Warning');
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