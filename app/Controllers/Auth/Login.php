<?php namespace App\Controllers\Auth;

use CodeIgniter\HTTP\Request;
use App\Controllers\BaseController;
//use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuariosModel;
// use App\Models\PostModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use App\Libraries\Backend_lib;  //Permisos

class Login extends BaseController
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
		 // FUNCIONA ASI CON LA SIGUIENTE LINEA
		//d('1-Auth/login __construct');
		//d(session()->get());
		$permisos = new Backend_lib();
		$this->router		= \Config\Services::router();
		$this->metodo		= $this->router->methodName();
		$this->controller	= $this->router->controllerName();
		$this->controlador	= explode('\\', $this->controller) ;
		$this->clase		= $this->controlador[max(array_keys($this->controlador))] ;
		$this->modelo		= ucfirst($this->clase).'Model()';
		//$this->permisos		= parent::control(); 
		$this->siteSettings	= parent::loadGlobalSettings();
		//d('1-Auth/login __construct');
	}
	/* -------------------------------------------------------------- */

    public function index(){
		//d('2-Auth/login index()');
	    // Nivel 4-Debug
        $config['log_threshold'] = 4;

        if( !session()->get('is_logged')) {

			log_message("debug", "Controllers/Login/index no esta logueado, vamos al Auth/login");

           //  return view('Auth/login');
		  // parent::depuraSession(['gm'=>'no esta logueado auth/login index()']);

        }else{

            log_message("debug", "Controllers/Login/index esta logueado.");

			if (session()->get('is_logged') && (session()->get('group_name') == 'admin')) {

				log_message("debug", "Controllers/Login/index Esta logueado como" . session()->get('username') . ", vamos a la ruta DASHBOARD");


                return redirect()->route('dashboard')
                                ->with('msg', [
                                    'type' => 'success',
                                    'body' => 'Usuario registrado exitosamente'
                ]);

            }else{
                //echo "REVISAR A DONDE TENGO Que IR";
                log_message("debug", "Controllers/Login/index Esta logueado como" . session()->get('username') . ", vamos a la ruta DASHBOARD");
                return redirect()->route('dashboard')
                        ->with('msg', [
                        'type' => 'success',
                        'body' => 'Bienvenido nuevamente : ' . session()->get('username'),
                    ]);
                }
            }
        }

        public function miCesion($user, $name_group ) {
            log_message("info", "Controllers/Login/miCesion cargada...");
             // We retrieve the Session class
             $session = \Config\Services::session();
            // Si el usuario es 'user'
			$data = [
				'id_user'	=> $user->id, //id_userid (antes)
				'username'	=> $user->username,
				'nombre'	=> $user->nombres . ' ' . $user->apellidos,
				'is_logged' => (bool)true,
				'rol'		=> $user->rol_id,
			];
			session()->set($data);

			// ------------------------ //
			// 27 de Agosto 2024        //
			// ------------------------ //
			d($session->get('nombre'));
			//$permisos = Backend_lib::control();
			echo PHP_EOL . "----------miCesion-------------------" . PHP_EOL ;
			d($this->permisos);
			echo PHP_EOL . "----------fin miCesion-------------------" . PHP_EOL ;
        }

  public function signin(){
		//helper('text');
    log_message("debug", "Controllers/Login/signin");
       if(!$this->validate([
        'email' => 'required|valid_email',
        'password' => 'required'
       ])){
	log_message("debug", "Controllers/Login/signin No valida");
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
	log_message("debug", "Controllers/Login/signin Validado");
       // Obtenemos el Valor que viene del Form
       $email    = $this->request->getVar('email');
       $password = $this->request->getVar('password');
       $model = model('UsuariosModel');

	 if(!$user = $model->getUserBy('email', $email)){
	 log_message("debug", "Controllers/Login/signin, Este usuario no esta registrado");
		return redirect()->back()
			->with('msg', [
				'type' => 'danger',
				'body' => 'Este usuario no esta registrado.',
			 ]);
    }
	   // Verificamos que el password ingresado es igual al de la BD
	   if(!password_verify($password, $user->password)){
			log_message("debug", "Controllers/Login/signin, PASSWORD Incorrecta.");
			return redirect()->back()
			->with('msg', [
				'type' => 'danger',
				'body' => 'Password incorrecta.'
			 ]);
		}

		//echo "Email y password correctos";
		// Logueamos la session
		$data = [
			'id_user'	=> $user->id, //id_userid (antes)
			'username'	=> $user->username,
			'nombre'	=> $user->nombres . ' ' . $user->apellidos,
			'is_logged' => (bool)true,
			'rol'		=> $user->rol_id,
		];
		session()->set($data);

		// ------------------------ //
		// 27 de Agosto 2024        //
		// ------------------------ //
		// d(session()->get('nombre'));
		//$permisos = $this->lib->control();
		//$permisos = $this->permisos;

		 echo PHP_EOL . "----------miCesion-------------------" . PHP_EOL ;
		 d($this->permisos);
		 echo PHP_EOL . "----------fin miCesion-------------------" . PHP_EOL ;

		log_message("debug", "Controllers/Login/signin, SESSION Seteada.");

		// redireccionamos
		log_message("debug", "Controllers/Login/signin, REDIRECCIONAMOS al POSTS.");

		//return redirect()->route('posts');
		// ->with('msg', [
				// 'type' => 'success',
				// 'body' => 'Bienvenido nuevamente : ' . $user->username,
			// ]);

		return redirect()->route('login');

    }

    public function signout(){
		$data = [
			'id_user'	=> '',
			'username'	=> '',
			'nombre'	=> '',
			'is_logged' => (bool) false,
			'rol'		=> '',
		];            
		session()->set($data);
		session()->destroy();
        return redirect()->route('login');
    }
}
