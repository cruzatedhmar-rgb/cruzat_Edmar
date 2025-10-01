<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model 
{
    protected $table = 'users';

    public function getByUsername($username) {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get()
                        ->row_array();
    }

    public function insertUser($data) {
        return $this->db->table($this->table)
                        ->insert($data);
    }
}
