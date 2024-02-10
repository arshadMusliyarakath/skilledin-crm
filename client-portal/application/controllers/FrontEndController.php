<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontEndController extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->Model('Defualt_Model');
		$this->load->Model('Common_model');
    }

	public function index(){
		redirect('dashboard');	
	}

	public function dashboard(){
	    //ini_set('display_errors', 1);
		$data['client'] 		= 		$this->session->userdata('userData');
		$data['documents']  	=   	$this->Common_model->getUploadedDocswithStatus($this->session->userdata('userid'));
		$data['chats']  		=   	$this->Defualt_Model->findAll('chat', array('client' => $data['client']->id));
		$this->load->view('dashboard', $data);
	}
	public function login()
	{
		ini_set('display_errors', 1);
		($this->session->userdata('userid')) ? redirect('dashboard') : '';
		$this->load->view('login');
		if ($this->input->post()) {
	        $email = $this->input->post('cl_email');
	        $password = $this->input->post('cl_password');
	        $client = $this->Defualt_Model->find('clients', array('email' => $email));
			if($client){
				if ($password == $client->mobile){

					if ($client->handle_deprt == 2 && $client->assigned_at != NULL){
						$userdata = array(
							'userid'		=> 	$client->id,
							'product_name' 	=> 	$this->Common_model->productName($client->product),
							'userData'		=> 	$client,
						);
						$this->session->set_userdata($userdata);
						if($client->portal_status == 0){
							$this->Defualt_Model->update('clients', array('portal_status' => 1), array('id' => $client->id));
							$activity = [
								'client' 		=> 	$client->id,
								'type'	 		=>	3, //info
								'span_1'		=>	$client->name,
								'text'			=>	' logged ',
								'span_2'		=>	'Client Portal',
								'created_at' 	=> 	date('Y-m-d H:i:s')
							];
							$this->Defualt_Model->insert('activity_tracker', $activity);
						}
						//var_dump($userdata);
						redirect('dashboard');	
					}
					else
					{
						$this->session->set_flashdata('denied', 'Access Denied!!. Try again!');
					}
				}else { $this->session->set_flashdata('invalidMsg', 'Invalid credentials. Try again!'); }
			}else { $this->session->set_flashdata('invalidMsg', 'Invalid credentials. Try again!'); }
			
	        redirect('login'); 
		}
	}


	public function viewPdf() {
    	ini_set('display_errors', 1);
    	$filename 	= 	$this->input->post('documentName');
    	//$pdfPath = 'C:\wamp64\www\crm\sales\uploads/clients/documents/';
		$pdfPath = '/home/zghmf6tth3su/public_html/sales.beskilledin.com/uploads/clients/documents/';
        $filePath = $pdfPath . $filename;
        if (file_exists($filePath)) {
            header('Content-Type: application/pdf');
            readfile($filePath);
        } else {
            show_error('File not found', 404);
        }    
    }


	public function uploadDocAPI() {
	    ini_set('display_errors', 1);
		$client = $this->Defualt_Model->findSelect('clients', array('email', 'mobile'), array('id' => $this->session->userdata('userid')));
		$filePath = $_FILES['doc-file']['tmp_name'];
	
		if (!empty($filePath) && is_readable($filePath)) {
			$ch = curl_init();
			$postData = array(
				'email'      => $client[0]->email,
				'mobile'     => $client[0]->mobile,
				'client-id'  => $this->session->userdata('userid'),
				'up-doc-id'  => $this->input->post('up-doc-id'),
				'doc-name'   => $this->input->post('doc-name'),
				'doc-file'   => new CURLFile($filePath, $_FILES['doc-file']['type'], $_FILES['doc-file']['name']),
			);
	
			curl_setopt($ch, CURLOPT_URL, 'https://sales.beskilledin.com/Client/addDocsAPI');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$response = curl_exec($ch);
	
			if (curl_errno($ch)) {
				echo 'Curl error: ' . curl_error($ch);
			}
	
			curl_close($ch);
			$responseData = json_decode($response, true);
			//var_dump($responseData);
	
			if ($responseData['success_code'] == 1) {
				$this->session->set_flashdata('success', $this->input->post('doc-name').' Uploaded Successfully!');
			}
		} else {
			echo 'Error: Unable to read the uploaded file.';
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	
	
	public function logout(){
		$this->session->sess_destroy();	
		redirect('login'); 
	}

	public function documents(){
		$data['client'] 	= 	$this->session->userdata('userData');
		$this->load->view('documents', $data);
	}

	public function sendChat(){
		$clientId 		= 		$this->session->userdata('userid');
		$caseManager    =		$this->input->post('caseManager');
		$messageText	=		$this->input->post('messageText');

		$data = [
			'client'		=>	$clientId,
			'user'			=>	$caseManager, 
			'message'		=>	$messageText,
			'type'			=>	2,
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$this->Defualt_Model->insert('chat', $data);

		var_dump($data);
	}




	
}