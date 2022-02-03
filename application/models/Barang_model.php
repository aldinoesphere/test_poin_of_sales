<?php

/**
* Model untuk mengatur data barang
*/
class Barang_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('barang', $args);
    }

    public function delete($id)
    {
        return $this->db
                    ->delete('barang', ['id' => $id]);
    }

    public function update($args, $id)
    {
        return $this->db
                    ->where(['id' => $id])
                    ->update('barang', $args);
    }

    public function getById($where)
    {
        return $this->db
                    ->where($where)
                    ->get('barang')
                    ->result();
    }

    public function getByBarcode($where)
    {
        return $this->db
                    ->where($where)
                    ->get('barang')
                    ->result();
    }

    public function getAll()
    {
        return $this->db
                    ->select('B.id, B.kode_brg, B.nama_brg, stok, B.harga_beli, B.harga_jual')
                    ->where(['B.flag' => 0])
                    ->get('barang B')
                    ->result();
    }

    public function getByTerm($term)
    {
        return $this->db
                    ->like($term)
                    ->get('barang')
                    ->result();
    }

    public function getMaxId($kode_brg)
    {
        return $this->db
                    ->select('max(RIGHT(kode_brg, 6)) as kode_brg')
                    ->like($kode_brg)
                    ->get('barang')
                    ->result();
    }

    public function getItemOrderByBarcode() {

        return $this->db
                    ->where("barcode != ''", null, false)
                    ->get('barang')
                    ->result();   
    }

    public function getBarangById($id)
    {
        $where = [
            'flag' => 0,
            'id' => $id
        ];

        return $this->db
                    ->where($where)
                    ->get('barang B')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table barang');   
    }
}
