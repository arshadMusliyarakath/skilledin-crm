<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model'); 
    }

	public function index(){
		ini_set('display_errors', 1);
		$data['page_name'] 		= 	'Case Managers';
		$data['users']    		=   $this->user_model->getCaseMngrsWithMultiProduct($this->session->userdata('userid'));
		$this->load->view('Documentation/case_managers', $data);
	}

	public function addCaseManager(){
		ini_set('display_errors', 1);
		$data['page_name'] 		= 	'Add Case Managers';
		$data['products']    		=   $this->Defualt_Model->all('products');

		if ($this->input->post()) {
			$insData = [
				'empid' 		=> 	"SK".$this->user_model->lastUserId()+1,
				'name'			=> 	$this->input->post('name'),
				'email' 		=> 	$this->input->post('email'),
				'mobile' 		=> 	$this->input->post('mobile'),
				'password' 		=> 	password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'product_id' 	=> 	$this->input->post('product'),
				'role' 			=> 	5,
				'manager'		=>  $this->session->userdata('userid'),
				'added_by' 		=> 	$this->session->userdata('userid'),
				'created_at' 	=> 	date('Y-m-d h:s:i'),
			]; 

			$this->Defualt_Model->insert('users',$insData);
			$this->session->set_flashdata('success', 'Added Successfully');
			redirect('Documentation');
		}


		$this->load->view('Documentation/add_case_manager', $data);
	}

	public function viewCaseManager(){
		//ini_set('display_errors', 1);
		$id = $this->uri->segment(3);
		$data['page_name'] 		= 	'View / Edit Case Managers';
		$data['user']   	 	=   $this->Defualt_Model->find('users', array('id' => $id));
		$data['products']    	=   $this->Defualt_Model->all('products');
		($data['user'] != NULL) ? $this->load->view('Documentation/view_case_manager', $data) : redirect('Documentation');

		if ($this->input->post()) {
			$insData = [
				'name' 			=> $this->input->post('name'),
				'email' 		=> $this->input->post('email'),
				'mobile' 		=> $this->input->post('mobile'),
				'product_id'	=> $this->input->post('product'),
				'status'		=> ($this->input->post('status') == 'on') ? 1 : 0,
			]; 
			$res = $this->Defualt_Model->update('users',$insData, array('id' => $this->input->post('id')));
			($res > 0) ? $this->session->set_flashdata('success', 'Updated Successfully') : '';
			redirect('Documentation');
		}
	}	

	public function deleteCaseManager(){
		//ini_set('display_errors', 1);
		$id = $this->uri->segment(3);
		$this->Defualt_Model->delete('users', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted Successfully');
		redirect('Documentation');
	}


	



}