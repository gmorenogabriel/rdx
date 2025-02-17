<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
		// Deshabilito las ForeignKeys
		//$this->db->disableForeignKeyChecks();
        // Migration rules would go here..

		$this->forge->addfield([
		'id'	 			=> [
			'type' 			=> 'INT',
			'constraint'	=> '12',
			'unsigned' 		=> true,
			'null' 			=> false,
			'auto_increment'=> true,
			],
		'username'			=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '120',
			'null'	 		=> false,
			'unique'        => true,
			],
		'email'				=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '120',
			'null'	 		=> false,
			'unique'        => true,
			],
		'password'			=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '255',
			'null'	 		=> false,
			],
		'group'		 		=> [
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
			],
		'deleted_at'	 	=> [
			'type' 			=> 'DATETIME',
			'null' 			=> true,
			]
		]);
		/*                  ('id', Indice unico=True) */
		$this->forge->addkey('id', true);
		//$this->forge->addForeignKey('group','groups','id_group','CASCADE','SET NULL');
		$this->forge->createtable('users');

		// Habilito las ForeignKeys
		//$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
		$this->forge->dropTable('users');
    }
}
