<?php namespace App\Libraries;

use Config\Services;
use \App\Models\BackendModel;
use App\Libraries\Toastr;

/* Estas van en todos los Controladores del proyecto */
//use App\Controllers\ClasesPublicas;
//use App\Libraries\Custom;
// use CodeIgniter\Config\Factories;

class Backend_lib{

    private $CI;
	private $uri;

	public function __construct(){
		// Instanciamos los Modelos y Librerias de Codeigniter
	/*  $this->CI = & get_instance();
		$url = $this->CI->uri->segment(1);
    */
	}

	public function control(){

         $session = \Config\Services::session();
		 $logueado = $session->get();
		if(!$logueado)	{
			$msgToast = [
				"warning"=> "warning",
				"titulo"=> "Usuario no logueado",
				"texto"	=> "Debe identificarse en el sistema",
				"footer"=> "Vuelva a intentar",
		    	"toast" => false,
				"showConfirmButton" => true,
			];
			session()->setFlashdata($msgToast);

			return redirect()->route('login');
		}

		$request =  \Config\Services::request();
		$uri = $request->getUri();

		if ($uri->getSegment(2)){

            $url = $uri->getSegment(1)."/".$uri->getSegment(2);

		}

			$model = new BackendModel();
            $infomenu = $model->getID($url);


		if (isset($infomenu)){

			$permisos = $model->getPermisos($infomenu->id,$session->rol);

		} else{

			$permisos = null;}

			if (isset($permisos) && ($permisos->read == 0 )){

				redirect(base_url());
			}else {
				return $permisos;
			}

	}

}