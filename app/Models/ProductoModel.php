<?php 
// app/Models/ProductoModel.php
namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'precio', 'stock'];

    // Obtener productos por array de IDs
    // Función para obtener un producto por su ID
    public function obtenerProductoPorId($idProducto)
    {
        return $this->where('id', $idProducto)->first();
    }

    // Actualizar el stock después de agregar al carrito o compra
    public function actualizarStock($id, $cantidad)
    {
        // Obtener el stock actual
        $producto = $this->find($id);
        $nuevoStock = $producto['stock'] - $cantidad;

        // Verificar si hay stock suficiente
        if ($nuevoStock >= 0) {
            // Actualizar el stock en la base de datos
            return $this->update($id, ['stock' => $nuevoStock]);
        } else {
            return false;
        }
    }
}
