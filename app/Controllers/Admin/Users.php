<?php namespace App\Controllers\Admin   ;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\UsersModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr; 
use Hashids\Hashids;
use App\Libraries\Backend_lib;  // Permisos

class Users extends BaseController
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
		$this->siteSettings		= parent::loadGlobalSettings() ;

	}
	/* -------------------------------------------------------------- */
    public function index(){
			// Msg Toast / SweetAlert2
		$msgToast	= Custom::msgToast($this->clase, 'Ingreso al listado');

		// Arma el Array para pasar a la vista
		$model	= new UsersModel();
		$data	= Custom::msgBuild('UsersModel', $this->configs->regPerPage, $this->clase, $this->modelo, $this->metodo, $cantidadRegistros=0, 'users');
		$query	= $model->table('users')->countAllResults();
		$count	= $cantidadRegistros = Custom::cantidadFilasTabla('users');

		// Nuevo 19 de Agosto
		$count = $data['cantRegistros'];
		// Verificamos si la tabla contiene datoa para que no devuelva un error
		if ($count > 0){
			log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . "Encontre " . $cantidadRegistros . " registros en " . $this->clase);
		}else{
			log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", NO encontre registros en Categories");
		}

		// Msg Toast - SweetAlert2
		$msgToast = [
			's2Titulo'=> $this->clase,
			's2Texto' => 'Ingreso al listado de Categorias.',
			's2Icono' => 'success',
			's2Toast' => 'true',
			's2Footer' => null,
		];
		$data += $msgToast;
        return view('Admin/Users',$data);
    }

    public function create(){
        return view('Admin/Users_create');
    }
    public function store(){
        if(!$this->validate([
            'name' => 'required|max_length[120]'
        ])){
            return redirect()->back()->withInput()
                ->with('msg', [
                'type' => 'danger',
                'body' => 'Tienes campos incorrectos'
            ])
            ->with('errors', $this->validator->getErrors());
        }
        // Guardamos en la Base de Datos
        $model = model('UsersModel');
        $model->save([
            'name' => trim($this->request->getVar('name'))
        ]);
        //dd($this->request->getPost());


        // Redirecionamos y enviamos mensaje con el With
        return redirect('Users')->with('msg',[
            'type' => 'success',
            'body' => 'Categoría guardada exitosamente'
        ]);
    }
    public function edit(string $id_user){
        $model = model('UsersModel');
        if(!$users = $model->find($id_user)){
            throw PageNotFoundException::forPageNotFound();
        }
        return view('Admin/Users_edit',[
            'users' => $users,
            ''
        ]);
    }
    public function update(){
        if(!$this->validate([
            'email'   => 'required|max_length[120]',
            'id_user' => 'required|is_not_unique[Users.id]',
        ])){
            return redirect()->back()->withInput()
                ->with('msg', [
                'type' => 'danger',
                'body' => 'Tienes campos incorrectos'
            ])
            ->with('errors', $this->validator->getErrors());
        }
        // Guardamos en la Base de Datos
        $model = model('UsersModel');
        $model->save([
            'id_user' => trim($this->request->getVar('id_user')),
            'email' => trim($this->request->getVar('email')),
        ]);
        //dd($this->request->getPost());
        // Redirecionamos y enviamos mensaje con el With
        return redirect('Users')->with('msg',[
            'type' => 'success',
            'body' => 'Usuario fue actualizado exitosamente'
        ]);
    }
    public function delete(string $id){
        $hash = new Hashids();
        $id_user = $hash->decode($id);
        $model = model('UsersModel');
        $model->delete($id_user);
        return redirect('users')->with('msg',[
            'type' => 'success',
            'body' => 'Usuario fue eliminado exitosamente'
        ]);
    }


}