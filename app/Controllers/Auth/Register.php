<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\User;
use App\Entities\UserInfo;
use App\Models\CountriesModel;
use App\Config\Blog;

//use CodeIgniter\I18n\Time;

class Register extends BaseController{

	protected $configs;

	public function __construct(){
		$this->configs = config('Blog');
	}

	public function index(){
		$model = model('CountriesModel');
		$data['countries'] = $model->findAll();
		$data['defaultUser'] = $this->configs->defaultGroupUsers;
		//d($data);
		return view('Auth/register', $data );

	}

    public function store(){

		$validation = service('validation');
        $validation->setRules([
            'name'    => 'required|alpha_space',
            'surname' => 'required|alpha_space|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'id_country' => 'required|is_not_unique[countries.id_country]',
            'password' => 'required|matches[c-password]'
        ]);

       if( !$validation->withRequest($this->request)->run() ){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

		$user = new User($this->request->getPost());
		$user->generateUsername();
		d($user);

		$model = model('UsersModel');
		$model->withGroup($this->configs->defaultGroupUsers);

		$userInfo = new UserInfo($this->request->getPost());
		$model->addInfoUser($userInfo);

		$model->save($user);

        return redirect()->
		       route('login')->
		       with('msg', [
			        'type' => 'success',
					'body' => 'Usuario registrado con éxito!'
				]);
    }

}
