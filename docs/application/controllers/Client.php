<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model'); 
		$this->load->model('Client_model'); 
    }
	// public function test(){
	// 	//$this->load->library('uri');
	// 	//echo $this->uri->segment(3);  
	// 	//var_dump($this->user_model->getUsersWithRole(3)[0]->name);
	// }
	public function AssignToDoc(){
		$loginClients = [10,11,12,13];
		$monthlyDealCounts = [
			['id' => 8,'clients' => 5],
			['id' => 9,'clients' => 12],
			['id' => 10,'clients' => 8],
			['id' => 11,'clients' => 3],
			['id' => 12,'clients' => 7],
			['id' => 13,'clients' => 1],
			['id' => 14,'clients' => 23],
		];
		echo '<pre>';
		$smallestClientsCount = PHP_INT_MAX; 
		$smallestClientsId = null;
		foreach ($monthlyDealCounts as $deal) {
			if ($deal['clients'] < $smallestClientsCount) {
				$smallestClientsCount 	= 	$deal['clients'];
				$smallestClientsId 		= 	$deal['id'];
			}
		}
		echo $smallestClientsId;
	}
	public function index(){
		//ini_set('display_errors', 1);
		$data['page_name'] 			= 	'Clients';
		$data['clients'] 			= 	$this->Client_model->allClientsWithConsultent(2); // hnadled : 2
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
			$insData['added_by'] = $this->session->userdata('userid');
			$insData['created_at'] = date('Y-m-d H:s:i');	
			$clientid = $this->Defualt_Model->insert('clients',$insData);
			$this->session->set_flashdata('success', 'Added Successfully');
			$activity = [
				'client' 		=> 	$clientid,
				'type'	 		=>	1, //Registration
				'span_1'		=>	$this->session->userdata('username'),
				'text'			=>	'made a registration',
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
		$clientId = $this->uri->segment(3);
		$data['client']   	 			=   $this->Client_model->getClientWithDetails($clientId);
		$data['documents']   	 		=   $this->Client_model->getMandetaryDocsWithStatus($clientId, 1); // 1 is Docs Type: sales 
		$data['up_docs_count']			=   count($this->Defualt_Model->findAll('client_uploaded_documents', array('client' => $clientId)));
		$data['regPaymntStatus']		=   count($this->Defualt_Model->findAll('payment_master', array('client' => $clientId, 'type' => 1)));
		$data['activities']				=   $this->Defualt_Model->findAll('activity_tracker', array('client' => $clientId), array('activity_tracker.id' => 'DESC'));
		$data['sales_url']				=	$this->session->userdata('urls')['sales'];
		$data['firstPayment']			=	count($this->Defualt_Model->findAll('payment_master', array('client' => $clientId)));
		$data['page_name'] 				= 	'Client Detials';
		// echo "<pre>";
		// print_r($data);
		// exit;
		// /echo $this->db->last_query();
		//echo $data['firstPayment'] ;
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
		$newFileName = $clientid. '_' .$docName. '.' . $imageFileType;
		$targetFile = $targetDirectory . $newFileName;
		move_uploaded_file($_FILES["doc_file"]["tmp_name"], $targetFile);
		$insData = [
			'client' 		=> 	$clientid,
			'file_name'	 	=>	$newFileName,
			'document' 		=> 	$docType,
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
	public function uploadMandateryPassport()
	{
		$clientid    = $this->input->post('id');
		$docName     = $this->input->post('doc_name');
		$targetDirectory = './uploads/clients/documents/';
		$file1Name = $clientid . '_' . $docName . '_front.' . strtolower(pathinfo($_FILES["doc_file_passport1"]["name"], PATHINFO_EXTENSION));
		$targetFile1 = $targetDirectory . $file1Name;
		move_uploaded_file($_FILES["doc_file_passport1"]["tmp_name"], $targetFile1);
		$file2Name = $clientid . '_' . $docName . '_back.' . strtolower(pathinfo($_FILES["doc_file_passport2"]["name"], PATHINFO_EXTENSION));
		$targetFile2 = $targetDirectory . $file2Name;
		move_uploaded_file($_FILES["doc_file_passport2"]["tmp_name"], $targetFile2);
		$insData1 = [
			'client'        => $clientid,
			'file_name'     => $file1Name,
			'document'      => 4,
			'side'     		=> 1,
			'added_by'      => $this->session->userdata('userid'),
			'created_at'    => date('Y-m-d H:i:s')
		];
		$insData2 = [
			'client'        => $clientid,
			'file_name'     => $file2Name,
			'document'      => 4,
			'side'     		=> 2,
			'added_by'      => $this->session->userdata('userid'),
			'created_at'    => date('Y-m-d H:i:s')
		];
		$checkDoc1 = $this->Defualt_Model->findAll('client_uploaded_documents', ['client' => $clientid, 'document' => 4, 'side' => 1, 'file_name' => $file1Name]);
		if ($checkDoc1) {
			$this->Defualt_Model->update('client_uploaded_documents', $insData1, ['id' => $checkDoc1[0]->id]);
			$this->session->set_flashdata('update', ' Passport Updated Successfully!');
		} else {
			$this->Defualt_Model->insert('client_uploaded_documents', $insData1);
			$this->session->set_flashdata('success', ' Passport Added Successfully!');
		}
		$checkDoc2 = $this->Defualt_Model->findAll('client_uploaded_documents', ['client' => $clientid, 'document' => 4, 'side' => 2, 'file_name' => $file2Name]);
		if ($checkDoc2) {
			$this->Defualt_Model->update('client_uploaded_documents', $insData2, ['id' => $checkDoc2[0]->id]);
			$this->session->set_flashdata('update', ' Passport Updated Successfully!');
		} else {
			$this->Defualt_Model->insert('client_uploaded_documents', $insData2);
			$this->session->set_flashdata('success', ' Passport Added Successfully!');
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
			'span_1'		=>	$this->session->userdata('username'),
			'text'			=>	'pushed',
			'span_2'		=>	$docsManager->name." (".$docsManager->role_name.")",
			'added_by' 		=> 	$this->session->userdata('userid'),
			'created_at' 	=> 	date('Y-m-d H:i:s')
		];
		$this->Defualt_Model->insert('activity_tracker', $activity);
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
	public function docsView(){
		$this->load->model('Common_model');
		//ini_set('display_errors', 1);
		$clientId = $this->uri->segment(3);
		$data['curr_tab']   	 		=   	($this->session->userdata('tab')) ? $this->session->userdata('tab') : 1;
		$data['client']   	 			=   	$this->Client_model->getClientWithDetails($clientId);
		$data['documents']   	 		=   	$this->Client_model->getUploadedDocswithStatus($clientId);
		$data['up_docs_count']			=   	count($this->Defualt_Model->findAll('client_uploaded_documents', array('client' => $clientId)));
		$data['activities']				=   	$this->Defualt_Model->findAll('activity_tracker', array('client' => $clientId), array('activity_tracker.id' => 'DESC'));
		$data['sales_url']				=		$this->session->userdata('urls')['sales'];
		$data['firstPayment']			=		count($this->Defualt_Model->findAll('payment_master', array('client' => $clientId)));
		$data['deal_stages']			=		$this->Client_model->allStagesAndCurrOption($clientId, 2);  // 2 : Care Giver
		$data['lastStageStatus']		=		$this->Client_model->lastStageStatus($clientId);
		$data['stageTimeLine']			=		$this->Client_model->stageTimeLine($clientId);
		$data['notes']					=		$this->Defualt_Model->findAll('notes', array('client' => $clientId));
		$data['payment_milestone']		=		$this->Defualt_Model->findAll('payment_master', array('client' => $clientId));
		$data['products']  		  		=   	$this->Defualt_Model->all('products');
		$data['mail_templates']  		=   	$this->Defualt_Model->findSelect('mail_template', array('id', 'title'), array('template' => 1));
		$data['page_name'] 				= 		'Client Detials';
		// echo "<pre>";
		// print_r($data['mail_templates']);
		// exit
		// /echo $this->db->last_query();
		//echo $data['firstPayment'] ;
		($data['client'] != NULL) ? $this->load->view('Client/client_profile_docs', $data) : redirect('Client');	
	}
	public function AllPushed()
	{
		ini_set('display_errors', 1);
		$data['page_name'] 		= 'Pushed Clients';
		$data['pushed_clients'] = $this->Client_model->pushedClients();
		// echo "<pre>";
		// var_dump($data['pushed_clients']);
		// exit;
		$this->load->view('Documentation/pushed_clients', $data);
	}
}