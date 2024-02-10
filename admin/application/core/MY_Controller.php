<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class MY_Controller extends CI_Controller {



    public function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->library('upload');

        date_default_timezone_set('Asia/Kolkata');

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->model('Mail_Model');


    }



    protected function checkPermissions() {

        $controller = $this->router->fetch_class();

        $method = $this->router->fetch_method();

        $userRole = $this->session->userdata('role');

        $permissions = $this->setPermissions();



        $freeAccess = ['index', 'login', 'logout', 'dashboard', 'ForgotPassword'];

	    if (in_array($method, $freeAccess)) {

	        return;

	    }



	    if (!isset($permissions["$controller/$method"]) || !in_array($userRole, $permissions["$controller/$method"])) {

	        show_error('You are not authorized to access this page.', 403);

	    }

       

    }



    protected function setPermissions() {

        return [

            'ManagerController/managers' => [1, 2], // Admin, Manager

            'ManagerController/addManager' => [1, 2], // Admin, Manager

        ];

    }

}

