<?php
// app/Controllers/Carrito.php
namespace App\Controllers\Mantenimiento;
use App\Controllers\BaseController;
use App\Models\ProductoModel;
use App\Models\CompraModel;
use App\Models\DetalleCompraModel;
use App\Models\UsuariosModel;

//use App\Libraries\Toastr;

class Carrito extends BaseController
{
    protected $productoModel;

    public function __construct()
    {
        // Cargar la librería de sesión
        session();
        // Crear una instancia del modelo ProductoModel
        $this->productoModel = new ProductoModel();
    }

    public function agregarAlCarrito()
    {

        $productosSeleccionados = $this->request->getPost('productos');

        if (!empty($productosSeleccionados)) {
            $carrito = session()->get('carrito', []);

            foreach ($productosSeleccionados as $idProducto => $datosProducto) {
                if (isset($datosProducto['seleccionado']) && $datosProducto['cantidad'] > 0) {
                    // Obtener la información del producto (simular que proviene de la base de datos o similar)
                    $producto = $this->productoModel->obtenerProductoPorId($idProducto); // Implementa esta función según tu estructura

                    // Si el producto existe y tiene suficiente stock
                    if ($producto && $producto['stock'] >= $datosProducto['cantidad']) {
                        // Agregar o actualizar el producto en el carrito
                        if (isset($carrito[$idProducto])) {
                            $carrito[$idProducto]['cantidad'] += $datosProducto['cantidad'];
                        } else {
                            $carrito[$idProducto] = [
                                'id' => $producto['id'],
                                'nombre' => $producto['nombre'],
                                'precio' => $producto['precio'],
                                'cantidad' => $datosProducto['cantidad'],
                            ];
                        }
                    }
                }
            }

            // Guardar el carrito en la sesión
            session()->set('carrito', $carrito);
        }
            $msgToast = [
                'tipo'      => 'success',
                'titulo'    => 'Producto', 
                'texto'     => 'Agregado al carrito !!!',
                'posicion'  => 'top-end',
                'icono'     => 'success',
                'toast'     => 'true'
            ];
        //
        // Obtengo nuevamente la lista de los productos para que continue comprando
        //
        $productos = $this->productoModel->findAll();
        echo view('layouts/header');
        echo view('layouts/aside');
        // echo view('Admin/carrito/ver_carrito', $carrito);
        echo view('Admin/carrito/productos', ['productos' => $productos]);
        echo view('layouts/footer');
        echo view('sweetalert2',$msgToast);

    }

    // Método para ver el contenido del carrito
    public function ver()
    {
        $session = session();
        $carrito = $session->get('carrito');
        // d($carrito);
        // return view('Admin/carrito/ver_carrito', ['carrito' => $carrito]);
        echo view('layouts/header');
        echo view('layouts/aside');
        echo view('Admin/carrito/ver_carrito',  ['carrito' => $carrito]); //, ['productos' => $productos]);
        echo view('layouts/footer');
        echo view('sweetalert2');

    }

    // Método para eliminar un producto del carrito
    public function eliminarProducto($id)
    {
        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito');
// d($carrito);
        // Verificar si el producto está en el carrito
        if (isset($carrito[$id])) {
            unset($carrito[$id]); // Eliminar el producto del carrito
            session()->set('carrito', $carrito); // Actualizar la sesión
            // return redirect()->to('/Admin/carrito/ver')->with('success', 'Producto eliminado del carrito.');
            //return redirect()->to(route_to('verCarrito'))->with('success', 'Producto eliminado del carrito.');;
            // MSG -> Success
			$msgToast = [
                'tipo'      => 'success',
				'titulo'    => 'Productos',
				'texto'     => 'Se elimino el item del carrito.',
				'posicion'  => 'top-end',
				'icono'     => 'success',
				'toast'     => true,
				'footer'	=> null,
			];
			//$carrito += $msgToast;
            $productos = $this->productoModel->findAll();
//d($carrito);
            echo view('layouts/header');
            echo view('layouts/aside');
            echo view('Admin/carrito/productos',  ['productos' => $productos]); //, ['productos' => $productos]);
            echo view('layouts/footer');
            echo view('sweetalert2');
        }
        $msgToast = [
                'tipo'     => 'info',
				'titulo'    => 'info',
				'texto'     => 'Producto no encontrado.',
				'posicion'  => 'center',
				'icono'     => 'info',
				'toast'     => true,
				'footer'	=> null,
                'botonConfirma'=> 'Confirme',
        ];

        //$carrito += $msgToast;
// d($carrito);
        session()->setFlashdata('errors', "Producto no encontrado");
        echo view('layouts/header');
        echo view('layouts/aside');
        echo view('Admin/carrito/ver_carrito',  ['carrito' => $carrito]); //, ['productos' => $productos]);
        echo view('layouts/footer');
        echo view('sweetalert2');

    }

