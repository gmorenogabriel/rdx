<!--
    Estan definidos en "Views\layouts\footer

    <script src="<?= base_url()?>assets/template/dist/js/jquery-3.7.1.js"></script> 
    <script src="<?= base_url()?>assets/template/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url()?>assets/template/dist/js/sweetalert2.all.min.js"></script>
-->
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

