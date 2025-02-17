<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use App\Entities\Post;
use App\Models\PostModel;
use App\Models\CategoriesModel;
// use CodeIgniter\Images\Exceptions\ImageException;

/* Estas van en todos los Controladores del proyecto */
use App\Controllers\ClasesPublicas;
use App\Libraries\Custom;
use App\Libraries\Toastr; 
use Hashids\Hashids;

class Posts extends BaseController
{
    // protected $db;
	protected $regPerPage;
	protected $router;
	protected $metodo;
	protected $controller;
	protected $controlador;
	protected $clase;
	protected $modelo;
	protected $configs;
	

	/* -------------------------------------------------------------- */
	/* Agregar esta funcion a todos los Controladores del Proyecto */
	//#[\AllowDynamicProperties]
	public function __construct(){
		
			$clasePub = new ClasesPublicas(
						$router=null, 
						$metodo=null, 
						$controller=null, 
						$controlador=null, 
						$clase=null, 
						$modelo=null, 
						$configs=null);
			
			$this->router = $clasePub->router;
			$this->metodo = $clasePub->metodo;
			$this->controller = $clasePub->controller;         
			$this->controlador = $clasePub->controlador ;
			$this->clase = $clasePub->clase ;
			$this->modelo= $clasePub->modelo;
			$this->configs = $clasePub->configs;

	}
	/* -------------------------------------------------------------- */
	
    public function index(){ 

		//$db      = \Config\Database::connect();
		$builder = new PostModel();
		$cantidadRegistros = $builder->countAll();	
		
		$data = Custom::msgBuild('PostModel', $this->configs->regPerPage, $this->clase, $this->modelo, $this->metodo, $cantidadRegistros, 'posts');
		$key = array_search('cantRegistros', $data);

		$builder->get();
		//$count=$builder->countAllResults();

		if ($cantidadRegistros > 0){
			log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . "Encontre " . $cantidadRegistros . " registros en " . $this-Clase);
			$sql = "SELECT posts.id, 
						   substring(posts.title, 1, 15) as title,
						   substring(posts.body,  1, 40) as body,
						   concat(posts.author, '-', users_info.name, ' ', users_info.surname) as author,
						   DATE_FORMAT(posts.published_at,'%d/%m/%Y') as published_at
					  FROM `posts` 
				 LEFT JOIN `users_info` 
						on posts.author = users_info.id_user
					 WHERE posts.author is not null
					 LIMIT 10"; 				 
			$data = [
				'datos'			=> $db->query($sql)->getResult(), //Array(),
				'pager'			=> $this->configs->regPerPage, 
				'currentPage'	=> 1
			];     
		}else{
			$data = [
				'datos'			=> [],
				'pager'			=> null, 
				'currentPage'	=> 1,
				'paginate'		=> $this->configs->regPerPage,
			];     
		}	
		
		// Msg Toast / SweetAlert2
		$msgToast = [
			's2Titulo'=> $this->clase, 
			's2Texto' => 'Ingreso al listado de Posts.',
			's2Icono' => 'success',
			's2Toast' => 'true',
			's2Footer' => null,
		]; 
		$data += $msgToast; 
		$key = array_search('success', $data);
        //return view('Admin/posts', $data);
		echo view('Admin/posts', $data);

