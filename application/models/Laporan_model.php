<?php

/**
*
*/
class Laporan_model extends CI_Model
{

    public function get_ringkasan_penjualan($start_date, $end_date) {
        $data_ringkasan_penjualan = $this->db
                    ->select('P.id, P.no_nota, PS.id_perusahaan, PS.nama_perusahaan, P.total, P.bayar, P.kembali, P.tanggal, P.sub_total, P.discount')
                    ->join('perusahaan PS', 'PS.id_perusahaan=P.id_perusahaan')
                    ->where("DATE_FORMAT(P.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(P.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->get('penjualan P')
                    ->result();

        return $data_ringkasan_penjualan;
    }

    public function get_details_penjualan($no_nota) {
        $data_details_penjualan = $this->db
                    ->select('DP.id, DP.no_nota, B.kode_brg, B.nama_brg, DP.qty, DP.harga_beli, DP.harga_jual')
                    ->join('barang B', 'B.kode_brg=DP.kode_brg')
                    ->where("DP.no_nota", $no_nota)
                    ->get('det_penjualan DP')
                    ->result();

        return $data_details_penjualan;
    }

    public function get_chart_daily_report($start_date, $end_date)
    {
        $daily_report = $this->db
                    ->select('count(P.no_nota) as total, day(P.tanggal) as tanggal')
                    ->where("DATE_FORMAT(P.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(P.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->group_by('day(P.tanggal)')
                    ->get('penjualan P')
                    ->result();

        return $daily_report;
    }
}
