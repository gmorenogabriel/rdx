<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Clientes;
//use App\Entities\UserInfo;

class ClientesModel extends Model
{

	protected $table      = 'clientes';
    protected $primaryKey = 'id';

	protected $returnType     = Clientes::class;
    protected $useSoftDeletes = false; //no los elimina fisicamente

    protected $useAutoIncrement = true;

	protected $allowedFields = ['nombres','apellidos','telefono','direccion','ruc','empresa','estado','fecha_creado','email'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_creado';
    //protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;

    // Manejo del Usuario donde ubicamos el Grupo
    // before insert ejecuta un metodo addGroup definido por mi
//    protected $beforeInsert = ['addGroup'];
//    protected $afterInsert  = ['storeUserInfo'];

    protected $assignGroup;
    protected $infoUser;
/*
    protected function storeUserInfo($data){
     // foreach ($data as $key => $value){
     //  echo "$key = $value  </br>";
     // }

         $this->infoUser->id_user = $data['id'];
        $model = model('App\Models\UserInfoModel');

        $model->insert($this->infoUser);
		echo "<pre>";
		echo "Informacion de InfoUserModel";
        d($model);
    }

    protected function addGroup($data){
	    $data ['data']['group'] = $this->assignGroup;
        return $data;
    }

    public function withGroup(string $group){
        $row = $this->db->table('groups')
                    ->where('name_group',$group)
                    ->get()->getFirstRow();
        if($row != null){
            $this->assignGroup = $row->id_group;
        }

    }
    public function addInfoUser(UserInfo $ui){
        $this->infoUser = $ui;
    }
 */
   public function obtenerClientePorId($idCliente)
    {
        return $this->where('id', $idCliente)->first();
    }
    // Validacion del Login
    public function getUserBy(string $column, string $value){
        $res = $this->where($column, $value)->get()->getFirstRow();
        if($res == null){
            echo "no hay datos";
        }{
            //echo "Hay datos";
        }
		//d($this->where($column, $value)->get()->getFirstRow());
		//dd($res->password);
        return $this->where($column, $value)->get()->getFirstRow();
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

}
