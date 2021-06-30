<?php

class Kategori extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_kategori');
	}

	function index()
	{
		$data['record'] = $this->Model_kategori->tampilkan_data();
		$this->template->load('template/template', 'Kategori/lihat_data', $data);
		$this->load->view('template/datatables');
	}

	function post()
	{
		if (isset($_POST['submit'])) {
			//proses kategori
			$id = $this->input->post('id');
			$nama = $this->input->post('nama_kategori');
			$data = array(
				'nama_kategori' => $nama
			);

			$this->Model_kategori->post($id, $data);
			$this->session->set_flashdata('message', 'Kategori berhasil ditambahkan!');
			redirect('kategori');
		} else {
			$this->template->load('template/template', 'Kategori/form_input');
		}
	}
	function edit()
	{
		if (isset($_POST['submit'])) {
			//proses kategori
			$id = $this->input->post('id');
			$nama = $this->input->post('nama_kategori');
			$data = array(
				'nama_kategori' => $nama
			);
			$this->Model_kategori->edit($id, $data);
			$this->session->set_flashdata('message', 'Kategori berhasil diubah!');
			redirect('kategori');
		} else {
			$id = $this->uri->segment(3);
			$data['record'] = $this->Model_kategori->get_one($id)->row_array();
			$this->template->load('template/template', 'kategori/form_edit', $data);
		}
	}

	function hapus()
	{
		$td = $this->uri->segment(3);
		$this->Model_kategori->hapus($td);
		redirect('kategori');
	}
}