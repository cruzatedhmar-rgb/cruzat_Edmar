<?php
class User_model extends Model {
    protected $table = 'users';

    public function register($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->insert($data);
    }

    public function getByUsername($username) {
        return $this->where('username', $username)->first();
    }

    public function getByEmail($email) {
        return $this->where('email', $email)->first();
    }
}
