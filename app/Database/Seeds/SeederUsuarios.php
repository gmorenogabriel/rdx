<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SeederUsuarios extends Seeder
{
	protected $dt;
	protected $clave;
	protected $password;
	protected $usuarios;

    public function run()
    {
		$dt = new \DateTime();
		// $this->attributes['password'] = password_hash($password,PASSWORD_DEFAULT);
		$clave = 'morega';
		$password = password_hash($clave,PASSWORD_DEFAULT);

		/* $array = [	'nombres' => 'Super',
					'apellidos'=> 'SUPER',
					'telefono'	=> '091100123',
					'email'	=> 'super@gmail.com',
					'username'	=> 'super',
					'password'	=> '5d47ea0e283d1df67f0d1b0d68da214ef1fe26d4',
					'rol_id'	=> 1,
					'estado'	=> 1,
					'so'	=> 'Windows 11',
					'navegador'	=> 'Mozilla',
					'fecha_creado'	=> '2024-08-27 21:04:14'];
		$this->db->table("usuarios")->insert($array);
		*/

		$array = ['nombres' => 'Super', 	'apellidos'=> 'SUPER', 					'telefono'	=> '091100123',		'email'	=> 'super@gmail.com', 	'username'	=> 'super',	'password'	=> '5d47ea0e283d1df67f0d1b0d68da214ef1fe26d4',		'rol_id'	=> 1,	'estado'	=> 1,	'so'	=> 'Windows 11',	'navegador'	=> 'Mozilla', 'created_at' => '2024-08-27 21:04:14', 	'updated_at' => $dt->format('Y-m-d H:i:s')];
		$this->db->table("usuarios")->insert($array);

		$array = ['nombres' => 'Admin', 	'apellidos'=> 'ADMIN', 					'telefono'	=> '092103456', 	'email'	=> 'admin@gmail.com', 	'username'	=> 'admin',	'password'	=> '5d47ea0e283d1df67f0d1b0d68da214ef1fe26d4',		'rol_id'	=> 2,	'estado'	=> 1,	'so'	=> 'Windows 10',	'navegador'	=> 'Mozilla', 'created_at' => '2024-08-27 21:04:14', 	'updated_at' => $dt->format('Y-m-d H:i:s')];
		$this->db->table("usuarios")->insert($array);

		$array = ['nombres' => 'Usuario', 	'apellidos'=> 'USUARIO', 				'telefono'	=> '093103567', 	'email'	=> 'usuario@gmail.com', 'username'	=> 'usuario', 'password'	=> '5d47ea0e283d1df67f0d1b0d68da214ef1fe26d4',	'rol_id'	=> 3,	'estado'	=> 1,	'so'	=> 'Windows 8',		'navegador'	=> 'Mozilla', 'created_at' => '2024-08-27 21:04:14', 	'updated_at' => $dt->format('Y-m-d H:i:s')];
		$this->db->table("usuarios")->insert($array);

		$array = ['nombres' => 'Gabriel Antonio', 	'apellidos'=> 'Moreno Taranto', 'telefono'	=> '099103769', 	'email'	=> 'gmoreno@gmail.com', 'username'	=> 'gmoreno', 'password'	=> '5d47ea0e283d1df67f0d1b0d68da214ef1fe26d4',	'rol_id'	=> 3,	'estado'	=> 1,	'so'	=> 'Windows 7',		'navegador'	=> 'Mozilla', 'created_at' => '2024-08-27 21:04:14', 	'updated_at' => $dt->format('Y-m-d H:i:s')];
		$this->db->table("usuarios")->insert($array);
		// Inserta el Administrador
		// $this->db->table("usuarios")->insert($array);

	}
}