<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script type="text/javascript">
    <?php $session = \Config\Services::session(); ?>
    <?php echo $session->has('success');?>
    <?php if($session->has('success')){ ?>
        swal.success("<?= $session->has('success'); ?>");
    <?php }else if($session->getFlashdata('error')){  ?>
        swal.error("<?php echo $this->session->getFlashdata('error'); ?>");
    <?php }else if($this->session->getFlashdata('warning')){  ?>
        swal.warning("<?php echo $this->session->getFlashdata('warning'); ?>");
    <?php }else if($this->session->getFlashdata('info')){  ?>
        swal.info("<?php echo $this->session->getFlashdata('info'); ?>");
    <?php } ?>


    </script>
