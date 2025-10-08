<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

require_once __DIR__ . '/../models/User_model.php';

class Maintenance extends Controller {

    private $User_model;

    public function __construct() {
        parent::__construct();
        $this->User_model = new User_model();
    }

    // Admin-only: force add role column and seed admin role
    public function add_role_column() {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            redirect(site_url('auth/login'));
            return;
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            show_error('Forbidden: Admins only', 403);
            return;
        }

        $this->User_model->ensure_role_column();
        $_SESSION['success'] = 'Role column ensured. Admin user role set to admin.';
        redirect(site_url('auth/register'));
    }

    // Admin-only: drop obsolete columns from authors table if present
    public function drop_authors_birthdate_added() {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            redirect(site_url('auth/login'));
            return;
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            show_error('Forbidden: Admins only', 403);
            return;
        }

        try {
            // Check and drop birthdate
            $stmt = $this->db->raw("SHOW COLUMNS FROM `authors` LIKE 'birthdate'");
            if ($stmt->fetch()) {
                $this->db->raw("ALTER TABLE `authors` DROP COLUMN `birthdate`");
            }
            // Check and drop added
            $stmt2 = $this->db->raw("SHOW COLUMNS FROM `authors` LIKE 'added'");
            if ($stmt2->fetch()) {
                $this->db->raw("ALTER TABLE `authors` DROP COLUMN `added`");
            }
            $_SESSION['success'] = 'Removed birthdate and added columns (if they existed).';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Failed to update table: ' . $e->getMessage();
        }
        redirect(site_url('author'));
    }
}
?>


