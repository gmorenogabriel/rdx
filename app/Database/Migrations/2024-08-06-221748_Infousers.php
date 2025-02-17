<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
// solo permite la primer letra de la Clase en mayusculas, da error pero no lo informa
// no crea la tabla
class Infousers extends Migration
{
    public function up()
    {
		// Deshabilito las ForeignKeys
		$this->db->disableForeignKeyChecks();

		$this->forge->addfield([
		'id_user' 			=> [
			'type' 			=> 'INT',
			'constraint'	=> '12',
			'unsigned' 		=> true,
			'null' 			=> false,
			'auto_increment'=> true,
			],
		'name'	 			=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '100',
			'null'	 		=> false,
			],
		'surname'			=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '100',
			'null'	 		=> false,
			],
		'id_country' 		=> [
			'type' 			=> 'INT',
			'constraint'	=> '12',
			'unsigned' 		=> true,
			'null' 			=> false,
			],
		'created_at'	 	=> [
			'type' 			=> 'DATETIME',
			'null' 			=> false,
			],
		'updated_at'	 	=> [
			'type' 			=> 'DATETIME',
			'null' 			=> true,
			]
		]);
		/*                  ('id_user', Indice unico=True) */
		$this->forge->addkey('id_user', true);

		// Creamos las Claves Foraneas, relacionamos la informacion de un usuario con un Pais
		//$this->forge->addForeignKey('id_country', 'countries', 'id_country', 'CASCADE', 'SET NULL', 'fk_infocountryid');
		//$this->forge->addForeignKey('id_user',     'users',        'id', 'CASCADE',  'CASCADE', 'infouserid_fk');

		// Tabla principal con las Claves Foraneas a otras tablas.
		$this->forge->createtable('users_info');

		// Habilito las ForeignKeys
		$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
         $this->forge->dropTable('users_info');
    }
}
