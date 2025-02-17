<?php namespace App\Controllers\Mantenimiento;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Category;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Database\Exceptions\DataException;
use App\Models\CategoriasModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use \App\Libraries\Backend_lib;  // Permisos
use \App\Models\BackendModel;
use DateTime;

class Categorias extends BaseController
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

	/* ----------------------------------------------
	/  ----------------==> INDEX <==-----------------
		---------------------------------------------- */
	public function index(){

		//$this->session = parent::$this->session;

		$language = \Config\Services::language();
        //d($language->setLocale($this->session->lang));
		$supported = [
			'en',
			'es',
			'pt-BR',
		];
//d($lang = $this->request->negotiate('language', $supported));
		if($this->permisos==null){
			return redirect('login');
		}
		else
		{
		// Arma el Array para pasar a la vista
			$model	= new CategoriasModel();
			$categorias = (array) $model->where('estado',1)->findAll();
			$data = [
				'permisos'		=> $this->permisos,
				'categorias'	=> $categorias,
				'pager'			=> $model->pager
				];
			// Msg Toast - SweetAlert2
 			$msgToast = [
				's2Titulo'	=> $this->clase,
				's2Texto'	=> 'Ingreso al listado de Categorias.',
				's2Posicion'=> 'top-end',
				's2Icono'	=> 'success',
				's2Toast'	=> true,
				's2Footer'	=> null,
			];
			$data += $msgToast;

				echo view('layouts/header');
				echo view('layouts/aside');
				echo view('Admin/categorias/list', $data);
				echo view('layouts/footer');
				echo view('sweetalert2');
		}
	}

	/* ----------------------------------------------
	/  ----------------==> CREATE <==----------------
		---------------------------------------------- */
	public function create(){
		log_message("info", "Controllers/categorias/create, vamos a la vista Admin/categorias_create." );

		echo view('layouts/header');
		echo view('layouts/aside');
		echo view('admin/categorias/add');
		echo view('layouts/footer');
	}

	/* ----------------------------------------------
	/  ----------------==> STORE <==-----------------
	   ---------------------------------------------- */
	public function store(){
		log_message("info", "Controllers/categorias/store." );

			if (!$this->validate([
				// 'nombre'		=> 'required|regex_match[/\A[a-zA-Z0-9\.-_]+\z/]|trim|max_length[100]',
				'nombre'		=> 'required|trim|max_length[100]',
				'descripcion'	=> 'required|regex_match[ \s \S]+[\-]|trim|max_length[120]',
			])){
				$msgToast = [
					's2Titulo'	=> "No valido las reglas",
					's2Texto'	=> "Puede que el campo 'Nombre' ya exista en la tabla.",
					's2Posicion'=> 'top-end',
					's2Icono'	=> 'info',
					's2Toast'	=> true,
					's2Footer'	=> "Revise por favor",
				];

				session()->setFlashdata('errors', "no valido las reglas");
				// echo view('sweetalert2',$msgToast, true);
				return redirect()->back()->withInput()
				->with('msg', [
					'type' => 'danger',
					'body' => 'Tienes campos incorrectos'
					])
					->with('errors', $this->validator->getErrors());
			}
		log_message("info", "Controllers/categorias/store - Reglas validadas." );
		// Guardamos en la Base de Datos
		log_message("info", "Controllers/categorias/store - Cargamos CategoriasModel y los Datos." );

		$dt			= new DateTime();
		$nombre		= $this->request->getVar('nombre');
		$descripcion= $this->request->getVar('descripcion');
		$dt 		= new DateTime();
		$data 		= [
				'nombre'		=> $nombre,
				'descripcion'	=> $descripcion,
				'estado'		=> 1,
				'fecha_creado'	=> $dt->format('Y-m-d H:i:s'),
		];
		d($data);

		// Paso al modelo la clave de lo que necesito buscar
		$model		= model('CategoriasModel');
		$resultado  = $model->validoClave('nombre', $nombre);

		if ($resultado == 0){
			// Todo bien insertaremos en la BD

			$resultado = $model->save($data);

			$msgToast = [
				"success"=> "success",
				"titulo"=> "Se ha creado un nuevo registro",
				"texto"	=> "Los datos fueron actualizados satisfactoriamente !!!",
				"footer"=> "Continuar",
				"toast" => false,
				"showConfirmButton" => true,
			];
			session()->setFlashdata($msgToast);

			log_message("info", "Controllers/categorias/store - realizar el SAVE, Resultado=".$resultado );

		}else{
			// la Consulta a la BD devolvio ERROR
			//$clase = parent::seteos();

			$msgToast = [
				"warning"=> "warning",
				"titulo"=> "Error al guardar los datos",
				"texto"	=> "El Nombre ya existe en la Base de Datos!!!",
				"footer"=> "Revise por favor",
				"toast" => false,
				"showConfirmButton" => true,
			];
			session()->setFlashdata($msgToast);

			log_message("info", "Controllers/categorias/store - Ya EXISTE el Nombre " . $nombre . ", en la BD, ERROR, Resultado=".$resultado );


		}
		// Redirecionamos y enviamos mensaje con el With
		return redirect('categorias')->with('msg',[
			'type' => 'success',
			'body' => 'Categoría guardada exitosamente'
		]);

	}

	/* ----------------------------------------------
	/  ----------------==> EDIT  <==-----------------
		---------------------------------------------- */
	public function edit(string $id){

		$model		= model('CategoriasModel');
		$categoria	= $model->where('estado',1)->find($id);

		// Buscamos y editamos, el registro selecciona en la BD
		$categorias = $model->where('estado',1)->find($id);
		$data = [
			'permisos'	=> $this->permisos,
			'categoria'	=> $categorias,
			'pager'		=> $model->pager,
		];

		echo view('layouts/header');
		echo view('layouts/aside');
		echo view('Admin/categorias/edit', $data);
		echo view('layouts/footer');
	}

	/* ----------------------------------------------
	/  ----------------==> UPDATE <==----------------
		---------------------------------------------- */
	public function update(){
		if(!$this->validate([
			'nombre'		=> 'required|alpha_space|trim|max_length[100]',
			'descripcion'	=> 'required|alpha_numeric_punct|trim|max_length[120]',
			])){
				return redirect()->back()->withInput()
                ->with('msg', [
                'type' => 'danger',
                'body' => 'Tienes campos incorrectos'
				])
				->with('errors', $this->validator->getErrors());

			log_message("info", $this->clase . "/" . $this->metodo . " - UPDATE - No validan las reglas.");
			}
/*
			$msgToast = [
				'tipo'		=> "info",
				'titulo'	=> "No valido las reglas",
				'texto'		=> "Puede que el campo 'Nombre' ya exista en la tabla.",
				'pie'		=> "Revise por favor",
				'toast'		=> false,
				'posicion'	=> 'top-end',
				'botonConfirma' => true,
			]; */

			//echo view('sweetalert2',true);
			//echo view('sweetalert2',$msgToast, ['tres'=>true]);

			//	return redirect()->back()->withInput()->with('errors', $validation->getErrors());


		log_message("info", $this->clase . "/" . $this->metodo . $this->siteSettings['username'] . " - UPDATE - Reglas validadas.");

		// -------------------------------------------
		// ---------- Si las reglas Validaron --------
		// -------------------------------------------
		//$nombre 	= $this->request->getPost("nombre");

		$model			= model('CategoriasModel');
		$categorias		= $model->where('estado',1)->find($this->request->getPost("nombre"));
		$resultado		= $model->validoClave('nombre', $this->request->getPost("nombre"));

		$id				= $this->request->getPost("id");
		$nombre			= $this->request->getPost("nombre");
		$descripcion	= $this->request->getPost("descripcion");

		// Como es Update es lo contrario a Store, tiene que existir
		if ($resultado == 1){
			$dt 		= new DateTime();
			$data 		= [
					//'id'			=> $id,
					//'nombre'		=> $nombre,
					'descripcion'	=> $descripcion,
					'estado'		=> 1,
					'fecha_creado'	=> $dt->format('Y-m-d H:i:s'),
			];

			log_message("info", $this->clase . "/" . $this->metodo   ." - " . $this->siteSettings['username'] . " - UPDATE - Proximo paso es UPDATE(), Resultado=".$resultado );

			// Crearemos un Metodo Update
			// -----------------------------
			// ---------- UPDATE -----------
			// -----------------------------
			$model->where('nombre', $nombre)
						->set($data)
						->update();

			// Lo encontramos, todo bien, actualizamos la BD
			$msgToast = [	"success"=> "success",
							"titulo"=> "Se ha creado un nuevo registro",
							"texto"	=> "Los datos fueron actualizados satisfactoriamente !!!",
							"footer"=> "Continuar",	"toast" => false,
							"showConfirmButton" => true,
			];
			session()->setFlashdata($msgToast);

			log_message("info", $this->clase . "/" . $this->metodo   ." - " . $this->siteSettings['username'] . " - UPDATE - " . "Id=".$id . ", Nombre=" . $nombre . ", Descripcion=". $descripcion );

		}else{
			// la Consulta a la BD devolvio ERROR
			$msgToast = [
				"warning"=> "warning",
				"titulo"=> "Error al guardar los datos",
				"texto"	=> "El Nombre ya existe en la Base de Datos!!!",
				"footer"=> "Revise por favor",
				"toast" => false,
				"showConfirmButton" => true,
			];
			session()->setFlashdata($msgToast);

			log_message("info", $this->clase . "/" . $this->metodo   . " - " . $this->siteSettings['username'] . " - UPDATE - Ya EXISTE el Nombre " . $nombre . ", en la BD, ERROR, Resultado=".$resultado );
		}

		// Regreso al Listado de Categorías
		$categModel = model('CategoriasModel');
		$categorias = (array) $model->where('estado',1)->findAll();
		$builder = new CategoriasModel();
		$builder->get();
		$data = [
				'permisos'		=> $this->permisos,
				'titulo'		=> $this->clase,
				'categorias'	=> $builder->where('estado',1)->orderBy('fecha_creado','DESC')->paginate($this->configs->regPerPage),
				'pager'			=> $builder->pager,
				'currentPage'	=> 1
		];

		log_message("info", $this->clase . "/" . $this->metodo    ." - " . $this->siteSettings['username'] .  " - UPDATE - Llamo a la vista Admin/cateorias/list");

		echo view('layouts/header');
		echo view('layouts/aside');
		echo view('Admin/categorias/list', $data);
		echo view('layouts/footer');
		echo view('sweetalert2', $msgToast);

		session()->setFlashdata($msgToast);
	}

	/* ----------------------------------------------
	/  ----------------==> DELETE <==----------------
		---------------------------------------------- */
	public function delete(string $id){
		//$hash = new Hashids();
		//$id = $hash->decode($id);
		$model = model('CategoriasModel');
		$data=array(
			'estado' => "0",
		);
		$model->update($id, $data);

		$msgToast = [
			"success"	=> "success",
			"titulo"	=> "Se ha eliminado el registro",
			"texto"		=> "Los datos fueron actualizados satisfactoriamente !!!",
			"footer"	=> "Revise por favor",
			"toast"		=> true,
			"showConfirmButton" => true,
		];
		// Arma el Array para pasar a la vista
		$model	= new CategoriasModel();
		$categorias = (array) $model->where('estado',1)->findAll();
		$data = [
			'permisos'		=> $this->permisos,
			'categorias'	=> $categorias,
			'pager'			=> $model->pager
			];
		session()->setFlashdata($msgToast);
		echo view('layouts/header');
		echo view('layouts/aside');
		echo view('Admin/categorias/list', $data);
		echo view('layouts/footer');
		echo view('sweetalert2', $msgToast);
/*
		return redirect('Admin/categorias/list')->with('msg',[
			'type' => 'success',
			'body' => 'Categoría fue eliminada exitosamente'
		]);
*/
		}
	}
