<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Student extends Controller {

    public function __construct() {
        parent::__construct();
        $this->check_auth();
    }

    private function check_auth() {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            redirect(site_url('auth/login'));
        }
    }

    public function all() 
    {
        
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
         }

        $records_per_page = 10;

        $all = $this->Student_model->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('author').'?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('students', $data);
    }

        public function create()
        {
            if ($this->io->method() === 'post') {
                $data = [
                    'first_name' => $this->io->post('first_name'),
                    'last_name' => $this->io->post('last_name'),
                    'email' => $this->io->post('email'),
                    'birthdate' => $this->io->post('birthdate'),
                ];
                $this->Student_model->create($data);
                redirect(site_url('student/all'));
            }
            $this->call->view('student_create');
        }

        public function edit($id)
        {
        $student = $this->Student_model->get($id);
            if (!$student) {
                show_404();
            }
            if ($this->io->method() === 'post') {
                $data = [
                    'first_name' => $this->io->post('first_name'),
                    'last_name' => $this->io->post('last_name'),
                    'email' => $this->io->post('email'),
                    'birthdate' => $this->io->post('birthdate'),
                ];
                $this->Student_model->update($id, $data);
                redirect(site_url('student/all'));
            }
            $this->call->view('student_edit', ['student' => $student]);
        }

        public function delete($id)
        {
            $this->Student_model->delete($id);
            redirect(site_url('student/all'));
        }
}
?>
