<!-- Estoy ahora en Views/Auth/Register.php
	tomamos la base de views/Front/Home.php para no trabajar el doble
-->		
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>SISTEMAS PRESTAMOS</title>
	<!-- Normalize V8.0.1 -->
<link rel="stylesheet" href="http://localhost:8084/rdx/public/css/normalize.css">

<!-- Bootstrap V4.3 -->
<link rel="stylesheet" href="http://localhost:8084/rdx/public/css/bootstrap.min.css">

<!-- Bootstrap Material Design V4.0 -->
<link rel="stylesheet" href="http://localhost:8084/rdx/public/css/bootstrap-material-design.min.css">

<!-- Font Awesome V5.9.0 -->
<link rel="stylesheet" href="http://localhost:8084/rdx/public/css/all.css">

<!-- Sweet Alerts V8.13.0 CSS file -->
<link rel="stylesheet" href="http://localhost:8084/rdx/public/css/sweetalert2.min.css">

<!-- Sweet Alert V8.13.0 JS file-->
<script src="http://localhost:8084/rdx/public/js/sweetalert2.min.js" ></script>

<!-- jQuery Custom Content Scroller V3.1.5 -->
<link rel="stylesheet" href="http://localhost:8084/rdx/public/css/jquery.mCustomScrollbar.css">

<!-- General Styles -->
<link rel="stylesheet" href="http://localhost:8084/rdx/public/css/style.css"></head>
<body>
	<div class="login-container">
	<div class="login-content">
		<p class="text-center">
			<i class="fas fa-user-circle fa-5x"></i>
		</p>
		<p class="text-center">
			Inicia sesión
		</p>
		<form action="" method="POST" autocomplete="off" >
			<div class="form-group">
				<label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Usuario</label>
				<input type="text" class="form-control" id="UserName" name="usuario_log" pattern="[a-zA-Z0-9]{1,35}" maxlength="35" required="" >
			</div>
			<div class="form-group">
				<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
				<input type="password" class="form-control" id="UserPassword" name="clave_log" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
			</div>
			<button type="submit" class="btn-login text-center">LOG IN</button>
		</form>
	</div>
</div>

</div>
</section>	