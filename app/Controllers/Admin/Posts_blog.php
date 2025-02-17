<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Post;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\PostModel;

use CodeIgniter\Images\Exceptions\ImageException;
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
	/* Agregar esta funcion a todos los Controladores del Proyecto    */
	/* -------------------------------------------------------------- */
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
        // $config['log_threshold'] = 4;
        // d($this->configs->regPerPage);
        // d(session()->get('group_name')); 
        // log_message("debug", "Controllers/Login/index no esta logueado, vamos al Auth/login");
        $db      = \Config\Database::connect();
        $builder = new PostModel();
        $builder->get();
        $sql = "SELECT posts.id, 
                       substring(posts.title, 1, 15) as title,
                       substring(posts.body,  1, 40) as body,
                       concat(posts.author, '-',users_info.name, ' ', users_info.surname) as author,
                       posts.published_at
                  FROM `posts` 
             LEFT JOIN `users_info` 
                    on posts.author = users_info.id_user
                 WHERE posts.author is not null
                 LIMIT 10";
				 
        $data = [
            'datos'			=> $db->query($sql)->getResultArray(),
            'pager'			=> $builder->pager,
            'currentPage'	=> 1, //$currentPage,
        ];        
        return view('Admin/posts', $data);
    }
    public function resizeImage($file_name){

        log_message("info", "Medida de las Imagenes Miniatura, Ancho: " . $this->configs->defImgMinWidth . " Alto: " . $this->configs->defImgMinHeight );
            
        //$source = WRITEPATH . '/uploads/covers/' . $file_name;
		$source = $file_name;
        $dest   = WRITEPATH . '/uploads/covers/miniatura/' ;
        $file = $this->request->getFile('file');
		log_message("info", "Source: " . $source . ", Destino: " . $dest . ", Archivo: " . $file);
        //--------------------------------
        // Fijo Tamaño Miniatura 100 x 100_
        //--------------------------------        
        $image = \Config\Services::image();
		dd($image);
		
		if ( !$file->hasMoved()){
		 
		$file->move( WRITEPATH . '/uploads/covers/', $file->getBasename());
		
          log_message("info", "Controllers/Posts/resizeImage 100x100 movemos el archivo " . WRITEPATH . '/uploads/covers/' . $file_name . ".");
            // Miniatura
            try {
                $image->withFile($source)
                    ->fit($this->configs->defImgMinWidth,  $this->configs->defImgMinHeight, 'center')
                    ->save(WRITEPATH . '/uploads/covers/miniatura/' . $file_name );
                } catch (\CodeIgniter\Images\Exceptions\ImageException $e) {
                    echo $e->getMessage();
            }
        }else{
            log_message("debug", "Controllers/Posts/resizeImage 100x100 el archivo " . $file_name . "  has moved.");
        }
        // --------------------------------
        // Tamaño 1024 x 768
        //--------------------------------        
            // $archivo =  $this->cambioNombreArchivo($file_name);  
			log_message("info", "Nombre de archivo para procesar: " . $file_name);
            try {
				$image->withFile($source)
                //$image->withFile(WRITEPATH . '/uploads/covers/' . $file_name)
                    ->resize($this->configs->defImgMaxWidth, $this->configs->defImgMaxHeight, 'center', true, 'height')
                    ->save(WRITEPATH . '/uploads/covers/' . $file_name );
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
    public function create(){
        log_message("info", "Controllers/Posts/create, vamos a la vista Admin/posts_create." );
        $cModel = model('CategoriesModel');
        return view('Admin/posts_create',[
            'categories' => $cModel->findAll(),
        ]);
    }
    public function store(){
        log_message("info", "Controllers/Posts/store." );
        // para control no recibe el archivo dd($this->request->getPost());         
        // $file = $this->request->getFile('cover')->getName();
        $varLargo = (int)strlen($this->request->getFile('file'));
        if ( $varLargo>0 ){
            $file = $this->request->getFile('file');
            $fileName = $this->request->getFile('file')->getName();
			log_message("info", "Controllers/Posts/store, " . $file . ". Nombre: " . $fileName );
       }
        $validationRule = [
            'title' => 'required',
            'body' => 'required',
            'published_at' => 'required|valid_date',
            'categories.*' => 'permit_empty|is_not_unique[categories.id]',
            'file' => 'uploaded[file]|is_image[file]',
        ];
        //$file = $this->request->getFile('cover');
        if (! $this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
        }
		log_message("info", "Controllers/Posts/store, se validaron las reglas.");

        // este Post pertenece a la Entidad
        $post = new Post($this->request->getPost());
        $post->slug = $this->request->getVar('title');
        $post->author = session()->id_user;

        $postModel = model('PostModel');
        $postModel->assignCategories($this->request->getVar('categories'));
        log_message("info", "Controllers/Posts/store, nombre archivo recibido:  " . $post->cover );

        $postModel->insert($post);   
        log_message("info", "Controllers/Posts/store, imagen insertada:  " . $post->cover );

		$file->store('covers/', $post->cover);
        log_message("info", "Controllers/Posts/store, imagen store:  " . $post->cover );
				
		log_message("info", "resizeImages invocamos con " . $file );		
        // Resize Image, devulve el nombre del archivo modificado
		$post->cover = $this->resizeImage($file);
        //$post->cover = $this->resizeImage($this->request->getFile('file')->getRandomName());
//        log_message("info", "resizeImages " . $file);
		
        // ----- Fin RESIZE images
        //--------------------------------------------------------------------------------------------        
        return redirect()->route('posts')->with('msg', [
            'type' => 'success',
            'body' => 'El Artículo fue guardado exitosamente !!!'
        ]);
    }
}