<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederPermisos extends Seeder
{
  public function run(){

		$dt = new \DateTime();

    // 1
    $array = ['menu_id' => 1,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 1,  	'rol_id'=> 3, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 2,  	'rol_id'=> 2, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 0,	'delete'	=> 0];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 7,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 7,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 3,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 6,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 4,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 6,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 4,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 5,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 2,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 8,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 4,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 9,  	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 10, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 11, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 13, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 14, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 15, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 16, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 17, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 1,  	'rol_id'=> 2, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 18, 	'rol_id'=> 2, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 18, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 19, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 20, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);

    $array = ['menu_id' => 22, 	'rol_id'=> 1, 'read'	=> 1, 	'insert'	=> 1, 	'update'	=> 1,	'delete'	=> 1];
    $this->db->table("permisos")->insert($array);


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
    // $this->db->table("productos")->insert($productos);
    // Inserta varios
    // $this->db->table("productos")->insertBatch($productos);
    }
}