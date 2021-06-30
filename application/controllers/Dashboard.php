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
        $this->template->load('template/template', 'dashboard/lihat_dashboard', $data);
        // var_dump($this->session->userdata());
        // die;
    }

    public function box()
    {

        $box = [
            [
                'box'         => 'light-blue',
                'total'     => $this->Model_dashboard->total('baranginv'),
                'title'        => 'Total Barang',
                'link'    => 'sbarang',
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