    // Método para vaciar todo el carrito
    public function vaciarCarrito()
    {
        $msgToast = [
            'tipo'     => 'info',
			'titulo'    => 'info',
			'texto'     => 'Se vació el carrito.',
			'posicion'  => 'center',
			'icono'     => 'info',
			'toast'     => false,
			'footer'	=> null,
            'botonConfirma'=> 'Confirme',
        ];
        //
        // Obtengo nuevamente la lista de los productos para que continue comprando
        //
        $productos = $this->productoModel->findAll();
        echo view('layouts/header');
        echo view('layouts/aside');
        echo view('Admin/carrito/productos', ['productos' => $productos]);
        echo view('layouts/footer');
        echo view('sweetalert2',$msgToast);

        session()->remove('carrito');
    }


    public function finalizarCompra(){

        // Cargar los modelos
        $productoModel      = new ProductoModel();
        $compraModel        = new CompraModel();
        $detalleCompraModel = new DetalleCompraModel();
        $usuariosModel      = new UsuariosModel();

        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);
// d($carrito);
        // Verificar si el carrito tiene productos
        if (empty($carrito)) {
            log_message('debug', 'Carrito/finalizarCompra - El carrito esta vacío ' . print_r($carrito));
            // Si no hay productos, redirigir con un mensaje
            // return redirect()->route('productos')->with('error', 'No hay productos en el carrito.');
            echo view('layouts/header');
            echo view('layouts/aside');
            echo view('Admin/carrito/productos', ['productos' => $carrito]);
            echo view('layouts/footer');
            echo view('sweetalert2');
        }

        // Calcular el total de la compra
        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
          // --------------------------------------------------------- //
          // Nuevo 13 Set 2024                                         //
          // --------------------------------------------------------- //
          // Guardar la compra en la tabla de compras
          $session = \Config\Services::session();

          $usuarioId= $session->get('id_user'); // Aquí debes obtener el ID del usuario autenticado
          $rolId    = $session->get('rol');
          $nombre   = $session->get('nombre');
          $fecha    = date('Y-m-d H:i:s');
          $numeradorComprobante = $this->generateComprobanteNumber(); // Generar un número de comprobante único
          $resultados = $usuariosModel->getUsuario($usuarioId);
//d($resultados);
          $nombre     = $resultados->nombres . " " . $resultados->apellidos;
          $direccion  = ''; //$resultados->direccion;
          $telefono   = $resultados->telefono;
          $email      = $resultados->email;
          //Obtener la forma de pago seleccionada por el usuario
          $formaPago = $this->request->getVar('forma_pago');

          $compraData = [
            'usuario_id'=> $usuarioId,
            'rol_id'    => $rolId,
            'nombre'    => $nombre,
            'direccion' => $direccion,
            'telefono'  => $telefono,
            'email'     => $email,
            'fecha'     => $fecha,
            'numerador_comprobante' => $numeradorComprobante,
            'forma_pago'=> $formaPago,
        ];


        //$nombre     = $this->resultados->('nombre');

// d($compraData);

        $compraId = $compraModel->insert($compraData);

