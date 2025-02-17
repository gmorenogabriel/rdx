<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;

class ClientesMigracion extends Migration
{

    private array $fields;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        /** @var \Config\Auth $authConfig */
        $authConfig   = config('Auth');
        $this->tables = $authConfig->tables;
    }

    public function up()
    {
        {
            $forge = \Config\Database::forge();

            $fields = array(
                'email'				=> [
                    'type'	 		=> 'VARCHAR',
                    'constraint'	=> '120',
                    'null'	 		=> false,
                    'unique'        => true,
                ]);
                $forge->addColumn('clientes', $fields);
                //$forge->addField($fields);

        // Deshabilito las ForeignKeys

        $this->db->disableForeignKeyChecks();
        // Migration rules would go here..

        $this->forge->addfield([
            'id'	 			=> [
                'type' 			=> 'INT',
                'constraint'	=> '12',
                'unsigned' 		=> true,
                'null' 			=> false,
                'auto_increment'=> true,
                ],
            'nombres'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '45',
                'null'	 		=> false,
                'unique'        => false,
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
            'direccion'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '100',
                'null'	 		=> false,
                'unique'        => false,
                ],
            'ruc'	    		=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '20',
                'null'	 		=> false,
                'unique'        => false
                ],
            'empresa'			=> [
                'type'	 		=> 'VARCHAR',
                'constraint'	=> '255',
                'null'	 		=> false,
                ],
             'estado'	 		=> [
                'type' 			=> 'TINYINT',
                'constraint'	=> '1',
                'unsigned' 		=> true,
                'null' 			=> false,
             ],
            'fecha_creado'	 	=> [
                'type' 			=> 'DATETIME',
                'null' 			=> false,
                ]
            ]);
            /*   ('id', Prymary Key ) */
            $this->forge->addkey('id', true);
/*             $this->forge->addkey('username', true);
            $this->forge->addkey('email', true);
            $this->forge->addForeignKey('rol_id','roles','id','CASCADE','set null');
            //$this->forge->addForeignKey('group','groups','id_group','CASCADE','SET NULL');
*/

            $this->forge->createtable('clientes');

            // Habilito las ForeignKeys
            $this->db->enableForeignKeyChecks();
        }

        public function down()
        {
            $this->forge->dropTable('clientes');
        }
}
