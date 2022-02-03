<?php

/**
*
*/
class Perusahaan_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('perusahaan', $args);
    }

    public function update($args, $id_perusahaan)
    {
        return $this->db
                    ->where(['id_perusahaan' => $id_perusahaan])
                    ->update('perusahaan', $args);
    }

    public function delete($id_perusahaan)
    {
        return $this->db
                    ->delete('perusahaan', ['id_perusahaan' => $id_perusahaan]);
    }

    public function getAll()
    {
        return $this->db
                    ->get('perusahaan')
                    ->result();
    }

    public function getPerusahaanById($id_perusahaan)
    {
        $where = [
            'id_perusahaan' => $id_perusahaan
        ];

        return $this->db
                    ->where($where)
                    ->get('perusahaan')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table perusahaan');   
    }
}
