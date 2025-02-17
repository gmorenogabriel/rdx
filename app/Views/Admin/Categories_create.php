<!-- Estoy ahora en Views/Auth/Register.php
	tomamos la base de views/Front/Home.php para no trabajar el doble
-->
<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Agregar una Categoría
<?= $this->endSection() ?>

<?=$this->section('content')?>
<form action="<?=base_url(route_to('categories_store'))?>" method="POST">
	<div class="field">
		<label class="label">Nombre de la Categoría</label>
		<div class="control">
			<input class="input" name="name" value="<?=old('name')?>" type="text" placeholder="Text input">
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

<?= $this->endSection() ?>