<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends MY_Controller {
	
	private $settings;

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model'); 
		$this->load->model('Client_model');
		$this->load->model('Common_model'); 
		$this->settings = $this->session->userdata('settings');
    }
	public function index(){
		//ini_set('display_errors', 1);
		$userId = ($this->session->userdata('role')==2) ? '' : $this->session->userdata('userid'); // 2 : Sales manager 
		$data['page_name'] 			= 	'Clients';
		$data['clients'] 			= 	$this->Client_model->allClientsWithConsultent($userId); // added_user
		$this->load->view('Client/clients', $data);
	}
	public function addClient()
	{
		ini_set('display_errors', 1);
		$data['page_name'] 			= 	'Add Client';
		$data['products']    		=   $this->Defualt_Model->all('products');
		$this->load->view('Client/add_client', $data);
		if ($this->input->post()) {	
			$insData = $this->input->post();
			if($this->input->post('qualification') == 'NULL'){
				$insData['qualification'] = $insData["other-qualification"];	
			}
			unset($insData["other-qualification"]);
			$insData['requirement'] = json_encode($insData['requirement']);
			$insData['added_by'] = $this->session->userdata('userid');
			$insData['created_at'] = date('Y-m-d H:s:i');	
			$clientid = $this->Defualt_Model->insert('clients',$insData);
			$this->session->set_flashdata('success', 'Added Successfully');
			$activity = [
				'client' 		=> 	$clientid,
				'type'	 		=>	1, //Registration
				'span_1'		=>	$this->session->userdata('username'),
				'text'			=>	'made a registration.',
				'added_by' 		=> 	$this->session->userdata('userid'),
				'created_at' 	=> 	date('Y-m-d H:i:s')
			];
			$this->Defualt_Model->insert('activity_tracker', $activity);
			redirect('Client');
		}
	}
	public function updateClient()
	{
		ini_set('display_errors', 1);
		if ($this->input->post()) {	
			$clientid = $this->Defualt_Model->update('clients',$this->input->post(), array('id' => $this->input->post('id')));
			$this->session->set_flashdata('success', 'Updated Successfully');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function salesView(){
		//ini_set('display_errors', 1);
		// $this->load->model('Notification_model');
		// $this->Notification_model->sendNotification();
		$clientId = $this->uri->segment(3);
		$data['client']   	 			=   $this->Client_model->getClientWithDetails($clientId);
		$data['documents']   	 		=   $this->Client_model->getMandetaryDocsWithStatus($clientId);
		$data['up_docs_count']			=   count($this->Defualt_Model->findAll('client_uploaded_documents', array('client' => $clientId)));
		$data['regPaymntStatus']		=   count($this->Defualt_Model->findAll('payment_master', array('client' => $clientId)));
		$data['activities']				=   $this->Defualt_Model->findAll('activity_tracker', array('client' => $clientId), array('activity_tracker.id' => 'DESC'));
		$data['sales_url']				=	$this->session->userdata('urls')['sales'];
		$data['firstPayment']			=	count($this->Defualt_Model->findAll('payment_master', array('client' => $clientId)));
		$data['products']  		  		=   	$this->Defualt_Model->all('products');
		$data['page_name'] 				= 	'Client Detials';
		($data['client'] != NULL) ? $this->load->view('Client/client_profile', $data) : redirect('Client');	
	}
	public function changeProfilePic()
	{
		$clientid = $this->input->post('id');
		$targetDirectory = './uploads/clients/profiles/';
		$imageFileType = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));
		$newFileName = "profile-" . $clientid . '.' . $imageFileType;
		$targetFile = $targetDirectory . $newFileName;
		$desiredWidth = 300;
		$compressedImage = $this->compressAndResizeImage($_FILES["profile_pic"]["tmp_name"], $targetFile, $desiredWidth);
		$this->Defualt_Model->update('clients', array('profile_pic' => base_url().substr($compressedImage, 2)), array('id' => $clientid));
		$this->session->set_flashdata('success', 'Profile Picture Changed Successfully!');
		redirect($_SERVER['HTTP_REFERER']);
	}
	private function compressAndResizeImage($source, $destination, $desiredWidth)
	{
		$info = getimagesize($source);
		list($width, $height) = $info;
		$aspectRatio = $width / $height;
		$desiredHeight = $desiredWidth / $aspectRatio;
		$image = imagecreatefromstring(file_get_contents($source));
		$resizedImage = imagescale($image, $desiredWidth, $desiredHeight);
		if ($info['mime'] == 'image/jpeg') {
			imagejpeg($resizedImage, $destination, 25); 
		} elseif ($info['mime'] == 'image/png') {
			imagepng($resizedImage, $destination, 3); 
		}
		imagedestroy($image);
		imagedestroy($resizedImage);
		return $destination;
	}
	public function uploadMandateryDocs()
	{
		$clientid	 = 	$this->input->post('id');
		$docType	 = 	$this->input->post('doc_id');
		$docName	 = 	$this->input->post('doc_name');
		$targetDirectory = './uploads/clients/documents/';
		$imageFileType = strtolower(pathinfo($_FILES["doc_file"]["name"], PATHINFO_EXTENSION));
		$docNameAlter     = str_replace(" ","_",$docName);
		$newFileName = $clientid. '_' .$docNameAlter. '.' . $imageFileType;
		$targetFile = $targetDirectory . $newFileName;
		move_uploaded_file($_FILES["doc_file"]["tmp_name"], $targetFile);
		$insData = [
			'client' 		=> 	$clientid,
			'file_name'	 	=>	$newFileName,
			'document' 		=> 	$docType,
			'doc_name' 		=> 	$docName,
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$checkDoc = $this->Defualt_Model->findAll('client_uploaded_documents', array('client' => $clientid, 'document' => $docType));
		if($checkDoc){
			$this->Defualt_Model->update('client_uploaded_documents', $insData, array('id' => $checkDoc[0]->id));
			$this->session->set_flashdata('update', $docName.' Updated Successfully!');
		}
		else{
			$this->Defualt_Model->insert('client_uploaded_documents', $insData);
			$this->session->set_flashdata('success', $docName.' Added Successfully!');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function addRegPayment()
	{
		$clientid    		= 	$this->input->post('client-id');
		$paymentType    	= 	$this->input->post('payment-type');
		$milestoneAmt     	= 	$this->input->post('milestone-amount');
		$milestoneName 		=  	($this->input->post('milestone-name')) ? $this->input->post('milestone-name') : 'Registration';
		$insData = [
			'client' 		=> 	$clientid,
			'type'	 		=>	$milestoneName,
			'fixed_amount'	=>	300000,
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$checkMailstone = $this->Defualt_Model->findSelect('payment_master', array('id'), array('client' => $clientid, 'type' => $milestoneName));
		if($checkMailstone){
			$lastId =  $checkMailstone[0]->id;
		}else{
			$lastId = $this->Defualt_Model->insert('payment_master', $insData);
		}
		$insData2 = [
			'payment_id'	=>		$lastId,
			'client'		=>		$clientid,
			'amount'		=>		$milestoneAmt,
			'payment_type'	=>		$paymentType,
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
			'span_2'		=>	number_format($milestoneAmt, 2),
			'text2'			=>	'('.$paymentType.') is credited.',
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$this->Defualt_Model->insert('activity_tracker', $activity);
		$this->session->set_flashdata('success', $milestoneName.' Payment Added Successfully!');
		redirect($_SERVER['HTTP_REFERER']);
	 }
	public function pushToDoc(){
		$clientid    = $this->input->post('clientId');
		$docsManager = $this->user_model->getUsersWithRole(3)[0];
		echo $this->Defualt_Model->update('clients', array('handle_deprt' => 2, 'pushed_at' => date('Y-m')), array('id' => $clientid, 'handle_deprt' => 1));
		$activity = [
			'client' 		=> 	$clientid,
			'type'	 		=>	3, //Push
			'span_1'		=>	'Pushed',
			'text'			=>	'the client to',
			'span_2'		=>	$docsManager->name." (".$docsManager->role_name.").",
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$this->Defualt_Model->insert('activity_tracker', $activity);

		$clientDetial 		= 	$this->Client_model->getClientWithDetails($clientid);

		//Notification to Doc Manager
		$notify	=	[
			'time'			=>		date('h:i A'),
			'receiver'		=>		39, //winny
			'title'			=>		$clientDetial->name.' - '.$clientDetial->product_name,
			'message' 		=> 		"Pushed: ".$this->session->userdata('username')." (Sales Consultant)"
		];
		$this->Notification_model->sendNotification($notify);

		$url				=	$this->Common_model->findSettings($this->settings, 'documentation_url')['_value'];
		$notify['link']		=	$url."Client/salesView/".$clientid;
		$notify['datetime']	=	 date('d M Y, h:i A');
		$notify['icon']		=	'user-plus';
		$notify['theme']	=	'warning';
		$this->Defualt_Model->insert('notifications', $notify);
		//------------

		$this->session->set_flashdata('success', 'Client Move to Documentation Department');
	}
	public function CheckMobileExist(){
		$mobile    = $this->input->post('mobile');
		echo ($this->Defualt_Model->findSelect('clients', array('mobile') ,array('mobile' => $mobile)) != NULL) ? 1 : 0;
	}
	public function CheckEmailExist(){
		$email    = $this->input->post('email');
		echo ($this->Defualt_Model->findSelect('clients', array('email') ,array('email' => $email)) != NULL) ? 1 : 0;
	}
	public function CheckPassportExist(){
		$passport_no    = $this->input->post('passport_no');
		echo ($this->Defualt_Model->findSelect('clients', array('passport_no') ,array('passport_no' => $passport_no)) != NULL) ? 1 : 0;
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
	public function fakeClients() {
		ini_set('display_errors', 1);
		require_once 'vendor/autoload.php';
		$faker = Faker\Factory::create();
		for ($i = 0 ; $i <= 1250 ; $i++) {
			$requirement = array('UKVI\/IELTS', 'UKNARIC', 'Interview Training');
			shuffle($requirement);
			array_pop($requirement);
			$addClient = [
				'name'            => $faker->name,
				'crm_number'      => $faker->numberBetween(65236564, 75236564),
				'product'         => $faker->randomElement([1, 2, 3, 4]),
				'country'         => $faker->country,
				'agreement_date'  => $faker->date,
				'close_amt'       => $faker->numberBetween(400000, 650000),
				'mobile'          => $faker->phoneNumber,
				'email'           => $faker->email,
				'address'         => $faker->address,
				'passport_no'     => $faker->randomNumber(8),
				'dob'             => $faker->date,
				'occupation'      => $faker->randomElement(['Student', 'Engineer', 'Doctor', 'Nurse', 'Advacate', 'Actor']),
				'category'        => $faker->randomElement(['Medical', 'Non-Medical']),
				'requirement'     => json_encode($requirement),
				'qualification'   => $faker->randomElement(['Nurse', 'GNM', 'ANM', 'MSW', '+2']),
				'handle_deprt'	  => 1,
				'profile_status'  => 1,
				'added_by' 		  => $this->session->userdata('userid'),
				'created_at' 	  => date('Y-m-d H:i:s')
			];
			echo "<pre>";
			//print_r($addClient);
			$this->Defualt_Model->insert('clients', $addClient);
		}
	}
	public function addDocsAPI()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('client-id', 'Client ID', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('up-doc-id', 'Document ID', 'required');
		$this->form_validation->set_rules('doc-name', 'Document Name', 'required');
		//$this->form_validation->set_rules('doc-file', 'Document File', 'required');
		if ($this->form_validation->run()) {
			$email      	= 	$this->input->post('email');
			$password     	= 	$this->input->post('mobile');
			$clientId   	= 	$this->input->post('client-id');
			$documentId 	= 	$this->input->post('up-doc-id');
			$docName    	= 	$this->input->post('doc-name');
			$docFile    	= 	$this->input->post('doc-file');
			$client = $this->Defualt_Model->find('clients', array('email' => $email));
			if ($client) {
				if ($password == $client->mobile && $clientId == $client->id) {				
					$targetDirectory = './uploads/clients/documents/';
					$imageFileType = strtolower(pathinfo($_FILES["doc-file"]["name"], PATHINFO_EXTENSION));
					$docNameAlter     = str_replace(" ","_",$docName);
					$newFileName = $clientId. '_' .$docNameAlter. '.' . $imageFileType;
					$targetFile = $targetDirectory . $newFileName;
					if (move_uploaded_file($_FILES["doc-file"]["tmp_name"], $targetFile)) {
						$insData = [
							'client' 		=> 	$clientId,
							'doc_name' 		=> 	$docName,
							'file_name'		=>	$newFileName,
							'status' 		=> 	1,
							'created_at' 	=> 	date('Y-m-d H:i:s')
						];
						$res = $this->Defualt_Model->update('client_uploaded_documents', $insData, array('id' => $documentId));
						if($res == 1){
							$response = [
								'status'       => 200,
								'message'      => 'Added Successfully',
								'success_code' => 1,
							];
						}
					} else {
						$response = [
							'status'  => 400,
							'message' => $this->upload->display_errors(),
						];
					}
				} else {
					$response = ['status' => 400, 'message' => 'Invalid Credentials'];
				}
			} else {
				$response = ['status' => 400, 'message' => 'Invalid Credentials'];
			}
		} else {
			$response = [
				'status' => 400,
				'message' => validation_errors()
			];
		}
		http_response_code($response['status']);
		header('Content-Type: application/json');
		//echo json_encode($this->input->post());
		echo json_encode($response);
	}
}