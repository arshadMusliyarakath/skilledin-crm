<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Defualt_Model');
    }

	public function index()
	{
		ini_set('display_errors', 1);
		$data['page_name'] 				= 	'Dashboard';
		$data['registraionCount'] 		= 	$this->Common_model->getCount(); 
		$data['caregiverCount'] 		= 	$this->Common_model->getCount(2); 
		$data['canadaPRCount'] 			= 	$this->Common_model->getCount(1);
		$data['australiaPRCount'] 		= 	$this->Common_model->getCount(4); 
		$data['studyCount'] 			= 	$this->Common_model->getCount(3); 
		//print_r( $data);


		$notify	=	[
			'time'			=>		date('h:i A'),
			'receiver'		=>		41, //shony
			'title'			=>		'Test Heading - New 2024',
			'message' 		=> 		"This Message coming from Controller"
		];
		$this->Notification_model->sendNotification($notify);

		$notify['link']		=	'https://www.google.com';
		$notify['datetime']	=	 date('d M Y, h:i A');
		$notify['icon']		=	'user-plus';
		$notify['theme']	=	'primary';
		//$this->Defualt_Model->insert('notifications', $notify);


		$this->load->view('Dashboard/dashboard', $data);
	}

	public function pageNotFound()
	{
		$this->load->view('pageNotFound', $data);
	}

	

}