<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Posts extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addfield([
            'id'        => [
				'type'			=> 'INT',
				'constraint'	=> 12,
				'unsigned'		=> true,
				'null'			=> false,
				'auto_increment'=> true
			],
            'title'      => ['type' => 'VARCHAR', 'constraint' => '120',    'null' => false      ],
            'slug'       => ['type' => 'VARCHAR', 'constraint' => '140',    'null' => false, 'unique' => true ],     
            'body'       => ['type' => 'TEXT',                              'null' => false      ],
            'cover'      => ['type' => 'VARCHAR', 'constraint' => '60',     'null' => false      ],            
            'author'     => ['type' => 'INT',     'constraint' => 12,       'null' => true, 'unsigned' => true],
            'published_at'=> ['type'=> 'DATETIME',                          'null' => false      ],            
            'created_at' => ['type' => 'DATETIME',                          'null' => false      ],
            'updated_at' => ['type' => 'DATETIME',                          'null' => true       ],
            'deleted_at' => ['type' => 'DATETIME',                          'null' => true       ],      
        ]);
    $this->forge->addkey('id', true);
    //  La Clave foranea es "author" contra "users" por el Campo "id_user"
    //  La Actualizacion es en CASCADA
    //  La Eliminacion   lo deja en NULL                   'Actualiza','Elimina'
    $this->forge->addForeignKey('author','users','id',  'CASCADE','set null');
    $this->forge->createtable('posts');
    $this->db->enableForeignKeyChecks();
}

    public function down()
    {
        $this->forge->droptable('posts');
    }
    /*
     Una vez finalizado para subir los datos a la Base
     se debe ejecutar:
     php spark db:seed PostsSeeder
    */
}

