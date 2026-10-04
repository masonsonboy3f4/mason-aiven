<?php

class Add_role_to_users_table
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('userss') || $this->_lava->dbforge->column_exists('userss', 'role')) {
            return;
        }

        $this->_lava->dbforge->add_column('userss', [
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => FALSE,
                'default' => 'admin',
                'after' => 'is_active',
            ],
        ]);
    }

    public function down()
    {
        if ($this->_lava->dbforge->table_exists('userss') && $this->_lava->dbforge->column_exists('userss', 'role')) {
            $this->_lava->dbforge->drop_column('userss', 'role');
        }
    }
}