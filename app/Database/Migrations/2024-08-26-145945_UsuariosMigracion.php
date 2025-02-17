<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuariosMigracion extends Migration
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
            'nombres'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '45',
                'null'	 		=> false,
                'unique'        => true,
                ],
            'apellidos'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '45',
                'null'	 		=> false,
                'unique'        => false,
                ],
            'telefono'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '20',
                'null'	 		=> false,
                'unique'        => false,
                ],
            'email'				=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '120',
                'null'	 		=> false,
                'unique'        => true,
                ],
            'username'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '40',
                'null'	 		=> false,
                'unique'        => true,
                ],
            'password'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '255',
                'null'	 		=> false,
                ],
            'rol_id' 			=> [
                'type' 			=> 'INT',
                'constraint'	=> '12',
                'unsigned' 		=> true,
                'null' 			=> false,
                ],
            'estado'	 		=> [
                'type' 			=> 'TINYINT',
                'constraint'	=> '1',
                'null' 			=> false,
                ],
            'so' 	    		=> [
                'type' 			=> 'VARCHAR',
                'constraint'	=> '30',
                'null' 			=> false,
                ],
            'navegador'		 	=> [
                'type' 			=> 'VARCHAR',
                'constraint'	=> '30',
                'null' 			=> false,
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
            /*   ('id', Prymary Key ) */
            $this->forge->addkey('id', true);
            //$this->forge->addkey('username');
            //$this->forge->addkey('email', );

            $this->forge->addForeignKey('rol_id','roles','id','CASCADE','set null');
            //$this->forge->addForeignKey('group','groups','id_group','CASCADE','SET NULL');
            $this->forge->createtable('usuarios');

            // Habilito las ForeignKeys
            $this->db->enableForeignKeyChecks();
        }

        public function down()
        {
            $this->forge->dropTable('usuarios');
        }
}
