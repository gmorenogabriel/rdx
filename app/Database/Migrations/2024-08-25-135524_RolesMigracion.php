<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesMigracion extends Migration
{
    public function up()
    {
 		// Deshabilito las ForeignKeys
         $this->db->disableForeignKeyChecks();

         $this->forge->addfield([
             'id'   	 			=> [
                 'type' 			=> 'INT',
                 'constraint'   	=> '11',
//                 'unsigned' 		=> true,
                 'null' 			=> false,
                 'auto_increment'   => true,
                 ],
             'nombre'		        => [
                 'type'	 		    => 'VARCHAR',
                 'constraint'	    => '45',
                 'null'	 		    => false,
                 'unique'           => true,
                 ],
             'descripcion'			=> [
                 'type'	 		    => 'VARCHAR',
                 'constraint'	    => '100',
                 'null'	 		    => false,
                 'unique'           => true,
                 ]
                ]);
                /*   ('id', Prymary Key ) */
                $this->forge->addkey('id', true);

              //  $this->forge->addForeignKey('rol_id','roles','id','CASCADE','set null');
                //$this->forge->addForeignKey('group','groups','id_group','CASCADE','SET NULL');
                $this->forge->createtable('roles');

                // Habilito las ForeignKeys
                $this->db->enableForeignKeyChecks();
            }

            public function down()
            {
                $this->forge->dropTable('roles');
            }
        }