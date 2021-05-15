<?php

class lbm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
        $this->load->model('Model_lbm');
    }


    function index()
    {
        if (isset($_POST['search'])) {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $metode = $this->input->post('metode');
            $data['stok'] = $this->Model_laporan->get_range($start, $end, $metode);
            $data['metode'] = $this->Model_laporan->get_metode();
            $this->template->load('template/template', 'lbm/lihat_data', $data);
            $this->load->view('template/datatables');
        } elseif (isset($_GET['tgl'])) {
            $start = $_GET['tgl'];
            $end = $_GET['tgl'];
            $metode = '';
            $data['stok'] = $this->Model_laporan->get_range($start, $end, $metode);
            $this->template->load('template/template', 'lbm/lihat_data', $data);
            $this->load->view('template/datatables');
        } else {
            $data['stok'] = $this->Model_lbm->tampil_data();
            $this->template->load('template/template', 'lbm/lihat_data', $data);
            $this->load->view('template/datatables');
        }
        
    }

    function post()
    {
        if (isset($_POST["submit"])) {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 1024;
            $config['max_width']            = 6000;
            $config['max_height']           = 6000;
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
                return false;
            } else {
                // proses barang
                $id = $this->input->post('id');
                $nama = $this->input->post('nama_barang');
                $kategori = $this->input->post('kategori');
                $harga = $this->input->post('harga');
                $ukuran = $this->input->post('ukuran');
                $foto = $this->upload->data('file_name');
                $data = array(
                    'nama_barang' => $nama,
                    'id_kategori' => $kategori,
                    'ukuran' => $ukuran,
                    'harga' => $harga,
                    'foto' => $foto,
                );
                $this->Model_barang->post($data, $id);
                $this->session->set_flashdata('message', 'Data Barang berhasil ditambahkan!');
                redirect('lbm');
            }
        } else {
            $id = $this->uri->segment(3);
            $data['error'] = $this->upload->display_errors();
            $this->load->model("Model_kategori");
            $data['kategori'] =  $this->Model_kategori->tampilkan_data();
            $data['record'] = $this->Model_barang->get_one($id)->row_array();
            $data['ukuran'] = $this->Model_barang->tampilkan_ukuran()->result();
            $this->template->load("template/template", "lbm/form_input", $data);
        }
    }


    function edit()
    {
        if (isset($_POST['submit'])) {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 1024;
            $config['max_width']            = 6000;
            $config['max_height']           = 6000;
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
                return false;
            } else {
                $id         =   $this->input->post('id');
                $foto = $this->Model_barang->get_one($id)->row_array()['foto'];
                $path = $this->upload->data('file_path');
                $uploads = $path . $foto;
                if (unlink($uploads)) {
                    echo 'deleted successfully';
                } else {
                    echo 'errors occured';
                }
                $nama       =   $this->input->post('nama_barang');
                $kategori   =   $this->input->post('kategori');
                $harga      =   $this->input->post('harga');
                $ukuran     =   $this->input->post('ukuran');
                $foto = $this->upload->data('file_name');
                $data       = array(
                    'nama_barang' => $nama,
                    'id_kategori' => $kategori,
                    'ukuran' => $ukuran,
                    'harga' => $harga,
                    'foto' => $foto,
                );
                $this->Model_barang->edit($data, $id);
                $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
                redirect('lbm');
            }
        } else {
            $id =  $this->uri->segment(3);
            $this->load->model('Model_kategori');
            $data['kategori']   =  $this->Model_kategori->tampilkan_data();
            $data['record']     =  $this->Model_barang->get_one($id)->row_array();
            $data['ukuran'] = $this->Model_barang->tampilkan_ukuran()->result();
            $this->template->load('template/template', 'lbm/form_edit', $data);
        }
    }
    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_barang->hapus($id);
        $this->session->set_flashdata('message', 'Data Barang berhasil dihapus!');
        redirect('lbm');
    }
}