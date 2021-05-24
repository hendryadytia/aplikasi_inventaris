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
                                <th>Tanggal Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$no = 0;
							foreach ($barangkeluar as $s) { ?>
                            <tr>
                                <td><?php echo ++$no ?> </td>
                                <td><?php echo $s->nama_barang; ?></td>
                                <td><?php echo $s->no_invn; ?></td>
                                <td><?php echo $s->pemilik; ?></td>
                                <td><?php echo $s->nama_kategori; ?></td>
                                <td><?php echo $s->tgl_masuk; ?></td>
                                <td><?php echo $s->tgl_keluar; ?></td>
                                <td><?php
										echo anchor(site_url('sbarang/edit/' . $s->id_barang), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('sbarang/hapus/' . $s->id_barang), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
                                </td>
                            </tr>
                            <?php }	?>
                        </tbody>
                    </table>
                </div>
                <?php else : ?>
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
                                <th>Tanggal Keluar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$no = 0;
							foreach ($barangkeluar as $s) { ?>
                            <tr>
                                <td><?php echo ++$no ?> </td>
                                <td><?php echo $s->nama_barang; ?></td>
                                <td><?php echo $s->no_invn; ?></td>
                                <td><?php echo $s->pemilik; ?></td>
                                <td><?php echo $s->nama_kategori; ?></td>
                                <td><?php echo $s->tgl_masuk; ?></td>
                                <td><?php echo $s->tgl_keluar; ?></td>

                            </tr>
                            <?php }	?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
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
                    columns: [0, 1, 2, 3, 4, 5, 6],
                },
            },
            {
                extend: 'excelHtml5',
                title: 'Data Stok Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                },
            },
            {
                extend: 'copyHtml5',
                title: 'Data Stok Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                },
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'legal',
                title: 'Data Stok Barang',
                download: 'open',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
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
                orientation: 'landscape',
                pageSize: 'A4',
                title: 'Data Stok Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                },
            },
        ],
    });
});
</script>