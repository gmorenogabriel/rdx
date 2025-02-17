<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Category;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\CategoriasModel;

/* Estas van en todos los Controladores del proyecto */
use App\Libraries\Custom;
use App\Libraries\Toastr;
use Hashids\Hashids;
use App\Libraries\Backend_lib;  // Permisos

class Categories extends BaseController
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

		$permisos = new Backend_lib();
		$this->router		= \Config\Services::router();
		$this->metodo		= $this->router->methodName();
		$this->controller	= $this->router->controllerName();
		$this->controlador	= explode('\\', $this->controller) ;
		$this->clase		= $this->controlador[max(array_keys($this->controlador))] ;
		$this->modelo		= ucfirst($this->clase).'Model()';
	}
	/* -------------------------------------------------------------- */
		public function index(){

			// Msg Toast / SweetAlert2
			$msgToast	= Custom::msgToast($this->clase, 'Ingreso al listado');

			// Arma el Array para pasar a la vista
			$model	= new CategoriasModel();
			$data	= Custom::msgBuild('CategoriasModel', $this->configs->regPerPage, $this->clase, $this->modelo, $this->metodo, $cantidadRegistros=0, 'categories');
			$query	= $model->table('categorias')->countAllResults();
			$count	= $cantidadRegistros = Custom::cantidadFilasTabla('categorias');

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
			//return view('Admin/posts', $data);
			echo view('Admin/categories', $data);
		}

		public function create(){
			log_message("info", "Controllers/Categories/create, vamos a la vista Admin/categories_create." );
			return view('Admin/categories_create');
		}

		public function store(){
			if(!$this->validate([
					'name' => 'required|alpha_space|max_length[120]'
			])){
				return redirect()->back()->withInput()
                ->with('msg', [
				'type' => 'danger',
				'body' => 'Tienes campos incorrectos'
				])
				->with('errors', $this->validator->getErrors());
			}
			// Guardamos en la Base de Datos
			$model = model('CategoriesModel');
			//d($model);
			try {
				$model->save(['name' => trim($this->request->getVar('name'))]);
			}catch (\Exception $e)
				{
					if ($e->getCode() === 1062)
					{
						log_message('warning', 'Duplicate status ({status}) for order {id}', [
							'status' => $statusId,
							'id'     => $orderId
						]);
					}

					exit($e->getMessage());
				}

			// Redirecionamos y enviamos mensaje con el With
			$msgToast = Custom::msgToast($this->clase);
			$msgToast = [
				's2Titulo'=> $this->clase,
				's2Texto' => $this->clase . ' creada !!!',
				's2Icono' => 'success',
				's2Toast' => 'true'
			];

//			$categModel = model('CategoriesModel');
//			$categorias = $categModel->findAll();
			$builder = new CategoriesModel();
			$builder->get();
			$data = [
					'titulo'		=> $this->clase,
					'categories'	=> $builder->orderBy('created_at','DESC')->paginate($this->configs->regPerPage),
					'pager'			=> $builder->pager,
					'currentPage'	=> 1
			];
			//session()->setFlashdata('message', 'Categ.Ingresada exitosamente!!!');
			echo view('Admin/categories', $data);
		//	echo view('sweetalert2', $msgToast);
/*
return redirect('categories')->
						// with('msg',[
						with('message',[
							'type' => 'success',
							'body' => 'Categoría guardada exitosamente!',
							]);
					*/
		 }
		public function edit(string $id){
			$model = model('CategoriesModel');
			if(!$category = $model->find($id)){
				throw PageNotFoundException::forPageNotFound();
			}
			return view('Admin/categories_edit',[
						'category' => $category
			]);
		}
		public function update(){
			if(!$this->validate([
            'name' => 'required|max_length[120]',
            'id' => 'required|is_not_unique[categories.id]',
			])){
				return redirect()->back()->withInput()
                ->with('msg', [
                'type' => 'danger',
                'body' => 'Tienes campos incorrectos'
				])
				->with('errors', $this->validator->getErrors());
			}
			// Guardamos en la Base de Datos
			$model = model('CategoriesModel');
			$model->save([
            'id' => trim($this->request->getVar('id')),
            'name' => trim($this->request->getVar('name'))
			]);

			$msgToast = [
				's2Titulo'=> 'Categoría ',
				's2Texto' => 'Datos actualizados',
				's2Icono' => 'success',
				's2Toast' => 'true'
			];
			$categModel = model('CategoriesModel');
			$categorias = $categModel->findAll();
			$builder = new CategoriasModel();
			$builder->get();
			$data = [
					'titulo'		=> $this->clase,
					'categories'	=> $builder->orderBy('created_at','DESC')->paginate($this->configs->regPerPage),
					'pager'			=> $builder->pager,
					'currentPage'	=> 1
			];
			//session()->setFlashdata('msgToast', 'Swal Actualizado exitosamente!!!');
			echo view('Admin/categories', $data);
			//echo view('sweetalert2', $msgToast);
/*
return redirect('categories')->with('msg',[
            'type' => 'success',
            'body' => 'Categoría fue actualizada exitosamente'
			]);
*/
		}

		public function delete(string $id){
			$hash = new Hashids();
			$id = $hash->decode($id);
			$model = model('CategoriesModel');
			$model->delete($id);
			return redirect('categories')->with('msg',[
				'type' => 'success',
				'body' => 'Categoría fue eliminada exitosamente'
			]);
		}
	}
