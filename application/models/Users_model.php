<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* Class for registration model
*/
class Users_model extends CI_Model
{
    
    public function getUserById($id = '')
    {
        return $this->db
                ->where('id', $id)
                ->get('users')
                ->result();
    }

    public function add($data)
    {
        return $this->db
                    ->insert('users', $data);
    }

    public function update($args, $id)
    {
        return $this->db
                    ->update('users', $args, array('id' => $id));
    }

    public function delete($id)
    {
        return $this->db
                    ->delete('users', ['id' => $id]);
    }

    public function getAllAdminLogin()
    {
        return $this->db
                    ->select('*')
                    ->from('users')
                    ->get()
                    ->result();
    }

    public function checkUser($email, $password)
    {
        $data = [
            'email' => $email,
            'pass' => sha1(trim($password))
        ];
        $query = $this->db
                    ->where($data)
                    ->get('users');

        if ($user = $query->row()) {
            if ((int)$user->flag == 1) {
                set_session('user_id', $user->id);
                set_session('username', $user->name);
                set_session('email', $email);
                set_session('flag', $user->flag);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
