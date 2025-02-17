<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\Test\Fabricator;
use App\Models\PostModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use App\Libraries\Backend_lib;  // Permisos

class Home extends BaseController
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
	/* Agregar esta funcion a todos los Controladores del Proyecto */
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
    public function index(): string
    {
		// $db      = \Config\Database::connect();
        // $builder = new PostModel();
		// $builder = $db->table('posts');
		// $count   = $builder->selectCount('id')->get();
		// dd($count);
		// return view('Admin/articulos');
		// session()->setFlashdata("success", "This is success message");

		//session()->setFlashdata("warning", "This is warning message");
		if( !session()->get('is_logged') ){
            log_message("info", "Front/Home/index NO no esta logueado, vamos al Auth/login");
            return view('Auth/login');
        }else{
            //$post = model('PostModel');
            log_message("info", "Front/Home/index ESTA logueado, vamos al Front/Home");
            helper('text');
            $post = model('PostModel');
            // $builder = new \App\Models\PostModel();
            // $builder->get();
		log_message("info", $this->clase . "/" . $this->modelo . "Count de Posts antes de cargar la pagina");
			$builder = new PostModel();
			$builder->get();
			$count=$builder->countAllResults();
				//dd($count);
			if($count>0){
					return view('Front/Home',[
								'posts' => $post->published()->orderBy('published_at', 'desc')->paginate(4),  //utilizamos la paginacion 2 por pagina
								'pager' => $post->pager,
				]);
			}else{
				log_message("info", $this->clase . "/" . $this->modelo . "Count devolvio 0 Posts.");


//--funciona correctamente lo comento para probar msgToast
					return view('Front/Home',[
								'posts' => [],
								'pager' => $post->pager,
				]);

			}
		}
	}

}