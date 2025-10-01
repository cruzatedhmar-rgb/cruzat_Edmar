<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Author extends Controller {

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

        $all = $this->author_model->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('author').'?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('authors', $data);
    }

    // Show add form
    public function create() {
        $this->call->view('author_form', ['action' => 'create']);
    }

    // Handle add
    public function store() {
        $data = [
            'first_name' => $this->io->post('first_name'),
            'last_name' => $this->io->post('last_name'),
            'email' => $this->io->post('email'),
            'birthdate' => $this->io->post('birthdate'),
            'added' => date('Y-m-d H:i:s')
        ];
        $this->author_model->create_author($data);
        redirect(site_url('author'));
    }

    // Show edit form
    public function edit($id) {
        $author = $this->author_model->get_author($id);
        $this->call->view('author_form', ['author' => $author, 'action' => 'edit']);
    }

    // Handle update
    public function update($id) {
        $data = [
            'first_name' => $this->io->post('first_name'),
            'last_name' => $this->io->post('last_name'),
            'email' => $this->io->post('email'),
            'birthdate' => $this->io->post('birthdate')
        ];
        $this->author_model->update_author($id, $data);
        redirect(site_url('author'));
    }

    // Handle delete
    public function delete($id) {
        $this->author_model->delete_author($id);
        redirect(site_url('author'));
    }
}
?>
