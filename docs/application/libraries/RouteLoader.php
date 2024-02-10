<?php

// application/libraries/RouteLoader.php

class RouteLoader {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    public function loadRoutes() {
        $routes = $this->CI->db->get('routes')->result_array();
        foreach ($routes as $row) {
            $this->CI->config->set_item($row['url'], $row['controller'] . '/' . $row['method']);
        }
    }
}
