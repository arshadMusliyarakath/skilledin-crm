<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model'); 
		$this->load->model('Common_model'); 
    }

	public function index()
	{
		ini_set('display_errors', 1);
		$data['page_name'] 		= 	'Sales Consultants';
		$data['users']    		=   $this->user_model->getUsersWithProduct(4);
		$this->load->view('Sales/sales_consultants', $data);
	}
	public function addSalesConsultant()
	{
		ini_set('display_errors', 1);
		$data['page_name'] 		= 	'Add Sales Consultant';
		$data['products']    		=   $this->Defualt_Model->all('products');

		if ($this->input->post()) {
			$insData = [
				'empid' 		=> 	"SK".$this->user_model->lastUserId()+1,
				'name'			=> 	$this->input->post('name'),
				'email' 		=> 	$this->input->post('email'),
				'mobile' 		=> 	$this->input->post('mobile'),
				'password' 		=> 	password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'product_id' 	=> 	$this->input->post('product'),
				'role' 			=> 	4,
				'manager'		=>  $this->session->userdata('userid'),
				'added_by' 		=> 	$this->session->userdata('userid'),
				'created_at' 	=> 	date('Y-m-d h:s:i'),
			]; 

			$this->Defualt_Model->insert('users',$insData);
			$this->session->set_flashdata('success', 'Added Successfully');
			redirect('Sales');
		}


		$this->load->view('Sales/add_sales_consultant', $data);
	}

	public function viewSalesConsultant(){
		//ini_set('display_errors', 1);
		$id = $this->uri->segment(3);
		$data['page_name'] 		= 	'View / Edit Sales Consultant';
		$data['user']   	 	=   $this->Defualt_Model->find('users', array('id' => $id));
		$data['products']    	=   $this->Defualt_Model->all('products');
		($data['user'] != NULL) ? $this->load->view('Sales/view_sales_consultant', $data) : redirect('Sales');

		if ($this->input->post()) {
			$insData = [
				'name' 			=> $this->input->post('name'),
				'email' 		=> $this->input->post('email'),
				'mobile' 		=> $this->input->post('mobile'),
				'password' 		=> 	password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'product_id'	=> json_encode($this->input->post('product')),
				'status'		=> ($this->input->post('status') == 'on') ? 1 : 0,
			]; 
			$res = $this->Defualt_Model->update('users',$insData, array('id' => $this->input->post('id')));
			($res > 0) ? $this->session->set_flashdata('success', 'Updated Successfully') : '';
			redirect('Sales');
		}
	}	

	public function MyClients(){
		$id = $this->uri->segment(3);
		$this->load->model('Client_model');
		$userName				= $this->Defualt_Model->findSelect('users', array('name'), array('id' => $id)); 
		$data['page_name'] 		= 	$userName[0]->name.' Clients';
		$data['clients'] 		= 	$this->Client_model->allClientsWithDetails($id);
		$this->load->view('Sales/my_clients', $data);
	}

	public function deleteSalesConsultant(){
		//ini_set('display_errors', 1);
		$id = $this->uri->segment(3);
		$this->Defualt_Model->delete('users', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted Successfully');
		redirect('Sales');
	}






}