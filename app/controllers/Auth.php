<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

require_once __DIR__ . '/../models/User_model.php';

class Auth extends Controller {
    
    private $User_model;
    
    public function __construct() {
        parent::__construct();
        $this->User_model = new User_model();
        // Ensure schema has role column
        $this->User_model->ensure_role_column();
    }

    public function login() {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $selectedRole = $this->io->post('role');

            if (empty($username) || empty($password) || empty($selectedRole)) {
                $_SESSION['error'] = 'Please fill in all fields.';
                redirect(site_url('auth/login'));
                return;
            }

            $user = $this->User_model->get_by_username($username);
            
            // Debug: Check if user exists and what we got
            if (!$user) {
                $_SESSION['error'] = ($selectedRole === 'admin') ? 'Admin not found.' : 'User not found.';
                redirect(site_url('auth/login'));
                return;
            }
            
            if ($this->User_model->verify_password($password, $user['password'])) {
                // Enforce that the selected role matches the user's stored role
                $storedRole = isset($user['role']) ? $user['role'] : 'user';
                if (!in_array($selectedRole, ['admin', 'user'], true) || $selectedRole !== $storedRole) {
                    $_SESSION['error'] = ($selectedRole === 'admin') ? 'Admin not found.' : 'User not found.';
                    redirect(site_url('auth/login'));
                    return;
                }

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $storedRole;
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

            // Determine role: allow admin to set, others default to user
            $role = 'user';
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                $postedRole = $this->io->post('role');
                if (in_array($postedRole, ['admin', 'user'], true)) {
                    $role = $postedRole;
                }
            }

            // Create user
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role
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

    // Show form to request password reset and handle submission
    public function forgot_password() {
        if ($this->io->method() === 'post') {
            $email = $this->io->post('email');
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Please enter a valid email address.';
                redirect(site_url('auth/forgot-password'));
                return;
            }

            $user = $this->User_model->get_by_email($email);
            // Always show success even if email not found to avoid user enumeration
            $token = bin2hex(random_bytes(32));
            $expiresAt = time() + 3600; // 1 hour

            $dir = ROOT_DIR . 'runtime' . DIRECTORY_SEPARATOR . 'password_resets';
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            $filePath = $dir . DIRECTORY_SEPARATOR . $token . '.json';

            if ($user) {
                $payload = [
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'expires' => $expiresAt
                ];
                file_put_contents($filePath, json_encode($payload));

                // Send email with reset link
                try {
                    $emailLib = new Email();
                    $emailLib->sender('no-reply@example.com', 'Password Reset');
                    $emailLib->recipient($user['email']);
                    $emailLib->subject('Reset your password');
                    $resetLink = site_url('auth/reset-password/' . $token);
                    // Surface link in session for testing visibility on the UI
                    $_SESSION['reset_link'] = $resetLink;
                    $body = "Click the link to reset your password: " . $resetLink;
                    $emailLib->email_content($body, 'plain');
                    $emailLib->send();
                } catch (Exception $e) {
                    // Ignore sending failures; user will still see success
                }
            }

            $_SESSION['success'] = 'If your email exists in our system, you\'ll receive a reset link shortly.';
            redirect(site_url('auth/forgot-password'));
            return;
        }

        $this->call->view('forgot_password');
    }

    // Show reset form and handle password update
    public function reset_password($token) {
        $dir = ROOT_DIR . 'runtime' . DIRECTORY_SEPARATOR . 'password_resets';
        $filePath = $dir . DIRECTORY_SEPARATOR . basename($token) . '.json';

        if (!file_exists($filePath)) {
            $_SESSION['error'] = 'Invalid or expired reset link.';
            redirect(site_url('auth/forgot-password'));
            return;
        }

        $data = json_decode(file_get_contents($filePath), true);
        if (!$data || time() > (int)$data['expires']) {
            @unlink($filePath);
            $_SESSION['error'] = 'Reset link has expired. Please request a new one.';
            redirect(site_url('auth/forgot-password'));
            return;
        }

        if ($this->io->method() === 'post') {
            $password = $this->io->post('password');
            $confirm = $this->io->post('confirm_password');

            if (empty($password) || empty($confirm)) {
                $_SESSION['error'] = 'Please fill in all fields.';
                redirect(site_url('auth/reset-password/' . $token));
                return;
            }

            if ($password !== $confirm) {
                $_SESSION['error'] = 'Passwords do not match.';
                redirect(site_url('auth/reset-password/' . $token));
                return;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Password must be at least 6 characters long.';
                redirect(site_url('auth/reset-password/' . $token));
                return;
            }

            // Update password
            $this->User_model->update($data['user_id'], ['password' => $password]);
            @unlink($filePath);

            $_SESSION['success'] = 'Your password has been reset. Please log in.';
            redirect(site_url('auth/login'));
            return;
        }

        // Pass token for form action
        $this->call->view('reset_password', ['token' => $token]);
    }
}
?>
