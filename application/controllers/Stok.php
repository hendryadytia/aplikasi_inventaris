<?php

class Stok extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
        $this->load->model('Model_stok');
    }


    function index()
    {
        if (isset($_POST['search'])) {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $metode = $this->input->post('metode');
            $data['stok'] = $this->Model_laporan->get_range($start, $end, $metode);
            $data['metode'] = $this->Model_laporan->get_metode();
            $this->template->load('template/template', 'laporan/lihat_data', $data);
            $this->load->view('template/datatables');
        } elseif (isset($_GET['tgl'])) {
            $start = $_GET['tgl'];
            $end = $_GET['tgl'];
            $metode = '';
            $data['stok'] = $this->Model_laporan->get_range($start, $end, $metode);
            $this->template->load('template/template', 'laporan/lihat_data', $data);
            $this->load->view('template/datatables');
        } else {
            $data['stok'] = $this->Model_stok->tampil_data();
            $this->template->load('template/template', 'stok/lihat_data', $data);
            $this->load->view('template/datatables');
        }
        
    }

    function post()
    {
        if (isset($_POST["submit"])) {
            $barang = $this->input->post('barang');
            $stok = $this->Model_stok->get_stok($barang);
            if ($stok != NULL) {
                $stok_sebelumnya = $this->Model_stok->get_stok($barang)->stok_barang;
                $stok_baru = $this->input->post('stok');
                $hasil = intval($stok_sebelumnya) + intval($stok_baru);
                if ($hasil >= 1000) {
                    $this->session->set_flashdata('message', 'Kapasitas Stok Barang Telah melebihi Batas Maksimum!');
                    redirect('stok');
                } else {
                    $data = array(
                        'id_barang' => $barang,
                        'stok_barang' => $hasil,
                        'tanggal_stok' => date('Y-m-d')
                    );
                    $this->Model_stok->tambah_stok($barang, $data);
                    redirect('stok');
                }
            } else {
                $stok = $this->input->post('stok');
                $data = array(
                    'id_barang' => $barang,
                    'stok_barang' => $stok,
                    'tanggal_stok' => date('Y-m-d')
                );
                $this->Model_stok->post($data);
                redirect('stok');
            }
        } else {
            $id = $this->uri->segment(3);
            $data['barang'] =  $this->Model_barang->tampil_dropdown()->result();
            $this->template->load("template/template", "stok/form_input", $data);
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            $id         =   $this->input->post('id');
            $barang     =   $this->input->post('barang');
            $stok       =   $this->input->post('stok');
            if (intval($stok) >= 1000) {
                $this->session->set_flashdata('message', 'Stok Barang Yang Dimasukkan Telah melebihi Batas Maksimum!');
                redirect('stok');
            } else {
                $data       =   array(
                    'id_barang' => $barang,
                    'stok_barang' => $stok
                );
                $this->Model_stok->edit($id, $data);
                redirect('stok');
            }
        } else {
            $id =  $this->uri->segment(3);
            $data['barang'] =  $this->Model_barang->tampil_dropdown()->result();
            $data['stok']   =  $this->Model_stok->get_one($id)->row_array();
            $this->template->load('template/template', 'stok/form_edit', $data);
        }
    }

    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_stok->hapus($id);
        redirect('stok');
    }
}