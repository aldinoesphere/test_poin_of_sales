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