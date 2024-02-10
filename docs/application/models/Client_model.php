<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function allClientsWithDetails($id) {
        $this->db->select('clients.*, products.product_name');
        $this->db->from('clients');
        $this->db->where('clients.case_manager', $id);
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
    public function allClientsWithConsultent($handle_deprt) {
        $this->db->select('clients.*, products.product_name, users.name as consultent_name');
        $this->db->from('clients');
        $this->db->join('products', 'products.id = clients.product', 'left');
        $this->db->join('users', 'users.id = clients.added_by', 'left');
        $this->db->where('clients.handle_deprt', $handle_deprt);
        $this->db->where('clients.case_manager IS NULL');
        $this->db->order_by('clients.id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    public function getClientWithDetails($clientId) {
        $this->db->select('clients.*, dp.id as doc_process_id, dp.cur_stage, dp.cur_option,  products.product_name');
        $this->db->from('clients');
        $this->db->where('clients.id', $clientId);
        // $this->db->where('clients.added_by', $added_by);
        $this->db->join('products', 'products.id = clients.product', 'left');
        $this->db->join('doc_process as dp', 'dp.client = clients.id', 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    public function getMandetaryDocsWithStatus($clientId, $type = null) {
        $this->db->select('cd.*, cud.client, cud.file_name, cud.document, cud.added_by, cud.created_at, cud.status as up_status');
        $this->db->from('client_documents cd');
        $this->db->join('client_uploaded_documents cud', 'cd.id = cud.document  AND cud.client = ' . $clientId, 'left');  
        ($type) ? $this->db->where('cd.type',  $type) : '';
        $this->db->order_by('cd.id');
        return $this->db->get()->result();
    }
    public function getUploadedDocswithStatus($clientId) {
        $this->db->select('cd.*, cud.client, cud.file_name, cud.document, cud.added_by, cud.created_at, cud.status as up_status, cud.doc_name');
        $this->db->from('client_uploaded_documents cud');
        $this->db->join('client_documents cd', 'cd.id = cud.document', 'left');   
        $this->db->where('cud.client', $clientId);
        return $this->db->get()->result();
    }
    public function waitingClients(){
        $this->db->select('cl.id, cl.name, cl.email, us.name as consultant_name, pr.product_name');
        $this->db->from('clients cl');
        $this->db->join('users us', 'us.id = cl.added_by', 'left'); 
        $this->db->join('products pr', 'pr.id = cl.product', 'left');   
        $this->db->where('cl.handle_deprt', 2); //documentation
        $this->db->where('cl.case_manager IS NULL');
        $this->db->where('cl.assigned_at IS NULL');
        return $this->db->get()->result();
    }
    public function getUserCaseCount($date) {
        $this->db->select('COUNT(*) as client_count, cl.case_manager, us.name');
        $this->db->from('clients as cl');
        $this->db->join('users as us', 'us.id = cl.case_manager', 'left');
        $this->db->like('cl.assigned_at', $date);
        $this->db->group_by('cl.case_manager');
        $query = $this->db->get();
        return $query->result();
    }
    public function assignedClients($date = null, $case_manager = null) {
        $this->db->select('cl.id, cl.name, cl.assigned_at, us.name as case_manager, pr.product_name, cl.profile_status');
        $this->db->from('clients as cl');
        $this->db->join('users as us', 'us.id = cl.case_manager', 'left');
        $this->db->join('products pr', 'pr.id = cl.product', 'left'); 
        ($date != null) ? $this->db->like('cl.assigned_at', $date) : '';
        ($case_manager != null) ? $this->db->like('cl.case_manager', $case_manager) : '';
        $this->db->where('cl.handle_deprt', 2); //documentation
        $this->db->where('cl.case_manager IS NOT NULL');
        $this->db->where('cl.assigned_at IS NOT NULL');
        $query = $this->db->get();
        return $query->result();
    }
    public function lastStageStatus($clientId){
        $this->db->select('ds.stage as stage_name, sp.option_text as option_name');
        $this->db->from('clients as cl');
        $this->db->join('stage_process as sp', 'sp.id = cl.cur_stage ', 'left');
        $this->db->join('deal_stages as ds', 'ds.id = sp.stage', 'left');
        $this->db->where('cl.id', $clientId); 
        $query = $this->db->get();
        return $query->result();
    }
    public function allStagesAndCurrOption($clientId, $product){
        $this->db->select('ds.*, sp.*, ds.id as stage_id, ds.stage as stage_name');
        $this->db->from('deal_stages as ds');
        $this->db->join('stage_process as sp', 'sp.stage = ds.id AND sp.client = ' . $clientId, 'left');
        $this->db->where('ds.product', $product);
        $query = $this->db->get();
        return $query->result();
    }
    public function stageTimeLine($clientId){
        $this->db->select('ds.id as stage_id, ds.stage, sp.option_text , sp.created_at');
        $this->db->from('stage_process as sp');
        $this->db->join('deal_stages as ds', 'ds.id = sp.stage', 'left');
        $this->db->where('sp.client', $clientId);
        $this->db->order_by('ds.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function totSplitPaid($clientId, $paymentId){
        $this->db->select_sum('amount', 'total_amount');
        $this->db->where('client', $clientId);
        $this->db->where('payment_id', $paymentId);
        $query = $this->db->get('split_payments');
        return $query->row()->total_amount;
    }
    public function pushedClients(){
        $this->db->select('cl.id as client_id, cl.name, cl.crm_number, cl.email, cl.profile_status, cl.portal_status, pr.product_name, us.name as case_manager');
        $this->db->from('clients as cl');
        $this->db->join('products as pr','pr.id = cl.product', 'left');
        $this->db->join('users as us','us.id = cl.case_manager', 'left');
        $this->db->where('handle_deprt', 2);
        $query = $this->db->get();
        return $query->result();
    }
    // public function stagesWithOption($clientId, $productId) {
    //     $this->db->select('ds.*, sp.stage as stageId, sp.stage_option');
    //     $this->db->from('deal_stages ds');
    //     $this->db->join('stage_process sp', 'sp.client = '. $clientId, 'left');   
    //     $this->db->where('ds.product', 2); //2 : Caregiver
    //     $this->db->where('sp.stage = ds.stage' );
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    // public function stageWithOptionStatus(){
    //     $this->db->select('*');
    //     $this->db->from('clients as cl');
    //     $this->db->join('users as us', 'us.id = cl.case_manager', 'left');
    //     $this->db->like('cl.assigned_at', $date);
    //     $this->db->group_by('cl.case_manager');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}