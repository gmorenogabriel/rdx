<?php namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Hashids\Hashids;

class Category extends Entity{

    protected $dates = ['fecha_creado'];
    

    public function getEditLink(){
        //return base_url(route_to('users_edit', $this->id));
		return base_url(route_to('categorias_edit', $this->id));
	}
    public function getDeleteLink(){
        $hash = new Hashids();
        // return base_url(route_to('user_delete', $hash->encode($this->id)));
		return base_url(route_to('categorias/delete', $hash->encode($this->id)));
    }
}
