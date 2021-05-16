<style>
#chartdiv {
    width: 100%;
    height: 300px;
}

#chartdiv2 {
    width: 100%;
    height: 250px;
}

#chartdiv3 {
    width: 100%;
    height: 250px;
}

.widget-user .widget-user-image>img {
    width: 90px;
    height: auto;
    border: none;
}
</style>
<section class="content">
    <?php if ($this->session->userdata('akses') == 1 ):?>
    <div class="row">
        <?php foreach ($box as $info_box) : ?>
        <div class="col-lg-6 col-xs-12">
            <div class="small-box bg-<?= $info_box->box ?>">
                <div class="inner">
                    <h3 class="count"><?= $info_box->total; ?></h3>
                    <p><?= $info_box->title; ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-<?= $info_box->icon ?>"></i>
                </div>
                <a href="<?= base_url() . strtolower($info_box->link); ?>" class="small-box-footer">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php else : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green-active">
                    <p style="text-align: center;">
                        <span style="font-family: georgia, palatino; font-size: 15pt;">Selamat datang di Indotek Sinar
                            Makmur</span>
                    </p>
                    <h3 class="widget-user-username"></h3>
                    <h5 class="widget-user-desc"></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="<?php echo base_url(); ?>assets/dist/img/logo.png">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            </div>
                        </div>
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Kantor: jl.wibawamukti no. 12A jatiasih, bekasi</h5>
                                <span class="description-text">No.Telp:</span>
                            </div>
                            <center>
                                <i>Sistem Inventaris </i><br>
                            </center>
                        </div>
                        <div class="col-sm-3">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>

<!-- HTML -->