<?php

class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function productName($productId)
    {
        $this->db->select('product_name');
        $this->db->from('products');
        $this->db->where('id', $productId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->product_name;
        } else {
            return null;
        }
    }

    public function getUploadedDocswithStatus($clientId) {
        $this->db->select('cd.*, cud.client, cud.file_name, cud.document, cud.added_by, cud.created_at, cud.status as up_status, cud.doc_name, cud.id as upDoc_id');
        $this->db->from('client_uploaded_documents cud');
        $this->db->join('client_documents cd', 'cd.id = cud.document', 'left');   
        $this->db->where('cud.client', $clientId);
        $this->db->order_by('cud.id', 'DESC');
        return $this->db->get()->result();
    }


    public function getCount($product = null)
    {
      $this->db->select('COUNT(*) as client_count');
      $this->db->from('clients');
      ($product != null) ? $this->db->where('product',$product) : '' ;
      $this->db->where('YEAR(created_at)', date('Y'));
      $this->db->where('MONTH(created_at)', date('m'));
      
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
  
}