<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Lista de Categorías
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
	<a class="button is-dark" href="<?= base_url(route_to('categories_create')) ?>">Agregar nueva Categoría</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<!--
		</div>

		<div class="field">
	-->
	<a class="button is-dark" href="<?= base_url(route_to('posts')) ?>">Regresar</a>
</div>
 <!-- <button onclick="Swal.fire()">Swal</button>  -->

<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
	<thead>
		<tr class="bg-info">
			<th>Id</th>
			<th>Nombre</th>
			<th>Creado</th>
			<th>Actualizado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $datos as $v) : ?>
		<tr>

			<td><?= esc($v['id']) ?></td>
			<td><?= esc($v['name']) ?></td>
			<td><?= esc($v['created_at']) ?></td>
			<td><?= esc($v['updated_at']) ?></td>
		<!--	<td>< ? = $v->created_at->format('d-m-y') ?></td>
			<td>< ? = $v->updated_at->humanize() ?></td>

			<td><a href="< ? = $v['getEditLink()'] ?>">Editar</a> | <a href="< ? = $v['getDeleteLink()'] ?>">Eliminar</a></td>
		-->
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php if (isset($pager)):?>
<div class="pagination justify-content-center mb-4">
	<?= $pager->Links() ?>
</div>
<?php endif; ?>

<?= $this->endSection() ?>