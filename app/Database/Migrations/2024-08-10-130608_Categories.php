<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
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
		'name'				=> [
			'type'	 		=> 'VARCHAR',
			'constraint'	=> '120',
			'null'	 		=> false,
			'unique'        => true,			
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
		$this->forge->createtable('categories');
		
		// Habilito las ForeignKeys		
		//$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
		$this->forge->dropTable('categories');
    }
}
