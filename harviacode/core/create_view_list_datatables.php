<?php 

$string = "<div class=\"content-wrapper\">
    <section class=\"content\">
        <div class=\"row\">
            <div class=\"col-xs-12\">
                <div class=\"box box-primary box-solid\">
    
                    <div class=\"box-header\">
                        <h3 class=\"box-title\">DATA ".  strtoupper(ucwords(str_replace("_", " ", $table_name)))."</h3>
                    </div>
        
                    <div class=\"box-body\">
                        <div style=\"padding-bottom: 10px;\">
                        <?php echo anchor(site_url('".$c_url."/create'), '<i class=\"fa fa-wpforms\" aria-hidden=\"true\"></i> Tambah Data', 'class=\"btn btn-success btn-sm\"'); ?>";

            if ($export_excel == '1') {
                $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel-o\" aria-hidden=\"true\"></i> Export Ms Excel', 'class=\"btn btn-success btn-sm\"'); ?>";
            }
            if ($export_word == '1') {
                $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word-o\" aria-hidden=\"true\"></i> Export Ms Word', 'class=\"btn btn-primary btn-sm\"'); ?>";
            }
            if ($export_pdf == '1') {
                $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
            }

                $string.="
                        </div>
                        <table class=\"table table-bordered table-striped\" id=\"mytable\" style=\"width: 100%;\">
                            <thead>
                                <tr>
                                    <th width=\"30px\">No</th>";
                $string .= "\n\t\t    <th width=\"60px\">Aksi</th>";
                foreach ($non_pk as $row) {
                    $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
                }
                $string .= "    
                                </tr>
                            </thead>";

                $column_non_pk = array();
                foreach ($non_pk as $row) {
                    $column_non_pk[] .= "{\"data\": \"".$row['column_name']."\"}";
                }
                $col_non_pk = implode(',', $column_non_pk);

                $string .= "\n\t    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src=\"<?php echo base_url('assets/js/jquery.min.js') ?>\"></script>
<script src=\"<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>\"></script>
<script src=\"<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>\"></script>
<script src=\"<?php echo base_url('assets/js/load-overlay.js') ?>\"></script>
<script src=\"<?php echo base_url('assets/js/toastr.min.js'); ?>\"></script>

<script type=\"text/javascript\">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                \"iStart\": oSettings._iDisplayStart,
                \"iEnd\": oSettings.fnDisplayEnd(),
                \"iLength\": oSettings._iDisplayLength,
                \"iTotal\": oSettings.fnRecordsTotal(),
                \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $(\"#mytable\").dataTable({
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
                sProcessing: \"loading...\"
            },
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {\"url\": \"".$c_url."/json\", \"type\": \"POST\"},
            columns: [
                {
                    \"data\": \"$pk\",
                    \"orderable\": false
                },
                {
                    \"data\" : \"action\",
                    \"orderable\": false,
                    \"className\" : \"text-center\"
                },
                ".$col_non_pk."
                
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
</script>";

$string .="

<script type=\"text/javascript\">
    <?php if (\$this->session->flashdata('message')): ?>
        toastr.options = {
          \"positionClass\": \"toast-bottom-right\",
        }
        toastr.info(\"<?php echo \$this->session->flashdata('message'); ?>\");
    <?php endif ?>
</script>";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>