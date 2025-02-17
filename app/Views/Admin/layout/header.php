<!-- <script src="<?php echo base_url(); ?>js/sweetalert2.all.min.js"></script> -->
<section class="hero is-dark">
	<div class="hero-head">
		<nav class="navbar">
			<div class="container">
				<div class="navbar-brand">
					<a class="navbar-item">
						Mi RDX al  <?php $time = time();echo date("d-m-Y");?>
					</a>
				</div>
				<div id="navbarMenuHeroB" class="navbar-menu">
					<div class="navbar-end">
						<a class="navbar-item">
							<?= session('username') ?>
						</a>
						<a class="navbar-item" href="<?= base_url(route_to('signout')) ?>">
							Cerrar Sesión
						</a>
					</span>
					</div>
				</div>
			</div>
		</nav>
	</div>
	<div class="hero-body">
		<div class="container">
			<h1 class="title">
				Dashboard del Blog
			</h1>
			<h2 class="subtitle">
				Administra la Tienda RDX
			</h2>
		</div>
	</div>
	<div class="hero-foot">
		<nav class="tabs is-boxed is-fullwidth">
			<div class="container">
				<ul>
					<?php $uri=service("uri")->getRoutePath(); ?>
<!--					<?php if(service("uri")->getRoutePath() == 'admin/articulos') : ?> -->
					<li class="<?php service("uri")->getRoutePath() == 'admin/articulos' ? 'navbar-item is-active' : '' ?>">
						<a href="<?=base_url(route_to('dashboard'))?>">Articulos</a>
					</li>
<!--					<?php endif?>   -->

<!--					<?php if(service("uri")->getRoutePath() == 'admin/articulos') : ?> -->
					<li class="<?php $uri=service("uri")->getRoutePath();
						preg_match('|^admin/categorias(\S)*$|', $uri, $matches) ? 'navbar-item is-active' : '' ?>">
						<a href="<?=base_url(route_to('categories'))?>">Categorías</a>
					</li>
<!--					<?php endif?>	  -->

<!--					<?php if(service("uri")->getRoutePath() == 'admin/articulos') : ?> -->
					<li class="<?php service("uri")->getRoutePath() == 'admin/usuarios' ? 'navbar-item is-active' : '' ?>">
						<a href="<?=base_url(route_to('users'))?>">Usuarios</a>
					</li>
<!--					<?php endif?>		 -->
				</ul>
			</div>
		</nav>
	</div>
</section>