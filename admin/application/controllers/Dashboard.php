<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
        parent::__construct();
		ini_set('display_errors', 1);
		$this->load->model('Common_model');
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
		// print_r( $data);
		// exit;
		$this->load->view('Dashboard/dashboard', $data);
	}

	public function pageNotFound()
	{
		$this->load->view('pageNotFound', $data);
	}

	

}