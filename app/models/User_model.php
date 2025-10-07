<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    
    protected $table = 'user';
    protected $primary_key = 'id';
    
    public function __construct() {
        parent::__construct();
    }

    public function create($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
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

    /**
     * Save reset token (token, expires_at) for a user
     */
    public function save_reset_token($user_id, $token, $expires_at)
    {
        return $this->db->table($this->table)
                    ->where($this->primary_key, $user_id)
                    ->update(['reset_token' => $token, 'reset_expires_at' => $expires_at, 'updated_at' => date('Y-m-d H:i:s')]);
    }

    public function get_by_reset_token($token)
    {
        $row = $this->db->table($this->table)
                    ->where('reset_token', $token)
                    ->get();
        if (!$row) return false;
        if (isset($row['reset_expires_at']) && strtotime($row['reset_expires_at']) < time()) {
            return false;
        }
        return $row;
    }

    public function clear_reset_token($user_id)
    {
        return $this->db->table($this->table)
                    ->where($this->primary_key, $user_id)
                    ->update(['reset_token' => null, 'reset_expires_at' => null, 'updated_at' => date('Y-m-d H:i:s')]);
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
