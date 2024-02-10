<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
 
    }


    public function lastUserId() {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result->id;
        } else {
            return null;
        }
    }

    public function getUserRole($role_id) {
        $this->db->select('role');
        $this->db->where('role_id', $role_id);
        $query = $this->db->get('user_roles');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->role;
        } else {
            return null;
        }
    }

    public function username($userId){
		$this->db->select('name');
        $this->db->from('users');
        $this->db->where('id',$userId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $resultSet =  $query->result();
            return $resultSet[0]->name;
        }
	}

    public function getManagersRoles() {
        $this->db->select('*');
        $this->db->where('role_id', 2);
        $this->db->or_where('role_id', 3);
        $this->db->where('status', 1);
        $query = $this->db->get('user_roles');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function getManagers() {
        $this->db->select('*');
        $this->db->where('role', 2);
        $this->db->or_where('role', 3);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function getManagersWithRole() {
        $this->db->select('users.*, user_roles.role as role_name');
        $this->db->from('users');
        $this->db->where('users.role', 2);
        $this->db->or_where('users.role', 3);
        $this->db->join('user_roles', 'user_roles.role_id = users.role', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function getUsersWithRole($role) {
        $this->db->select('users.*, user_roles.role as role_name');
        $this->db->from('users');
        $this->db->where('users.role', $role);
        $this->db->join('user_roles', 'user_roles.role_id = users.role', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function getManagerTeam($managerID) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.manager', $managerID);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function getUsersWithProduct($role) {
        $this->db->select('users.*, products.product_name');
        $this->db->from('users');
        $this->db->where('users.role', $role);
        $this->db->join('products', 'products.id = users.product_id', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }



    public function getCaseMngrsWithMultiProduct($managerId) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.manager', $managerId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function todayLogins($role, $date){
		$this->db->select('users.id, users.name, login_history.in_time, ');
        $this->db->from('login_history');
        $this->db->join('users', 'users.id = login_history.user', 'left');
        $this->db->where('login_history.date', $date);
        $this->db->where('login_history.role', $role);
        $this->db->where('users.id IS NOT NULL');
        $this->db->order_by('login_history.in_time', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
	}



}