<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'precio', 'stock'];

    // Obtener productos por IDs
    public function obtenerProductoPorId($ids)
    {
        return $this->whereIn('id', $ids)->findAll();
    }

    // Actualizar el stock después de agregar al carrito o compra
    public function actualizarStock($id, $cantidad)
    {
        // Primero, obtener el stock actual
        $producto = $this->find($id);
        $nuevoStock = $producto['stock'] - $cantidad;

        // Asegurarse de que no se excede el stock disponible
        if ($nuevoStock >= 0) {
            // Actualizar el stock
            return $this->update($id, ['stock' => $nuevoStock]);
        } else {
            // Si no hay stock suficiente
            return false;
        }
    }
}
