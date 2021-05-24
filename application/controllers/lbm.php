<?php

class lbm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        chek_session();
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
        $this->load->model('Model_lbm');
    }


   
    function index($start = null, $end = null)
    {
        if (isset($_POST['search'])) {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $data['barangmasuk'] = $this->Model_lbm->get_range($start, $end);
            $this->template->load('template/template', 'lbm/lihat_data', $data);
            $this->load->view('template/datatables');
        } elseif (isset($_GET['tgl'])) {
            $start = $_GET['tgl'];
            $end = $_GET['tgl'];
            $data['barangmasuk'] = $this->Model_lbm->get_range($start, $end);
            $this->template->load('template/template', 'lbm/lihat_data', $data);
            $this->load->view('template/datatables');
        } else {
            $data['barangmasuk'] = $this->Model_lbm->tampil_data();
            $this->template->load('template/template', 'lbm/lihat_data', $data);
            $this->load->view('template/datatables');
        }
    }

    function post()
    {
        if (isset($_POST["submit"])) {
        
            // proses barang
            $id = $this->input->post('id');
            $nama = $this->input->post('nama_barang');
            $no_invn =  $this->input->post('no_invn');
            $pemilik = $this->input->post('pemilik');
            $id_kerusakan = $this->input->post('id_kerusakan');
            $tgl_masuk = $this->input->post('tgl_masuk'); 
       
            $data = array(
                'nama_barang' => $nama,
                'no_invn' => $no_invn,
                'pemilik' => $pemilik,
                'id_kerusakan' => $id_kerusakan,
                'tgl_masuk' => $tgl_masuk,
            );

            $this->Model_lbm->post($data, $id);
            $this->session->set_flashdata('message', 'Data Barang berhasil ditambahkan!');
            redirect('lbm');
        
        } else {
            $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            $this->load->model("Model_kategori");
            $data['kategori'] =  $this->Model_kategori->tampilkan_data();
            $this->template->load("template/template", "lbm/form_input", $data);
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
       
            $data = array(
                'nama_barang' => $nama,
                'no_invn' => $no_invn,
                'pemilik' => $pemilik,
                'id_kerusakan' => $id_kerusakan,
                'tgl_masuk' => $tgl_masuk,
            );

                $this->Model_lbm->edit($id, $data);
                $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
                redirect('lbm');
            
        } else {
            $id =  $this->uri->segment(3);
            $this->load->model('Model_kategori');
            $data['kategori']   =  $this->Model_kategori->tampilkan_data();
            $data['record']     =  $this->Model_lbm->get_one($id)->row_array();
            $this->template->load('template/template', 'lbm/form_edit', $data);
        }
    }
    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_lbm->hapus($id);
        $this->session->set_flashdata('message', 'Data Barang berhasil dihapus!');
        redirect('lbm');
    }
}