<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mail_Template extends MY_Controller {

	private $settings;

	public function __construct() {
        parent::__construct();
        $this->load->model('Defualt_Model'); 
        $this->load->model('Common_model'); 
		$this->settings = $this->session->userdata('settings');
    }
    
	public function sendMail(){
		$clientName		=		$this->input->post('clientName');
		$fromUserId		=		$this->session->userdata('userid');
		$fromName		=		$this->session->userdata('username')." - ".$this->Common_model->findSettings($this->settings, 'company_name_short')['_value'];
		$to 			= 		json_encode(array(['email' => $this->input->post('to'), 'sender' => $clientName	]));
		$cc 			= 		(!empty($this->input->post('cc'))) ? json_encode(array(['email' => $this->input->post('cc')])) : null;  
		$subject 		= 		$this->input->post('subject');
		$message 		= 		$this->input->post('message');
		$response 		= 		$this->Mail_Model->send($fromUserId, $fromName, $to, $subject, $message, $cc = null);
		echo json_decode($response, true)['success_code'];

	}

	public function fetchTemplate(){
		$tempTitle		=		$this->input->post('tempTitle');
		$template		=		$this->Mail_Model->template($tempTitle);
		$findTitle		=		$template->title;

		if($findTitle == "Welcome Mail - Documentation"){
			$subject 		= 		$template->subject;
			$message 		= 		$template->message;
			echo json_encode(array('subject' => $subject, 'message' => $message));
		}

	}
}