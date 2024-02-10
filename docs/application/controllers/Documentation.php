<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documentation extends MY_Controller
{
	private $settings;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('Defualt_Model');
		$this->load->model('Common_model');
		$this->load->model('Client_model');
		$this->settings = $this->session->userdata('settings');
	}

	public function index()
	{
		ini_set('display_errors', 1);
		$data['page_name'] = 'Case Managers';
		$data['users'] = $this->user_model->getCaseMngrsWithMultiProduct($this->session->userdata('userid'));
		$this->load->view('Documentation/case_managers', $data);
	}

	public function addCaseManager()
	{
		ini_set('display_errors', 1);
		$data['page_name'] = 'Add Case Managers';
		$data['products'] = $this->Defualt_Model->all('products');

		if ($this->input->post()) {
			$insData = [
				'empid' => "SK" . $this->user_model->lastUserId() + 1,
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'password' => password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'product_id' => json_encode($this->input->post('product')),
				'role' => 5,
				'manager' => $this->session->userdata('userid'),
				'added_by' => $this->session->userdata('userid'),
				'created_at' => date('Y-m-d H:i:s'),
			];

			$this->Defualt_Model->insert('users', $insData);

			//***********START MAIL **************

			$get_key = $this->Common_model->findSettings($this->settings, 'documentation_url');

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
			redirect('Documentation');
		}
		
		$this->load->view('Documentation/add_case_manager', $data);
	}

	public function viewCaseManager()
	{
		//ini_set('display_errors', 1);
		$id = $this->uri->segment(3);
		$data['page_name'] = 'View / Edit Case Managers';
		$data['user'] = $this->Defualt_Model->find('users', array('id' => $id));
		$data['products'] = $this->Defualt_Model->all('products');
		($data['user'] != NULL) ? $this->load->view('Documentation/view_case_manager', $data) : redirect('Documentation');

		if ($this->input->post()) {
			$insData = [
				'name' 			=> 	$this->input->post('name'),
				'email' 		=> 	$this->input->post('email'),
				'mobile' 		=> 	$this->input->post('mobile'),
				'password' 		=>	password_hash($this->input->post('mobile'), PASSWORD_DEFAULT),
				'product_id' 	=> 	json_encode($this->input->post('product')),
				'status' 		=> 	($this->input->post('status') == 'on') ? 1 : 0,
			];
			$res = $this->Defualt_Model->update('users', $insData, array('id' => $this->input->post('id')));
			($res > 0) ? $this->session->set_flashdata('success', 'Updated Successfully') : '';
			redirect('Documentation');
		}
	}

	public function deleteCaseManager()
	{
		//ini_set('display_errors', 1);
		$id = $this->uri->segment(3);
		$this->Defualt_Model->delete('users', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted Successfully');
		redirect('Documentation');
	}


	public function AssignToDoc()
	{
		ini_set('display_errors', 1);
		$data['page_name'] 			= 	'Client Assigning';
		$data['todayLogins'] 		= 	$this->user_model->todayLogins(5, date('Y-m-d'));
		$data['waitingClients'] 	= 	$this->Client_model->waitingClients();
		$data['getCaseCount'] 		= 	$this->Client_model->getUserCaseCount(date('Y-m'));
		$data['assignedClients'] 	= 	$this->Client_model->assignedClients(date('Y-m'));

		if ($this->input->post()) {

			$upData = ['case_manager' => $this->input->post('case-manager'), 'assigned_at' => date('Y-m-d H:i:s')];
			$res = $this->Defualt_Model->update('clients', $upData, array('id' => $this->input->post('client')));
			($res > 0) ? $this->session->set_flashdata('success', 'Assigned Successfully') : '';

			$activity = [
				'client' 		=> 	$this->input->post('client'),
				'type'	 		=>	6, //danger
				'span_1'		=>	$this->session->userdata('username'),
				'text'			=>	' assigned the client to ',
				'span_2'		=>	$this->user_model->username($this->input->post('case-manager')),
				'added_by' 		=> 	$this->session->userdata('userid'),
				'created_at' 	=> 	date('Y-m-d H:i:s')
			];
			$this->Defualt_Model->insert('activity_tracker', $activity);

			$notify	=	[
				'time'			=>		date('h:i A'),
				'receiver'		=>		$this->input->post('case-manager'),
				'title'			=>		$this->session->userdata('username')."( ".$this->session->userdata('role_name')." )",
				'message' 		=> 		"Assigned new client for you",
				'link'			=>		'https://www.google.com'
			];
	
			$this->Notification_model->sendNotification($notify);

			//***********START MAIL **************

			$fromUserId		=		$this->input->post('case-manager'); // Assigned Case Manager
			$to				=		json_encode(array(['email' => $this->input->post('client-email')]));

			$mailTitle 		= 		'Welcome Mail';
			$template 		= 		$this->Mail_Model->template($mailTitle);
			$fromName		=		str_replace("**assigned_doc_manager**", $this->user_model->username($this->input->post('case-manager')), $template->from_name);
			$subject		=		$template->subject;
			$message 		= 		$template->message;
			$responce = $this->Mail_Model->send($fromUserId, $fromName, $to, $subject, $message, $cc = null);

			//************END MAIL *****************

			redirect($_SERVER['HTTP_REFERER']);
		}
		//echo "<pre>";
		//print_r($data['assignedClients']);
		// //echo $this->db->last_query();
		$this->load->view('Documentation/client_assigning', $data);
	}

	public function AssignedClients(){
		$data['page_name'] 			= 	'My Clients';
		$data['assignedClients'] 	= 	$this->Client_model->assignedClients($date = null, $case_manager = $this->session->userdata('userid'));
		// echo "<pre>";
		// print_r($data['assignedClients']);
		$this->load->view('Documentation/assigned_clients', $data);
	}


	public function submitChecklist(){
		$clientId 		= 	$this->input->post('client');
		$docNameArry 	=   $this->input->post('doc-name');
		$pendingDocs 	=   $this->Defualt_Model->findSelect('client_uploaded_documents', array('document'), array('client' => $clientId)); 
		$pendingReq 	=   $this->Defualt_Model->findSelect('client_uploaded_documents', array('document'), array('client' => $clientId, 'status' => 0)); 
		$documentArray  = 	[];
		$pendingReqArray = 	[];

        foreach ($pendingDocs as $item) {
          $documentArray[] = $item->document;
        }

		foreach ($pendingReq as $item) {
			$pendingReqArray[] = $item->document;
		  }

		foreach ($docNameArry as $key => $doc) {

			$docName = $this->Defualt_Model->findSelect('client_documents', array('name'), array('id' => $doc));
			$data = [
				'client'  	=>  $clientId,
				'document'	=>	$doc,
				'doc_name'	=>  $docName[0]->name,
				'side'		=>	1,
				'status'	=>	0,
				'added_by'  => $this->session->userdata('userid'),
			];
					
			if(!in_array($doc, $documentArray)){
				$res = $this->Defualt_Model->insert('client_uploaded_documents', $data);
				
			}else{
				$res = $this->Defualt_Model->update('client_uploaded_documents', $data, array('client' => $clientId, 'document' => $doc) );
			}
			($res > 0) ? $this->session->set_flashdata('success', 'Check List submited successfully!') : '';		
		}
		$activity = [
			'client' 		=> 	$clientId,
			'type'	 		=>	5, //
			'span_1'		=>	'Checklist',
			'text'			=>	' is sent to the ',
			'span_2'		=>	'Client Portal.',
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$this->Defualt_Model->insert('activity_tracker', $activity);

		$this->session->set_userdata(array('tab' => 2)); //for the TAB
		$this->session->mark_as_temp('tab', 2);
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function changeStageStatus(){
		ini_set('display_errors', 1);

		$clientId 		= 	$this->input->post('client-id');
		$stageId 		= 	$this->input->post('stage-id');
		$option 		= 	($this->input->post('travel_status')) ? $this->input->post('travel_status') : $this->input->post('stage-option');
		

		$checkStageOption 	 = 	$this->Defualt_Model->findSelect('stage_process', array('stage'), array('client' => $clientId,'stage' => $stageId));
			
		$data = [
			'client'		=>		$clientId,
			'stage'			=>		$stageId,
			'option_text'	=>		$option,	
			'added_by' 		=> 		$this->session->userdata('userid'),
			'created_at' 	=> 		date('Y-m-d H:i:s'),
		];

		if($checkStageOption){
			$res = $this->Defualt_Model->update('stage_process', $data, array('client' => $clientId, 'stage' => $stageId));
		}
		else{
			$res = $this->Defualt_Model->insert('stage_process', $data);
		}
		
		$checkLastOption 	 = 	$this->Defualt_Model->findSelect('stage_process', array('id', 'option_text'), array('client' => $clientId));
		$lstArry = end($checkLastOption);

		// echo "<pre>";
		// print_r($lstArry);
		// exit;
		$this->Defualt_Model->update('clients', array('cur_stage' => $lstArry->id), array('id' => $clientId));


		($res > 0) ? $this->session->set_flashdata('success', 'Stage Updated') : '';

		$this->session->set_userdata(array('tab' => 3)); //for the TAB
		$this->session->mark_as_temp('tab', 2);

		redirect($_SERVER['HTTP_REFERER']);
	}


	public function addNewDoc(){
		$data = [
			'client'		=>		$this->input->post('client'),
			'side'			=>		1,
			'doc_name'		=>		strtoupper($this->input->post('add-new-doc')),
			'status' 		=>	 	0,
			'added_by' 		=> 		$this->session->userdata('userid'),
		];
		$res = $this->Defualt_Model->insert('client_uploaded_documents', $data);

		$this->session->set_userdata(array('tab' => 2)); //for the TAB
		$this->session->mark_as_temp('tab', 2);


		redirect($_SERVER['HTTP_REFERER']);

	}

	


	public function removeRequestedDoc(){
		echo $this->Defualt_Model->delete('client_uploaded_documents', array('client' => $this->input->post('clientId'), 'doc_name' => $this->input->post('docName')));
	}


	public function addStagesandOptions(){

		$options = [
			array('product' => 2, 'stage' => 1, 'option_text' => strtoupper('IELTS cleared')),
			array('product' => 2, 'stage' => 1, 'option_text' => strtoupper('IELTS Reattempt')),
			array('product' => 2, 'stage' => 1, 'option_text' => strtoupper('UKNARIC Received')),
			array('product' => 2, 'stage' => 1, 'option_text' => strtoupper('Drop out')),
			array('product' => 2, 'stage' => 1, 'option_text' => strtoupper('On Hold')),

			array('product' => 2, 'stage' => 2, 'option_text' => strtoupper('Not applicable')),
			array('product' => 2, 'stage' => 2, 'option_text' => strtoupper('Level 3 classes on going')),
			array('product' => 2, 'stage' => 2, 'option_text' => strtoupper('Level 3 classes completed')),
			array('product' => 2, 'stage' => 2, 'option_text' => strtoupper('Level 3 Certificate received')),
			array('product' => 2, 'stage' => 2, 'option_text' => strtoupper('On Hold')),
			array('product' => 2, 'stage' => 2, 'option_text' => strtoupper('Drop out')),

			array('product' => 2, 'stage' => 3, 'option_text' => strtoupper('Interview Passed')),
			array('product' => 2, 'stage' => 3, 'option_text' => strtoupper('Interview Failed')),
			array('product' => 2, 'stage' => 3, 'option_text' => strtoupper('Interview reattempt')),
			array('product' => 2, 'stage' => 3, 'option_text' => strtoupper('On hold')),
			array('product' => 2, 'stage' => 3, 'option_text' => strtoupper('Drop out')),

			array('product' => 2, 'stage' => 4, 'option_text' => strtoupper('Offer letter received')),
			array('product' => 2, 'stage' => 4, 'option_text' => strtoupper('On hold')),
			array('product' => 2, 'stage' => 4, 'option_text' => strtoupper('Drop out')),

			array('product' => 2, 'stage' => 5, 'option_text' => strtoupper('COS Received')),
			array('product' => 2, 'stage' => 5, 'option_text' => strtoupper('On hold')),
			array('product' => 2, 'stage' => 5, 'option_text' => strtoupper('Drop Out')),

			array('product' => 2, 'stage' => 6, 'option_text' => strtoupper('Visa filled')),
			array('product' => 2, 'stage' => 6, 'option_text' => strtoupper('VFS Submitted')),
			array('product' => 2, 'stage' => 6, 'option_text' => strtoupper('Visa received')),
			array('product' => 2, 'stage' => 6, 'option_text' => strtoupper('Visa rejected')),
			array('product' => 2, 'stage' => 6, 'option_text' => strtoupper('Drop out')),
		];

		//echo "<pre>";
		//var_dump($options);

		foreach ($options as $key => $option) {
			//$this->Defualt_Model->insert('deal_stage_options', $option);
		}

		
	}

	public function addNote(){
		$data = [
			'client'		=>		$this->input->post('id'),
			'note'			=>		$this->input->post('new_note'),
			'target_date'	=>		$this->input->post('targetDate'),
			'added_by'  	=> 		$this->session->userdata('userid'),
			'created_at' 	=> 		date('Y-m-d H:i:s'),
		];

		$res = $this->Defualt_Model->insert('notes', $data);
		($res > 0) ? $this->session->set_flashdata('success', 'Note Added') : '';
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function deleteNote(){
		ini_set('display_errors', 1);
		$clientId 	= 	$this->input->post('clientId');
		$noteID 	= 	$this->input->post('noteId');
		$res = $this->Defualt_Model->delete('notes', array('client' => $clientId, 'id' => $noteID));
		($res > 0) ? $this->session->set_flashdata('success', 'Note Deleted') : '';
	}


	public function paySplit()
	{
		$clientid    		= 	$this->input->post('client-id');
		$milestoneId     	= 	$this->input->post('mailestone-id');
		$milestoneName    	= 	$this->input->post('mailestone-name');
		$split_amount     	= 	$this->input->post('pay-amount');
		$split_pay_type    	= 	$this->input->post('payment-type');

		

		$insData2 = [
			'payment_id'	=>		$milestoneId,
			'client'		=>		$clientid,
			'amount'		=>		$split_amount,
			'payment_type'	=>		$split_pay_type,
			'status'		=>		1,
			'added_by' 		=> 		$this->session->userdata('userid'),
			'created_at' 	=> 		date('Y-m-d H:i:s')
		];
		$this->Defualt_Model->insert('split_payments', $insData2);

		$activity = [
			'client' 		=> 	$clientid,
			'type'	 		=>	2, //Payment
			'span_1'		=>	$milestoneName.' payment',
			'text'			=>	'of',
			'span_2'		=>	number_format($split_amount, 2),
			'text2'			=>	'('.$split_pay_type.') is credited.',
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		
		$this->Defualt_Model->insert('activity_tracker', $activity);
		$this->session->set_flashdata('success', $milestoneName.' Payment Added Successfully!');

		$this->session->set_userdata(array('tab' => 4)); //for the TAB
		$this->session->mark_as_temp('tab', 2);


		redirect($_SERVER['HTTP_REFERER']);
	}

	public function addMilestone(){
		$clientid    		= 	$this->input->post('client-id');
		$fixedAmt   	  	= 	$this->input->post('fixed-amount');
		$milestoneName 		=  	$this->input->post('milestone-name');

		$insData = [
			'client' 		=> 	$clientid,
			'type'	 		=>	$milestoneName,
			'fixed_amount'	=>	$fixedAmt,
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		
		$lastId = $this->Defualt_Model->insert('payment_master', $insData);
		$this->session->set_flashdata('success', $milestoneName.' Created Successfully!');

		$activity = [
			'client' 		=> 	$clientid,
			'text'			=>	'Payment milestone ',
			'span_2'		=>	$milestoneName,
			'text2'			=>	'added.',
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$this->Defualt_Model->insert('activity_tracker', $activity);

		$this->session->set_userdata(array('tab' => 4)); //for the TAB
		$this->session->mark_as_temp('tab', 2);
		
		redirect($_SERVER['HTTP_REFERER']);


	}

	public function changeProfileStatus(){
		ini_set('display_errors', 1);
		$clientid   	= 	$this->input->post('clientId');
		$prof_status   	= 	$this->input->post('prof_status');
		echo $this->Defualt_Model->update('clients', array('profile_status' => ($prof_status == 0) ? 1 : 0), array('id' => $clientid));
	}





	


	



}