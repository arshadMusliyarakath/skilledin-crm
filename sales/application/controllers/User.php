<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model');
		$this->load->model('Common_model');
	}

	public function login()
	{
		ini_set('display_errors', 1);
		($this->session->userdata('userid')) ? redirect('Dashboard') : '';
		$this->load->view('user/login');



		if ($this->input->post()) {


			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
		        $this->load->view('User/login');
		    }

	        $email = $this->input->post('email');
	        $password = $this->input->post('password');
	        
	        $user = $this->Defualt_Model->find('users', array('email' => $email, 'status' => 1));
	        if (password_verify($password, $user->password)) {

	        	if($user->role == 2 || $user->role == 4){ 

	        		$iconColor = ['primary', 'secondary', 'warning', 'danger', 'success', 'info'];
		        	shuffle($iconColor);
		        	$shortName = strtoupper(substr($user->name, 0, 2));

		        	$userdata = array(
		                'userid'	=> 	$user->id,
		                'role'		=> 	$user->role,
		                'role_name'	=> 	$this->user_model->getUserRole($user->role),
		                'empid'  	=> 	$user->empid,
		                'username' 	=> 	$user->name,
		                'email'		=> 	$user->email,
		                'mobile' 	=> 	$user->mobile,
		                'iconColor' =>	$iconColor[0],
		                'shortName' =>	$shortName,
						'settings'	=>	$this->Common_model->loadSettings()
		            );

		         	$this->session->set_userdata($userdata);
					$loginHistory = [
						'user'				=> 		$user->id,
						'role'				=> 		$user->role,
						'date'				=>		date('Y-m-d'),
						'in_time'			=>		date('H:i:s'),
						'login_ip_address'	=>		$this->input->ip_address()
					];

					$loginHistoryCheck = $this->Defualt_Model->findSelect('login_history', array('date') , array('user' =>  $user->id, 'date' => date('Y-m-d')));
					if($loginHistoryCheck == NULL){
						$this->Defualt_Model->insert('login_history', $loginHistory);
					}
					redirect('Dashboard');
	        	}
	        	else{
	        		$this->session->set_flashdata('warning', 'Permission denied!');
	        	}	        	
	        }
	        else
	        {
	        	$this->session->set_flashdata('error', 'Invalid credentials. Try again!');
	        }
	        redirect('User/login'); 
    	}
	}

	public function ForgotPassword(){
		ini_set('display_errors', 1);
		$email   	=		$this->input->post('email');
		$user    	=  		$this->Defualt_Model->findSelect('users', array('id' , 'name', 'email','role'), array('email' => $email));

		if(!empty($user)){

			$userId  	= 		$user[0]->id;
			$role 	 	= 		$user[0]->role;
			$name 		=		$user[0]->name;

			if($role == 2 || $role == 4){
				$resetLinkCheck = $this->Defualt_Model->findSelect('reset_password', array('reset_code'), array('user' => $userId, 'status' => 1));

				if(!($resetLinkCheck))
				{
					$code 	 =  	$this->passwordGenerator(50);
					$this->Defualt_Model->insert('reset_password', array('user' =>  $userId, 'reset_code' => $code , 'requested_at' => date('Y-m-d H:i:s')));
				}else{

					$code 	= 	$resetLinkCheck[0]->reset_code;
				}

				// Email Sent
				$resetlink =  base_url().'reset-password?reset-code='.$code;

				$fromUserId		=		1; //Admin
				$to				=		json_encode(array(['email' => $email]));
	
				$mailTitle 		= 		'reset_password';
				$template 		= 		$this->Mail_Model->template($mailTitle);
				$fromName		=		$template->from_name;
				$subject		=		$template->subject;
				$message 		= 		$template->message;
				$message 		= 		str_replace("**username**", $name, $message);
				$message 		= 		str_replace("**Reset-Password-Link**", "<a href='".$resetlink."'>Reset Password</a>", $message);

				$responce = $this->Mail_Model->send($fromUserId, $fromName, $to, $subject, $message, $cc = null);

				$this->session->set_flashdata('success', 'Password reset link has been sent.');
			}
			else{
				$this->session->set_flashdata('warning', 'Invalid User');
			}
		}
		else{
			$this->session->set_flashdata('warning', 'Email not found');
		}
 	

		redirect('User/login'); 
	}


	public function passwordGenerator($letterCount){
		$CapsAlpha 		= 	str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
		$SmallAlpha 	= 	str_shuffle("abcdefghijklmnopqrstuvwxyz");
		$digits			=	str_shuffle('1234567890');

		$mixedPassword = substr($CapsAlpha, 0, 10) . substr($SmallAlpha, 0, 10) . substr($digits, 0, 10);
		$finalPassword = str_shuffle($mixedPassword);
		return substr($finalPassword, 0, $letterCount);
	}

	public function ResetPassword(){
		$resetCode   		=  $_GET['reset-code'];
		$checkResetCode 	=  $this->Defualt_Model->findSelect('reset_password', array('id', 'user', 'reset_code'), array('reset_code' => $resetCode, 'status' => 1));

		if($checkResetCode){
			$data['requestId']		=	$checkResetCode[0]->id;
			$data['user']			=	$this->Defualt_Model->find('users', array('id' => $checkResetCode[0]->user, 'status' => 1));
			$this->load->view('user/reset-password', $data);
		}
		else
		{
			redirect('User/login'); 
		}

		if ($this->input->post()) {
			$requestId		=	$this->input->post('requestId');
			$userId			=	$this->input->post('user-id');
			$password 		= 	$this->input->post('reset-newpassword');
			$up_data = array('password' => password_hash($password, PASSWORD_DEFAULT));
			$res = $this->Defualt_Model->update('users',$up_data, array('id' => $userId));
			$this->Defualt_Model->update('reset_password', array('status' => 2, 'reset_at' => date('Y-m-d H:i:s')) ,array('id' => $requestId));
			($res > 0) ? $this->session->set_flashdata('success', 'Password Changed Successful. Login Now!') : '';
			redirect('User/login');
		}	
	}


	public function logout(){
		$this->session->sess_destroy();	
		redirect('User/login'); 
	}

}