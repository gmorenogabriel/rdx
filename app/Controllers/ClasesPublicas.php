<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr; 
use Hashids\Hashids;

class ClasesPublicas extends BaseController
{
    public $router;
	public $metodo;
	public $controller;
	public $controlador;
	public $clase;
	public $modelo;
	public $configs;

	/* -------------------------------------------------------------- */
	/* Agregar esta funcion a todos los Controladores del Proyecto    */
	/* //#[\AllowDynamicProperties]                                   */
	/* -------------------------------------------------------------- */
	public function index($router, $metodo, $clase, $controller, $controlador, $modelo, $configs){

		d('4- ClasesPublicas - index() ');

			$this->router		= \Config\Services::router();
			$this->metodo		= $this->router->methodName();
			$this->controller	= $this->router->controllerName();
			$this->controlador	= explode('\\', $this->controller) ;
			$this->clase		= $this->controlador[max(array_keys($this->controlador))] ;
			$this->modelo		= ucfirst($this->clase).'Model()';
			$this->configs		= config('Blog');

			// ---------------------------------------------
	}

	
}