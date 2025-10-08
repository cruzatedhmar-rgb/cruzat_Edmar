<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    
    protected $table = 'user';
    protected $primary_key = 'id';
    
    public function __construct() {
        parent::__construct();
    }

    // Ensure 'role' column exists; add if missing and set default admin
    public function ensure_role_column() {
        try {
            $check = $this->db->raw("SHOW COLUMNS FROM `{$this->table}` LIKE 'role'");
            $exists = $check->fetch();
            if (!$exists) {
                // Add role column
                $this->db->raw("ALTER TABLE `{$this->table}` ADD COLUMN `role` ENUM('admin','user') NOT NULL DEFAULT 'user' AFTER `password`");
                // Ensure default admin stays admin if present
                $this->db->raw("UPDATE `{$this->table}` SET `role`='admin' WHERE `username`='admin'");
            }
        } catch (Exception $e) {
            // Silently ignore to avoid breaking requests if permissions are limited
        }
    }

    public function create($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if (!isset($data['role']) || empty($data['role'])) {
            $data['role'] = 'user';
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->table($this->table)->insert($data);
    }

    public function get_by_username($username) {
        return $this->db->table($this->table)
                    ->where('username', $username)
                    ->get();
    }

    public function get_by_email($email) {
        return $this->db->table($this->table)
                    ->where('email', $email)
                    ->get();
    }

    public function verify_password($password, $hash) {
        return password_verify($password, $hash);
    }

    public function get_by_id($id) {
        return $this->db->table($this->table)
                    ->where($this->primary_key, $id)
                    ->get();
    }

    public function update($id, $data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->table($this->table)
                    ->where($this->primary_key, $id)
                    ->update($data);
    }

    public function delete($id) {
        return $this->db->table($this->table)
                    ->where($this->primary_key, $id)
                    ->delete();
    }

    public function get_all() {
        return $this->db->table($this->table)->get_all();
    }

    public function check_username_exists($username, $exclude_id = null) {
        $query = $this->db->table($this->table)->where('username', $username);
        if ($exclude_id) {
            $query->where($this->primary_key . ' !=', $exclude_id);
        }
        return $query->get() ? true : false;
    }

    public function check_email_exists($email, $exclude_id = null) {
        $query = $this->db->table($this->table)->where('email', $email);
        if ($exclude_id) {
            $query->where($this->primary_key . ' !=', $exclude_id);
        }
        return $query->get() ? true : false;
    }
}
?>
