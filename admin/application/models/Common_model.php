<?php

class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function getCount($product = null)
    {
      $this->db->select('COUNT(*) as client_count');
      $this->db->from('clients');
      ($product != null) ? $this->db->where('product',$product) : '' ;
      // $this->db->where('YEAR(created_at)', date('Y'));
      // $this->db->where('MONTH(created_at)', date('m'));
      
      $query = $this->db->get();
      $result = $query->row();
      return ($result) ? $result->client_count : 0;
    }

    public function ExplodeProductName($product_id){
      $val = '';                                                                
      $productArry = json_decode($product_id);
      foreach ($productArry as $key => $product) {
        $arr = $this->Defualt_Model->findSelect('products', array('product_name'), array('id' => $product));
        $product_names = array_column($arr, 'product_name');
        $result_string = implode(', ', $product_names);
        $val = $val.', '.$result_string;     
      }   
      return substr($val, 1); 
    }

    public function ExplodeArray($jsonValue){
      $val = '';                                                                
      $array = json_decode($jsonValue, true); // Use true to decode as an associative array
      foreach ($array as $item) {
          $val .= $item . ', '; 
      }
      return rtrim($val, ', '); 
  }
  public function dateFormat($value){
    $dateTime = new DateTime($value);
    return $dateTime->format('d M Y');
  }

  public function dateTimeFormat($value){
    $dateTime = new DateTime($value);
    return $dateTime->format('d M Y, h:i A');
  }

  public function loadSettings() {
    $query = $this->db->get('crm_settings');
    return $query->result_array();
  }

  function findSettings($array, $key) {
    foreach ($array as $item) {
        if ($item['_key'] === $key) {
            return $item;
        }
    }
    return null; 
  }


}