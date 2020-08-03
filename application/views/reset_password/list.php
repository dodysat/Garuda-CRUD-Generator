<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div id="alertDanger" class="alert alert-danger alert-dismissible" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>&nbsp;&nbsp;<div id="alertDangerValue"></div>
                    </h4>

                </div>
                <div id="alertInfo" class="alert alert-info alert-dismissible" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i>&nbsp;&nbsp;<div id="alertInfoValue"></div>
                    </h4>

                </div>
                <div id="alertWarning" class="alert alert-warning alert-dismissible" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i>&nbsp;&nbsp;<div id="alertWarningValue"></div>
                    </h4>

                </div>
                <div id="alertSuccess" class="alert alert-success alert-dismissible" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i>&nbsp;&nbsp;<div id="alertSuccessValue"></div>
                    </h4>

                </div>
                <?php if ($this->session->flashdata('danger')) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                        <?php echo $this->session->flashdata('danger'); ?>
                    </div>
                <?php } ?>

                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">RESET PASSWORD | <a href="javascript:;" class="btn btn-default" onclick="reloadTable()"><i class="fa fa-refresh" aria- hidden="true"></i>&nbsp;&nbsp;Refresh Tabel</a></h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th width="50px">Action</th>
                                    <th>full_name</th>
                                    <th>username</th>
                                    <th>Level</th>
                                    <th>is Active</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reloadTable()">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <form action="" id="formPassword">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12" id="idColPhoto">

                            <div class="form-group">
                                <input type="text" class="form-control" name="password" id="passwordForm" placeholder="Password Baru" autocomplete="false">
                                <input type="hidden" class="form-control" name="id_users" id="id_usersForm" placeholder="Password Baru" autocomplete="false" autofocus="">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-default pull-left btn-block" data-dismiss="modal" onclick="reloadTable()">Tutup</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-success pull-right btn-block">Update</button>
                            <!-- <a href="javascript:;" id="submitPassword"  onclick="document.getElementById('formPassword').submit();" class="btn btn-success pull-right btn-block">Simpan</a> -->
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
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
                sProcessing: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>'
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "reset_password/json",
                "type": "POST"
            },
            columns: [{
                    "data": "id_users",
                    "orderable": false
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "full_name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "nama_level"
                },


                {
                    "data": "is_aktif"
                }
            ],
            order: [
                [0, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });

    function reloadTable() {
        $('#mytable').DataTable().ajax.reload();
    }

    function resetPassword(id) {
        $.ajax({
            url: "reset_password/person/" + id,
            success: function(data) {
                console.log(data);
                $(".modal-title").text("Ganti Password " + data.identitas.full_name);

                $("#passwordForm").val('');
                $("#id_usersForm").val(data.identitas.id_users);
                $('#modal-default').modal('show');
            }
        });

        $('#modal-default').modal('hide');
    }
    $(function() {
        var frm = $('#formPassword');
        frm.submit(function(ev) {
            $.ajax({
                type: 'post',
                url: '<?php echo site_url('reset_password/update') ?>',
                data: $('form').serialize(),
                success: function(datapass) {
                    reloadTable();
                    $('#modal-default').modal('hide');
                    $("#alertSuccessValue").text("Password berhasil diubah");
                    $('#alertSuccess').slideDown('slow').delay(5000).slideUp('slow');
                }
            });
            ev.preventDefault();
        });
    });
</script>