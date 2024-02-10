<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends MY_Controller {

	private $settings;

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model'); 
        $this->load->model('Common_model'); 
		$this->settings = $this->session->userdata('settings');
    }
    public function TeamMembers() {
        ini_set('display_errors', 1);
		$managerId              =    $this->uri->segment(3);
        $managerRole            =    $this->uri->segment(4);
		$data['page_name'] 		= 	($this->uri->segment(4) == 2) ? 'Sales Manager Team' : 'Documentation Manager Team';
		$data['users']    		=   $this->user_model->getManagerTeam($managerId);
        $this->load->view('Common/team_members', $data);
    }
    public function MyClients(){
		$id = $this->uri->segment(3);
		$this->load->model('Client_model');
		$userName				=   $this->Defualt_Model->findSelect('users', array('name'), array('id' => $id)); 
		$data['page_name'] 		= 	$userName[0]->name.' Clients';
		$data['clients'] 		= 	$this->Client_model->allClientsWithDetails($id);
		$this->load->view('Common/my_clients', $data);
	}
    public function viewConsultant(){
		$id = $this->uri->segment(3);
		$data['page_name'] 		= 	'View / Edit';
		$data['user']   	 	=   $this->Defualt_Model->find('users', array('id' => $id));
		$data['products']    	=   $this->Defualt_Model->all('products');
		($data['user'] != NULL) ? $this->load->view('Common/view_consultant', $data) : redirect('Sales');
		if ($this->input->post()) {
			$insData = [
				'name' 			=>      $this->input->post('name'),
				'email' 		=>      $this->input->post('email'),
				'mobile' 		=>      $this->input->post('mobile'),
				'password' 		=>      password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'product_id'	=>      json_encode($this->input->post('product')),
				'status'		=>      ($this->input->post('status') == 'on') ? 1 : 0,
			]; 
			$res = $this->Defualt_Model->update('users',$insData, array('id' => $this->input->post('id')));
			($res > 0) ? $this->session->set_flashdata('success', 'Updated Successfully') : '';
			redirect($this->agent->referrer());
		}
	}
	public function readNotification(){
		$notifyID	=	$this->input->post('notifyID');
		echo $this->Defualt_Model->update('notifications', array('status' => 1), array('id' => $notifyID) );

	}
	
}