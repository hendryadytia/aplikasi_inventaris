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
                    <h3 class='box-title'>Tambah Data Barang Keluar</h3>
                </div>
                <div class="box-body">
                    <?php echo form_open('lbk/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                    <div class="form-group">
                        <label for="nama_barang" class="control-label">Nama Barang</label>
                        <div class="input-group">
                            <select class="form-control" name="nama_barang">
                                <?php
								foreach ($nm_brg as $nm) {
									echo "<option value=' $nm->id_barang'>$nm->nama_barang</option>";
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
                        <label for="tgl_keluar" class="control-label">Tanggal Keluar</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="tgl_keluar" id="tgl_keluar"
                                data-error="Tanggal keluar harus diisi" required />
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
                        <a href="<?php echo base_url() ?>lbk" class="btn btn-default ">Cancel</a>
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