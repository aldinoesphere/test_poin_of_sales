<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RINGKASAN PENJUALAN</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">DASHBOARD</a>
                        </li>
                        <li class="breadcrumb-item active">RINGKASAN PENJUALAN</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title">FILTER DATA TRANSAKSI</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <!-- form start -->
                            <form class="form-horizontal" id="form_filter" action="
                                <?php echo base_url('laporan/ajax_filter'); ?>" method="POST">
                                <div class="form-group">
                                    <label>FILTER BERDASARKAN</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                            <i class="fa fa-calendar"></i>&nbsp; <span>PILIH TANGGAL</span>
                                            <i class="fa fa-caret-down"></i>
                                            <input type="text" name="start_date" style="display: none;">
                                            <input type="text" name="end_date" style="display: none;">
                                        </button>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-filter"></i> FILTER </button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                            <!-- / .form -->
                        </div>
                        <!-- / .card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- / .col-md-6 -->
            </div>
            <div id="result-ajax-reingkasan-penjualan">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">PENJUALAN</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="laporan_penjualan" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NO NOTA</th>
                                            <th>NAMA PERUSAHAAN</th>
                                            <th>TOTAL</th>
                                            <th>BAYAR</th>
                                            <th>KEMBALI</th>
                                            <th>TANGGAL</th>
                                            <th>SUB TOTAL</th>
                                            <th>DISCOUNT</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            foreach ($ringkasan_laporan as $laporan) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $laporan->no_nota; ?></td>
                                            <td><?php echo $laporan->nama_perusahaan; ?></td>
                                            <td><?php echo idr_format($laporan->total); ?></td>
                                            <td><?php echo idr_format($laporan->bayar); ?></td>
                                            <td><?php echo idr_format($laporan->kembali); ?></td>
                                            <td><?php echo date('Y-m-d H:i:s', strtotime($laporan->tanggal)); ?></td>
                                            <td><?php echo idr_format($laporan->sub_total); ?></td>
                                            <td><?php echo $laporan->discount; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('laporan/details/'.$laporan->no_nota); ?>" class="btn btn-success">DETAILS</a>
                                            </td>
                                        </tr>
                                        <?php
                                            $i++;
                                            endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- / .row -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
   $this->load->view('v2/dashboard/js');
?>
<script type="text/javascript">
    $(document).ready(function(){
        var table = $("#laporan_penjualan").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"],
            "createdRow": function( row, data, dataIndex){
                if( data[3] <= 0){
                    $(row).css('color', 'red');
                }
            }
        }).buttons().container().appendTo('#laporan_penjualan_wrapper .col-md-6:eq(0)');

        function reinitAjaxFilter() {
            $('#select-filter').change(function() {
                var filterId = $(this).val();
                
            });
        }

        function ajax_form() {
          $('#form_filter').on('submit', function(e) {
                e.preventDefault();
                $('#form-loading').show();
                data = $(this).serialize();
                $('#form-loading').show();
                $.ajax({
                    url : $(this).attr('action'),
                    dataType : 'JSON',
                    type : "POST",
                    data : data
                }).done(function(r) {
                    $('#form-loading').hide();
                    $('#result-ajax-reingkasan-penjualan').html(r.html);
                    var total_transaksi = '<h3>'+r.report_data.total_transaksi+'</h3>'
                    +'<p>Total Transaksi</p>';
                    $('.inner').html(total_transaksi);
                }).fail(function(jqXHR, textStatus) {
                    $('#form-loading').hide();
                    Swal.fire(
                      'Gagal!',
                      textStatus,
                      'danger'
                    );
                });
          });
        }

        function reinitDaterange() {
            $('#daterange-btn').daterangepicker({
                ranges   : {
                    'HARI INI'       : [moment(), moment()],
                    'KEMARIN'        : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '1 MINGGU'       : [moment().subtract(6, 'days'), moment()],
                    '1 BULAN'        : [moment().subtract(29, 'days'), moment()],
                    '2 BULAN'        : [moment().subtract(58, 'days'), moment()],
                    '3 BULAN'        : [moment().subtract(87, 'days'), moment()],
                    'BULAN INI'      : [moment().startOf('month'), moment().endOf('month')],
                    'BULAN KEMARIN'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('[name=start_date]').val(start.format('YYYY-MM-DD'));
                $('[name=end_date]').val(end.format('YYYY-MM-DD'));
            });
        }

        function init() {
            $('.select2').select2();
            reinitAjaxFilter();
            reinitDaterange();
            ajax_form();
            $('#reportrange').daterangepicker();
            table;
        }

        init();
    });
</script>