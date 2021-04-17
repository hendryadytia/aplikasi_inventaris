<style type="text/css">
table,
th,
tr,
td {
    text-align: center;
}

.swal2-popup {
    font-family: inherit;
    font-size: 1.2rem;
}

.btn-group,
.btn-group-vertical {
    position: relative;
    display: initial;
    vertical-align: middle;
}

@media only screen and (max-width: 600px) {

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
}
</style>
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4> <i class="icon fa fa-ban"></i>Warning</h4>
        <p><?php echo $this->session->flashdata('message'); ?></p>
    </div>
</div>
<?php } else {
} ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class='box-header  with-border'>
                    <h3 class='box-title'>Stok Barang</h3>
                    <div class="pull-right">
                        <?php
						echo anchor('stok/post', 'Tambah Data', array('class' => 'btn btn-success'));
						?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo form_open('laporan', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                        <div class="col-md-3">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="start_date" class="control-label">Tanggal Awal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="start_date" id="start_date"
                                            data-error="Tanggal Awal harus diisi" required />
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="end_date" class="control-label">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="end_date" id="end_date"
                                            data-error="Tanggal Akhir harus diisi" required />
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="metode" class="control-label">Metode</label>
                                <div class="input-group">
                                    <select class="form-control" name="metode">
                                        <option value="">Pilih Semua</option>
                                        <?php
                                        foreach ($metode as $m) {
                                            echo "<option value=' $m->id_byr'>$m->metode</option>";
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-addon">
                                        <span class="fa fa-list"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="submit" name="search" id="search" value="Search" class="btn btn-info">
                                Search</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="box-body">
                    <table id="myTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama barang</th>
                                <th>Kategori barang</th>
                                <th>Harga Barang</th>
                                <th>Stok Barang</th>

                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$no = 0;
							foreach ($stok as $s) { ?>
                            <tr>
                                <td><?php echo ++$no ?> </td>
                                <td><?php echo $s->nama_barang; ?></td>
                                <td><?php echo $s->nama_kategori; ?></td>
                                <td>Rp.<?php echo number_format($s->harga); ?></td>
                                <td>
                                    <?php echo $s->stok_barang; ?>
                                </td>

                                <td><?php echo $s->tanggal_stok; ?></td>
                                <td><?php
										echo anchor(site_url('stok/edit/' . $s->id_stok), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('stok/hapus/' . $s->id_stok), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
                                </td>
                            </tr>
                            <?php }	?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        dom: 'Blfrtip',

        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6],
                },
            },
            {
                extend: 'excelHtml5',
                title: 'Data Stok Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6],
                },
            },
            {
                extend: 'copyHtml5',
                title: 'Data Stok Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6],
                },
            },
            {
                extend: 'pdfHtml5',
                oriented: 'portrait',
                pageSize: 'legal',
                title: 'Data Stok Barang',
                download: 'open',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6],
                },
                customize: function(doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1)
                        .join('*').split('');
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                },
            },
            {
                extend: 'print',
                oriented: 'portrait',
                pageSize: 'A4',
                title: 'Data Stok Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6],
                },
            },
        ],
    });
});
</script>