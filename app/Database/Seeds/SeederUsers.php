<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SeederUsers extends Seeder
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
		$usuarioAdmin = [
			'username'       => 'Administrador',
			'password'       => null,
			'email'       	 => 'admin@gmail.com',
			'password'       => password_hash($clave,PASSWORD_DEFAULT),
			'group'          => '1',
			'created_at' => $dt->format('Y-m-d H:i:s'),
			'updated_at' => $dt->format('Y-m-d H:i:s'),
			];
			// Inserta el Administrador
		$this->db->table("users")->insert($usuarioAdmin);

        for($i=0; $i<10; $i++){

			$usuarios[] = $this->generaFakeUsuarios();

			//$this->db->table("users")->insert($usuarios);
		}
				// Inserta una sola vez
		$this->db->table("users")->insertBatch($usuarios);

    }
		private function generaFakeUsuarios(){
		$clave = 'morega';
		$fakerObject = Factory::create();
		$created_at = $fakerObject->dateTime();
		$update_at = $fakerObject->dateTimeBetween($created_at);

		$grupos = [
			"1", // Administrador
			"2", // Jefe
			"3", // Sub-Jefe
			"4", // Auditor
			"5", // Usuario
			];

		// Todos los Usuarios comunes pertenecen al grupo "5".
		return array(
		    // La clave principal es autoincrement, no va
			//'id_country' =>
			'username'       	=> $fakerObject->name,
			'password'      	=> password_hash($clave,PASSWORD_DEFAULT),
			'email'       		=> $fakerObject->email,
			//'password'       => $fakerObject->password,
			'group'          	=> '5',
			/* $faker->dateTime->format('Y-m-d'), */
			'created_at' => $created_at->format('Y-m-d H:i:s'), /* $faker->dateTime->format('Y-m-d'), */
			'updated_at' => $update_at->format('Y-m-d H:i:s'),
		);
	}
}
