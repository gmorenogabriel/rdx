<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Category;

class CategoriasModel extends Model{

    protected $table      = 'categorias';
    protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    protected $returnType     = Category::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nombre','descripcion','estado'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_creado';

// protected $beforeInsert = [];
//    protected $afterInsert  = ['storeUserInfo'];

public function obtenerCategoriaPorId($idCategoria)
    {
        return $this->where('id', $idCategoria)->first();
    }
public function validoClave($column, $value){

    $res = $this->where($column, $value)
                ->where('estado', 1)
                ->get()->getFirstRow();
    // dd($this->db->getLastQuery());
    if($res == null){
        return 0; // No existe la Clave, se puede realizar el Insert
    }else{
        return 1; // Existe la clave en la tabla
    }
    return $res;
}

protected $assignGroup;
	public function assignCategories(array $categorias){

	}

}