		//echo view('Admin/posts', $data);
		//echo view('sweetalert2', $msgToast);  		
		
    }
    //public function resizeImage($file_name){


    public function create(){

        $cModel = model('CategoriesModel');
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", pasamos el modelo cModel a la vista post_create.");
		return view('Admin/posts_create',[
            'categories' => $cModel->findAll(),
        ]);
    }
	/* ================================================================================== */
	/* ================================================================================== */
	/* ================================================================================== */
    public function store(){
        log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", recibimos los datos para crear el Artículo.");

		$varLargo = (int)strlen($this->request->getFile('cover'));	
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", variable $varLargo =" . $varLargo);

        if ( $varLargo>0 ){
            $file = $this->request->getFile('cover');
            $fileName = $this->request->getFile('cover')->getName();
			log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", variable $file =" . $file);
			log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", variable $fileName =" . $fileName);
       }
        $validationRule = [
            'title' => 'required',
            'body' => 'required',
            'published_at' => 'required|valid_date',
            'categories.*' => 'permit_empty|is_not_unique[categories.id]',
	'cover' => 'uploaded[cover]|is_image[cover]',  // |max_size[file,4048] |ext_in[file,jpeg,jpg,png]
        ];
		
        if (! $this->validate($validationRule)) {
			log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", NO Valido las reglas.");
            return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
        }
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", Reglas Validadas.");
        // este Post pertenece a la Entidad
		$file = $this->request->getFile('cover');
		
        $post = new Post($this->request->getPost());
        $post->slug = $this->request->getVar('title');
        $post->author = session()->id_user;
		$post->cover = $file->getRandomName();
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", Author=".$post->author);
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", Cover =".$post->cover);
				
        //$post->cover = $this->resizeImage($this->request->getFile('file')->getRandomName());
        //log_message("info", "resizeImages ( this->request->getFile(file)->getRandomName()) : " . $post->cover);
		// 39-. Guardar Artículos
        $postModel = model('PostModel');		        
		$postModel->assignCategories($this->request->getVar('categories'));
        
        $postModel->insert($post);   
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", Insertamos $post =".$post);
		$file->store( WRITEPATH . 'uploads/covers/', $post->cover);		
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", file->store=" . WRITEPATH . 'uploads/covers/', $post->cover);
		d($file);
		d($post->cover);
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", vamos a $resizeImage()");
		// -------------------- //
		// -------------------- //
		$resizeImage();
		// -------------------- //
		// -------------------- //
		log_message("info", $this->clase . "/" . $this->modelo . "/" . $this->metodo . ", volvimos de $resizeImage()");
	}
		/* ================================================================================== */
		/* ================================================================================== */
		/* ================================================================================== */
	public function resizeImage2($file_name){

        log_message("info", "Medida de las Imagenes Miniatura, Ancho: " . $this->configs->defImgMinWidth . " Alto: " . $this->configs->defImgMinHeight );
        log_message("info", "Medida de las Imagenes Standard,  Ancho: " . $this->configs->defImgMaxWidth . " Alto: " . $this->configs->defImgMaxHeight );
		d($file_name);

        $dest   = ROOTPATH . 'writable\\uploads\\covers\\miniatura\\' ;
        // $file   = $this->request->getFile('file');
		$nombre = $file_name->getBasename();
		d($dest);
		d($nombre);

        //--------------------------------
        // Fijo Tamaño Miniatura 100 x 100_
        //--------------------------------        
        if ( ! $file_name->hasMoved()){
		echo "======== </br>" . $file_name . " ========= </br>";
			$newName = $file_name->getRandomName(); //cambia a un nombre randomico
		echo "</br>" . $newName . "</br>";	

			echo "*********</br>";
			d($file_name);
			echo "=========</br>";
			d($dest);
			echo "-------- </br>";
			d(ROOTPATH);
			echo "</br>";
            $image = \Config\Services::image();
			$file_name->move($dest, $newName);
			d($this->configs->defImgMinWidth);
			d($this->configs->defImgMinHeight);
exit();
			log_message("info", "Controllers\Posts\resizeImage 100x100 movemos el archivo " . ROOTPATH . 'writable/uploads/covers/' . $file_name . ".");
            // Miniatura
			//d($newName);			 

            try {
                //$image->withFile(ROOTPATH . 'writable/uploads/covers/' . $file_name)
				$image->withFile($file_name)
                      ->fit($this->configs->defImgMinWidth,  $this->configs->defImgMinHeight, 'center')
                      ->save(ROOTPATH . 'writable/uploads/covers/miniatura/' . $nombre );
                } catch (\CodeIgniter\Images\Exceptions\ImageException $e) {
                    echo $e->getMessage();
            }
        }else{
            log_message("debug", "Controllers/Posts/resizeImage 100x100 el archivo " . $file_name . "  has moved.");
        }
        //--------------------------------
        // Tamaño 1024 x 768
        //--------------------------------        
            $archivo =  $this->cambioNombreArchivo($file_name);   
			dd($archivo);
            try {
                $image->withFile(ROOTPATH . 'writable/uploads/covers/' . $file_name)
                    ->resize($this->configs->defImgMaxWidth, $this->configs->defImgMaxHeight, 'center', true, 'height')
                    ->save(ROOTPATH . 'writable/uploads/covers/' . $archivo );
                } catch (\CodeIgniter\Images\Exceptions\ImageException $e2) {
                    echo $e2->getMessage();
            }
        return $archivo;
    }
    public function cambioNombreArchivo($file_name){
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        log_message("info", "Controllers/Posts/resizeImage, Extension:  " . $extension );

        $agregar = "_" . $this->configs->defImgMaxWidth ."x" . $this->configs->defImgMaxHeight . "." . $extension;
        $archivo = substr($file_name, 0, strrpos($file_name, '.', -1)) . $agregar;

        log_message("info", "Controllers/Posts/cambioNombreArchivo, nombre archivo generado:  " . $archivo );

        return $archivo;
		
	}
}