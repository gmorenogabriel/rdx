<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederProductos extends Seeder
{
    public function run(){

		$dt = new \DateTime();
			// 1
		$array = [
			  'nombre' 		=> 'Tobilleras',
			  'codigo' 		=> '24021742032351',
			  'descripcion'	=> '24021742032351_SGR-T1R-M_MOLD-KING',
			  'precio'		=> 790.00,
			  'stock'		=> 10,
			  'imagen' 		=> '1724596487_d05dadfe937208448e4f.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s')
			  ];
			  $this->db->table("productos")->insert($array);
			// 2
		$array = [
			  'nombre' 		=> 'Vendas Wrap',
			  'codigo' 		=> '24034569094602',
			  'descripcion'	=> '24034569094602_HWC-RBU_RED-BLACK-BLUE_HAND-WRAP_COMBO',
			  'precio'		=> 500.00,
			  'stock'		=> 12,
			  'imagen' 		=> '1724596552_1c574dd881f0375da595.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s')
			  ];
			  $this->db->table("productos")->insert($array);
			// 3
		$array = [
			  'nombre' 		=> 'Guantes de 14 Oz',
			  'codigo' 		=> '23112484498195',
			  'descripcion'	=> '23112484498195_BGR_F7R_14OZ_RED_BOXING',
			  'precio'		=> 790.00,
			  'stock'		=> 12,
			  'imagen' 		=> '1724596639_c47141c4eb7b216fb50f.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s')
			  ];
			  $this->db->table("productos")->insert($array);
			// 4
		$array = [
			  'nombre' 		=> 'Guantes de 16 Oz Azul',
			  'codigo' 		=> '23104017659697',
			  'descripcion'	=> '23104017659697_BGR-F7U-16OZ_BLUE_BOXING',
			  'precio'		=> 790.00,
			  'stock'		=> 9,
			  'imagen' 		=> '1724596798_6c9736c4e40e614757c3.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s')
			  ];
			  $this->db->table("productos")->insert($array);
			// 5
		$array = [
			  'nombre' 		=> 'Guantes de 16 Oz Dorado',
			  'codigo' 		=> '2310273434303',
			  'descripcion'	=> '2310273434303_BGR-F7GL_16OZ_GOLDEN_BOXING',
			  'precio'		=> 790.00,
			  'stock'		=> 10,
			  'imagen' 		=> '1724596877_d023620028bc554bdf32.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s')
			  ];
			  $this->db->table("productos")->insert($array);
			// 6
		$array = [
			  'nombre' 		=> 'Guantes Junior ROJO',
			  'codigo' 		=> '602711',
			  'descripcion'	=> '602711_189763_BMR-1R',
			  'precio'		=> 600.00,
			  'stock'		=> 10,
			  'imagen' 		=> '1724596963_a123764543b9097133ef.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s')
			  ];
			  $this->db->table("productos")->insert($array);
			// 7
		$array = [
			  'nombre' 		=> 'Guantes 14Oz Azul',
			  'codigo' 		=> '2401554623714',
			  'descripcion'	=> '2401554623714_BGR-F6MU-14OZ_BLUE',
			  'precio'		=> 700.00,
			  'stock'		=> 10,
			  'imagen' 		=> '1724600259_2185c281302283679a51.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s')
			  ];
			  $this->db->table("productos")->insert($array);
			// 8
		$array = [
			  'nombre' 		=> 'Guantes 16Oz Amarillo',
			  'codigo' 		=> '23102734343032',
			  'descripcion'	=> '23102734343032_BGR-F7GL-16OZ_GOLDEN',
			  'precio'		=> 700.00,
			  'stock'		=> 10,
			  'imagen' 		=> '1724600380_e5785e5d493f31d43815.jpg',
			  'created_at'	=> $dt->format('Y-m-d H:i:s'),
			  'updated_at'	=> $dt->format('Y-m-d H:i:s'),
			];
			  $this->db->table("productos")->insert($array);
//(1, 'Tobilleras', 				'24021742032351',	'24021742032351_SGR-T1R-M_MOLD-KING', 						790.00, 10,'1724596487_d05dadfe937208448e4f.jpg', '2024-08-25 11:34:49', '2024-08-25 11:34:49', NULL),
//(2, 'Vendas Wrap', 				'24034569094602',	'24034569094602_HWC-RBU_RED-BLACK-BLUE_HAND-WRAP_COMBO',	1500.00,11,'1724596552_1c574dd881f0375da595.jpg', '2024-08-25 11:35:54', '2024-08-25 11:35:54', NULL),
//(3, 'Guantes 14Oz', 			    '23112484498195',	'23112484498195_BGR_F7R_14OZ_RED_BOXING', 					790.00, 9,'1724596639_c47141c4eb7b216fb50f.jpg', '2024-08-25 11:37:20', '2024-08-25 12:40:26', NULL),
//(4, 'Guantes 16Oz Azul', 		    '23104017659697',	'23104017659697_BGR-F7U-16OZ_BLUE_BOXING', 					790.00, 6,'1724596798_6c9736c4e40e614757c3.jpg', '2024-08-25 11:40:00', '2024-08-25 11:40:00', NULL),
//(5, 'Guantes 16OZ GOLDEN', 		'2310273434303',	'2310273434303_BGR-F7GL_16OZ_GOLDEN_BOXING', 				790.00, 12,'1724596877_d023620028bc554bdf32.jpg', '2024-08-25 11:41:18', '2024-08-25 11:41:18', NULL),
//(6, 'Guantes Junior ROJO', 		'602711',			'602711_189763_BMR-1R', 									750.00, 10,'1724596963_a123764543b9097133ef.jpg', '2024-08-25 11:42:45', '2024-08-25 12:38:17', NULL),
//(7, 'Guantes 14Oz Azul', 		    '2401554623714',	'2401554623714_BGR-F6MU-14OZ_BLUE', 						790.00, 20,'1724600259_2185c281302283679a51.jpg', '2024-08-25 12:37:40', '2024-08-25 12:37:40', NULL),
//(8, 'Guantes 16Oz Amarillo',	    '23102734343032',	'23102734343032_BGR-F7GL-16OZ_GOLDEN', 						790.00, 17,'1724600380_e5785e5d493f31d43815.jpg', '2024-08-25 12:39:41', '2024-08-25 12:40:08', NULL);
//
			// Inserta una sola vez
			// $this->db->table("productos")->insert($productos);
			// Inserta varios
			// $this->db->table("productos")->insertBatch($productos);
			}
}
