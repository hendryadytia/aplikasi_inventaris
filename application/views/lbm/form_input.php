<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4> <i class="icon fa fa-ban"></i> Error</h4>
        <p><?php echo $this->session->flashdata('message'); ?></p>
    </div>
</div>
<?php } else {
} ?>
<section class="content">
    <div class="row">
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>Tambah Data Barang</h3>
                </div>
                <div class="box-body">
                    <?php echo form_open('lbm/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                    <div class="form-group">
                        <label for="nama_barang" class="control-label">Nama Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                pattern="[a-zA-Z0-9\s]+" placeholder="nama barang" value="" required />
                            <span class="input-group-addon">
                                <span class="fa fa-cube"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang" class="control-label">Nomor Inventaris</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="no_invn" id="no_invn" placeholder="Nomor Inventaris"
                                value="" />
                            <span class="input-group-addon">
                                <span class="fa fa-cube"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang" class="control-label">Nama Pemilik</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="pemilik" id="pemilik"
                                placeholder="nama pemilik" value="" required />
                            <span class="input-group-addon">
                                <span class="fa fa-cube"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="control-label">Kategori Kerusakan</label>
                        <div class="input-group">
                            <select class="form-control" name="id_kerusakan">
                                <?php
								foreach ($kategori as $k) {
									echo "<option value=' $k->id_kategori'>$k->nama_kategori</option>";
								}
								?>
                            </select>
                            <span class="input-group-addon">
                                <span class="fa fa-list"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group input-daterange">
                        <label for="tgl_masuk" class="control-label">Tanggal Masuk</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk"
                                data-error="Tanggal masuk harus diisi" required />
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
                        <a href="<?php echo base_url() ?>lbm" class="btn btn-default ">Cancel</a>
                    </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: "yyyy-mm-dd",
        autoclose: true
    });
});
</script>