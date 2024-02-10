<?php

require_once APPPATH . '../vendor/autoload.php';

use Pusher\Pusher;

class Pusher_lib extends Pusher
{
    public function __construct()
    {
        // Your Pusher credentials and options
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        parent::__construct(
            '556376f0d41bd141cd21',
            'a19b5d975b6e3a7cf8c9',
            '1720517',
            $options
        );
    }
}
