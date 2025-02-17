<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SeederGroups extends Seeder
{
	protected $x;

    public function run(){
		$nombreGrupos = [
			 '0' => "Administrador", // "1",
			 '1' => "Jefe",		  // "2",
			 '2' => "Sub-Jefe",      // "3"
			 '3' => "Auditor",       // "4",
			 '4' => "Usuario",       // "5"
			];

        for($i=0; $i<5; $i++){
			$grupos1[] = $nombreGrupos[$i];
			//print_r($grupos1);
			$dt = new \DateTime();

			$grupos = [
				'name_group' => $nombreGrupos[$i],
				'created_at' => $dt->format('Y-m-d H:i:s'),
				'updated_at' => $dt->format('Y-m-d H:i:s'),
			];
		// Inserta una sola vez
		$this->db->table("groups")->insert($grupos);
		}
	}
}
