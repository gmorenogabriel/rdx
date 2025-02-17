<?php namespace App\Controllers\Front;

use App\Controllers\BaseController;
//use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Ventas;
use App\Models\UsersModel;
//use App\Models\PostModel;
use App\Models\VentasModel;
use App\Models\BackendModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use App\Libraries\Backend_lib;  // Permisos

class Dashboard extends BaseController
{
	protected $regPerPage;
	protected $router;
	protected $metodo;
	protected $controller;
	protected $controlador;
	protected $clase;
	protected $modelo;
	protected $configs;
	protected $permisos;
	protected $sitesettings; // Viene del BaseController "logged" y "username"

	public function __construct(){

		//$permisos = new Backend_lib();
		$this->router		= \Config\Services::router();
		$this->metodo		= $this->router->methodName();
		$this->controller	= $this->router->controllerName();
		$this->controlador	= explode('\\', $this->controller) ;
		$this->clase		= $this->controlador[max(array_keys($this->controlador))] ;
		$this->modelo		= ucfirst($this->clase).'Model()';
		$this->siteSettings	= parent::loadGlobalSettings() ;

	}

	public function index(){

		$session = \Config\Services::session();
		$logueado = $session->get();
		if(!isset($logueado))	{
			d("Dashboard/index() - no esta logueado ");
			echo "<br/>";
			$msgToast = [
				"warning"=> "warning",
				"titulo"=> "Usuario no logueado",
				"texto"	=> "Debe identificarse en el sistema",
				"footer"=> "Vuelva a intentar",
				"toast" => false,
				"showConfirmButton" => true,
			];
			session()->setFlashdata($msgToast);
//d(' Front/dashboard INDEX() IF antes del DASHBOARD');
			return redirect()->route('login');

		}else{

//d(' Front/dashboard INDEX() else DASHBOARD');

			$back_Model		= new BackendModel();
			$ventas_Model	= new VentasModel();

			$data = [
			//cantVentas"	=> $back_Model->rowCount('ventas'),
			'cantUsuarios'	=> $back_Model->rowCount('usuarios'),
			'cantClientes'	=> $back_Model->rowCount('clientes'),
			'cantProductos'	=> $back_Model->rowCount('productos'),
			//years"			=> $ventas_Model->years()
			];
		//	$data += $this->viewData;

			echo view("layouts/header");
			echo view("layouts/aside");
			echo view("Front/Dashboard");
			//return redirect()->route('dashboard');
			echo view("layouts/footer");
		}
	}
	public function getAge(){
		$age = array( "Peter"=>'35',
			"Peter"=>'37',
			"Peter"=>'43',
		);

		echo json_encode($age, TRUE);
	}
	public function getData($year){
		$resultados = $this->Ventas_model->montos(trim($year));
		if(!isset($resultados)){	
			header('Content-Type: application/json');
			echo json_encode([]);  //devolver un  Json vacío
		}else{
		header('Content-Type: application/json');
		echo json_encode($resultados);

		/*
			$resultados =str_replace(' ', '', json_encode($resultados));
			$resultados =str_replace('[', '', json_decode(json_encode($resultados), true));
			echo $resultados =str_replace(']', '', json_decode(json_encode($resultados), true));
			*/
		}
	}
	public function getProductosWs($idproducto){
		// echo 'Todas las ventas';
		$valor = $this->input->post("valor");

		$clientes= $this->Ventas_model->getProductos($valor);
		echo json_encode($clientes);
	}
	public function getUnProductoWs($id){
		//echo 'Llamado al Web Service: localhost:8084/ventas_ci/dashboard/getUnProductoWs/12';
		//echo 'Un Producto:' . '<br></br>';
		$producto= $this->Productos_model->getProducto($id);
		header('Content-Type: application/json');
		echo json_encode($producto);
	}
}
?>
