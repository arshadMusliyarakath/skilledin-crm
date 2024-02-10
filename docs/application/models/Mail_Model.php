<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function configuration($userId) {
        $this->db->select('*');
        $this->db->from('mail_config');  
        $this->db->where('client', $userId);
        return $this->db->get()->row();
    }

    public function send($userId, $fromName, $to, $subject, $messageText, $cc = null) {
     
        $url    = 'https://accentcarehome.com/mail/send';

        $message = "<html><body>";
        $message = $message.$messageText;
        $message = str_replace("<p>", "<p style='margin:0px'>", $message);
        $message = $message."</body></html>";

        $to     =   '[{"email":"arssshu.demo@gmail.com", "sender" : "Test Arshad"}]'; //temporary email

        $data = array(
            // 'username'  => $this->configuration($userId)->smtp_user,
            // 'password'  => $this->configuration($userId)->smtp_password,

            'username'  => $this->configuration(1)->smtp_user, //temp
            'password'  => $this->configuration(1)->smtp_password, //temp

            'to'        => $to,
            'from-name' => $fromName,
            'subject'   => $subject,
            'message'   => $message,
            'cc'        => $cc
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if(curl_errno($ch)){
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
        return $response;
        
    }

    public function template($title){
        $this->db->select('*');
        $this->db->from('mail_template');  
        $this->db->where('title', $title);
        return $this->db->get()->row();
    }



}
