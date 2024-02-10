<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
 
    }
    
    public function allClientsWithDetails($added_by) {
        $this->db->select('clients.*, products.product_name');
        $this->db->from('clients');
        $this->db->where('clients.added_by', $added_by);
        // $this->db->where('clients.handle_deprt', 1);
        $this->db->join('products', 'products.id = clients.product', 'left');
        $this->db->order_by('clients.id', 'DESC');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function allClientsWithConsultent($userId = null) {
        $this->db->select('clients.*, products.product_name, users.name as consultent_name');
        $this->db->from('clients');
        $this->db->join('products', 'products.id = clients.product', 'left');
        $this->db->join('users', 'users.id = clients.added_by', 'left');
        ($userId != null) ? $this->db->where('clients.added_by', $userId) : '';
        $this->db->order_by('clients.id', 'DESC');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function getClientWithDetails($clientId) {
        $this->db->select('clients.*, products.product_name');
        $this->db->from('clients');
        $this->db->where('clients.id', $clientId);
        // $this->db->where('clients.added_by', $added_by);
        $this->db->join('products', 'products.id = clients.product', 'left');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function getMandetaryDocsWithStatus($clientId) {
        $this->db->select('cd.*, cud.client, cud.file_name, cud.document, cud.added_by, cud.created_at, cud.doc_name, cud.status as up_status');
        $this->db->from('client_documents cd');
        $this->db->join('client_uploaded_documents cud', 'cd.id = cud.document AND cud.side = 1  AND cud.client = ' . $clientId, 'left');  
        $this->db->where('cd.type', 1); 
        $this->db->order_by('cd.id');
        return $this->db->get()->result();
    }
    
    public function monthlyDealCounts($date) {
        $this->db->select('id, name');
        $this->db->from('clients');   
        $this->db->where('clients.pushed_at', $date);
        $this->db->where('clients.handle_deprt', 2);
        return $this->db->get()->result();
    }
    
    

}