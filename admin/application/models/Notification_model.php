<?php

class Notification_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // Load Pusher library
        require __DIR__ . '/../../vendor/autoload.php'; // Adjusted the path
    }

    public function sendNotification()
    {
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            'e1f1cdb3fb62f16eb305',
            '633e653edc5713fe7a33',
            '1718201',
            $options
          );
        
          $data['message'] = 'hello world';
          $pusher->trigger('my-channel', 'my-event', $data);
    }
}
