<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('barang_model');
	$this->load->model('pemesanan_model');
  }
	
	public function index()
	{
		$data['title'] = 'pemesanan';
		$data['pemesanan'] = $this->pemesanan_model->dataJoin()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pemesanan/index');
		$this->load->view('templates/footer');
	}

	// public function laporan()
	// {
	// 	$data['title'] = 'Laporan Barang Masuk';

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('pemesanan/laporan');
	// 	$this->load->view('templates/footer');
	// }

	public function getpemesanan()
	{
    	$data = $this->pemesanan_model->dataJoin()->result();
    	echo json_encode($data);
	}

	public function filterpemesanan($tglawal, $tglakhir)
	{
      	$data = $this->pemesanan_model->lapdata($tglawal, $tglakhir)->result();
    	echo json_encode($data);
	}


	public function getBarang()
	{
		$id = $this->input->post('id');
    	$where = array('id_barang' => $id );
    	$data = $this->barang_model->detail_data($where, 'barang')->result();
    	echo json_encode($data);
	}

	// public function getTotalStok()
	// {
	// 	$id = $this->input->post('id');
	// 	$where = array('id_barang'=>$id);
    // 	$data = $this->db->select_sum('qty')->from('barang_masuk')->where($where)->get();
    //     $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where($where)->get();
	// 	$bm = $data->row();
	// 	$bk = $data2->row();
	// 	$hasil = intval($bm->qty) - intval($bk->jumlah_keluar);
	// 	$total = array('total'=>$hasil);
	// 	echo json_encode($total);
	// }

	public function proses_hapus($id,$jml,$idb)
	{
		$where = array('id_pemesanan'=>$id);
		$this->barang_model->hapus_data($where, 'barang_masuk');


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
		redirect('barang_masuk');
	}

	public function tambah()
	{
        $data['title'] = 'Pemesanan';

        // $data['kode'] = $this->pemesanan_model->buat_kode();
        
		$data['barang'] = $this->barang_model->data()->result();
        $data['jmlbarang'] = $this->barang_model->data()->num_rows();
        
        // $data['supplier'] = $this->supplier_model->data()->result();
        // $data['jmlsupplier'] = $this->supplier_model->data()->num_rows();
        
		$data['tglnow'] = date('m/d/Y');

		$this->load->view('templates/header', $data);
		$this->load->view('pemesanan/form_tambah');
		$this->load->view('templates/footer');
	}

	public function ubah($id)
	{
		$data['title'] = 'Pemesanan';
		// $data['supplier'] = $this->supplier_model->data()->result();
		// $data['jmlsupplier'] = $this->supplier_model->data()->num_rows();

		//menampilkan data berdasarkan id
		$data['data'] = $this->pemesanan_model->detailJoin($id)->result();


		$this->load->view('templates/header', $data);
		$this->load->view('pemesanan/form_ubah');
		$this->load->view('templates/footer');
	}

	public function proses_tambah()
	{
        $id 		= $this->input->post('id');
        $tgl 		= $this->input->post('tgl');
		$barang 	= $this->input->post('barang');
        $qty 		= $this->input->post('jumlah');
		$bpesan 	= $this->input->post('biayapemesanan');
		$bpenyimpan = $this->input->post('biayapenyimpanan');
		$bpmlhr 	= $this->input->post('biayapemeliharaan');
		$explode 	= explode("/", $tgl);
      	$tglpesan 	= $explode[2].'-'.$explode[0].'-'.$explode[1];

		
		$data=array(
			'id_pemesanan'=>$id,
			'tgl_pesan'=>$tglpesan,
			'id_barang'=> $barang,
			'jumlah'=>$qty,
			'biaya_pemesanan'=>$bpesan,
			'biaya_penyimpanan'=>$bpenyimpan,
			'biaya_pemeliharaan'=>$bpmlhr,
		);

		$where = array('id_pemesanan' => $id);

		$this->pemesanan_model->tambah_data($data, 'pemesanan');
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
    	redirect('pemesanan');
	}
	

	public function proses_ubah()
	{
		$kode = $this->input->post('idbm');
		$barang = $this->input->post('barang');
		// $supplier = $this->input->post('supplier');
		$tgl = $this->input->post('tgl');
		$qty = $this->input->post('qty');
		$qtylama = $this->input->post('qtylama');

		$explode = explode("/", $tgl);
      	$tglmasuk = $explode[2].'-'.$explode[0].'-'.$explode[1];
		
		$data=array(
			'id_barang'=> $barang,
			// 'id_supplier'=>$supplier,
			'qty'=>$qty,
			'tgl_masuk'=>$tglmasuk
		);
		$where = array('id_barang_masuk'=>$kode);

		$this->pemesanan_model->ubah_data($where, $data, 'pemesanan');
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
    	redirect('barang_masuk');
	}

	
}