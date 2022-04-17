<?php
class rop_model extends ci_model
{


  function data()
  {
    $this->db->order_by('id_rop', 'DESC');
    return $query = $this->db->get('rop');
  }

  public function dataJoin()
  {
    $this->db->select('*');
    $this->db->from('rop');
    $this->db->join('barang', 'barang.id_barang = barang.id_barang');
    $this->db->join('safety_stok', 'safety_stok.id_safety = safety_stok.id_safety');
    $this->db->order_by('r.id_rop', 'DESC');
    return $query = $this->db->get();
  }


  public function getLeadTime($lt)
  {

    return $this->db->get_where('view_rop', ['lead_time' => $lt])->result();
  }

  public function detailJoin($where)
  {
    $this->db->select('*');
    $this->db->from('rop as r');
    $this->db->where('b.id_barang', $where);
    $this->db->join('r.lead_time', 'r.safety_stok');
    $this->db->where('r.id_rop', $where);
    $this->db->order_by('r.id_rop', 'DESC');
    return $query = $this->db->get();
  }


  public function ambilId($table, $where)
  {
    return $this->db->get_where($table, $where);
  }



  public function hapus_data($where, $table)
  {
    $this->db->where($where);
    $this->db->delete($table);
    if ($this->db->affected_rows() == 1) {
      return TRUE;
    }
    return false;
  }


  public function detail_data($where, $table)
  {
    return $this->db->get_where($table, $where);
  }

  public function tambah_data($data, $table)
  {
    $this->db->insert($table, $data);
  }

  public function ubah_data($where, $data, $table)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }


  //   public function buat_kode()   {
  // 	  $this->db->select('RIGHT(safety_stok.id_safety_stok,4) as kode', FALSE);
  // 	  $this->db->order_by('id_safety_stok','DESC');
  // 	  $this->db->limit(1);
  // 	  $query = $this->db->get('safety_stok');      //cek dulu apakah ada sudah ada kode di tabel.
  // 	  if($query->num_rows() <> 0){
  // 	   //jika kode ternyata sudah ada.
  // 	   $data = $query->row();
  // 	   $kode = intval($data->kode) + 1;
  // 	  }
  // 	  else {
  // 	   //jika kode belum ada
  // 	   $kode = 1;
  // 	  }
  // 	  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
  // 	  $kodejadi = "BRG-M-".$kodemax;    // hasilnya 
  // 	  return $kodejadi;
  // }





}
