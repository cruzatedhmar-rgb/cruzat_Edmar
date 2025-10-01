<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller 
{
    public function __construct() {
        // start session kung wala pa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * LOGIN FUNCTION
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = model('User_model');
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // hanapin user
            $user = $userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // security: regenerate session id
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                redirect('/');
            } else {
                $error = "Invalid username or password.";
                return view('login', compact('error'));
            }
        }

        // GET request → show login form
        return view('login');
    }

    /**
     * REGISTER FUNCTION
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = model('User_model');
            $username  = trim($_POST['username']);
            $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // sample insert function sa User_model
            $userModel->insertUser([
                'username' => $username,
                'password' => $password,
                'role'     => 'user'
            ]);

            redirect('/auth/login');
        }

        return view('register');
    }

    /**
     * LOGOUT FUNCTION
     */
    public function logout() {
        // clear session
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        redirect('/auth/login');
    }
}
