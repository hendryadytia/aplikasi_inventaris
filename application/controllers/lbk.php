<?php


class lbk extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        chek_session();
        $this->load->model('Model_lbk');
    }


    function index($start = null, $end = null)
    {
        if (isset($_POST['search'])) {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $data['barangkeluar'] = $this->Model_lbk->get_range($start, $end);
            $this->template->load('template/template', 'lbk/lihat_data', $data);
            $this->load->view('template/datatables');
        } elseif (isset($_GET['tgl'])) {
            $start = $_GET['tgl'];
            $end = $_GET['tgl'];
            $data['barangkeluar'] = $this->Model_lbk->get_range($start, $end);
            $this->template->load('template/template', 'lbk/lihat_data', $data);
            $this->load->view('template/datatables');
        } else {
            $data['barangkeluar'] = $this->Model_lbk->tampil_data();
            $this->template->load('template/template', 'lbk/lihat_data', $data);
            $this->load->view('template/datatables');
        }
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

                $this->Model_lbk->edit($id, $data);
                $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
                redirect('lbk');
            
        } else {
         
            $data['nm_brg'] = $this->Model_lbk->tampil_nmbrg();
            $this->template->load('template/template', 'lbk/form_input', $data);
        }
    }


    function edit()
    {
        if (isset($_POST['submit'])) {
            
            // proses barang
            $id = $this->input->post('id');
            $tgl_keluar = $this->input->post('tgl_keluar'); 
            $data = array(
                'tgl_keluar' => $tgl_keluar,
            );

                $this->Model_lbk->edit($id, $data);
                $this->session->set_flashdata('message', 'Data Barang berhasil dirubah!');
                redirect('lbk');
            
        } else {
            $id =  $this->uri->segment(3);
            $this->load->model('Model_kategori');
            $data['record']     =  $this->Model_lbk->get_one($id)->row_array();
            $this->template->load('template/template', 'lbk/form_edit', $data);
        }
    }

    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_lbk->hapus($id);
        $this->session->set_flashdata('message', 'Data Barang berhasil dihapus!');
        redirect('lbk');
    }
}