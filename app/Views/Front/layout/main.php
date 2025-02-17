<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="<?=base_url("assets/template/dist/css/bulma.min.css"); ?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
		<link rel="stylesheet" href="<?=base_url("assets/template/dist/css/bootstrap.min.css"); ?>">
		<!-- Agregar los js dentro de js.php en la ruta Views->Front->js.php
			<script src="http://localhost:8084/rdx/public/js/jquery-3.4.1.js"></script>
			-->
		<title><?=$this->renderSection('tile')?>&nbsp;-&nbsp;Mi Blog</title>
		<?=$this->renderSection('<?=base_url("css/custom.css')?>
	</head>
	<body>
		<?=$this->include('Front/layout/header')?>
		<?=$this->renderSection('content')?>
		<?=$this->include('Front/layout/footer')?>
		<?=$this->include('sweetalert2')?>
		<?=$this->include('Front/layout/js')?>
	</body>
</html>

