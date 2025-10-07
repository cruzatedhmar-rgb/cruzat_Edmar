<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

require_once __DIR__ . '/../models/User_model.php';

class Auth extends Controller {
    
    private $User_model;
    
    public function __construct() {
        parent::__construct();
        $this->User_model = new User_model();
    }

    public function login() {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Please fill in all fields.';
                redirect(site_url('auth/login'));
                return;
            }

            $user = $this->User_model->get_by_username($username);
            
            // Debug: Check if user exists and what we got
            if (!$user) {
                $_SESSION['error'] = 'User not found.';
                redirect(site_url('auth/login'));
                return;
            }
            
            if ($this->User_model->verify_password($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;
                
                redirect(site_url('author'));
            } else {
                $_SESSION['error'] = 'Invalid username or password.';
                redirect(site_url('auth/login'));
            }
        } else {
            // Check if user is already logged in
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                redirect(site_url('author'));
            }
            $this->call->view('login');
        }
    }

    public function register() {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $confirm_password = $this->io->post('confirm_password');

            // Validation
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = 'Please fill in all fields.';
                redirect(site_url('auth/register'));
                return;
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Passwords do not match.';
                redirect(site_url('auth/register'));
                return;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Password must be at least 6 characters long.';
                redirect(site_url('auth/register'));
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Please enter a valid email address.';
                redirect(site_url('auth/register'));
                return;
            }

            // Check if username or email already exists
            if ($this->User_model->check_username_exists($username)) {
                $_SESSION['error'] = 'Username already exists.';
                redirect(site_url('auth/register'));
                return;
            }

            if ($this->User_model->check_email_exists($email)) {
                $_SESSION['error'] = 'Email already exists.';
                redirect(site_url('auth/register'));
                return;
            }

            // Create user
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password
            ];

            if ($this->User_model->create($data)) {
                $_SESSION['success'] = 'Registration successful! Please login.';
                redirect(site_url('auth/login'));
            } else {
                $_SESSION['error'] = 'Registration failed. Please try again.';
                redirect(site_url('auth/register'));
            }
        } else {
            // Check if user is already logged in
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                redirect(site_url('author'));
            }
            $this->call->view('register');
        }
    }

    public function logout() {
        session_destroy();
        redirect(site_url('auth/login'));
    }

    public function check_auth() {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            redirect(site_url('auth/login'));
        }
    }
}
?>
