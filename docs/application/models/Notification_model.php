<?php

class Notification_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // Load Pusher library
        require __DIR__ . '/../../vendor/autoload.php'; // Adjusted the path
    }

    public function sendNotification($notify)
    {
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            '41671e855cbf4c922a1d',
            '02ddf2f6395391688942',
            '1717966',
            $options
          );
        
          $pusher->trigger('my-channel', 'my-event', $notify);
    }
}
