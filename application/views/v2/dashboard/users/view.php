<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">USERS</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
                           <li class="breadcrumb-item active">USERS</li>
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
                              <h3 class="card-title">DATA SEMUA USERS</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body table-responsive">
                              <table id="users" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>NO</th>
                                       <th>NAMA PENGGUNA</th>
                                       <th>EMAIL</th>
                                       <th>AKSI</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $i = 1;
                                       foreach ($users as $value) :
                                       ?>
                                    <tr>
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $value->name; ?></td>
                                       <td><?php echo $value->email; ?></td>
                                       <td>
                                          <a href="javascript:void(0)" onClick="executeDeleteFunction('<?php echo $value->id; ?>');"><i class="fa fa-trash"></i></a>
                                          <a href="<?php echo base_url('users/edit/' . $value->id); ?>"><i class="fa fa-edit"></i></a>
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
                        <a class="btn btn-primary" href="<?php echo base_url('users/add')?>">
                           <i class="fa fa-plus"></i>
                           Pengguna Baru
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

    var table = $("#users").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"],
            "createdRow": function( row, data, dataIndex){
                if( data[3] <= 0){
                    $(row).css('color', 'red');
                }
            }
        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');

    function executeDeleteFunction(id) {
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Ingin menghapus data User ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $('#form-loading').show();
            $.ajax({
                url : baseUrl+'users/delete/'+id,
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