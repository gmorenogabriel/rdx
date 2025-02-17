<?php namespace App\Controllers\Reportes;
	//******************************************************** //
	// el Store funciona bien, hay que aplicarlo en el update
	//******************************************************** //

use App\Controllers\BaseController;
use App\Models\ClientesModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use App\Libraries\Backend_lib;  // Permisos

class Clientes extends BaseController
{
    protected $db;
	protected $regPerPage;
	protected $router;
	protected $metodo;
	protected $controller;
	protected $controlador;
	protected $clase;
	protected $modelo;
	protected $configs;
	protected $permisos;
	protected $session;
	protected $sitesettings; // Viene del BaseController "logged" y "username"



	/* -------------------------------------------------------------- */
	/* Agregar esta funcion a todos los Controladores del Proyecto    */
	/* -------------------------------------------------------------- */
	//#[\AllowDynamicProperties]
	public function __construct(){

		$permisos = new Backend_lib();
		$this->router		= \Config\Services::router();
		$this->metodo		= $this->router->methodName();
		$this->controller	= $this->router->controllerName();
		$this->controlador	= explode('\\', $this->controller) ;
		$this->clase		= $this->controlador[max(array_keys($this->controlador))] ;
		$this->modelo		= ucfirst($this->clase).'Model()';
		$this->permisos		= parent::control();
		$this->siteSettings	= parent::loadGlobalSettings() ;
	}
	/* -------------------------------------------------------------- */
	public function index(){
			$clientes = new ClientesModel();
			$data['clientes'] = $clientes->findAll();
			//var_dump($data);
//			die();
		/*	return view('admin/clientes/clientes', $data);    */
			echo view('layouts/header');
			echo view('layouts/aside');
			echo view('Admin/Reportes/clientes', $data);
			echo view('layouts/footer');
		}
		
 		public function rep_prod_view(){
			$idcliente = $this->input->post("id");
			dd($idcliente);
		
			//$prod_item	= $clientes->find($id);
			$data = array(
				'clientes'  => $this->ClientesModel->obtenerClientePorId($idcliente),
			);
			echo view("Admin/clientes/rep_prod_view",$data);
		} 
}