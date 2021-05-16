<?php

class Model_lbm extends CI_Model{

	function tampil_data()
	{
		return 
		$this->db
		->where('status !=' ,1)
		->join('kategori','kategori.id_kategori = baranginv.id_kerusakan','left')
		->get('baranginv')->result();
	}

	function tampil_data2(){
		return $this->db->get('stok')->result();
	}

	function post($data)
	{
		$this->db->insert('baranginv', $data);
	}

	function get_one($id)
	{
		$param = array ('id_barang'=>$id);
		return $this->db->get_where('baranginv', $param);
	}

	function edit($id,$data)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('baranginv', $data);
	}

	function tambah_stok($id,$data)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('stok', $data);
	}

	function hapus($id)
	{
		$this->db->where('id_barang', $id);
		$this->db->delete('baranginv');
	}
	
	function get_stok($id){
		$param = array('id_barang' => $id);
		return $this->db->get_where('stok',$param)->row();
	}

	
    function get_range($start, $end)
    {
            return $this->db
				->where('status !=' ,1)
                ->where("tgl_masuk >=", $start)
                ->where("tgl_masuk <=", $end)
				->join('kategori','kategori.id_kategori = baranginv.id_kerusakan','left')
                ->order_by('id_barang', 'ASC')
                ->get('baranginv')->result();
      
    }
    
}