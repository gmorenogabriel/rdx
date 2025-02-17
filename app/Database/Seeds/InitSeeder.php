<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Generator;

class InitSeeder extends Seeder{
    public function run(){
		/* Si necesito que no se vuelvan a cargar los datos,
		 * borrar los existentes, debo ejecutar:
		 *
		 *	 php spark migrate:refresh
		 *
		 *
		 * Carga completa de todos los Seeders que voy creando.
		 *
		 *   php spark db:seed InitSeeder
		 */

		//$this->call('SeederGroups');
		//$this->call('SeederCountries');
		//$this->call('SeederUsers');
		/* ---------------------------------- */
		$this->call('SeederMenus');
		$this->call('SeederClientes');
		$this->call('SeederPaises');
		$this->call('SeederRoles');
		$this->call('SeederPermisos');
		$this->call('SeederUsuarios');
		$this->call('SeederProductos');

	}
}
