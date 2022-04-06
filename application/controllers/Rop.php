<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rop extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('rop_model');
	$this->load->model('barang_model');
	$this->load->model('safety_model');
  }
	
	public function index()
	{
		$data['title'] = 'Reorder Point';
		$data['rop'] = $this->rop_model->dataJoin()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('rop/index');
		$this->load->view('templates/footer');
	}
	public function getrop()
	{
    	$data = $this->rop_model->data()->result();
    	echo json_encode($data);
	}

	public function getBarang()
	{
		$id = $this->input->post('id');
    	$where = array('id_barang' => $id );
    	$data = $this->rop_model->detail_data($where, 'view_rop')->result();
    	echo json_encode($data);
	}

	public function getLeadTime()
	{
		$lt = $this->input->post('shari');
		$data = $this->rop_model->getLeadTime($lt);
		$this->output->st_content_type('application/json')->set_output(json_encode($data));
	}

	public function proses_hapus($id)
	{
		$where = array('id_rop'=>$id);
		$this->safety_model->hapus_data($where, 'view_rop');


		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil dihapus!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
		redirect('rop');
	}

	public function tambah()
	{
        $data['title'] = 'Reorder Point';   
		$data['barang'] = $this->rop_model->dataJoin()->result();
		$data['tglnow'] = date('m/d/Y');

		$this->load->view('templates/header', $data);
		$this->load->view('rop/form_tambah');
		$this->load->view('templates/footer');
	}

	public function ubah($id)
	{
		$data['title'] = 'Reorder Point';
		//menampilkan data berdasarkan id
		$data['data'] = $this->rop_model->detailJoin($id)->result();


		$this->load->view('templates/header', $data);
		$this->load->view('rop/form_ubah');
		$this->load->view('templates/footer');
	}

	public function proses_tambah()
	{
		$id_rop =$this->input->post('id_rop');
        $id_safety 	= $this->input->post('id_safety');
        $tgl 	= $this->input->post('tgl');
		$barang = $this->input->post('barang');
		$barang = $this->rop_model->get();
		$pmr 	= $this->input->post('pmr');
		$ltd 	= $this->input->post('ltd');
		$lt 	= $this->input->post('shari');
        $st 	= $this->input->post('sstok');
		$rop		=$this->input->post('rop');

		$explode = explode("/", $tgl);
      	$tglrop = $explode[2].'-'.$explode[0].'-'.$explode[1];

		
		$data=array(
			'id_rop' =>$id_rop,
			'id_safety'=>$id_safety,
			'id_barang'=> $barang,
			'pemakaian_rata'=>$pmr,
			'lead_time_demand'=>$ltd,
			'lead_time'=>$lt,
			'safety_stok'=>$st,
			'rop'=>$rop,
			'tgl_rop'=>$tglrop,

		);

		$where = array('id_barang' => $barang);

		$this->rop_model->tambah_data($data, 'rop');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil ditambahkan!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
    	redirect('rop');
	}
	

	public function proses_ubah()
	{
		$kode = $this->input->post('idbm');
		$barang = $this->input->post('barang');
		$supplier = $this->input->post('supplier');
		$tgl = $this->input->post('tgl');
		$jmlmasuk = $this->input->post('jmlmasuk');
		$jmlmasuklama = $this->input->post('jmlmasuklama');

		$explode = explode("/", $tgl);
      	$tglmasuk = $explode[2].'-'.$explode[0].'-'.$explode[1];
		
		$data=array(
			'id_barang'=> $barang,
			'id_supplier'=>$supplier,
			'jumlah_masuk'=>$jmlmasuk,
			'tgl_masuk'=>$tglmasuk
		);
		$where = array('id_safety_stok'=>$kode);

		$this->safety_model->ubah_data($where, $data, 'safety_stok');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil diubah!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
    	redirect('rop');
	}

	
}