<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DATA KARYAWAN</h3>
                    </div>
        
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                        <?php echo anchor(site_url('karyawan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('karyawan/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                        </div>
                        <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
		    <th width="60px">Aksi</th>
		    <th>Nama</th>
		    <th>Jabatan</th>
		    <th>Nomor Hp</th>
		    <th>Alamat</th>    
                                </tr>
                            </thead>
	    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script src="<?php echo base_url('assets/js/load-overlay.js') ?>"></script>
<script src="<?php echo base_url('assets/js/toastr.min.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {"url": "karyawan/json", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false
                },
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                },
                {"data": "nama"},{"data": "jabatan"},{"data": "nomor_hp"},{"data": "alamat"}
                
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>

<script type="text/javascript">
    <?php if ($this->session->flashdata('message')): ?>
        toastr.options = {
          "positionClass": "toast-bottom-right",
        }
        toastr.info("<?php echo $this->session->flashdata('message'); ?>");
    <?php endif ?>
</script>