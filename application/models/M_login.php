<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
    // Proses login
    public function login($username, $password)
    {
        return $this->db->get_where('pengguna', [
            'pengguna_username' => $username,
            'pengguna_password' => md5($password) // password terenkripsi md5
        ])->row_array();
    }

    // Proses registrasi
    public function register($data)
    {
        return $this->db->insert('pengguna', $data);
    }

    // Cek Username
    public function cek_username($username)
    {
        return $this->db->get_where('pengguna', ['pengguna_username' => $username])->row_array();
    }
}
