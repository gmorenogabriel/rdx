<?php
namespace App\Controllers\Mantenimiento;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class CartController extends BaseController
{
    public function __construct()
    {
        // Cargar la librería de sesión
        session();
    }

    public function index()
    {
        $productModel = new ProductModel();
        $data['productos'] = $productModel->findAll();
dd($data);
        return view('products/cart_view', $data);
    }

    public function addToCart()
    {
        $session = session();

        // Recuperar productos seleccionados del formulario
        $productosSeleccionados = $this->request->getPost('productos');

        $cart = $session->get('cart') ?? [];

        if ($productosSeleccionados) {
            $productoIds = array_column($productosSeleccionados, 'id');
            $productoModel = new ProductModel();
            $productos = $productoModel->obtenerProductosPorIds($productoIds);

            // Añadir las cantidades a los productos
            foreach ($productos as &$producto) {
                $producto['cantidad'] = $productosSeleccionados[$producto['id']]['cantidad'];
            }
            d($productosSeleccionados);
            d($producto['cantidad']);
            d($cart);
            exit();

            // Mostrar los productos seleccionados con sus cantidades
            return view('cart', ['productos' => $productos]);
        } else {
            // return redirect()->back()->with('error', 'No seleccionaste ningún producto.');
        }


    /* Guardar el carrito en la sesión
        $session->set('cart', $cart);
        //return redirect()->to('/cart');
        return redirect()->to('productscart');
    */
    }
}