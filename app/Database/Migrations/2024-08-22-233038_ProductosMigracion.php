<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductosMigracion extends Migration
{
    public function up()
    {
	// Deshabilito las ForeignKeys
		$this->db->disableForeignKeyChecks();
        // Migration rules would go here..

		$this->forge->addfield([
		'id'	 			=> [
			'type' 			=> 'INT',
			'constraint'	=> '11',
			'null' 			=> false,
			'auto_increment'=> true,
			],
		'codigo'				=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '20',
			'null'	 		=> true,
			],
		'nombre'			=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '120',
			'null'	 		=> false,
			'unique'        => true,
			],
		'descripcion'		=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '255',
			'null'	 		=> false,
			'unique'        => true,
			],
		'precio'			=> [
			'type'	 		=> 'DOUBLE',
			'constraint'	=> '13,2',
			'null'	 		=> false,
			],
		'stock'				=> [
			'type'	 		=> 'INT',
			'constraint'	=> '9',
			'null'	 		=> false,
			],
		'imagen'			=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '255',
			'null'	 		=> true,
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
		$this->forge->addkey('id', true);
		$this->forge->createtable('productos');
    }

    public function down()
    {
        $this->forge->dropTable('productos');
    }
}