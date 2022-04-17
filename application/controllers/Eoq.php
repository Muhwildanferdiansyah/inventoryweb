<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eoq extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
    $this->load->library('pagination');
    $this->load->helper('cookie');
    $this->load->model('Eoq_model');
  }

  public function index()
  {
    $data['title'] = 'Transaksi EOQ';
    $data['eoq'] = $this->Eoq_model->join()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('eoq/index');
		$this->load->view('templates/footer');

  }

}


/* End of file Eoq.php */
/* Location: ./application/controllers/Eoq.php */