<?php


class sbarang extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        chek_session();
        $this->load->model('Model_sbarang');
    }


    function index($start = null, $end = null)
    {
   
            $data['barangkeluar'] = $this->Model_sbarang->tampil_data();
            $this->template->load('template/template', 'sbarang/lihat_data', $data);
            $this->load->view('template/datatables');
        
    }

    function post()
    {
        if (isset($_POST['submit'])) {
            
            // proses barang
            $id = $this->input->post('nama_barang');
            $tgl_keluar = $this->input->post('tgl_keluar'); 
            $status = 1;
            $data = array(
                'tgl_keluar' => $tgl_keluar,
                'status' => $status
            );

                $this->Model_sbarang->edit($id, $data);
                $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
                redirect('lbk');
            
        } else {
         
            $data['nm_brg'] = $this->Model_sbarang->tampil_nmbrg();
            $this->template->load('template/template', 'sbarang/form_input', $data);
        }
    }


    function edit()
    {
        if (isset($_POST['submit'])) {
            
            // proses barang
            $id = $this->input->post('id');
            $nama = $this->input->post('nama_barang');
            $no_invn =  $this->input->post('no_invn');
            $pemilik = $this->input->post('pemilik');
            $id_kerusakan = $this->input->post('id_kerusakan');
            $tgl_masuk = $this->input->post('tgl_masuk'); 
            $tgl_keluar = $this->input->post('tgl_keluar'); 
            $data = array(
                'nama_barang' => $nama,
                'no_invn' => $no_invn,
                'pemilik' => $pemilik,
                'id_kerusakan' => $id_kerusakan,
                'tgl_masuk' => $tgl_masuk,
                'tgl_keluar' => $tgl_keluar,
            );

                $this->Model_sbarang->edit($id, $data);
                $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
                redirect('sbarang');
            
        } else {
            $id =  $this->uri->segment(3);
            $this->load->model('Model_kategori');
            $data['kategori']   =  $this->Model_kategori->tampilkan_data();
            $data['record']     =  $this->Model_sbarang->get_one($id)->row_array();
            $this->template->load('template/template', 'sbarang/form_edit', $data);
        }
    }

    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_sbarang->hapus($id);
        $this->session->set_flashdata('message', 'Data Barang berhasil dihapus!');
        redirect('sbarang');
    }
}