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
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4> <i class="icon fa fa-check"></i>Okay!</h4>
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
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo form_open('lbm', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
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

                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="submit" name="search" id="search" value="Search" class="btn btn-info">
                                Search</button>
                        </div>
                        </form>
                    </div>
                </div>
                <?php if ($this->session->userdata('akses') == 1 ):?>
                <div class="box-body">
                    <table id="myTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama barang</th>
                                <th>Nomor Inventaris</th>
                                <th>Pemilik</th>
                                <th>Kategori Kerusakan</th>
                                <th>Tanggal Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$no = 0;
							foreach ($barangmasuk as $s) { ?>
                            <tr>
                                <td><?php echo ++$no ?> </td>
                                <td><?php echo $s->nama_barang; ?></td>
                                <td><?php echo $s->no_invn; ?></td>
                                <td><?php echo $s->pemilik; ?></td>
                                <td><?php echo $s->nama_kategori; ?></td>
                                <td><?php echo $s->tgl_masuk; ?></td>
                                <td><?php
										echo anchor(site_url('lbm/edit/' . $s->id_barang), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('lbm/hapus/' . $s->id_barang), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
                                </td>
                            </tr>
                            <?php }	?>
                        </tbody>
                    </table>
                </div>
                <?php else :?>
                <div class="box-body">
                    <table id="myTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama barang</th>
                                <th>Nomor Inventaris</th>
                                <th>Pemilik</th>
                                <th>Kategori Kerusakan</th>
                                <th>Tanggal Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$no = 0;
							foreach ($barangmasuk as $s) { ?>
                            <tr>
                                <td><?php echo ++$no ?> </td>
                                <td><?php echo $s->nama_barang; ?></td>
                                <td><?php echo $s->no_invn; ?></td>
                                <td><?php echo $s->pemilik; ?></td>
                                <td><?php echo $s->nama_kategori; ?></td>
                                <td><?php echo $s->tgl_masuk; ?></td>
                            </tr>
                            <?php }	?>
                        </tbody>
                    </table>
                </div>
                <?php endif ;?>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
$(document).ready(function() {


    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: "yyyy-mm-dd",
        autoclose: true
    });

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