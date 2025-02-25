<?php namespace App\Libraries;

use Config\Services;
/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Backend_lib;  // Permisos
//use App\Libraries\Custom;
//use CodeIgniter\Config\Factories;

Class Custom {

	protected $email;
	protected $model;
	protected $ancho;
	protected $alto;
   // protected $db;
	protected $regPerPage;
	protected $router;
	protected $metodo;
	protected $controller;
	protected $controlador;
	protected $clase;
	protected $modelo;
	protected $configs;
	protected $cantFilas;
	protected $pager;
	// -----------------
	protected $defImgMaxWidth;
    protected $defImgMaxHeight;
	protected $imgDefaultPath;
	protected $imgDefaultDest;

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

	}

	public static function msgToast(string $clase, string $titulo){
		$msgToast = [
		's2Titulo'=> $clase,
		's2Texto' => $titulo,
		's2Icono' => 'success',
		's2Toast' => 'true'
		];
		return $msgToast;
	}

		public static function msgBuild($build, $regPerPage, $clase, $modelo, $metodo, $cantidadRegistros, $tabla){

			$configs= config('Blog');
			///$model  = new model($build);
			//$model = new UsersModel($this->request);
			// $model = model($build);
// Or
// $model = Factories::models('\Blog\Models\$build::class');

			// Query builder
			$db			= \Config\Database::connect();
			$builder	= $db->table($tabla);
			$cantFilas	= $builder->countAll();
			$builder->get();


			$query		= $db->query('select * from ' . $tabla);
			if ($cantFilas > 0){
				log_message("info", $clase . "/" . $modelo . "/" . $metodo . ", encontre en " . $tabla . ", " .$cantFilas . " registros.");
			}else{
				log_message("info", $clase . "/" . $modelo . "/" . $metodo . "NO encontre registros.");
			}

			$data['datos']	= $query->getResultArray();
			$data 		+= [
						'cantRegistros'	=> $cantFilas,
						'typography'	=> Services::typography(),
						];
			return $data;
		}

		public static function cantidadFilasTabla(string $tabla){
			$db      = \Config\Database::connect();
			$builder = $db->table($tabla);
			//d($builder->countAll());
			return $builder->countAll();
		}

		public static function obtenerTodosRes(string $tabla){
			$db      = \Config\Database::connect();
			$sql     = "SELECT * FROM `" . $tabla . "` order By created_at DESC";
			$result  = $db->query($sql)->getResultArray();
			//dd($db->query($sql)->getResultArray());
			return $result;
		}
		public static function obtenerTodosObj(string $tabla){
			$db = \Config\Database::connect();
			$builder = $db->query('select * from ' . $tabla);
			$query = $builder->get();

			//dd($query);
			return $builder->getResult();
		}

		public function envioEMail($para, $asunto, $mensaje, $adjunto=null ){
			// Load Services in Controller
			// $email= \Config\Services::email();
			//$email->setFrom('1961gamt@gmail.com');
			$this->email->setTo($para);
			$this->email->setSubject($asunto);
			$this->email->setMessage($mensaje);
			if($adjunto){
				$adjunto= base_url() . '/images/logo.png';
				$this->email->attach($adjunto);
			}
			if($this->email->send()){
				$data = [
                'titulo' => 'Envío de E-Mail',
                'titulo2' => 'E-Mail enviado correctamente',
				];
				$msgToast = [
                's2Titulo' => $this->clase,
                's2Texto' => 'E-Mail enviado correctamente',
                's2Icono' => 'success',
                's2Toast' => 'true'
				];
				echo "<br>";
				echo view('header');
				echo view('sweetalert2', $msgToast);
				echo view('enviomail/enviomail', $data);
				echo view('footer');
				}else{
				$data = $this->email->printDebugger(['headers']);
				print_r($data);
			}
		}
		
		public static function resizeImageCovers($imageName,$ancho,$alto){
			$configs= config('Blog');
			$image	= service('image');
				
			if (!file_exists( $configs->imgDefaultDest )) {
				mkdir( $configs->imgDefaultDest, 0777, true);
			}
			
			$image->withFile( $configs->imgDefaultPath . $imageName)
					->fit($ancho, $alto, 'center')
					->save($configs->imgDefaultDest . $imageName);
		}
		
		public static function resizeImageMaxResol($imageName,$ancho,$alto){
			$configs= config('Blog');
			$image	= service('image');
			
			if (!file_exists( $configs->imgDefaultTemp )) {
				mkdir( $configs->imgDefaultTemp, 0777, true);
			}
			
			//d($imageName);
			$image->withFile( $configs->imgDefaultTemp . $imageName)
				->fit($configs->defImgMaxWidth, $configs->defImgMaxHeight, 'center')
				->save($configs->imgDefaultPath . $imageName);
		}
		
		public function resizeImage22(){
			$this->configs = config('Blog');
			$request = service('request');
			// $ancho = $this->configs->defImgMinWidth;
			// $alto  = $this->configs->defImgMinHeight;
			
			## Validation
			$validation = \Config\Services::validation();
			
			$input = $validation->setRules([
			'file' => 'uploaded[file]|max_size[file,4048]|ext_in[file,jpeg,jpg,png],'
			]);
			
			if ($validation->withRequest($this->request)->run() == FALSE){
				
				$data['validation'] = $this->validator;
				return redirect()->back()->withInput()->with('validation', $this->validator);
				
				}else{
				
				if($file = $this->request->getFile('file')) {
					if ($file->isValid() && ! $file->hasMoved()) {
						// https://makitweb.com/how-to-upload-and-resize-image-in-codeigniter-4/
						// Get file name and extension
						$filename = $file->getName();
						$ext = $file->getClientExtension();
						
						// Get random file name
						$newName = $file->getRandomName();
						
						// Store file in public/uploads/ folder
						$upload_location = "../writable/uploads/";
						$file->move($upload_location, $newName);
						
						// File path to display preview
						$filepath = base_url()."../writable/uploads/cover/".$newName;
						
						// Resize image
						$resize_location = "../writable/uploads/cover/miniatura/";
						if (!is_dir($resize_location)) {
							mkdir($resize_location, 0777, TRUE);
						}
						
						$image = \Config\Services::image();
						$image->withFile($upload_location.$newName)
						->resize($ancho, $alto, true, 'width')
						->save($resize_location.$newName);
						
						// Set Session
						session()->setFlashdata('message', 'File uploaded successfully.');
						session()->setFlashdata('alert-class', 'alert-success');
						
						}else{
						// Set Session
						session()->setFlashdata('message', 'File not uploaded.');
						session()->setFlashdata('alert-class', 'alert-danger');
					}
					}else{
					// Set Session
					session()->setFlashdata('message', 'File not uploaded.');
					session()->setFlashdata('alert-class', 'alert-danger');
				}
			}
			return redirect()->route('posts')->with('msg', [
			'type' => 'success',
			'body' => 'El Artículo fue guardado exitosamente !!!'
			]);		  
		}
	}	