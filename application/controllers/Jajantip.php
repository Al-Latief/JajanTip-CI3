<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jajantip extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

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

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_data');

		// Cek Login
		// if ($this->session->userdata('status_login') != "telah_login" || $this->session->userdata('pengguna_level') != "pengunjung") {
		// 	$this->session->set_flashdata('error', 'Akses ditolak! Anda harus login sebagai pengunjung.');
		// 	redirect('login');
		// }
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

	// Fitur Homepage
	public function index()
	{
		// ambil 3 produk acak dari tabel produk
		$this->db->order_by('RAND()');
		$this->db->limit(3);
		$data['produk'] = $this->db->get('produk')->result();

		$this->load->view('frontend/v_header');
		$this->load->view('frontend/v_index', $data);
		$this->load->view('frontend/v_footer');
	}

	// Fitur halaman produk
	public function produk()
	{
		$keyword  = $this->input->get('q');

		// Ambil semua kategori unik
		$data['kategori'] = $this->M_data->getKategori();

		$produk_per_kategori = [];
		foreach ($data['kategori'] as $kat) {
			// Ambil semua produk per kategori
			$produk_per_kategori[$kat->produk_kategori] = $this->M_data->getProduk($keyword, $kat->produk_kategori)->result();
		}

		$data['produk_per_kategori'] = $produk_per_kategori;

		$this->load->view('frontend/v_header');
		$this->load->view('frontend/v_produk', $data);
		$this->load->view('frontend/v_footer');
	}

	// Fitur halaman produk detail
	public function produk_detail($encoded_id = null)
	{
		// Denkripsi Id
		$id = $this->decrypt_url($encoded_id);

		$produk = $this->M_data->getProdukById($id);

		if (!$produk) {
			show_404();
		}

		$data['produk'] = $produk;

		$this->load->view('frontend/v_header');
		$this->load->view('frontend/v_produk_detail', $data);
		$this->load->view('frontend/v_footer');
	}

	// Fitur kirim pesan
	public function kirim_pesan()
	{
		// ambil data dari form
		$data = array(
			'pengguna_id'       => $this->input->post('pengguna_id'),
			'pesan_konten'       => $this->input->post('pesan_konten'),
			'pesan_status'       => 'belum terbaca',
			'tanggal_ditambahkan' => date('Y-m-d H:i:s')
		);

		// insert ke database
		$this->M_data->insert_data('pesan', $data);

		// kasih notifikasi sukses
		$this->session->set_flashdata('success', 'Produk berhasil dikirim!');
		redirect('jajantip');
	}

	// Fitur edit profil
	public function pengguna_edit($encoded_id = null)
	{
		// Jika tidak ada ID, tampilkan halaman error
		if (!$encoded_id) {
			show_404();
			return;
		}

		// Denkripsi Id
		$id = $this->decrypt_url($encoded_id);

		// Validasi jika denkripsi gagal
		if (!$id || !is_numeric($id)) {
			show_404();
			return; // atau redirect('dashboard'); untuk diarahkan kembali
		}

		$where = array('pengguna_id' => $id);
		$data['pengguna'] = $this->M_data->edit_data('pengguna', $where)->row();

		$this->load->view('frontend/v_header');
		$this->load->view('frontend/v_pengguna_edit', $data);
		$this->load->view('frontend/v_footer');
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
			redirect('pengguna_edit/' . $this->encrypt_url($id));
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
				redirect('pengguna_edit/' . $this->encrypt_url($id));
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

		$this->session->set_flashdata('success', 'Pengguna berhasil diupdate!');
		redirect('pengguna_edit/' . $this->encrypt_url($id));
	}
}
