<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defualt_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
 
    }

    public function all($table) {
        $query = $this->db->get($table);
        return $query->result();
    }


    public function find($table, $data) {
        $this->db->where($data);
        $query = $this->db->get($table);


        if ($query->num_rows() > 1) {
            return $query->result();
        } else {
            return $query->row();
        }
    }

    public function findAll($table, $data, $orderBy = null, $limit = null) {
        $this->db->where($data);
    
        if ($orderBy !== null) {
            foreach ($orderBy as $column => $direction) {
                $this->db->order_by($column, $direction);
            }
        }
    
        $query = $this->db->get($table);
        return $query->result();
    }

    public function findSelect($table, $selectData, $whereData) {
        $this->db->select($selectData);
        $this->db->where($whereData);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $setData, $whereData) {
        $this->db->update($table, $setData, $whereData);
        return $this->db->affected_rows();
    }

    public function delete($table, $whereData) {
        $this->db->delete($table, $whereData);
        return $this->db->affected_rows();
    }


    

}
