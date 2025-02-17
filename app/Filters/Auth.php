<?php

namespace App\Filters;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Entity\User;


class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
		// los usuarios que tienen permitido el acceso a la ruta
        // dd($arguments); 
        // Aqui vemos los Filtros y nos devuelve los grupos/Roles
        // que tienen permisos y vienen desde Routes.php 
        // dd($arguments);
        if(!session()->is_logged){
            log_message("debug", "Filter Auth function before, no esta loqueado redirec route login");
            
            return redirect()->
			       route('login')->
						with('msg',  [
							'type' => 'warning',
							'body' => 'Para acceder primero debe loguearse !!!'
            ]);
        }
        //model = model('App\Models\UsersModel');
		$model = model('UsersModel');
        if(!$user = $model->getUserBy('id', session()->id_user)){
            session()->destroy();
            return redirect()->route('login')->with('msg',[
                'type' => 'danger',
                'body' => 'Actualmente el usuario no está disponible !!!'
            ]);           
        }
		
		//d($user); // obtenemos el usuario
		//d($user->group); // obtenemos el grupo
        $modelUser = model('App\Entities\User');//->getRole();
		//d($model->getRole($user->group));
        if(!in_array($modelUser->getRole($user->group)->name_group, $arguments)){
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}