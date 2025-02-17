<!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<!-- 23 Feb 2018 -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/template/dist/img/rdxuymediano.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        <p>RDX Uruguay</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        </div>

<!--         <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
        </button>
        </span>
        </div>
        </form> -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo base_url();?>/">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Mantenimiento</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>mant/categorias"><i class="fa fa-circle-o"></i> Categorias</a></li>
                    <li><a href="<?php echo base_url(); ?>mant/clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                    <li><a href="<?php echo base_url(); ?>mant/productos"><i class="fa fa-circle-o"></i> Productos</a></li>
                    <li><a href="<?php echo base_url(); ?>mant/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share-alt"></i> <span>Movimientos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>movimientos/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
                    <li><a href="<?php echo base_url(); ?>movimientos/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
                    <li><a href="<?php echo base_url(); ?>movimientos/comprasdos"><i class="fa fa-circle-o"></i> ComprasDOS</a></li>                    
                    <!--
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Generar Factura</a></li>
                -->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-print"></i> <span>Reportes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Categorias</a></li>
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Clientes</a></li>
                    <li><a href="<?php echo base_url(); ?>reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
                    <li><a href="<?php echo base_url(); ?>reportes/productos"><i class="fa fa-circle-o"></i> Productos</a></li>
                    <li><a href="<?php echo base_url(); ?>reportes/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
                    <li><a href="<?php echo base_url(); ?>reportes/boletopagodgi"><i class="fa fa-circle-o"></i> Boleto Pago DGI</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i> <span>Administrador</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Tipo Documentos</a></li>
                    <li><a href="<?php echo base_url();?>admin/usuarios"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                    <li><a href="<?php echo base_url();?>admin/permisos"><i class="fa fa-circle-o"></i> Permisos</a></li>
                    <li><a href="<?php echo base_url();?>admin/liquidacionmensual"><i class="fa fa-circle-o"></i> Liquidac.Mensual</a></li>                            
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->