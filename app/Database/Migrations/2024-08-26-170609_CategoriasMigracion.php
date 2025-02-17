<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriasMigracion extends Migration
{
     public function up()
    {
		$this->db->disableForeignKeyChecks();
/* 		$forge = \Config\Database::forge();

		$fields = array(
			'fecha_actualizado'	=> [
				'type' 		=> 'DATETIME',
				'null' 		=> true
				]
			);
			$forge->addColumn('categorias', $fields); */
			//$forge->addField($fields);

		// Deshabilito las ForeignKeys


		// Migration rules would go here..

		$this->forge->addfield([
		'id'	 			=> [
			'type' 			=> 'INT',
			'constraint'	=> '12',
			'unsigned' 		=> true,
			'null' 			=> false,
			'auto_increment'=> true,
			],
		'nombre'			=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '100',
			'null'	 		=> false,
			'unique'        => true,
		],
		'descripcion'		=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '100',
			'null'	 		=> false,
			'unique'        => false,
			],
		'estado'			=> [
			'type'	 		=> 'TINYINT',
			'constraint'	=> '1',
			'null'	 		=> false,
			],
		'fecha_creado'	 	=> [
			'type' 			=> 'DATETIME',
			'null' 			=> false,
			],
		]);
		/*                  ('id', Indice unico=True) */
		$this->forge->addkey('id', true);
		//$this->forge->addForeignKey('group','groups','id_group','CASCADE','SET NULL');
		$this->forge->createtable('categorias');

		// Habilito las ForeignKeys
		//$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
		$this->forge->dropTable('categorias');
    }
}
