if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    public function logout() {
        session_destroy();
        header('Location: /auth/login');
        exit;
    }
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = model('User_model');
            $user = $userModel->getByUsername($_POST['username']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: /');
                exit;
            } else {
                $error = 'Invalid username or password.';
                return view('login', compact('error'));
            }
        }
        return view('login');
    }
<?php
class Auth extends Controller {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = model('User_model');
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            if ($userModel->getByUsername($data['username']) || $userModel->getByEmail($data['email'])) {
                $error = 'Username or email already exists.';
                return view('register', compact('error'));
            }
            $userModel->register($data);
            header('Location: /auth/login');
            exit;
        }
        return view('register');
    }
}
