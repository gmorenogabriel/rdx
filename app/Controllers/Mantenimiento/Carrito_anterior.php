<?php
// app/Controllers/Carrito.php
namespace App\Controllers\Mantenimiento;
use App\Controllers\BaseController;
use App\Models\ProductoModel;

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
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        // Obtener productos seleccionados del formulario
        $productosSeleccionados = $this->request->getPost('productos');

        foreach ($productosSeleccionados as $productoId => $productoInfo) {
            // Aquí asumes que obtienes el producto de la base de datos (ProductoModel)
            $productoModel = new \App\Models\ProductoModel();
            $producto = $productoModel->find($productoId);

            if (!$producto) {
                // Si el producto no existe, continuar con el siguiente
                continue;
            }

            if(!$this->request->getPost('cantidad')>0){

                $msgToast = [
                        'tipo'      => 'info',
                        'titulo'    => 'info',
                        'texto'     => 'No ingresó una Cantidad.',
                        'posicion'  => 'center',
                        'icono'     => 'info',
                        'toast'     => true,
                        'footer'	=> null,
                        'botonConfirma'=> 'Confirme',
                        ];

                       // Guardar el carrito actualizado en la sesión
                       $session->set('carrito', $carrito);

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
                        echo view('sweetalert2',$msgToast);

            }else{
                $cantidad = (int)$productoInfo['cantidad'];

        d('Carrito - 70 - el Checkbox esta marcado y la cantidad tmb');
                    // Verificar stock disponible
                    if ($cantidad > $producto['stock']) {
                        // Mostrar error o manejar la cantidad sobrepasada
                        continue; // O también podrías retornar un error a la vista
                    }

                    // Si el producto ya existe en el carrito, actualizar la cantidad
                    if (isset($carrito[$productoId])) {
                        // Verificar que no se supere el stock
                        $nuevaCantidad = $carrito[$productoId]['cantidad'] + $cantidad;
                        if ($nuevaCantidad <= $producto['stock']) {
                            $carrito[$productoId]['cantidad'] = $nuevaCantidad;
                        } else {
                            // Manejar el caso donde la nueva cantidad supera el stock disponible
                            continue;
                        }
                    } else {
                                // Si no está en el carrito, agregarlo
                                $carrito[$productoId] = [
                                    'id' => $producto['id'],
                                    'nombre' => $producto['nombre'],
                                    'precio' => $producto['precio'],
                                    'cantidad' => $cantidad,
                                    'stock' => $producto['stock']
                                ];
                            }
                    }
                        $msgToast = [
                            'tipo'      => 'success',
                            'titulo'    => 'Producto', 
                            'texto'     => 'Agregado al carrito !!!',
                            'posicion'  => 'top-end',
                            'icono'     => 'success',
                            'toast'     => 'true'
                        ];

                        // Guardar el carrito actualizado en la sesión
                        $session->set('carrito', $carrito);

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
    }

    // Método para ver el contenido del carrito
    public function ver()
    {
        $session = session();
        $carrito = $session->get('carrito');
        d($carrito);
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
d($carrito);
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
            d($carrito);
            echo view('layouts/header');
            echo view('layouts/aside');
            echo view('Admin/carrito/ver_carrito',  ['carrito' => $carrito]); //, ['productos' => $productos]);
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
        d($carrito);
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



    // Finalizar la Compra
    // app/Controllers/Carrito.php

    public function finalizarCompra()
    {
        $session = session();
        $carrito = $session->get('carrito');

        // Verificar si el carrito está vacío
        if (empty($carrito)) {
            echo view('layouts/header');
            echo view('layouts/aside');
            echo view('Admin/carrito/ver_carrito'); //, ['productos' => $productos]);
            echo view('layouts/footer');
            echo view('sweetalert2');
            //return redirect()->to(route_to('verCarrito'))->with('error', 'No tienes productos en el carrito.');
        }

        // Aquí podrías insertar la compra en la base de datos
        // Ejemplo de sumar el total de la compra
        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        // Limpiar el carrito después de finalizar la compra
        $session->remove('carrito');

        // Redirigir a una página de confirmación o resumen de la compra
        return view('compra_finalizada', ['total' => $total]);
    }

}
