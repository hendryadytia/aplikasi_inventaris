<?php
class Dashboard extends CI_controller
{


    public function __construct()
    {
        parent::__construct();
        chek_session();
        $this->load->model('Model_dashboard');
    }


    function index()
    {
        $data['box'] = $this->box();
        $data['graph'] = $this->Model_dashboard->graph_stok();
        $data['kategori'] = $this->Model_dashboard->graph_kategori();
        $data['laris'] = $this->Model_dashboard->barang_laris();
        $this->template->load('template/template', 'dashboard/lihat_dashboard', $data);
        // var_dump($this->session->userdata());
        // die;
    }

    public function box()
    {

        $box = [
            [
                'box'         => 'light-blue',
                'total'     => $this->Model_dashboard->total('barang'),
                'title'        => 'Total Barang',
                'link'    => 'Barang',
                'icon'        => 'cubes'
            ],
            [
                'box'         => 'olive',
                'total'     => $this->Model_dashboard->total('kategori'),
                'title'        => 'Kategori Barang',
                'link'    => 'kategori',
                'icon'        => 'list'
            ],
           
        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }
}