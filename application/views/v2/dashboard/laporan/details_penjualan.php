<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DETAILS PENJUALAN</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">DASHBOARD</a>
                        </li>
                        <li class="breadcrumb-item active">DETAILS PENJUALAN</li>
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
            <div id="result-ajax-reingkasan-penjualan">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DETAIL PENJUALAN <small>Nota{<?php echo $details_penjualan[0]->no_nota; ?>}</small></h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table id="laporan_penjualan" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NO NOTA</th>
                                            <th>KODE BARANG</th>
                                            <th>NAMA BARANG</th>
                                            <th>QTY</th>
                                            <th>HARGA BELI</th>
                                            <th>HARGA JUAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            foreach ($details_penjualan as $penjualan) :
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $penjualan->no_nota; ?></td>
                                            <td><?php echo $penjualan->kode_brg; ?></td>
                                            <td><?php echo $penjualan->nama_brg; ?></td>
                                            <td><?php echo $penjualan->qty; ?></td>
                                            <td><?php echo idr_format($penjualan->harga_beli); ?></td>
                                            <td><?php echo idr_format($penjualan->harga_jual); ?></td>
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

        function init() {
            table;
        }

        init();
    });
</script>