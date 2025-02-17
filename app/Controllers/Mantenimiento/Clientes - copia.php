<?php namespace App\Controllers\Mantenimiento;

use App\Controllers\BaseController;
use App\Entities\Category;
use App\Models\ClientesModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use \App\Libraries\Backend_lib;  // Permisos
use \App\Models\BackendModel;
use DateTime;

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
	public function __construct(){

		$this->router		= \Config\Services::router();
		$this->metodo		= $this->router->methodName();
		$this->controller	= $this->router->controllerName();
		$this->controlador	= explode('\\', $this->controller) ;
		$this->clase		= $this->controlador[max(array_keys($this->controlador))] ;
		$this->modelo		= ucfirst($this->clase).'Model()';
		$this->permisos		= parent::control();
		$this->siteSettings		= parent::loadGlobalSettings() ;

	}
	/* -------------------------------------------------------------- */

	/* ----------------------------------------------
	/  ----------------==> INDEX <==-----------------
		---------------------------------------------- */
	public function index(){
		//dd($this->permisos); hacer el insert del menu y rol con los permisos.
		//d($this->permisos);
		$model	= new ClientesModel();
		$clientes = (array) $model->where('estado',1)->findAll();
		$data = [
			'permisos'	=> $this->permisos,
			'clientes'	=> $clientes,
			'pager'		=> $model->pager
			];

			echo view('layouts/header');
			echo view('layouts/aside');
			echo view('Admin/clientes/list', $data);
			echo view('layouts/footer');
			echo view('sweetalert2');
	}

	/* ----------------------------------------------
	/  ----------------==> CREATE <==----------------
		---------------------------------------------- */
	public function add(){

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/clientes/add');
		$this->load->view('layouts/footer');
	}

	/* ----------------------------------------------
	/  ----------------==> STORE <==-----------------
		---------------------------------------------- */
	public function store(){
		if(isset($_POST) && count($_POST) > 0) {
			$nombres   = $this->input->post("nombres");
			$apellidos = $this->input->post("apellidos");
			$telefono  = $this->input->post("telefono");
			$direccion = $this->input->post("direccion");
			$ruc       = $this->input->post("ruc");
			$empresa   = $this->input->post("empresa");
			$data      = array(
				'nombres'   => $nombres,
				'apellidos' => $apellidos,
				'telefono'  => $telefono,
				'direccion' => $direccion,
				'ruc'       => $ruc,
				'empresa'   => $empresa,
				//valor 0 es porque esta inactivo o eliminado
				//valor 1 es porque es Nuevo y Activo
				'estado'    => "1",
			);

			try {
					$resultado=$this->Clientes_model->save($data);
				} catch (UserException $error){
					var_dump($e->getMessage());
				}
				redirect(base_url()."mantenimiento/clientes");
		}else{
				$data['botonAdd'] = 'N';	/* usado para desplegar el Más (Add)   */
				$this->session->set_flashdata("error", "No se pudo guardar la información");
				redirect(base_url()."mantenimiento/clientes/add");
		}
	}
	/* ----------------------------------------------
	/  ----------------==> EDIT  <==-----------------
		---------------------------------------------- */
	public function edit($id){
		$model		= model('ClientesModel');
		$data = array(
			'cliente' => $model->where('estado',1)->find($id),
		);
		// Buscamos y editamos, el registro selecciona en la BD
		$clientes = $model->where('estado',1)->find($id);
		$data = [
			'permisos'	=> $this->permisos,
			'cliente'	=> $clientes,
			'pager'		=> $model->pager,
		];

		echo view('layouts/header');
		echo view('layouts/aside');
		echo view('Admin/clientes/edit', $data);
		echo view('layouts/footer');
	}

	/* ----------------------------------------------
	/  ----------------==> UPDATE <==----------------
		---------------------------------------------- */
	public function update(){

		if(!$this->validate([
			'nombres'		=> 'required|alpha_space|trim|max_length[45]',
			'apellidos'		=> 'required|alpha_numeric_punct|trim|max_length[45]',
			'telefono '		=> 'alpha_numeric_punct|trim|max_length[20]',
			'direccion'		=> 'alpha_numeric_punct|trim|max_length[100]',
			'ruc'			=> 'numeric|min_length[10]|max_length[20]',
			'empresa'		=> 'alpha_numeric_punct|trim|max_length[255]',
			'email'			=> 'max_length[120]|valid_email',   //|valid_email|is_unique[users.email,id,4]',
		])){
				return redirect()->back()->withInput()
                ->with('msg', [
                'type' => 'danger',
                'body' => 'Tienes campos incorrectos'
				])
				->with('errors', $this->validator->getErrors());
			}

			log_message("info", $this->clase . "/" . $this->metodo . " - UPDATE - Vamos a Guardar en la BD.");

			$data = [
				'id' 		=> $this->request->getPost('id'),
				'nombres'	=> $this->request->getPost('nombres'),
				'apellidos'	=> $this->request->getPost("apellidos"),
				'telefono'	=> $this->request->getPost("telefono"),
				'direccion'	=> $this->request->getPost("direccion"),
				'ruc'		=> $this->request->getPost("ruc"),
				'empresa'	=> $this->request->getPost("empresa"),
				'email'		=> $this->request->getPost("email"),
				'estado'     => 1,
			];
			// Guardamos en la Base de Datos
			$model = model('ClientesModel');
			$model->where('estado', 1)
				  ->set($data)
				  ->update();

//			$model = model('ClientesModel');
//			$clientes = (array) $model->where('estado',1)->findAll();
			$builder = new ClientesModel();
			$builder->get();

		// Lo encontramos, todo bien, actualizamos la BD
		$msgToast = [
			"success"=> "success",
			"titulo"=> "Se ha creado un nuevo registro",
			"texto"	=> "Los datos fueron actualizados satisfactoriamente !!!",
			"footer"=> "Continuar",	"toast" => false,
			"showConfirmButton" => true,
		];
		session()->setFlashdata($msgToast);

		$data = [
			'permisos'		=> $this->permisos,
			'titulo'		=> $this->clase,
			'clientes'		=> $builder->orderBy('fecha_creado','DESC')->paginate($this->configs->regPerPage),
			'pager'			=> $builder->pager,
			'currentPage'	=> 1,
		];

		echo view('layouts/header');
		echo view('layouts/aside');
		echo view('Admin/clientes/list', $data);
		echo view('layouts/footer');
		echo view('sweetalert2', $msgToast);


	}


	/* ----------------------------------------------
	/  ----------------==> VIEW   <==----------------
	   ---------------------------------------------- */
	public function view($id){
		$model		= model('ClientesModel');
		$data = [
			'cliente' => $model->where('estado',1)->find($id),
		];
		dd($data);
		echo view("Admin/clientes/view",$data);
	}


	/* ----------------------------------------------
	/  ----------------==> DELETE <==----------------
	   ---------------------------------------------- */
	public function delete($id){
		$model		= model('ClientesModel');
		$data=array(
			'estado' => "0",
		);
		$model->update($id,$data);
	}
}