<!DOCTYPE html>
<html lang="es"> <!--lang="<?= $locale ?>">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>RDX UY</title>
		<!-- Normalize V8.0.1 -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/normalize.css">

		<!-- Bootstrap V4.3 -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">

<!-- Bootstrap Material Design V4.0 -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-material-design.min.css">

		<!-- Font Awesome V5.9.0 -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/all.css">

		<!-- Sweet Alerts V8.13.0 CSS file -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/sweetalert2.min.css">

		<!-- Sweet Alert V8.13.0 JS file-->
		<script src="<?php echo base_url();?>js/sweetalert2.min.js" ></script>

		<!-- jQuery Custom Content Scroller V3.1.5 -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/jquery.mCustomScrollbar.css">

		<!-- General Styles -->
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css"></head>
	<body>
		<div class="login-container">
			<div class="login-content">

				<p class="text-center">
					<i class="fas fa-user-circle fa-5x"></i>
				</p>
				<p class="text-center">
					Inicia sesión
				</p>

				<form action="<?=base_url(route_to('signin'))?>" method="POST" autocomplete="off" >
					<div class="form-group">
						<label for="email" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Usuario</label>
						<input type="email" class="form-control" id="email" name="email" maxlength="35" required="" >
					</div>
					<p style="color:red;"><?=session('errors.email')?></p>
					<div class="form-group">
						<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
						<input type="password" class="form-control" id="password" name="password" maxlength="100" required="" >
					</div>


					<p style="color:red;"><?=session('errors.password')?></p>
					<button type="submit" class="btn-login text-center">LOG IN</button>

				</form>
			</div>
		</div>
	</section>
<!-- < ? = $this->endSection() ? >
