<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenusMigracion extends Migration
{
    public function up()
    {
        //
	 $this->forge->addfield([
		'id'        => [
            'type' 		=> 'INT',
            'constraint' => 12,
            'unsigned' => true,
            'auto_increment' => true,
            'null' => false,
            ],
		'nombre'=> [
            'type' => 'VARCHAR',
            'constraint' => '45',
            'null' => false ,
            ],
        'link'=> [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => false ,
            ],
        ]);
        $this->forge->addkey('id', true); // true es porque es indice unico
        $this->forge->createtable('menus');
    }

    public function down()
    {
        //
		 $this->forge->droptable('menus');
    }
}
