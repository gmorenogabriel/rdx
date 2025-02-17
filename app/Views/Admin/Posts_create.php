<!-- Estoy ahora en Views/Auth/Register.php
     tomamos la base de views/Front/Home.php para no trabajar el doble
-->
<?= $this->extend('Admin/layout/main') ?>
<?= $this->section('title') ?>
Crear Artículo
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1 class="title has-text-centered">Crear un nuevo Artículo</h1>
<form action="<?= base_url(route_to('posts_store')) ?>" enctype="multipart/form-data" method='POST'>
    <div class="columns">
        <!-- <div class="column is-four-fifths"> -->
        <div class="column is-three-quarters">
            <div class="field">
                <label class="label">Título</label>
                <div class="control">
                    <input type="text" class="input" name="title" placeholder="Text input" value="<?= old('title') ?>">
                </div>
                <p class="help is-danger"><?= session('errors.title') ?></p>
            </div>

            <div class="field">
                <label class="label">Cuerpo</label>
                <div class="control">
                    <textarea name="body" id="body" class="textarea" placeholder="Textarea">
                        <?= old('body') ?>
                    </textarea>
                </div>
                <p class="help is-danger"><?= session('errors.body') ?></p>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label class="label">Título</label>
                <div class="file has-name is-boxed">
                    <label class="file-label">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- action="<?php echo base_url('form/store'); ?>" 
                                <form action=""  name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    -->
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <label for="formGroupExampleInput">Name</label>
                                        <input type="file" name="file" class="form-control" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                                    </div>

                                    <div class="form-group col-md-9">
                                        <img id="blah" src="//www.tutsmake.com/wp-content/uploads/2019/01/no-image-tut.png" class="" width="200" height="150" />
                                    </div>

                                    <!--
                                         <div class="form-group">
                                            <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                                        </div>

                                </form>
                                -->
                                </div>
                            </div>

                            <!-- /*
                        <input type="file" class="file-input" name="cover" id="cover">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Elija un archivo...
                            </span>
                        </span>
                        <span class="file-name">
                            Imagen Pantalla 2023-02/12 a las 10:32
                        </span>
                    </label>
                    */
-->
                            <!--
                    <div class="container">
                        <br>

                        <?php if (session('msg')) : ?>
                            <div class="alert alert-info alert-dismissible">
                                <?= session('msg') ?>
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            </div>
                        <?php endif ?>

                        <div class="row">
                            <div class="col-md-9">
                                <form action="<?php echo base_url('form/store'); ?>" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="formGroupExampleInput">Name</label>
                                            <input type="file" name="file" class="form-control" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <img id="blah" src="//www.tutsmake.com/wp-content/uploads/2019/01/no-image-tut.png" class="" width="200" height="150" />
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                                        </div>

                                </form>
                            </div>
                        </div>

                    </div>
                        -->

                        </div>


                </div>
                <p class="help is-danger"><?= session('errors.cover') ?></p>
            </div>

            <div class="field">
                <label class="label">Fecha de publicación</label>
                <div class="control">
                    <input type="date" class="input" name="published_at" placeholder="Text input" value="<?= old('published_at') ?>">
                </div>
                <p class="help is-danger"><?= session('errors.published_at') ?></p>
            </div>
            <div class="field">
                <label class="label">Categorías</label>
                <?php if (empty($categories)) : ?>
                    <a href="<?= base_url(route_to('categories_create')) ?>">Agregar una categoría</a>
                <?php else : ?>
                    <?php foreach ($categories as $v) : ?>
                        <div class="field">
                            <label class="checkbox">
                                <input type="checkbox" name="categories[]" value="<?= $v->id ?>" <?=
                                                                                                    old('categories.*')
                                                                                                        ?
                                                                                                        (in_array($v->id, old('categories.*'))
                                                                                                            ? 'checked'
                                                                                                            : '')
                                                                                                        : ''
                                                                                                    ?> />
                                <?= $v->name ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <p class="help is-danger"><?= session('errors')['categories.*'] ?? '' ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
    <div class="field">
        <button type="submit" class="button is-fullwidth is-dark">Guardar</button>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->Section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"></script>
<script>
    function readURL(input, id) {
        id = id || '#blah';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    tinyMCE.init({
        mode: "textarea",
        //  theme : "simple",
        selector: '#body',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
            'searchreplace', 'visualblocks', 'code', 'fullscreen', 'wordcount',
            'media', 'table', 'paste', 'code', 'image', 'help'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | table | image | code | help ',
        images_file_types: 'jpg,svg,webp,png',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
<?= $this->endSection() ?>