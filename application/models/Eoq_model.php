<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eoq_model extends CI_Model
{
  function data()
  {
    $this->db->order_by('id_eoq', 'DESC');
    return $query = $this->db->get('eoq');
  }
  // ------------------------------------------------------------------------
  public function join()
  {
    $this->db->select('*');
    $this->db->from('eoq');
    $this->db->join('barang', 'barang.id_barang = eoq.id_barang');
    $this->db->join('pemesanan', 'pemesanan.id_pemesanan = eoq.id_pemesanan');
    $this->db->join('safety_stok', 'safety_stok.id_safety = eoq.id_safety');
    $this->db->join('rop', 'rop.id_rop = eoq.id_rop');
    $this->db->order_by('eoq.id_eoq', 'DESC');
    return  $this->db->get('');
  }

  // ------------------------------------------------------------------------

}

/* End of file Eoq_model.php */
/* Location: ./application/models/Eoq_model.php */