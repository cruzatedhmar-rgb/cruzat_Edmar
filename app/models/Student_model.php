<?php
    defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

    class Student_model extends Model {
        
        protected $table = 'authors';
        protected $primary_key = 'id';
        
        public function __construct()
        {
            parent::__construct();
        }

        public function page($q, $records_per_page = null, $page = null) {
            if (is_null($page)) {
                return $this->db->table('authors')->get_all();
            } else {
                $query = $this->db->table('authors');
                
                // Build LIKE conditions
                $query->like('id', '%'.$q.'%')
                    ->or_like('first_name', '%'.$q.'%')
                    ->or_like('last_name', '%'.$q.'%')
                    ->or_like('birthdate', '%'.$q.'%')
                    ->or_like('email', '%'.$q.'%')
                    ->or_like('added', '%'.$q.'%');

                // Clone before pagination
                $countQuery = clone $query;

                $data['total_rows'] = $countQuery->select_count('*', 'count')
                                                ->get()['count'];

                $data['records'] = $query->pagination($records_per_page, $page)
                                        ->get_all();

                return $data;
            }
        }
            // Create a new author record
            public function create($data) {
                return $this->db->table($this->table)->insert($data);
            }

            // Get a single author by primary key
            public function get($id) {
                return $this->db->table($this->table)
                            ->where($this->primary_key, $id)
                            ->get();
            }

            // Update an author record
            public function update($id, $data) {
                return $this->db->table($this->table)
                            ->where($this->primary_key, $id)
                            ->update($data);
            }

            // Delete an author record
            public function delete($id) {
                return $this->db->table($this->table)
                            ->where($this->primary_key, $id)
                            ->delete();
            }

    }
?>