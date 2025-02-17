<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;
use App\Entities\UserInfo;

class UsersModel extends Model{

    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = User::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'email', 'password', 'group'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'deleted_at';
    protected $deletedField  = '';

    // Manejo del Usuario donde ubicamos el Grupo
    // before insert ejecuta un metodo addGroup definido por mi
    protected $beforeInsert = ['addGroup'];
    protected $afterInsert  = ['storeUserInfo'];
    
    protected $assignGroup = 1;
    protected $infoUser;

    protected function storeUserInfo($data){
     // foreach ($data as $key => $value){
     //  echo "$key = $value  </br>";
     // }

        $this->infoUser->id_user = $data['id'];
        //$model = model('App\Models\UserInfoModel');
		$model = model('UserInfoModel');
        $model->insert($this->infoUser);
       // dd($model);
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
    // Validacion del Login
    public function getUserBy(string $column, string $value){
        $res = $this->where($column, $value)->get()->getFirstRow();
        if($res == null){
            echo "no hay datos";
        }{
            //echo "Hay datos";
        }
        return $this->where($column, $value)->get()->getFirstRow();

    }
}
