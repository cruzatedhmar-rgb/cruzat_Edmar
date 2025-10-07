<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Pages extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function forgot_password()
    {
        // If POST, don't attempt to perform reset here — just give a friendly response
        if ($this->io->method() === 'post') {
            $_SESSION['success'] = 'Password reset is temporarily disabled. Please contact the administrator.';
            redirect(site_url('auth/login'));
            return;
        }

        // Render the existing view if present
        $this->call->view('forgot_password');
    }

    public function reset_password()
    {
        if ($this->io->method() === 'post') {
            $_SESSION['success'] = 'Password reset is temporarily disabled. Please contact the administrator.';
            redirect(site_url('auth/login'));
            return;
        }

        $token = $_GET['token'] ?? '';
        $this->call->view('reset_password', ['token' => $token]);
    }
}

?>
