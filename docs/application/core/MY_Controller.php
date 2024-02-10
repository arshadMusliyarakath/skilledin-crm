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

        $this->load->model('Notification_model');

        $this->load->model('Defualt_Model');

    }


}

