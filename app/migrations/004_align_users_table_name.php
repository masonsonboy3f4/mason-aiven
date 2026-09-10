<?php

class Align_users_table_name
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('userss') && $this->_lava->dbforge->table_exists('users')) {
            $this->_lava->dbforge->rename_table('users', 'userss');
        }
    }

    public function down()
    {
        if (!$this->_lava->dbforge->table_exists('userss') || $this->_lava->dbforge->table_exists('users')) {
            return;
        }

        $this->_lava->dbforge->rename_table('userss', 'users');
    }
}