<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederRoles extends Seeder
{
    public function run(){

		$dt = new \DateTime();
			// 1
		$array = [
			  'nombre' 		=> 'super',
			  'descripcion' => 'Super Usuario',
			  ];
			  $this->db->table("roles")->insert($array);
			// 2
		$array = [
			  'nombre' 		=> 'admin',
			  'descripcion' => 'Administrador',
			  ];
			  $this->db->table("roles")->insert($array);
			// 3
		$array = [
			  'nombre' 		=> 'usuario',
			  'descripcion' => 'Usuario Básico',
			  ];
			  $this->db->table("roles")->insert($array);

            //  INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
            //  (1, 'super', 'Super Usuario'),
            //  (2, 'admin', 'Administrador'),
            //  (3, 'usuario', 'Usuario Básico');
            //--
            //-- Indices de la tabla `roles`
            //--
            //ALTER TABLE `roles`
            //  ADD PRIMARY KEY (`id`),
            //  ADD UNIQUE KEY `nombre` (`nombre`);

			// Inserta una sola vez
			// $this->db->table("roles")->insert($roles);
			// Inserta varios
			// $this->db->table("roles")->insertBatch($roles);
			}
}