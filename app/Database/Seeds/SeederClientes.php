<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class SeederClientes extends Seeder
{

    public function run(){
		$dt = new \DateTime();
			// 1
/* 		$array = [
			  'nombres' 		=> 'super',
			  'apellidos' 		=> 'Super Usuario',
              'telefono'        => '123456789',
              'email'           => 'super@gmail.com',
              'direccion'       => '18 de Julio s/n',
              'ruc'             => '211012220011',
              'empresa'         => 'Personal',
              'estado'          => '1',
              'fecha_creado'    => $dt->format('Y-m-d H:i:s'),
];
                // Inserta Clientes de prueba
                $this->db->table("clientes")->insert($array);
                 */
                // Los demas paises
                for($i=0; $i<31; $i++){

                    $cli[] = $this->generaFakeClientes();
                   // $ruc[]    = $this->generaFakeRuc();

                }
                // Inserta una sola vez
                $this->db->table("clientes")->insertBatch($cli);
            }

        private function generaFakeClientes(){

            $fakerObject = Factory::create();
            $created_at = $fakerObject->dateTime();
            $update_at = $fakerObject->dateTimeBetween($created_at);
/*
            $nombrePaises = [
                "ARGENTINA",
                "BRASIL",
                "CHILE",
                "PARAGUAY",
                "URUGUAY"
            ];
*/
            return array(
                // La clave principal es autoincrement, no va
                //'id_country' =>
                'nombres'           => $fakerObject->name(),
                'apellidos'         => $fakerObject->lastname(),
                'telefono'          => '099000111',
                'direccion'         => $fakerObject->address(),
                'email'             => $fakerObject->email(),
                'ruc'               => $fakerObject->unique()->randomDigitNotNull(),
                'empresa'           => $fakerObject->text(35),
                'estado'            => '1',
                /* $faker->dateTime->format('Y-m-d'), */
                'fecha_creado' => $created_at->format('Y-m-d H:i:s'), /* $faker->dateTime->format('Y-m-d'), */
            );
        }
    }

    // Inserta una sola vez
    // $this->db->table("productos")->insert($productos);
    // Inserta varios
    // $this->db->table("productos")->insertBatch($productos);

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