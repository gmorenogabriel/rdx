<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaisesMigracion extends Migration
{
    public function up()
    {
        //
	 $this->forge->addfield([
		'id' => [
					'type' 		=> 'INT',
					'constraint' => 12,
					'unsigned' => true, 
					'auto_increment' => true,
					'null' => false,
					],
		'codpais'=> [
					'type' => 'INT',
					'constraint' => '3',
					'null' => false ,
					],
		'descripcion'=> [
					'type' => 'VARCHAR',
					'constraint' => '50',
					'null' => false ,
					],
		'caracteristicatel'=> [
					'type' => 'VARCHAR',
					'constraint' => '7',
					'null' => false ,
					],
		'fecha_creado' => [
					'type' => 'DATETIME',
					'null' => false,
					],
		'estado'			=> [
			'type'	 		=> 'TINYINT',
			'constraint'	=> '1',
			'null'	 		=> false,
			]
        ]);
        $this->forge->addkey('id', true); // true es porque es indice unico
        $this->forge->createtable('paises');
    }

    public function down()
    {
        //
		 $this->forge->droptable('paises');
    }
}
