<section class="hero is-info">
    <div class="hero-body">
      <div class="container">
          <a class="navbar-item">
         Mi Blog al <?php $time = time();echo date("d-m-Y");?>
          </a>
        <h1 class="title">
            Bienvenidos a la Tienda de RDX Uruguay
        </h1>
        <h2 class="subtitle">
            Lista de entrada
        </h2>
    </div>
  </div>
  <div class="hero-foot">
    <nav class="tabs is-boxed is-fullwidth">
      <div class="container">
        <ul>
			<!--- // falta < ? = service('request') -->
		  <li><a href="<?=base_url(route_to('dashboard'))?>">Inicio</a>
		  </li>
		  <!--- // falta < ? = service('request') -->
		  <li><a href="<?=base_url(route_to('register'))?>">Registro</a>
		  </li>
		  <?php if(session()->is_logged): ?>

		  	  <li><a href="<?=base_url(route_to('dashboard'))?>">Ir al Dashboard</a></li>
		  	  <li><a href="<?=base_url(route_to('signout'))?>">Salir</a></li>		
		  <?php else: ?>
				<li><a href="<?=base_url(route_to('login'))?>">Login</a></li>
		  <?php endif; ?>


        </ul>
      </div>
    </nav>
  </div>
</section>