<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller {

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
		// var_dump($this->Common_model->findSettings($this->settings, 'company_name_short')['_value']);
		// exit;
		//ini_set('display_errors', 1);
		$data['page_name'] 		= 	'Managers';
		$data['managers']    	=   $this->user_model->getManagersWithRole();
		$this->load->view('Manager/managers', $data);
	}

	public function addManager()
	{
		ini_set('display_errors', 1);
		$data['page_name'] 			= 	'Add Manager';
		$data['manager_roles']    	=   $this->user_model->getManagersRoles();

		if ($this->input->post()) {
			$insData = [
				'empid' => "SK".$this->user_model->lastUserId()+1,
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'password' => password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
				'added_by' => $this->session->userdata('userid'),
				'created_at' => date('Y-m-d h:i:s'),
			]; 

			$this->Defualt_Model->insert('users',$insData);

			//***********START MAIL **************

			$set_key =	($this->input->post('role') == 2) ? 'sales_url' : 'documentation_url';
			$get_key = $this->Common_model->findSettings($this->settings, $set_key);

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
			redirect('Manager');
		}

		$this->load->view('Manager/add_manager', $data);
	}

	public function viewManager(){
		//ini_set('display_errors', 1);
		$managerId = $this->uri->segment(3);
		$data['page_name'] 		= 	'View / Edit Manager';
		$data['user']   	 	=   $this->Defualt_Model->find('users', array('id' => $managerId));
		$data['manager_roles']  =   $this->user_model->getManagersRoles();
		($data['user'] != NULL) ? $this->load->view('Manager/view_manager', $data) : redirect('Manager');

		if ($this->input->post()) {
			$insData = [
				'name' 		=> $this->input->post('name'),
				'email' 	=> $this->input->post('email'),
				'mobile' 	=> $this->input->post('mobile'),
				'password' => password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'role'		=> $this->input->post('role'),
				'status'	=> ($this->input->post('status') == 'on') ? 1 : 0,
			]; 
			$res = $this->Defualt_Model->update('users',$insData, array('id' => $this->input->post('id')));
			($res > 0) ? $this->session->set_flashdata('success', 'Updated Successfully') : '';
			redirect('Manager');
		}		
	}

	public function TeamMembers(){
		ini_set('display_errors', 1);
		$managerId = $this->uri->segment(3);
		$data['page_name'] 		= 	'Sales Manager Team';
		$data['users']    		=   $this->user_model->getManagerTeam($managerId);
		// echo '<pre>';
		// var_dump($data['managers']);
		// exit();
		$this->load->view('Manager/sales_team_members', $data);
	}

	public function deleteManager(){
		//ini_set('display_errors', 1);
		$managerId = $this->uri->segment(3);
		$this->Defualt_Model->delete('users', array('id' => $managerId));
		$this->session->set_flashdata('success', 'Deleted Successfully');
		redirect('Manager');
	}

}