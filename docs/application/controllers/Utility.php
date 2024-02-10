<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Defualt_Model'); 
    }


    public function products()
	{
		$data['page_name'] 		= 	'Products';
		$data['datas']    		=   $this->Defualt_Model->all('products');
		$this->load->view('Utilities/products', $data);
	}

	public function addProduct()
	{

		$insData = [
			'product_name' => $this->input->post('name'),
			'added_by' => $this->session->userdata('userid'),
			'created_at' => date('Y-m-d h:s:i'),
		]; 

		$this->Defualt_Model->insert('products',$insData);
		$this->session->set_flashdata('success', 'Added Successfully');
		redirect('Utility/products');
	}

	public function updateProduct(){
		ini_set('display_errors', 1);
		if ($this->input->post()) {
			$insData = [
				'product_name'		=> $this->input->post('product_name'),
				'status'			=> ($this->input->post('status') == 'on') ? 1 : 0,
			]; 
			$res = $this->Defualt_Model->update('products',$insData, array('id' => $this->input->post('id')));
			($res > 0) ? $this->session->set_flashdata('success', 'Updated Successfully') : '';
			redirect('Utility/products');
		}
	}


	public function roles()
	{
		$data['page_name'] 		= 	'Roles / Designation';
		$data['roles']    		=   $this->Defualt_Model->all('user_roles');
		$this->load->view('Utilities/roles', $data);
	}
	public function addRole(){
		$insData = [
			'role' => $this->input->post('role'),
			'added_by' => $this->session->userdata('userid'),
			'created_at' => date('Y-m-d h:s:i'),
		]; 

		$this->Defualt_Model->insert('user_roles',$insData);
		$this->session->set_flashdata('success', 'Added Successfully');
		redirect('Utility/roles');
	}

	public function updateRole(){
		//ini_set('display_errors', 1);	
		if ($this->input->post()) {
			$insData = [
				'role'		=> $this->input->post('role'),
				'status'	=> ($this->input->post('status') == 'on') ? 1 : 0,
			]; 
			$res = $this->Defualt_Model->update('user_roles',$insData, array('role_id' => $this->input->post('id')));
			($res > 0) ? $this->session->set_flashdata('success', 'Updated Successfully') : '';
			redirect('Utility/roles');
		}
	}


	
	public function getCategoryReq()
	{
		$categoryId = $this->input->post('category');
		
		$option = "<option>Select Requirement</option>";
		$option = $option."<option>UKVI/IELTS</option>";
		$option = $option."<option>UKNARIC</option>";
		$option = ($categoryId==2) ? $option."<option>Level 3</option>" : $option;
		$option = $option."<option>Interview Training</option>";

		echo $option;

	}

	
}