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
        <h4> <i class="icon fa fa-check"></i>Berhasil</h4>
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
                    <h3 class='box-title'>Data Pembelian</h3>
                    <div class="pull-right">
                        <?php
						echo anchor('barang/post', 'Tambah data', array('class' => 'btn btn-success'))
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
                    <table id="myTable" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Kategori Barang</th>
                                <th>Ukuran</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
							foreach ($record as $r) { ?>
                            <tr>
                                <td><?php echo ++$no; ?></td>
                                <td><?php echo $r->nama_barang; ?></td>
                                <td><?php echo $r->nama_kategori; ?></td>
                                <td><?php echo $r->nama_ukuran; ?></td>
                                <td>Rp.<?php echo number_format($r->harga); ?></td>
                                <td>
                                    <a href="<?php echo (site_url('uploads/' . $r->foto)); ?>" class="image-link">
                                        <img src="<?php echo (site_url('uploads/' . $r->foto)); ?>" alt=""
                                            style="width:30px;height:30px">
                                    </a>
                                </td>
                                <td><?php
										echo anchor(site_url('barang/edit/' . $r->id_barang), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('barang/hapus/' . $r->id_barang), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
                                </td>
                            </tr>
                            <?php } ?>
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
                    columns: [0, 1, 2, 3, 4, ],
                },
            },
            {
                extend: 'excelHtml5',
                title: 'DATA BARANG',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: 'copyHtml5',
                title: 'Data Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: 'pdfHtml5',
                oriented: 'portrait',
                pageSize: 'legal',
                title: 'Data Barang',
                download: 'open',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
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
                title: 'Data Barang',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
        ],
        "fnDrawCallback": function() {
            $('.image-link').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                },
            });
        }
    });
});
</script>