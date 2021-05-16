<?php

class Model_sbarang extends CI_Model
{

    function tampil_data()
	{
		return 
		$this->db
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


    function tampil_nmbrg(){
        return
        $this->db->where('status !=' ,1)->order_by('id_barang', 'ASC')->get('baranginv')->result(); 
    }

	function edit($id,$data)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('baranginv', $data);
	}

    function hapus_trf($id)
    {
        $this->db->where('id', $id)->delete('detail_penjualan');
    }

    function hapus_id($id)
    {
        $this->db->where('id_dtlpen', $id)->delete('penjualan');
    }
}