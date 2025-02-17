<!-- Estoy ahora en Views/Auth/Register.php
     tomamos la base de views/Front/Home.php para no trabajar el doble
-->
<?=$this->extend('Front/layout/main')?>
<?=$this->section('title')?>
Registro al <?php $time = time();echo date("d-m-Y");?>	

<?=$this->endSection()?>
<?=$this->section('css')?> 
	<link rel="stylesheet" src="<?= base_url()?>webfonts/font-awesome.min.css">
	
<?=$this->endSection()?>
<?=$this->section('content')?>
<!-- <h1>Registro de Usuarios</h1> -->
	<section class="section">
		<div class="container">
		  <h1 class="title">Registrate ya!</h1>
		  <h2 class="subtitle">
			Solicitamos unos pocos datos para comenzar a publicar.
		  </h2>
		  
		  <!-- copiados desde Aqui -->
	  <!-- <?php session() ?> -->
		<form action="<?=base_url('auth/store')?>" method="POST">
		<div class="field">
			<label class="label">Nombre</label>
			<div class="control has-icons-left has-icons-right">
				<input name="name" value="<?=old('name')?>" class="input" type="text" placeholder="Text input">
				<span class="icon is-small is-left">
					<i class="fas fa-user"></i>
				</span>
			</div>
			<p style="color:red;"><?=session('errors.name')?></p>
		</div>

		<div class="field">
			<label class="label">Apellidos</label>
			<div class="control has-icons-left has-icons-right">
				<input name="surname" value="<?=old('surname')?>" class="input is-success" type="text" placeholder="Text input" value="bulma">
				<span class="icon is-small is-left">
					<i class="fas fa-user"></i>
				</span>
				<span class="icon is-small is-right">
					<i class="fas fa-check"></i>
				</span>
			</div>
			<p style="color:red;"><?=session('errors.surname')?></p>
			<!-- <p class="help is-success">This username is available</p> -->
		</div>

		<div class="field">
			<label class="label">Correo</label>
			<div class="control has-icons-left has-icons-right">
				<input name="email" value="<?=old('email')?>" class="input" type="email" placeholder="Email input" value="hello@">
				<span class="icon is-small is-left">
					<i class="fas fa-envelope" style="font-size:24px"></i>
				</span>
				<span class="icon is-small is-right">
					<i class="fas fa-exclamation-triangle"></i>
				</span>
			</div>
			<p class="help"></p>
			<p style="color:red;"><?=session('errors.email')?></p>
		</div>

		<div class="field">
			<label class="label">Selecciona tu País</label>
			<div class="control">
				<div class="select">
					<select name="id_country">
						<option disabled selected>Elije un país</option>
						<?php foreach ($countries as $v): ?>
							<option value="<?=$v->id_country?>"
							<?php if ($v->id_country == old('id_country')):?>selected <?php endif;?>><?=$v->name?></option>
						<?php endforeach; ?>
					</select>
				</div>            
			</div>
			<p style="color:red;"><?=session('errors.id_country')?></p>
		</div>
		<div class="field">
			<label class="label">Contraseña</label>
			<div class="control has-icons-left has-icons-right">
				<input name="password" value="" class="input is-success" type="password" placeholder="Text input" value="bulma">
				<span class="icon is-small is-left">
					<i class="fas fa-key"></i>
				</span>
				<span class="icon is-small is-right">
					<i class="fas fa-check"></i>
				</span>
				<p style="color:red;"><?=session('errors.password')?></p>            
			</div>
			<div class="field">
			<label class="label">Confirmar Contraseña</label>
			<div class="control has-icons-left has-icons-right">
				<input name="c-password" value="" class="input is-success" type="password" placeholder="Text input" value="bulma">
				<span class="icon is-small is-left">
					<i class="fas fa-key"></i>
				</span>
				<span class="icon is-small is-right">
					<i class="fas fa-check"></i>
				</span>
			</div>
		</br>
		<div class="field is-grouped">
			<div class="control">
				<button class="button is-info">Registrarse</button>
			</div>
		</div>	  
		  
	<!-- Fin Copiado -->	  

	 </div>
	</section>
 
<?=$this->endSection()?>