<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping_cart extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_cart');
  }

  public function index(){

    $data['product'] = $this->M_cart->get()->result();
    $data['cart'] = $this->cart->contents();
    $this->load->view('index',$data);
  }

  public function beli(){
    $data = array(
      'id' => $this->input->post('id'),
      'name' => $this->input->post('nama'),
      'price' => $this->input->post('harga'),
      'gambar' => $this->input->post('gambar'),
      'qty' =>$this->input->post('qty'),
      'user_id'=>$this->session->userdata('user_id')
      );
    $this->cart->insert($data);
    redirect('Shopping_cart');
  }

  public function keranjang_belanja(){
    $data['cart'] = $this->cart->contents();
    $this->load->view('keranjang_belanja',$data);
  }

  public function ubah(){
    $cart_info = $_POST['cart'] ;
      foreach( $cart_info as $id => $cart)
      {
        $rowid = $cart['rowid'];
        $price = $cart['price'];
        $gambar = $cart['gambar'];
        $amount = $price * $cart['qty'];
        $qty = $cart['qty'];
        $data = array('rowid' => $rowid,
                'price' => $price,
                'gambar' => $gambar,
                'amount' => $amount,
                'qty' => $qty);
        $this->cart->update($data);
      }
    redirect('Shopping_cart/keranjang_belanja');
  }

  public function hapus($rowid){
    if ($rowid =="semua"){
        $this->cart->destroy();
    }else{
        $data = array('rowid' => $rowid,
                  'qty' =>0);
        $this->cart->update($data);
    }
    $this->session->set_flashdata('hapus', '<script>swal({
        title: "Keranjang Kosong",
        text: "Keranjang belanja sudah kosong",
        icon: "success",
        button: "Kembali",
      });</script>');   
    redirect('Shopping_cart/keranjang_belanja');
}

  public function bayar(){
    $cart = $this->cart->contents();
      foreach($cart as $item){
        $data = array(
          'id_order' => $item['id_order'],
          'id' => $item['id'],
          'qty' => $item['qty'],
          'subtotal' => $item['subtotal'],
          'user_id' => $item['user_id']
        );
        $this->M_cart->bayar($data);
      }
    $this->session->set_flashdata('berhasil', '<script>swal({
      title: "Pesanan Diterima",
      text: "Pesanan di terima silahkan konfirmasi pembayaran di profil anda",
      icon: "success",
      button: "Kembali",
    });</script>');  
    $this->cart->destroy();
    redirect('Shopping_cart/keranjang_belanja');
  }
}
