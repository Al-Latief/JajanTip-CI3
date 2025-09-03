<?php
class M_data extends CI_Model
{
    //untuk update data ganti password
    function update_data($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //fungsi untuk mengambil data dari database
    function get_data($table)
    {
        return $this->db->get($table);
    }

    //fungsi untuk menambahkan data ke database
    function insert_data($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    //fungsi untuk mengedit data dari database
    function edit_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    //fungsi untuk menghapus data dari database
    function delete_data($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    //Fungsi ambil data pesan dengan penggunaanya atau nama pengirimnya
    public function get_pesan_with_pengguna()
    {
        $this->db->select('pesan.*, pengguna.pengguna_nama');
        $this->db->from('pesan');
        $this->db->join('pengguna', 'pesan.pengguna_id = pengguna.pengguna_id', 'left');
        $this->db->order_by('pesan.tanggal_ditambahkan', 'DESC');
        return $this->db->get()->result();
    }




    // function frontend
    public function getProduk($keyword = null, $kategori = null)
    {
        $this->db->from('produk');

        if ($kategori) {
            $this->db->where('produk_kategori', $kategori);
        }

        if ($keyword) {
            $this->db->like('produk_nama', $keyword);
            $this->db->or_like('produk_deskripsi', $keyword);
        }

        $this->db->order_by('tanggal_ditambahkan', 'DESC');
        return $this->db->get();
    }
    public function getKategori()
    {
        $this->db->select('DISTINCT(produk_kategori) as produk_kategori');
        $this->db->from('produk');
        return $this->db->get()->result();
    }
    public function getProdukById($id)
    {
        return $this->db->where('produk_id', $id)->get('produk')->row();
    }
}
