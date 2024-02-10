<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales extends MY_Controller {

	private $settings;

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model'); 
		$this->load->model('Common_model'); 
		$this->settings = $this->session->userdata('settings');
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
				'product_id' 	=> 	json_encode($this->input->post('product')),
				'role' 			=> 	4,
				'manager'		=>  $this->session->userdata('userid'),
				'added_by' 		=> 	$this->session->userdata('userid'),
				'created_at' 	=> 	date('Y-m-d h:s:i'),
			]; 
			$this->Defualt_Model->insert('users',$insData);

			//***********START MAIL **************

			$get_key = $this->Common_model->findSettings($this->settings, 'sales_url');

			$fromUserId		=		$this->session->userdata('userid');
			$login_url		=		$get_key['_value'];
			$to				=		json_encode(array(['email' => $this->input->post('email')]));

			$mailTitle 		= 		'new_user_created';
			$template 		= 		$this->Mail_Model->template($mailTitle);
			$fromName		=		str_replace("**created_user_role**", $this->session->userdata('role_name'), $template->from_name);
			$subject		=		$template->subject;
			$message 		= 		$template->message;
			$message 		= 		str_replace("**username**", $this->input->post('name'), $message);
			$message 		= 		str_replace("**new_user_role**", $this->user_model->getUserRole($this->input->post('role')), $message);
			$message 		= 		str_replace("**new_user_email**", $this->input->post('email'), $message);
			$message 		= 		str_replace("**new_user_password**", $this->input->post('mobile'), $message);
			$message 		= 		str_replace("**login_url**", "<a href='".$login_url."'>".$login_url."</a>", $message);
			$message 		= 		str_replace("**superior_name**", $this->session->userdata('username'), $message);
			$message 		= 		str_replace("**superior_role**", $this->session->userdata('role_name'), $message);

			$responce = $this->Mail_Model->send($fromUserId, $fromName, $to, $subject, $message, $cc = null);

			//************END MAIL *****************


			$this->session->set_flashdata('success', 'User creation successful. Login credentials have been sent.');
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