<!-- Estoy ahora en Views/Auth/Register.php
     tomamos la base de views/Front/Home.php para no trabajar el doble
-->
<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Lista de Articulos
<?= $this->endSection() ?>

<?=$this->section('content')?>
<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Lista de Artículos
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="field">
  <a class="button is-dark" href="<?= base_url(route_to('posts_create')) ?>">Agregar Articulos</a>
</div>
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>Id</th>
      <th>Titulo</th>
      <th>Descripcion</th>
      <th>Autor</th>
      <th>Publicado</th>
      <!--<th>Acciones</th>       -->
    </tr>
  </thead>
  <tbody>
    <!--  =<?php dd($articulos) ?> -->
    <?php foreach ($articulos as $v) : ?>
      <tr>
        <td><?= $v['id'] ?></td>
        <td><?= $v['title'] ?></td>
        <td><?= $v['body'] ?></td>
        <td><?= $v['author'] ?></td>
        <td><?= $v['published_at'] ?></td>
        <!-- <td><a href="<?= $v->getEditLink() ?>">Ver</a></td>  -->
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?= $pager->Links() ?>
<?= $this->endSection() ?>