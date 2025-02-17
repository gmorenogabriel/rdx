<?php
// app/Controllers/Productos.php
namespace App\Controllers\Mantenimiento;
use App\Controllers\BaseController;
use App\Libraries\Custom;

use App\Models\ProductoModel;
//use App\Models\ProductModel;

class CarritoProductos extends BaseController
{
    protected $productoModel;

    public function __construct()
    {
        // Crear una instancia del modelo ProductoModel
        $this->productoModel = new ProductoModel();
    }
    public function index()
    {
        // Cargar el helper de URL
        helper('url');

        $msgToast = [
            'tipo'      => 'success',
            'titulo'    => 'Producto carrito', 
            'texto'     => 'Listado de productos !!!',
            'posicion'  => 'top-end',
            'icono'     => 'success',
            'toast'     => 'true'
        ];
        session()->setFlashdata($msgToast);

        // Obtener todos los productos
        $productos = $this->productoModel->findAll();

        // Enviar los productos a la vista
        // return view('Admin/carrito/productos', ['productos' => $productos]);

		echo view('layouts/header');
        echo view('layouts/aside');
        echo view('Admin/carrito/productos', ['productos' => $productos]);
        echo view('layouts/footer');
        echo view('sweetalert2',$msgToast);
    }
}
