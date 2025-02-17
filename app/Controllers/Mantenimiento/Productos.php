<?php namespace App\Controllers\Mantenimiento;
	//******************************************************** //
	// el Store funciona bien, hay que aplicarlo en el update
	//******************************************************** //

use App\Controllers\BaseController;
use App\Models\ProductosModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use App\Libraries\Backend_lib;  // Permisos

class Productos extends BaseController
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

		$permisos = new Backend_lib();
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
		public function index(){
			$productos = new ProductosModel();
			$data['productos'] = $productos->findAll();
		/*	return view('admin/productos/productos', $data);    */
			echo view('layouts/header');
			echo view('layouts/aside');
			echo view('Admin/productos/productos', $data);
			echo view('layouts/footer');
		}

		public function create(){
			return view('Admin/productos/productos_create');
		}

		public function store(){
			$image	= service('image');
			$configs= config('Blog');
			$producto = new ProductosModel();
			$file = $this->request->getFile('imagen');

			if ($file->isValid() && ! $file->hasMoved())
			{
				$imageName = $file->getRandomName();

				if (!file_exists( $configs->imgDefaultTemp )) {
					mkdir( $configs->imgDefaultTemp, 0777, true);
				}
				// ------------------------------------------------------ //
				// lo Guardo en Temp
			    $file->move($configs->imgDefaultTemp, $imageName);
				// ------------------------------------------------------ //
			}

			// ---------------------------------------------------------- //
			// ESTO LO PROBE Y FUNCIONA, LO PASE A CUSTOM COMO funcion -- //
			// ---------------------------------------------------------- //
//			$image->withFile( $configs->imgDefaultTemp . $imageName)
//				->fit($configs->defImgMaxWidth, $configs->defImgMaxHeight, 'center')
//				->save($configs->imgDefaultPath . $imageName);
//

			// Lo traigo desde Temp a Uploads xq cambio el tamaño
			Custom::resizeImageMaxResol($imageName, $configs->defImgMaxWidth, $configs->defImgMaxHeight);				// ---------------------------------------------------------- //
			// Genero las miniaturas en Covers
			Custom::resizeImageCovers($imageName, $configs->defImgMinWidth, $configs->defImgMinHeight);
			// ---------------------------------------------------------- //
			// Si existe en Temp entonces lo elimino
			if(file_exists( $configs->imgDefaultTemp . $imageName)){
				unlink( $configs->imgDefaultTemp . $imageName);
			}
			// ---------------------------------------------------------- //

			$data = [
				'codigo'		=> $this->request->getPost('codigo'),
				'nombre'		=> $this->request->getPost('nombre'),
				'descripcion'	=> $this->request->getPost('descripcion'),
				'precio'		=> $this->request->getPost('precio'),
				'stock'			=> $this->request->getPost('stock'),
				'imagen'		=> $imageName,
			];
			$producto->save($data);
			return redirect()->to('admin/productos')->with('status','Producto e imágenes guardados!');
		}

		public function edit($id){
//			$configs		= config('Blog');
			$producto = new ProductosModel();
			$data['producto']	= $producto->find($id);
			$imageName			= $data['producto']['imagen'];
			return view('admin/productos/productos_edit', $data);
		}
		public function update($id){
			$configs		= config('Blog');
			$productos		= new ProductosModel();
			$prod_item		= $productos->find($id);
			$old_img_name	= $prod_item['imagen'];
			$file			= $this->request->getFile('imagen');

			if($file->isValid() && !$file->hasMoved() && !$old_img_name=="") {
				// Camino Uploads
				if(file_exists( $configs->imgDefaultPath . $old_img_name)){
					unlink( $configs->imgDefaultPath . $old_img_name);
				}
				// Camino Cover, si el archiv existe lo elimino
				if(file_exists( $configs->imgDefaultDest. $old_img_name)){
					unlink( $configs->imgDefaultDest . $old_img_name);
				}

				$imageName = $file->getRandomName();

				$file->move($configs->imgDefaultPath, $imageName);
				// Genero las miniaturas en Covers
				Custom::resizeImageCovers($imageName, $configs->defImgMinWidth, $configs->defImgMinHeight);

			}else{
				$imageName = $old_img_name;
			}
			$data = [
				'codigo'		=> $this->request->getPost('codigo'),
				'nombre'		=> $this->request->getPost('nombre'),
				'descripcion'	=> $this->request->getPost('descripcion'),
				'precio'		=> $this->request->getPost('precio'),
				'stock'			=> $this->request->getPost('stock'),
				'imagen'		=> $imageName,
			];

			$productos->update($id, $data);
			return redirect()->to('Admin/productos')->with('status','Producto e imágenes guardados!');

		}

		public function viewplusimg($filename){

			// Verifica si el archivo existe
			//$file_path = WRITEPATH . 'uploads/' . $filename;

			$file_path = ROOTPATH  . 'public/uploads/' . $filename;

			if (!file_exists($file_path)) {
				// Redirige o muestra un error si la imagen no existe
			return redirect()->to('admin/productos')->with('error', 'Imagen no encontrada');
			}
			// Envía el nombre del archivo a la vista
			echo view('layouts/header');
			echo view('layouts/aside');
			echo view('Admin/productos/productosplusimg', ['filename' => $filename]);
			echo view('layouts/footer');

		}

}