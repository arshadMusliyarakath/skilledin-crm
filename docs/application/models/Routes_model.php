<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_routes() {
        $query = $this->db->get('routes');
        return $query->result_array();
    }
}
