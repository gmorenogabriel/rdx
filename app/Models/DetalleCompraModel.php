<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleCompraModel extends Model
{
    protected $table = 'detalle_compras';
    protected $primaryKey = 'id';

    protected $allowedFields = ['compra_id', 'producto_id', 'cantidad', 'precio'];
}
