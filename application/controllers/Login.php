<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
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

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_login');
    }

    function index()
    {
        $this->load->view('v_login');
    }

    // ---------------- LOGIN ----------------
    function proses_login()
    {
        $username = $this->input->post('pengguna_username');
        $password = $this->input->post('pengguna_password');

        $user = $this->M_login->cek_username($username);

        if ($user) {
            if ($user['pengguna_password'] == md5($password)) {
                // Set session
                $this->session->set_userdata([
                    'pengguna_id'       => $user['pengguna_id'],
                    'pengguna_nama'     => $user['pengguna_nama'],
                    'pengguna_username' => $user['pengguna_username'],
                    'pengguna_level'    => $user['pengguna_level'],
                    'pengguna_foto'    => $user['pengguna_foto'],
                    'status_login'      => true
                ]);

                $this->session->set_flashdata('success', 'Login berhasil!');

                if ($user['pengguna_level'] == 'pengunjung') {
                    redirect('');
                } elseif ($user['pengguna_level'] == 'admin') {
                    redirect('dashboard');
                } else {
                    redirect('login'); // fallback
                }
            } else {
                $this->session->set_flashdata('error', 'Password salah!');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', 'Username tidak ditemukan!');
            redirect('login');
        }
    }


    // ---------------- REGISTER ----------------
    function proses_register()
    {
        $nama        = $this->input->post('pengguna_nama');
        $username    = $this->input->post('pengguna_username');
        $password    = $this->input->post('pengguna_password');
        $konfirmasi  = $this->input->post('pengguna_password2');

        // Cek password sama atau tidak
        if ($password != $konfirmasi) {
            $this->session->set_flashdata('error', 'Password dan konfirmasi tidak sama!');
            redirect('login');
        }

        // Cek username sudah ada atau belum
        $cek_user = $this->M_login->cek_username($username);
        if ($cek_user) {
            $this->session->set_flashdata('error', 'Username sudah ada!');
            redirect('login');
        }

        $data = [
            'pengguna_nama'     => $nama,
            'pengguna_username' => $username,
            'pengguna_password' => md5($password),
            'pengguna_level'    => 'pengunjung',
            'tanggal_ditambahkan'  => date('Y-m-d H:i:s')
        ];

        if ($this->M_login->register($data)) {
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Registrasi gagal!');
            redirect('login');
        }
    }


    // ---------------- LOGOUT ----------------
    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
