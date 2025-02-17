<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Post;
use App\Models\PostModel;
use App\Models\CategoriesModel;


// use CodeIgniter\Images\Exceptions\ImageException;

class Posts extends BaseController
{
    protected $configs;

    public function __construct(){
        $this->configs = config('..\..\Config\Blog');
        /*
        $file_name = "1678888322121324.jpeg";
        d($file_name);
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $aCambiar = "_1024x768." . $extension; //pathinfo($str, PATHINFO_EXTENSION);
        d($aCambiar);
        $str = substr($file_name, 0, strrpos($file_name, '.', -1)).$aCambiar;
        dd($str);
        */
    }
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
						   concat(posts.author, '-', users_info.name, ' ', users_info.surname) as author,
						   DATE_FORMAT(posts.published_at,'%d/%m/%Y') as published_at
					  FROM `posts` 
				 LEFT JOIN `users_info` 
						on posts.author = users_info.id_user
					 WHERE posts.author is not null
					 LIMIT 10"; 				 
        $data = [
            'datos' => $db->query($sql)->getResultArray(),
            'pager'       => $builder->pager,
            'currentPage' => 2 //$currentPage,
        ];        
        return view('Admin/posts', $data);
    }
    public function resizeImage($file_name){

        log_message("info", "Medida de las Imagenes Miniatura, Ancho: " . $this->configs->defImgMinWidth . " Alto: " . $this->configs->defImgMinHeight );
        log_message("info", "Medida de las Imagenes Standard,  Ancho: " . $this->configs->defImgMaxWidth . " Alto: " . $this->configs->defImgMaxHeight );
    
        $source = WRITEPATH . '/uploads/covers/' . $file_name;
        $dest   = WRITEPATH . '/uploads/covers/miniatura/' ;
        $file = $this->request->getFile('file');
        //--------------------------------
        // Fijo Tamaño Miniatura 100 x 100
        //--------------------------------        
        if ( ! $file->hasMoved()){
             $file->move(WRITEPATH . '/uploads/covers/', $file_name);
             log_message("info", "Controllers/Posts/resizeImage 100x100 movemos el archivo " . WRITEPATH . '/uploads/covers/' . $file_name . ".");
            // Miniatura
            $image = \Config\Services::image();
            try {
                $image->withFile(WRITEPATH . '/uploads/covers/' . $file_name)
                    ->fit($this->configs->defImgMinWidth,  $this->configs->defImgMinHeight, 'center')
                    ->save(WRITEPATH . '/uploads/covers/miniatura/' . $file_name );
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
            try {
                $image->withFile(WRITEPATH . '/uploads/covers/' . $file_name)
                    ->resize($this->configs->defImgMaxWidth, $this->configs->defImgMaxHeight, 'center', true, 'height')
                    ->save(WRITEPATH . '/uploads/covers/' . $archivo );
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
        // este Post pertenece a la Entidad
        $post = new Post($this->request->getPost());
        $post->slug = $this->request->getVar('title');
        $post->author = session()->id_user;

        // Resize Image, devulve el nombre del archivo modificado
        $post->cover = $this->resizeImage($this->request->getFile('file')->getRandomName());
        log_message("info", "resizeImages ( this->request->getFile(file)->getRandomName()) : " . $post->cover);

        $postModel = model('PostModel');
        $postModel->assignCategories($this->request->getVar('categories'));
        log_message("info", "Controllers/Posts/store, nombre archivo recibido:  " . $post->cover );

        $postModel->insert($post);   
        log_message("info", "Controllers/Posts/store, imagen insertada:  " . $post->cover );

        // $file->store('covers/', $post->cover);
        // ----- Fin RESIZE images
        //--------------------------------------------------------------------------------------------        
        return redirect()->route('posts')->with('msg', [
            'type' => 'success',
            'body' => 'El Artículo fue guardado exitosamente !!!'
        ]);
    }
}