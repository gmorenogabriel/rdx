<?php namespace App\Models;

use CodeIgniter\Model;

class CompraModel extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id';

    protected $allowedFields = ['usuario_id', 'rol_id', 'nombre',  'nombre', 'telefono', 'direccion', 'email', 'fecha', 'forma_pago','numerador_comprobante'];
}
