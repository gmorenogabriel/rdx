<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PermisosMigracion extends Migration
{
    public function up()
    {
		// Deshabilito las ForeignKeys
		$this->db->disableForeignKeyChecks();

		// Migration rules would go here..

		$this->forge->addfield([
		'id'	 			=> [
			'type' 			=> 'INT',
			'constraint'	=> '5',
			'unsigned' 		=> true,
			'null' 			=> false,
			'auto_increment'=> true,
			],
		'menu_id'			=> [
			'type'	 		=> 'INT',
			'constraint'	=> '5',
			'null'	 		=> false,
			'unique'        => false,
			],
        'rol_id'			=> [
            'type'	 		=> 'INT',
            'constraint'	=> '5',
            'null'	 		=> false,
            'unique'        => false,
			],
		'read'				=> [
			'type'	 		=> 'TINYINT',
			'constraint'	=> '1',
			'null'	 		=> false,
			'unique'        => false,
			],
		'insert'			=> [
			'type'	 		=> 'TINYINT',
			'constraint'	=> '1',
			'null'	 		=> false,
			'unique'        => false,
			],
		'update'			=> [
			'type'	 		=> 'TINYINT',
			'constraint'	=> '1',
			'null'	 		=> false,
			'unique'        => false,
			],
		'delete'			=> [
			'type'	 		=> 'TINYINT',
			'constraint'	=> '1',
			'null'	 		=> false,
			'unique'        => false,
			],
		]);
		/*                  ('id', Indice unico=True) */
		$this->forge->addkey('id', true);
		//$this->forge->addForeignKey('group','groups','id_group','CASCADE','SET NULL');
		$this->forge->createtable('permisos');

		// Habilito las ForeignKeys
		//$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
		$this->forge->dropTable('permisos');
    }
}