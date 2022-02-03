<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <i class="fas fa-tachometer-alt"></i> DASHBOARD
                        </li>
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
                <div class="col-md-12">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Penjualan Harian</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div id="bar-chart" style="height: 300px;"></div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper --> <?php
   $this->load->view('v2/dashboard/js');
?>
<script type="text/javascript">
    $(function() {
        /*
         * BAR CHART
         * ---------
         */

         var count_data = <?php echo json_encode($count_data); ?>;
         var days_data = <?php echo json_encode($days_data); ?>;

        var bar_data = {
          data : count_data,
          bars: { show: true }
        }
        $.plot('#bar-chart', [bar_data], {
          grid  : {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor  : '#f3f3f3'
          },
          series: {
             bars: {
              show: true, barWidth: 0.5, align: 'center',
            },
          },
          colors: ['#3c8dbc'],
          xaxis : {
            ticks: days_data
          }
        })
        /* END BAR CHART */
    });

</script>