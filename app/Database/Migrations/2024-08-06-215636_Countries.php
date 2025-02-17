<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Countries extends Migration
{
    public function up()
    {
        //
	 $this->forge->addfield([
		'id_country' => [
					'type' 		=> 'INT',
					'constraint' => 12,
					'unsigned' => true,
					'auto_increment' => true,
					'null' => false,
					],
		'name'=> [
					'type' => 'VARCHAR',
					'constraint' => '80',
					'null' => false ,
					],
		'created_at' => [
					'type' => 'DATETIME',
					'null' => false,
					],
		'updated_at' => [
					'type' => 'DATETIME',
					'null' => true,
					]
        ]);
        $this->forge->addkey('id_country', true); // true es porque es indice unico
        $this->forge->createtable('countries');
    }

    public function down()
    {
        //
		 $this->forge->droptable('countries');
    }
}
