<?php

use CodeIgniter\Router\RouteCollection;


 /* --------------------------------------------------------------------
 * Router Setup viene de versiones anteriores
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Login');
//$routes->setDefaultController('App\Controllers\Auth\Registers');
//$routes->setDefaultController('App\Controllers\Front\Home');
//$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/**
 * @var RouteCollection $routes
 *
 *  Ruta principal que viene por defecto
   $routes->get('/', 'Home::index');
 */

	$routes->group('/',['namespace' => 'App\Controllers\Front'],function($routes){
		$routes->get('', 					'Dashboard::index', 	['as' => 'dashboard']);
		$routes->get('articulo/(:segment)', 'Home::article/$1', 	['as' => 'article']);
	});
	
	$routes->group('reportes', ['namespace' => 'App\Controllers\Reportes'], function($routes){
		$routes->get('categorias', 				'Categorias::index',			['as' => 'repcategorias']);
		$routes->get('clientes', 				'Clientes::index',	 			['as' => 'repclientes']);
        $routes->get('productos', 				'Productos::index',	 			['as' => 'repproductos']);
 //		$routes->get('productos/rep_prod_view',	'Productos::rep_prod_view',	 	['as' => 'productos_rep']);
	});
	$routes->group('auth',['namespace' => 'App\Controllers\Auth'],function($routes){
		$routes->get('registro', 	'Register::index',						['as' => 'register']);
		$routes->post('store',   	'Register::store');
		$routes->get('login',    	'Login::index',							['as' => 'login']);
		$routes->post('check',   	'Login::signin',						['as' => 'signin']);
		$routes->get('logout',    	'Login::signout',						['as' => 'signout']);
	// $routes->get('articulo/(:segment)', 'Home::article/$1', ['as' => 'article']);
	});

	$routes->group('mant', ['namespace' => 'App\Controllers\Mantenimiento'], function($routes){
		$routes->get('categorias', 					'Categorias::index',	 ['as' => 'categorias']);
		$routes->get('categorias/crear',    		'Categorias::create',    ['as' => 'categorias_create']);
		$routes->get('categorias/editar/(:any)', 	'Categorias::edit/$1',	 ['as' => 'categorias_edit']);
		$routes->get('categorias/borrar/(:any)', 	'Categorias::delete/$1', ['as' => 'categorias_delete']);
		$routes->post('categorias/store',    		'Categorias::store',     ['as' => 'categorias_store']);
		$routes->post('categorias/update',    		'Categorias::update',    ['as' => 'categorias_update']);
	//--
		$routes->get('clientes', 					'Clientes::index',		['as' => 'clientes']);
		$routes->get('clientes/crear',    			'Clientes::create',		['as' => 'clientes_create']);
		$routes->get('clientes/editar/(:any)', 		'Clientes::edit/$1',	['as' => 'clientes_edit']);
		$routes->get('clientes/borrar/(:any)', 		'clientes::delete/$1',	['as' => 'clientes_delete']);
		$routes->post('clientes/store',    			'clientes::store',    	['as' => 'clientes_store']);
		$routes->post('clientes/update',    		'clientes::update',		['as' => 'clientes_update']);
	//
		$routes->get('productos',					'Productos::index', 	['as' => 'productos']);
		$routes->get('productos/crear',				'Productos::create',	['as' => 'productos_create']);
		$routes->post('productos/guardar',			'Productos::store',		['as' => 'productos_store']);
		$routes->get('productos/edit/(:num)',  		'Productos::edit/$1', 	['as' => 'productos_edit']);
		$routes->post('productos/actualizar/(:num)','Productos::update/$1', ['as' => 'productos_update']);
		$routes->get('productos/viewplusimg/(:any)',  'Productos::viewplusimg/$1', 		['as' => 'productos_plusimage']);

	//--
	//$routes->get('productscart', 			 		'Products::index',	 			['as' => 'products']);
 // Ruta para mostrar la lista de productos
		$routes->get('carritoproductos', 				'CarritoProductos::index',  ['as' => 'verProductos']);
		$routes->post('carrito/agregarAlCarrito', 		'Carrito::agregarAlCarrito',['as' => 'agregarAlCarrito']);
		$routes->get('carrito/ver',						'Carrito::ver',				['as' => 'verCarrito']);
		$routes->get('carrito/eliminarProducto/(:num)', 'Carrito::eliminarProducto/$1', ['as' => 'eliminarProducto']);
		 // Ruta para vaciar el carrito
 		$routes->get('carrito/vaciarCarrito', 'Carrito::vaciarCarrito', ['as' => 'vaciarCarrito']);

		// Ruta para obtener el Metodo de Pago
		$routes->get('carrito/metodoPago', 'Carrito::metodoPago', ['as' => 'metodoPago']);
		// Ruta para finalizar la compra
		$routes->post('carrito/finalizarCompra', 	'Carrito::finalizarCompra', ['as' => 'finalizarCompra']);

		$routes->get('proveedores', 				'Proveedores::index',		['as' => 'proveedores']);
		$routes->get('proveedores/crear',    		'Proveedores::create',		['as' => 'proveedores_create']);
		$routes->get('proveedores/editar/(:any)', 	'Proveedores::edit/$1',		['as' => 'proveedores_edit']);
		$routes->get('proveedores/borrar/(:any)', 	'proveedores::delete/$1',	['as' => 'proveedores']);
		$routes->post('proveedores/store',    		'proveedores::store',    	['as' => 'proveedores']);
		$routes->post('proveedores/update',    		'proveedores::update',		['as' => 'proveedores']);
	});
	
	// --
	// Pasamos parametros para al filtro 'filter' => 'auth:admin,user']
	// si queremos que solo admin pueda controlar los roles, quitamos user
	$routes->group('admin',['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:Admin,Usuario'],function($routes){
	});