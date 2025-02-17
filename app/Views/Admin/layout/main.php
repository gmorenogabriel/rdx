<!DOCTYPE html>
<html lang="es"> <!--lang="<?= $locale ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url()?>assets/template/dist/css/bulma.min.css">
  <link rel="stylesheet" src="<?= base_url()?>assets/template/webfonts/font-awesome_6-2-1-all.css">
    <!-- Preview muestra las imagenes -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">
<!-- Agregar los js dentro de js.php en la ruta Views->Front->js.php
  <script src="http://localhost:8084/rdx/public/js/jquery-3.4.1.js"></script>
  <script src="<?= base_url()?>js/jquery-3.7.1.js"></script>
 -->
  <title><?= $this->renderSection('title') ?>&nbsp;-&nbsp;Dashboard </title>
</head>

<body>

  <?= $this->include('Admin/layout/header') ?>
  <section class="section">
    <div class="container">
      <?php if (session('msg')) : ?>
        <article class="message is-<?= session('msg.type') ?>">
          <div class="message-body">
            <?= session('msg.body') ?>
          </div>
        </article>
      <?php endif; ?>
      <?= $this->renderSection('content') ?>
    </div>
  </section>
  <?= $this->include('sweetalert2')?>
  <?= $this->include('Front/layout/js') ?>

  </body>

</lang=>