        // Recorrer los productos del carrito
        foreach ($carrito as $idProducto => $producto) {

            // Detalle de la compra
            $detalleCompraData = [
                'compra_id' => $compraId,
                'producto_id' => $idProducto,
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio']
            ];
            $detalleCompraModel->insert($detalleCompraData);

            // Obtener el producto desde la base de datos y actualiza STOCK
            $productoDb = $productoModel->obtenerProductoPorId($idProducto);

            // Verificar si el producto existe y tiene stock suficiente
            if ($productoDb && $productoDb['stock'] >= $producto['cantidad']) {

                // Restar la cantidad comprada del stock
                $nuevoStock = $productoDb['stock'] - $producto['cantidad'];

                // Actualizar el stock en la base de datos
                $productoModel->update($idProducto, ['stock' => $nuevoStock]);

            }
        }

        log_message('info', 'Carrito antes de eliminar: ' . print_r(session()->get('carrito'), true));
        // Eliminar el carrito
        session()->remove('carrito');
        log_message('info', 'Carrito después de eliminar: ' . print_r(session()->get('carrito'), true));

        // Leemos todos los productos nuevamente para ir a la Tienda
        $productos = $this->productoModel->findAll();
        // Redirigir a una página de confirmación o resumen de la compra
        echo view('layouts/header');
        echo view('layouts/aside');
        echo view('Admin/carrito/productos', ['productos' => $productos]);
        echo view('layouts/footer');
        echo view('sweetalert2');

    }

    public function metodoPago()
    {
        // Cargar los modelos
        $productoModel      = new ProductoModel();
        $compraModel        = new CompraModel();
        $detalleCompraModel = new DetalleCompraModel();
        $usuariosModel      = new UsuariosModel();

        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Verificar si el carrito tiene productos
        if (empty($carrito)) {
            // Si no hay productos, redirigir con un mensaje
            // return redirect()->route('productos')->with('error', 'No hay productos en el carrito.');
            echo view('layouts/header');
            echo view('layouts/aside');
            echo view('Admin/carrito/productos', ['productos' => $carrito]);
            echo view('layouts/footer');
            echo view('sweetalert2');
        }

        // Calcular el total de la compra
        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
          // --------------------------------------------------------- //
          // Nuevo 13 Set 2024                                         //
          // --------------------------------------------------------- //
          // Guardar la compra en la tabla de compras
          $session = \Config\Services::session();

          $usuarioId= $session->get('id_user'); // Aquí debes obtener el ID del usuario autenticado
          $rolId    = $session->get('rol');
          $nombre   = $session->get('nombre');
          $fecha    = date('Y-m-d H:i:s');
          $numeradorComprobante = $this->generateComprobanteNumber(); // Generar un número de comprobante único
          $resultados = $usuariosModel->getUsuario($usuarioId);
// d($resultados);
          $nombre     = $resultados->nombres . " " . $resultados->apellidos;
          $direccion  = ''; //$resultados->direccion;
          $telefono   = $resultados->telefono;
          $email      = $resultados->email;

          $compraData = [
            'usuario_id'=> $usuarioId,
            'rol_id'    => $rolId,
            'nombre'    => $nombre,
            'direccion' => $direccion,
            'telefono'  => $telefono,
            'email'     => $email,
            'fecha'     => $fecha,
            'numerador_comprobante' => $numeradorComprobante,
            'forma_pago'=> $this->request->getVar('forma_pago'),
        ];


        // Recorrer los productos del carrito
        foreach ($carrito as $idProducto => $producto) {

            // Detalle de la compra
            $detalleCompraData = [
                'producto_id' => $idProducto,
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio']
            ];

            // Obtener el producto desde la base de datos y actualiza STOCK
            $productoDb = $productoModel->obtenerProductoPorId($idProducto);

        }

        // Redirigir a una página de confirmación o resumen de la compra
        echo view('layouts/header');
        echo view('layouts/aside');
        echo view('Admin/carrito/compra_finalizada',[
                        'productos' => $carrito,
                        'total' => $total,
                        'comprobante' => $numeradorComprobante
                    ]);
        echo view('layouts/footer');
        echo view('sweetalert2');

    }

    private function generateComprobanteNumber()
    {
        // Generar un número de comprobante único, por ejemplo, basado en la fecha y hora
        return date('Ymd') . '-' . sprintf('%04d', rand(1, 9999));
    }

}

