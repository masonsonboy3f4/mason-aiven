<?php

class Create_users_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('userss')) {
            return;
        }

        $this->_lava->dbforge
            ->add_field([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE,
                    'null'           => FALSE,
                ],
                'username' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE,
                ],
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'is_active' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                    'default'    => 1,
                ],
                'created_at' => [
                    'type'    => 'TIMESTAMP',
                    'null'    => TRUE,
                    'default' => 'CURRENT_TIMESTAMP',
                ],
            ])
            ->add_key('id', primary: TRUE)
            ->add_key('username', unique: TRUE)
            ->create_table('userss');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('userss');
    }
}