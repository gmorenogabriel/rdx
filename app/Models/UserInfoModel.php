<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\UserInfo;

class UserInfoModel extends Model{

    protected $table      = 'users_info';
    protected $primaryKey = 'id_user';

    // protected $useAutoIncrement = true;

    protected $returnType     = 'object'; //UserInfo::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'surname','id_country'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

}