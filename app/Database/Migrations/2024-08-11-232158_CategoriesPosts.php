<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriesPosts extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();        
        $this->forge->addfield([
            'id_post' =>[
					'type'		=> 'INT',
					'constraint'=> 12,
					'unsigned'	=> true,
					'null'		=> false ,
            ],
            'id_category' => [
					'type'		=> 'INT',
					'constraint'=> 12, 
                    'unsigned'	=> true,
                    'null'		=> false,
            ],
        ]);
        //  Esta es una Tabla Auxiliar POR ESO SE BORRAN LOS ARCHIVOS
        // La Clave foranea es "id_posts" contra "posts" por el Campo "id"
        //  La Actualizacion es en CASCADA
        //  La Eliminacion   es en CASCADA

        $this->forge->addForeignKey('id_post','posts','id','CASCADE','CASCADE');        
        $this->forge->addForeignKey('id_category','categories','id','CASCADE','CASCADE');   
        $this->forge->createtable('categories_posts');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->droptable('categories_posts');
    }
    /*
     Una vez finalizado para subir los datos a la Base
     se debe ejecutar:
     php spark db:seed CategoriesPostsSeeder
    */
}