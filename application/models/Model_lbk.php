<?php

class Model_lbk extends CI_Model
{

    function tampil_data()
	{
		return 
		$this->db
		->where('status !=' ,0)
		->join('kategori','kategori.id_kategori = baranginv.id_kerusakan','left')
		->get('baranginv')->result();
	}
    function get_metode()
    {
        return $this->db->get('pembayaran')->result();
    }

    function get_one($id)
	{
		$param = array ('id_barang'=>$id);
		return $this->db->get_where('baranginv', $param);
	}


    function get_range($start, $end)
    {
            return $this->db
                ->where('status !=' ,0)
                ->where("tgl_keluar >=", $start)
                ->where("tgl_keluar <=", $end)
                ->join('kategori','kategori.id_kategori = baranginv.id_kerusakan','left')
                ->order_by('id_barang', 'ASC')
                ->get('baranginv')->result(); 
    }
    
    function tampil_nmbrg(){
        return
        $this->db->where('status !=' ,1)->order_by('id_barang', 'ASC')->get('baranginv')->result(); 
    }

	function edit($id,$data)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('baranginv', $data);
	}
    
    function hapus($id)
	{
		$this->db->where('id_barang', $id);
		$this->db->delete('baranginv');
	}

}