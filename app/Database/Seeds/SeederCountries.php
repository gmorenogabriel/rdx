<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SeederCountries extends Seeder
{
    public function run()
    {
		$dt = new \DateTime();
		// Inserta 1er país 'Uruguay'
		$array = [
			'name'       => 'Uruguay',
			'created_at' => $dt->format('Y-m-d H:i:s'),
			'updated_at' => $dt->format('Y-m-d H:i:s'),
		];
		// Inserta el Administrador
		$this->db->table("countries")->insert($array);

		// Los demas paises
		for($i=0; $i<6; $i++){

			$paises[] = $this->generaFakePaises();

			// $this->db->table("countries")->insert($paises);
		}
		// Inserta una sola vez
		$this->db->table("countries")->insertBatch($paises);
	}

	private function generaFakePaises(){

		$fakerObject = Factory::create();
		$created_at = $fakerObject->dateTime();
		$update_at = $fakerObject->dateTimeBetween($created_at);

		$nombrePaises = [
			"ARGENTINA",
			"BRASIL",
			"CHILE",
			"PARAGUAY",
			"URUGUAY"
		];

		return array(
		    // La clave principal es autoincrement, no va
			//'id_country' =>
			//'name'		 => $fakerObject->randomElement($nombrePaises),			
			'name'       => $fakerObject->country,
			//'name'       => $fakerObject->randomElement($nombrePaises),
			/* $faker->dateTime->format('Y-m-d'), */
			'created_at' => $created_at->format('Y-m-d H:i:s'), /* $faker->dateTime->format('Y-m-d'), */
			'updated_at' => $update_at->format('Y-m-d H:i:s'),
		);
	}
}
