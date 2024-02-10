<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->model('Defualt_Model'); 
        $this->load->model('Mail_Model'); 
    }

    public function MailTemplates(){
        $data['page_name']      =   'Mail Templates';
        $data['templates']      =   $this->Defualt_Model->all('mail_template');
        $this->load->view('Mail/mail-templates', $data);
    }   

    public function NewMail(){
        $data['page_name']      =   'New Mail';
        $this->load->view('Mail/new-mail', $data);
    }


    public function addNewMail(){
        if($this->input->post()){

            $insData   =      [
                'title'         =>      $this->input->post('title'),
                'subject'       =>      $this->input->post('subject'),
                'from_name'     =>      $this->input->post('fromName'),
                'message'       =>      $this->input->post('message'),
                'added_by'      =>      $this->session->userdata('userid'),
                'created_at'    =>      date('Y-m-d h:s:i'),
            ];

            $this->Defualt_Model->insert('mail_template',$insData);
        }
    }

    public function editMail(){
        ini_set('display_errors', 1);
        $mailId                 =    $this->uri->segment(3);
        $data['page_name']      =   'Edit Mail';
        $data['mail']           =    $this->Defualt_Model->find('mail_template', array('id' => $mailId));
        $this->load->view('Mail/edit-mail', $data);

        if($this->input->post()){
            $setData   =      [
                'title'         =>      $this->input->post('title'),
                'from_name'     =>      $this->input->post('fromName'),
                'subject'       =>      $this->input->post('subject'),
                'message'       =>      $this->input->post('message'),
                'added_by'      =>      $this->session->userdata('userid'),
                'created_at'    =>      date('Y-m-d h:s:i'),
            ];

            $this->Defualt_Model->update('mail_template',$setData, array('id' => $this->input->post('mailId')));
        }
    }

    public function deleteMail(){
        ini_set('display_errors', 1);
        $mailId                 =    $this->uri->segment(3);
        $this->Defualt_Model->delete('mail_template', array('id' => $mailId));
        redirect('Mail/MailTemplates');
    }




}