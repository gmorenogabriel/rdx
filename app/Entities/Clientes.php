<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Hashids\Hashids;

class Clientes extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts   = [];

/*---------------------------------------------- */
public function getClientes(){
    $this->db->where("estado", "1");
    $resultados = $this->db->get("clientes");
    return $resultados->result();
}
public function save($data){
    return $this->db->insert("clientes",$data);
}
public function getCliente($id){
    $this->db->where("id", $id);
    $resultado = $this->db->get("clientes");
    return $resultado->row();
}
public function update($id, $data){
    $this->db->where("id",$id);
    return $this->db->update("clientes",$data);
}

/*---------------------------------------------- */
/*  ------ Tomado de Usuarios Model              */
/*---------------------------------------------- */
	protected function setPassword(string $password){
		$this->attributes['password'] = password_hash($password,PASSWORD_DEFAULT);
	}
	public function generateUsername(){
		return $this->attributes['username'] = explode(" ", $this->name)[0] . explode(" ", $this->surname)[0];
	}
		// consultamos para ver a que registro pertenece
		// debe retornar una Entidad de Grupo, en este caso a un objeto
		// del usuario
	public function getRole(string $group){
		$model = model('App\Models\GroupsModel');
		//dd($group);
		return $model->where('id_group', $group)->first();
	}

    public function getEditLink(){
        //return base_url(route_to('users_edit', $this->id));
		return base_url(route_to('users_edit', $this->id));
	}
    public function getDeleteLink(){
        $hash = new Hashids();
        // return base_url(route_to('user_delete', $hash->encode($this->id)));
		return base_url(route_to('users_delete', $hash->encode($this->id)));
    }

}


