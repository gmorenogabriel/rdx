<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Ventas;

class VentasModel extends Model
{

	protected $table      = 'ventas';
    protected $primaryKey = 'id';
    
	protected $returnType     = User::class;
    protected $useSoftDeletes = false; //no los elimina fisicamente

    protected $useAutoIncrement = true;


    //protected $allowedFields = ['username', 'surname','email', 'password', 'group'];
	protected $allowedFields = ['username','email','password','group'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';
}