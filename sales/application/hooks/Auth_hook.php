<?php

class Auth_hook
{
    public function check_authentication()
    {
        $CI =& get_instance();

        $excluded_pages = array('User', 'Client');
        $excluded_methods = array('login', 'addDocsAPI', 'ForgotPassword', 'ResetPassword');

        $controller = $CI->router->fetch_class();
        $method = $CI->router->fetch_method();

        if (!in_array($controller, $excluded_pages) || !in_array($method, $excluded_methods)) {
            if (!$CI->session->userdata('userid')) {
                redirect('User/login');
            }
        }
    }
}
