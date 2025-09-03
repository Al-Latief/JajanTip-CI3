<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    /**
     * @var CI_Input
     */
    public $input;

    /**
     * @var CI_URI
     */
    public $uri;

    /**
     * @var M_login
     */
    public $M_login;

    /**
     * @var M_data
     */
    public $M_data;

    /**
     * @var M_pengaturan
     */
    public $M_pengaturan;

    /**
     * @var CI_SESSION
     */
    public $session;

    /**
     * @var form_validation
     */
    public $form_validation;

    /**
     * @var db
     */
    public $db;

    /**
     * @var upload
     */
    public $upload;

    /**
     * @var encryption
     */
    public $encryption;

    // Function yang pertama kali dikerjakan
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_data');

        // Cek Login
        if ($this->session->userdata('status_login') != "telah_login" || $this->session->userdata('pengguna_level') != "admin") {
            $this->session->set_flashdata('error', 'Akses ditolak! Anda harus login sebagai admin.');
            redirect('login');
        }
    }

    // Fitur denkripsi id
    private function decrypt_url($string)
    {
        // tambahin padding = yang mungkin hilang
        $string = str_pad($string, strlen($string) % 4 === 0 ? strlen($string) : strlen($string) + 4 - strlen($string) % 4, '=', STR_PAD_RIGHT);

        $decoded = base64_decode(strtr($string, '-_', '+/'));
        return $this->encryption->decrypt($decoded);
    }

    // Fitur enkrkipsi id
    private function encrypt_url($string)
    {
        return rtrim(strtr(base64_encode($this->encryption->encrypt($string)), '+/', '-_'), '=');
    }

    // Fitur Dashboard
    function index()
    {
        // Hitung total produk
        $data['total_produk'] = $this->db->count_all('produk');

        // Hitung total pengguna per level
        $data['total_admin'] = $this->db->where('pengguna_level', 'admin')->from('pengguna')->count_all_results();
        $data['total_pengunjung'] = $this->db->where('pengguna_level', 'pengunjung')->from('pengguna')->count_all_results();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_index', $data); // kirim data
        $this->load->view('dashboard/v_footer');
    }

    // Fitur Produk
    public function produk()
    {
        $data['produk'] = $this->M_data->get_data('produk')->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_produk', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function produk_tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_produk_tambah');
        $this->load->view('dashboard/v_footer');
    }
    public function produk_tambah_aksi()
    {
        // load library upload
        $config['upload_path']   = './uploads/produk_sampul/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = time() . '_' . $_FILES['produk_sampul']['name'];

        $this->load->library('upload', $config);

        // default gambar kalau tidak upload
        $sampul = "default.jpg";

        if (!empty($_FILES['produk_sampul']['name'])) {
            if ($this->upload->do_upload('produk_sampul')) {
                $uploadData = $this->upload->data();
                $sampul = $uploadData['file_name'];
            } else {
                // kalau gagal upload, kasih pesan error
                // $this->session->set_flashdata('error', $this->upload->display_errors());
                // cek jenis error
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'filetype') !== false) {
                    $this->session->set_flashdata('error', 'Maaf yang kamu upload bukan gambar dengan ekstensi jpg, jpeg ataupun png.');
                } elseif (strpos($error, 'filesize') !== false || strpos($error, 'larger') !== false) {
                    $this->session->set_flashdata('error', 'Maaf ukuran gambarmu terlalu besar dari 2 MB.');
                } else {
                    $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
                }
                redirect('dashboard/produk_tambah');
            }
        }

        // ambil data dari form
        $data = array(
            'produk_nama'       => $this->input->post('produk_nama'),
            'produk_harga'      => $this->input->post('produk_harga'),
            'produk_stok'       => $this->input->post('produk_stok'),
            'produk_kategori'   => $this->input->post('produk_kategori'),
            'produk_deskripsi'  => $this->input->post('produk_deskripsi'),
            'produk_sampul'     => $sampul,
            'tanggal_ditambahkan' => date('Y-m-d H:i:s')
        );

        // insert ke database
        $this->M_data->insert_data('produk', $data);

        // kasih notifikasi sukses
        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
        redirect('dashboard/produk');
    }
    public function produk_edit($encoded_id = null)
    {
        // Jika tidak ada ID, tampilkan halaman error
        if (!$encoded_id) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return;
        }

        // Denkripsi Id
        $id = $this->decrypt_url($encoded_id);

        // Validasi jika denkripsi gagal
        if (!$id || !is_numeric($id)) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return; // atau redirect('dashboard'); untuk diarahkan kembali
        }

        $where = array('produk_id' => $id);
        $data['produk'] = $this->M_data->edit_data('produk', $where)->row();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_produk_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function produk_edit_aksi()
    {
        $id = $this->input->post('produk_id');

        // ambil data lama (untuk cek gambar lama)
        $produk = $this->M_data->edit_data('produk', ['produk_id' => $id])->row();

        // config upload
        $config['upload_path']   = './uploads/produk_sampul/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = time() . '_' . $_FILES['produk_sampul']['name'];

        $this->load->library('upload', $config);

        $sampul = $produk->produk_sampul; // default pakai gambar lama

        if (!empty($_FILES['produk_sampul']['name'])) {
            if ($this->upload->do_upload('produk_sampul')) {
                $uploadData = $this->upload->data();
                $sampul = $uploadData['file_name'];

                // hapus gambar lama kecuali default.jpg
                if ($produk->produk_sampul != "default.jpg" && file_exists('./uploads/produk_sampul/' . $produk->produk_sampul)) {
                    unlink('./uploads/produk_sampul/' . $produk->produk_sampul);
                }
            } else {
                // $this->session->set_flashdata('error', $this->upload->display_errors());
                // cek jenis error
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'filetype') !== false) {
                    $this->session->set_flashdata('error', 'Maaf yang kamu upload bukan gambar dengan ekstensi jpg, jpeg ataupun png.');
                } elseif (strpos($error, 'filesize') !== false || strpos($error, 'larger') !== false) {
                    $this->session->set_flashdata('error', 'Maaf ukuran gambarmu terlalu besar dari 2 MB.');
                } else {
                    $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
                }
                redirect('dashboard/produk_edit/' . $this->encrypt_url($id));
            }
        }

        $data = array(
            'produk_nama'      => $this->input->post('produk_nama'),
            'produk_harga'     => $this->input->post('produk_harga'),
            'produk_stok'      => $this->input->post('produk_stok'),
            'produk_kategori'  => $this->input->post('produk_kategori'),
            'produk_deskripsi' => $this->input->post('produk_deskripsi'),
            'produk_sampul'    => $sampul
        );

        $where = array('produk_id' => $id);

        $this->M_data->update_data('produk', $data, $where);

        $this->session->set_flashdata('success', 'Produk berhasil diupdate!');
        redirect('dashboard/produk');
    }
    public function produk_hapus($encoded_id = null)
    {
        // Jika tidak ada ID, tampilkan halaman error
        if (!$encoded_id) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return;
        }

        // Denkripsi Id
        $id = $this->decrypt_url($encoded_id);

        // Validasi jika denkripsi gagal
        if (!$id || !is_numeric($id)) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return; // atau redirect('dashboard'); untuk diarahkan kembali
        }

        // cek dulu apakah produk ada
        $produk = $this->M_data->edit_data('produk', ['produk_id' => $id])->row();

        if ($produk) {
            // kalau ada gambarnya selain default, hapus file fisiknya
            if ($produk->produk_sampul != 'default.jpg' && file_exists('./uploads/produk_sampul/' . $produk->produk_sampul)) {
                unlink('./uploads/produk_sampul/' . $produk->produk_sampul);
            }

            // hapus data dari DB
            $this->M_data->delete_data('produk', ['produk_id' => $id]);

            $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
        }

        redirect('dashboard/produk');
    }


    // Fitur Pesan
    public function pesan()
    {
        $data['pesan'] = $this->M_data->get_pesan_with_pengguna();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pesan', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function pesan_status_edit_aksi()
    {
        $id = $this->input->post('pesan_id');
        $status = $this->input->post('pesan_status');

        // --- UPDATE ---
        $data = array(
            'pesan_status' => $status
        );

        $where = array('pesan_id' => $id);
        $this->M_data->update_data('pesan', $data, $where);

        $this->session->set_flashdata('success', 'Status pesan berhasil diupdate!');
        redirect('dashboard/pesan');
    }
    public function pesan_hapus($encoded_id = null)
    {
        // Jika tidak ada ID, tampilkan halaman error
        if (!$encoded_id) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return;
        }

        // Denkripsi Id
        $id = $this->decrypt_url($encoded_id);

        // Validasi jika denkripsi gagal
        if (!$id || !is_numeric($id)) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return; // atau redirect('dashboard'); untuk diarahkan kembali
        }

        // cek dulu apakah pesan ada
        $pesan = $this->M_data->edit_data('pesan', ['pesan_id' => $id])->row();

        if ($pesan) {
            // hapus data dari DB
            $this->M_data->delete_data('pesan', ['pesan_id' => $id]);

            $this->session->set_flashdata('success', 'pesan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'pesan tidak ditemukan.');
        }

        redirect('dashboard/pesan');
    }

    // Fitur pengguna
    public function pengguna()
    {
        $data['pengguna'] = $this->M_data->get_data('pengguna')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function pengguna_tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_tambah');
        $this->load->view('dashboard/v_footer');
    }
    public function pengguna_tambah_aksi()
    {
        // load library upload
        $config['upload_path']   = './uploads/pengguna_foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = time() . '_' . $_FILES['pengguna_foto']['name'];

        $this->load->library('upload', $config);

        // default gambar kalau tidak upload
        $foto = "default.jpg";

        if (!empty($_FILES['pengguna_foto']['name'])) {
            if ($this->upload->do_upload('pengguna_foto')) {
                $uploadData = $this->upload->data();
                $foto = $uploadData['file_name'];
            } else {
                // kalau gagal upload, kasih pesan error
                // $this->session->set_flashdata('error', $this->upload->display_errors());
                // cek jenis error
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'filetype') !== false) {
                    $this->session->set_flashdata('error', 'Maaf yang kamu upload bukan gambar dengan ekstensi jpg, jpeg ataupun png.');
                } elseif (strpos($error, 'filesize') !== false || strpos($error, 'larger') !== false) {
                    $this->session->set_flashdata('error', 'Maaf ukuran gambarmu terlalu besar dari 2 MB.');
                } else {
                    $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
                }
                redirect('dashboard/pengguna_tambah');
            }
        }

        // aturan validasi
        $this->form_validation->set_rules('pengguna_username', 'Username', 'required|is_unique[pengguna.pengguna_username]', [
            'is_unique' => 'Maaf, username sudah dipakai, silakan gunakan yang lain.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // balik ke form kalau gagal
            $this->session->set_flashdata('error', 'Username sudah digunakan');
            redirect('dashboard/pengguna_tambah');
        } else {
            // ambil data dari form
            $data = array(
                'pengguna_nama'          => $this->input->post('pengguna_nama'),
                'pengguna_username'      => $this->input->post('pengguna_username'),
                'pengguna_password'      => md5($this->input->post('pengguna_password')),
                'pengguna_level'         => $this->input->post('pengguna_level'),
                'pengguna_foto'          => $foto,
                'tanggal_ditambahkan'    => date('Y-m-d H:i:s')
            );

            // insert ke database
            $this->M_data->insert_data('pengguna', $data);

            // kasih notifikasi sukses
            $this->session->set_flashdata('success', 'pengguna berhasil ditambahkan!');
            redirect('dashboard/pengguna');
        }
    }
    public function pengguna_edit($encoded_id = null)
    {
        // Jika tidak ada ID, tampilkan halaman error
        if (!$encoded_id) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return;
        }

        // Denkripsi Id
        $id = $this->decrypt_url($encoded_id);

        // Validasi jika denkripsi gagal
        if (!$id || !is_numeric($id)) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return; // atau redirect('dashboard'); untuk diarahkan kembali
        }

        $where = array('pengguna_id' => $id);
        $data['pengguna'] = $this->M_data->edit_data('pengguna', $where)->row();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function pengguna_edit_aksi()
    {
        $id = $this->input->post('pengguna_id');

        // ambil data lama
        $pengguna = $this->M_data->edit_data('pengguna', ['pengguna_id' => $id])->row();

        // --- CEK USERNAME UNIK ---
        $username = $this->input->post('pengguna_username');
        $cek = $this->db->where('pengguna_username', $username)
            ->where('pengguna_id !=', $id)
            ->get('pengguna')
            ->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata('error', 'Maaf, username sudah dipakai user lain.');
            redirect('dashboard/pengguna_edit/' . $this->encrypt_url($id));
        }

        // config upload
        $config['upload_path']   = './uploads/pengguna_foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = time() . '_' . $_FILES['pengguna_foto']['name'];

        $this->load->library('upload', $config);

        $foto = $pengguna->pengguna_foto; // default pakai gambar lama

        if (!empty($_FILES['pengguna_foto']['name'])) {
            if ($this->upload->do_upload('pengguna_foto')) {
                $uploadData = $this->upload->data();
                $foto = $uploadData['file_name'];

                // hapus gambar lama kecuali default.jpg
                if ($pengguna->pengguna_foto != "default.jpg" && file_exists('./uploads/pengguna_foto/' . $pengguna->pengguna_foto)) {
                    unlink('./uploads/pengguna_foto/' . $pengguna->pengguna_foto);
                }
            } else {
                // $this->session->set_flashdata('error', $this->upload->display_errors());
                // cek jenis error
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'filetype') !== false) {
                    $this->session->set_flashdata('error', 'Maaf yang kamu upload bukan gambar dengan ekstensi jpg, jpeg ataupun png.');
                } elseif (strpos($error, 'filesize') !== false || strpos($error, 'larger') !== false) {
                    $this->session->set_flashdata('error', 'Maaf ukuran gambarmu terlalu besar dari 2 MB.');
                } else {
                    $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
                }
                redirect('dashboard/pengguna_edit/' . $this->encrypt_url($id));
            }
        }

        // --- CEK PASSWORD BARU ---
        $password_baru = $this->input->post('pengguna_password');
        if (!empty($password_baru)) {
            $password = md5($password_baru);
        } else {
            $password = $pengguna->pengguna_password;
        }

        // --- UPDATE ---
        $data = array(
            'pengguna_nama'       => $this->input->post('pengguna_nama'),
            'pengguna_username'   => $username,
            'pengguna_password'   => $password,
            'pengguna_level'      => $this->input->post('pengguna_level'),
            'pengguna_foto'       => $foto,
            'tanggal_ditambahkan' => date('Y-m-d H:i:s')
        );

        $where = array('pengguna_id' => $id);
        $this->M_data->update_data('pengguna', $data, $where);

        $this->session->set_flashdata('success', 'Pengguna berhasil diupdate!');
        redirect('dashboard/pengguna');
    }
    public function pengguna_hapus($encoded_id = null)
    {
        // Jika tidak ada ID, tampilkan halaman error
        if (!$encoded_id) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return;
        }

        // Denkripsi Id
        $id = $this->decrypt_url($encoded_id);

        // Validasi jika denkripsi gagal
        if (!$id || !is_numeric($id)) {
            $this->load->view('dashboard/v_header');
            $this->load->view('errors/custom_404_admin');
            $this->load->view('dashboard/v_footer');
            return; // atau redirect('dashboard'); untuk diarahkan kembali
        }

        // cek dulu apakah pengguna ada
        $pengguna = $this->M_data->edit_data('pengguna', ['pengguna_id' => $id])->row();

        if ($pengguna) {
            // kalau ada gambarnya selain default, hapus file fisiknya
            if ($pengguna->pengguna_foto != 'default.jpg' && file_exists('./uploads/pengguna_foto/' . $pengguna->pengguna_foto)) {
                unlink('./uploads/pengguna_foto/' . $pengguna->pengguna_foto);
            }

            // hapus data dari DB
            $this->M_data->delete_data('pengguna', ['pengguna_id' => $id]);

            $this->session->set_flashdata('success', 'pengguna berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'pengguna tidak ditemukan.');
        }

        redirect('dashboard/pengguna');
    }

    // Fitur profile
    public function profile_edit()
    {
        //ambil id pengguna yang sedang login dari session
        $current_user_id = $this->session->userdata('pengguna_id');
        $where = array(
            'pengguna_id' => $current_user_id
        );
        $data['profile_edit'] = $this->M_data->edit_data('pengguna', $where)->row();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_profile_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function profile_edit_aksi()
    {
        $id = $this->input->post('pengguna_id');

        // ambil data lama
        $pengguna = $this->M_data->edit_data('pengguna', ['pengguna_id' => $id])->row();

        // --- CEK USERNAME UNIK ---
        $username = $this->input->post('pengguna_username');
        $cek = $this->db->where('pengguna_username', $username)
            ->where('pengguna_id !=', $id)
            ->get('pengguna')
            ->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata('error', 'Maaf, username sudah dipakai user lain.');
            redirect('dashboard/profile_edit/');
        }

        // config upload
        $config['upload_path']   = './uploads/pengguna_foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = time() . '_' . $_FILES['pengguna_foto']['name'];

        $this->load->library('upload', $config);

        $foto = $pengguna->pengguna_foto; // default pakai gambar lama

        if (!empty($_FILES['pengguna_foto']['name'])) {
            if ($this->upload->do_upload('pengguna_foto')) {
                $uploadData = $this->upload->data();
                $foto = $uploadData['file_name'];

                // hapus gambar lama kecuali default.jpg
                if ($pengguna->pengguna_foto != "default.jpg" && file_exists('./uploads/pengguna_foto/' . $pengguna->pengguna_foto)) {
                    unlink('./uploads/pengguna_foto/' . $pengguna->pengguna_foto);
                }
            } else {
                // $this->session->set_flashdata('error', $this->upload->display_errors());
                // cek jenis error
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'filetype') !== false) {
                    $this->session->set_flashdata('error', 'Maaf yang kamu upload bukan gambar dengan ekstensi jpg, jpeg ataupun png.');
                } elseif (strpos($error, 'filesize') !== false || strpos($error, 'larger') !== false) {
                    $this->session->set_flashdata('error', 'Maaf ukuran gambarmu terlalu besar dari 2 MB.');
                } else {
                    $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
                }
                redirect('dashboard/profile_edit/');
            }
        }

        // --- CEK PASSWORD BARU ---
        $password_baru = $this->input->post('pengguna_password');
        if (!empty($password_baru)) {
            $password = md5($password_baru);
        } else {
            $password = $pengguna->pengguna_password;
        }

        // --- UPDATE ---
        $data = array(
            'pengguna_nama'       => $this->input->post('pengguna_nama'),
            'pengguna_username'   => $username,
            'pengguna_password'   => $password,
            'pengguna_foto'       => $foto,
            'tanggal_ditambahkan' => date('Y-m-d H:i:s')
        );

        $where = array('pengguna_id' => $id);
        $this->M_data->update_data('pengguna', $data, $where);

        $this->session->set_flashdata('success', 'Profil berhasil diupdate!');
        redirect('dashboard/profile_edit');
    }

    // Fitur pengaturan
    public function pengaturan()
    {
        $data['pengaturan'] = $this->M_data->get_data('pengaturan')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengaturan', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function pengaturan_edit_aksi()
    {
        $id = 1;
        // ambil data lama
        $pengaturan = $this->M_data->edit_data('pengaturan', ['pengaturan_id' => $id])->row();

        // config upload
        $config['upload_path']   = './uploads/pengaturan_logo_website/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = time() . '_' . $_FILES['pengaturan_logo_website']['name'];

        $this->load->library('upload', $config);

        $logo = $pengaturan->pengaturan_logo_website; // default pakai gambar lama

        if (!empty($_FILES['pengaturan_logo_website']['name'])) {
            if ($this->upload->do_upload('pengaturan_logo_website')) {
                $uploadData = $this->upload->data();
                $logo = $uploadData['file_name'];

                // hapus gambar lama kecuali default.jpg
                if ($pengaturan->pengaturan_logo_website != "default.jpg" && file_exists('./uploads/pengaturan_logo_website/' . $pengaturan->pengaturan_logo_website)) {
                    unlink('./uploads/pengaturan_logo_website/' . $pengaturan->pengaturan_logo_website);
                }
            } else {
                // $this->session->set_flashdata('error', $this->upload->display_errors());
                // cek jenis error
                $error = $this->upload->display_errors('', '');
                if (strpos($error, 'filetype') !== false) {
                    $this->session->set_flashdata('error', 'Maaf yang kamu upload bukan gambar dengan ekstensi jpg, jpeg ataupun png.');
                } elseif (strpos($error, 'filesize') !== false || strpos($error, 'larger') !== false) {
                    $this->session->set_flashdata('error', 'Maaf ukuran gambarmu terlalu besar dari 2 MB.');
                } else {
                    $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
                }
                redirect('dashboard/pengaturan/');
            }
        }

        // --- UPDATE ---
        $data = array(
            'pengaturan_nama_website'       => $this->input->post('pengaturan_nama_website'),
            'pengaturan_logo_website'       => $logo
        );

        $where = array('pengaturan_id' => $id);
        $this->M_data->update_data('pengaturan', $data, $where);

        $this->session->set_flashdata('success', 'Pengaturan berhasil diupdate!');
        redirect('dashboard/pengaturan');
    }
}
