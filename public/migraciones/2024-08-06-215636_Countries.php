<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
// solo permite la primer letra de la Clase en mayusculas, da error pero no lo informa
// no crea la tabla
class Countries extends Migration
{
    public function up()
    {
		// Deshabilito las ForeignKeys		
		//$this->db->disableForeignKeyChecks();
        // Migration rules would go here..			
		
	$this->forge->addfield([
		'id_country' 		=> [
			'type' 			=> 'INT',
			'constraint'	=> 12,
			'unsigned' 		=> true,
			'null' 			=> false,
			'auto_increment'=> true,
			],
		'name'				=> [
			'type'			=> 'VARCHAR',
			'constraint'	=> '80',
			'null' 			=> false,
			],	
		'created_at' 		=> [
			'type' 			=> 'DATETIME',
			'null' 			=> false,
			],	
		'updated_at' 		=> [
			'type'			=> 'DATETIME',
			'null'			=> true,  
			]
        ]);
        $this->forge->addkey('id_country', true); /* Indice unico */
        $this->forge->createtable('countries');
		// Habilito las ForeignKeys
		//$this->db->enableForeignKeyChecks();		
    }

    public function down()
    {
         $this->forge->dropTable('countries');
    }
}
