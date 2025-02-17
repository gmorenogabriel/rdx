<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
//use App\Libraries\Custom;
use \App\Models\BackendModel;
//use App\Libraries\Toastr;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['html', 'text'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */

    protected $db;
    protected $configs;
    protected $permisos;
    protected $session;
    protected $siteSettings;
    protected $configApp;
    protected $defaultLocale;
    protected $viewData = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->configs = config('Blog');

        /* Logueamos la session
        $this->session = \Config\Services::session();

        // Query Builder
        $this->db = \Config\Database::connect();

  $configApp = config('Config\App');

        $this->viewData['locale'] = $configApp->defaultLocale;
        $this->viewData['supportedLocales'] = $configApp->supportedLocales;

        $this->depuraSession($this->viewData);
*/
    }

    protected static function loadGlobalSettings()
    {

        $session = \Config\Services::session();
        $configApp = config('Config\App');

    if( $session->get('is_logged') )	{
       $siteSettings= [
             'logged'           => $session->get('is_logged'),
             'username'         => $session->get('username'),
             'locale'           => $configApp->defaultLocale,
             'supportedLocales' => $configApp->supportedLocales,
        ];
    }else{

        $siteSettings =[];

    }
       return $siteSettings;

    }

    protected  function control(){

        $session = \Config\Services::session();

        if(! $session->get('is_logged') )	{


            $this->depuraSession( $this->viewData );

        }else{


            $request = \Config\Services::request();
            $uri = $request->getUri();


            if ($uri->getSegment(2)){


                //$url = $uri->getSegment(1)."/".$uri->getSegment(2);
                //$uri->getSegment($this->defaultLocale)."/".
                $url = $uri->getSegment(1)."/".$uri->getSegment(2);


            //}

            // $model = new ('App\Models\BackendModel');
                $model = new BackendModel();
                $infomenu = $model->getID($url);

                if (!empty($infomenu)){

                    $permisos = $model->getPermisos($infomenu->id,$session->rol);

                } else{

                    $permisos = 0;

                }

                if (isset($permisos) && ($permisos->read == 0 )){
                    log_message('info', 'BaseController - control - this->viewData');
                    redirect(base_url()."Front/dashboard", $this->viewData);

                }else {

                    return $permisos;

                }
            }
        }
   }

   public static function depuraSession($viewData){
   // d('3-BaseController depuraSession(viewData) ');
        //d('4-BaseController depuraSession');
        $session = \Config\Services::session();
        $configApp = config('Config\App');
        $viewData['locale'] = $configApp->defaultLocale;
        $viewData['supportedLocales'] = $configApp->supportedLocales;

        if(! $session->get('is_logged') )	{

            $data = [
                'id_user'	=> '',
                'username'	=> '',
                'nombre'	=> '',
                'is_logged' => (bool) false,
                'rol'		=> '',
            ];
            $data += $viewData;
            session()->set($data);

            log_message('info', 'BaseController - depuraSession - Auth/login data');
            //d($data);
            echo view('Auth/login', $data);
        }
   }

   public static function seteos(){
    $clasePub = new ClasesPublicas(
        $router=null,
        $metodo=null,
        $controller=null,
        $controlador=null,
        $clase=null,
        $modelo=null,
        $configs=null);

        $router		= $clasePub->router;
        $metodo		= $clasePub->metodo;
        $controller	= $clasePub->controller;
        $controlador= $clasePub->controlador ;
        $clase		= $clasePub->clase ;
        $modelo		= $clasePub->modelo;
        //$configs	= $clasePub->configs;
        $cantFilas	= 0;
    }
}
