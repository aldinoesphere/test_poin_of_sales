<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">SEMUA DATA TRANSAKSI</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
                           <li class="breadcrumb-item active">SEMUA DATA TRANSAKSI</li>
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
                     <div class="col-md-10">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">SEMUA DATA TRANSAKSI</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body table-responsive">
                              <table id="transaksi" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>NO</th>
                                       <th>KODE TRANSAKSI</th>
                                       <th>NAMA TRANSAKSI</th>
                                       <th>AKSI</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $i = 1;
                                       foreach ($transaksi as $value) :
                                       ?>
                                    <tr>
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $value->kode_transaksi; ?></td>
                                       <td><?php echo $value->transaksi; ?></td>
                                       <td>
                                          <a href="javascript:void(0)" onClick="executeDeleteFunction('<?php echo $value->kode_transaksi; ?>');"><i class="fa fa-trash"></i></a>
                                          <a href="<?php echo base_url('transaksi/edit/' . $value->kode_transaksi); ?>"><i class="fa fa-edit"></i></a>
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
                           <div class="overlay" id="form-loading" style="display: none;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
                        </div>
                        <!-- /.card -->
                     </div>
                     <div class="col-md-2">
                        <a class="btn btn-primary" href="<?php echo base_url('transaksi/add')?>">
                           <i class="fa fa-plus"></i>
                           Jenis Baru
                        </a>
                     </div>
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

    var table = $("#transaksi").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"],
            "createdRow": function( row, data, dataIndex){
                if( data[3] <= 0){
                    $(row).css('color', 'red');
                }
            }
        }).buttons().container().appendTo('#transaksi_wrapper .col-md-6:eq(0)');

    function executeDeleteFunction(id) {
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Ingin menghapus data transaksi ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $('#form-loading').show();
            $.ajax({
                url : baseUrl+'transaksi/delete/'+id,
                dataType : 'JSON'
            }).done(function(r) {
                $('#form-loading').hide();
                Swal.fire(
                  r.messageInfo,
                  r.message,
                  r.messageType
                );
                location.reload();
            }).fail(function(jqXHR, textStatus) {
                $('#form-loading').hide();
                Swal.fire(
                  'Gagal!',
                  textStatus,
                  'danger'
                );
            });
            
          }
        })
    }

    function init() {
        table;
    }

    init();
</script>