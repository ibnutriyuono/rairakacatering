<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cart extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function get(){
    return $this->db->get('posts');
  }

  public function bayar($data){
    return $this->db->insert('order',$data);
  }

}
