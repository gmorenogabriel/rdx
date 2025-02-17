<?php
$tipo=isset($tipo) ? $tipo : null	;


	if ( $tipo == 'success' ): ?>
		console.log('tipo success');
		<script>
				console.log('sweetalert -> Swal -> msgToast-> success');
				Swal.fire({
					animation: true,
					position: '<?php echo $posicion; ?>',
					title: '<?php echo $titulo; ?>',
					text: '<?php echo $texto; ?>',
					icon: '<?php echo $tipo; ?>',
					toast: '<?php echo $toast; ?>',
					background: '#E0FFFF',
					timer: 2000,
					timerProgressBar: true,
					didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				});
			</script>

	<?php endif; ?>	

	<?php 
		if ($tipo == 'info' ): ?>
		console.log('tipo: info');
		<script>
			console.log('sweetalert -> Swal -> msgToast-> info');
			Swal.fire({
				animation: true,
				position: '<?php echo $posicion; ?>',
				title: '<?php echo $titulo; ?>',
				text: '<?php echo $texto; ?>',
				icon: '<?php echo $tipo; ?>',
				toast: '<?php echo $toast; ?>',
				showConfirmButton: '<?php echo $botonConfirma; ?>',
				background: '#E0FFFF',
				timer: 2000,
				timerProgressBar: true,
				didOpen: (toast) => {
				  toast.addEventListener('mouseenter', Swal.stopTimer)
				  toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			});
		</script>

	<?php endif; ?>

	<?php
	if( $tipo == 'error'  || $tipo == 'warning'): ?>
		<script>
			console.log('sweetalert -> Swal -> NoToast -> error/Warning');
			Swal.fire({
				title: '<?php echo $titulo; ?>',
				text: '<?php echo $texto; ?>',
				icon: '<?php echo $tipo; ?>',
				confirmButtonColor: '#dd6b55',
				footer: '<a href><?php echo $pie; ?></a>',
			 	timerProgressBar: true,
				didOpen: (toast) => {
				  toast.addEventListener('mouseenter', Swal.stopTimer)
				  toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			});
		</script>


	<?php endif; ?>
