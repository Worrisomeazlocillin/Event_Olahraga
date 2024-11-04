<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\EventModel;
use App\Models\KategoriEventModel;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;

class PendaftaranController extends BaseController
{
    protected $eventModel;
    protected $kategorieventModel;
    protected $pendaftaranModel;
    protected $provinsiModel;

    public function __construct() {
        $this->eventModel = new EventModel(); // Inisialisasi EventModel
        $this->kategorieventModel = new KategoriEventModel();
        $this->pendaftaranModel = new PendaftaranModel(); // Inisialisasi model pendaftaran jika diperlukan
        $this->provinsiModel = new ProvinsiModel();
    }

    public function index()
    {
        // Menginstansiasi model PendaftaranModel
        $pendaftaranModel = new PendaftaranModel();

        // Mengambil data pendaftaran dengan detail menggunakan fungsi getPesertaWithDetails
        $data['pendaftaran'] = $pendaftaranModel->getPesertaWithDetails();

        // Mengembalikan view dengan data pendaftaran
        return view('pendaftaran/index', $data);
    }
    
    public function create()
    {
        // Inisialisasi model yang dibutuhkan
        $this->EventModel = new EventModel(); // Menggunakan $this untuk akses model
        $this->KategoriEventModel = new KategoriEventModel();
        $this->ProvinsiModel = new ProvinsiModel();

        // Ambil semua event gratis (biaya 0), kategori event, dan provinsi untuk dropdown
        $data['events'] = $this->eventModel->where('biaya', 0)->findAll(); // Ambil event dengan biaya 0
        $data['kategori_events'] = $this->KategoriEventModel->findAll(); 
        $data['provinsi'] = $this->ProvinsiModel->findAll(); 

        return view('pendaftaran/pendaftaran_gratis', $data); // Ganti dengan nama view yang sesuai
    }

    public function get_kabupaten($id_provinsi)
    {
        $kabupatenModel = new KabupatenModel();
        $kabupaten = $kabupatenModel->where('id_provinsi', $id_provinsi)->findAll();
        return $this->response->setJSON($kabupaten);
    }

    public function store() {
        if (!$this->validate([
            'id_kabupaten' => 'required',
            'id_event' => 'required',
            'kategori_event' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $idKategoriEvent = $this->request->getPost('kategori_event');
        $kategori = $this->kategoriEventModel->find($idKategoriEvent);

        if (!$kategori) {
            return redirect()->back()->withInput()->with('errors', ['ID kategori event tidak valid.']);
        }

        // Simpan data pendaftaran
        $data = [
            'id_event' => $this->request->getPost('id_event'),
            'kategori_event' => $this->request->getPost('kategori_event'),
            'id_provinsi' => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'nama_bib' => $this->request->getPost('nama_bib'),
            'no_identitas' => $this->request->getPost('no_identitas'),
            'golongan_darah' => $this->request->getPost('golongan_darah'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'riwayat_penyakit' => $this->request->getPost('riwayat_penyakit'),
            'ukuran_kaos' => $this->request->getPost('ukuran_kaos'),
            'kontak_darurat_nama_lengkap' => $this->request->getPost('kontak_darurat_nama_lengkap'),
            'kontak_darurat_no_hp' => $this->request->getPost('kontak_darurat_no_hp'),
            'kontak_darurat_hubungan' => $this->request->getPost('kontak_darurat_hubungan'),
            'persetujuan_peserta' => $this->request->getPost('persetujuan_peserta'),
            'rute' => $kategori['rute'], // Ambil rute dari kategori_event
            'biaya' => $kategori['biaya'], // Ambil biaya dari kategori_event
        ];

        // Panggil model untuk menyimpan data pendaftaran
        $pendaftaranModel = new PendaftaranModel();
        $pendaftaranModel->save($data);

        return redirect()->to('/pendaftaran/success'); // Ganti dengan rute yang sesuai
    }

    public function peserta()
    {
        // Pastikan model telah diinisialisasi
        $pendaftaranModel = new PendaftaranModel();

        // Mengambil semua data pendaftaran
        $pesertaList = $pendaftaranModel->findAll();

        // Konversi status persetujuan menjadi 'Y' atau 'N'
        foreach ($pesertaList as &$peserta) {
            $peserta['persetujuan_peserta'] = $peserta['persetujuan_peserta'] ? 'Y' : 'N';
        }

        // Mengirim data ke view
        $data = [
            'pesertaList' => $pesertaList,
        ];

        return view('pendaftaran/peserta', $data);
    }

    // Ajax untuk mendapatkan kategori event berdasarkan id_event
    public function getKategoriEventByEvent($id_event)
    {
        $kategori_events = $this->kategorieventModel->where('id_event', $id_event)->findAll();
        return $this->response->setJSON($kategori_events);
    }

    // Form Berbayar
    public function formBerbayar($event_id = null)
    {
        // Ambil data event yang dipilih
        $event = null;
        if ($event_id !== null) {
            $event = $this->eventModel->find($event_id);
        }

         // Ambil semua event, kategori event terkait, dan provinsi
        $data['events'] = $this->eventModel->findAll();
        $data['kategori_events'] = $this->kategorieventModel->where('id_event', $event_id)->findAll(); // Filter kategori event
        $data['provinsi'] = $this->provinsiModel->findAll();

        return view('pendaftaran/form_berbayar', [
            'event_id' => $event_id, 
            'event' => $event,
            'events' => $data['events'],
            'kategori_events' => $data['kategori_events'], // Kirim kategori event terkait ke view
            'provinsi' => $data['provinsi']
        ]);
    }

    public function formGratis($event_id)
    {
        // Inisialisasi model yang diperlukan
        $eventModel = new EventModel();
        $kategorieventModel = new KategoriEventModel(); // Tambahkan inisialisasi KategoriEventModel
        $provinsiModel = new ProvinsiModel();

        // Ambil detail event dari model berdasarkan ID
        $event = $eventModel->find($event_id);
        if (!$event) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Event dengan ID $event_id tidak ditemukan.");
        }

        // Ambil kategori event yang terkait dengan event ini
        $kategori_events = $kategorieventModel->where('id_event', $event_id)->findAll();

        // Ambil provinsi untuk dropdown
        $provinsi = $provinsiModel->findAll();

        // Kirim data ke view
        return view('pendaftaran/form_gratis', [
            'event' => $event,
            'kategori_events' => $kategori_events,
            'provinsi' => $provinsi,
            'event_id' => $event_id, // Tambahkan $event_id ke view
        ]);
    }
    
    // Store Berbayar
    public function storeBerbayar()
    {
        // Validasi data
        $this->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|valid_email',
            'no_hp' => 'required',
            'alamat_lengkap' => 'required',
            'id_event' => 'required',
            'kategori_event' => 'required',
            'id_provinsi' => 'required',
            'id_kabupaten' => 'required',
            'kewarganegaraan' => 'required',
            'nama_bib' => 'required',
            'no_identitas' => 'required',
            'golongan_darah' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'riwayat_penyakit' => 'required',
            'ukuran_kaos' => 'required',
            'kontak_darurat_nama_lengkap' => 'required',
            'kontak_darurat_no_hp' => 'required',
            'kontak_darurat_hubungan' => 'required',
            'persetujuan_peserta' => 'required'
        ]);

        // Ambil kategori event berdasarkan ID kategori event
        $kategoriEventModel = new KategoriEventModel();
        $idKategoriEvent = $this->request->getPost('kategori_event'); // Ambil ID kategori dari request

        // Tambahkan pengecekan jika `kategori_event` kosong
        if (empty($idKategoriEvent)) {
            return redirect()->back()->withInput()->with('errors', ['Kategori event tidak boleh kosong.']);
        }

        $kategori = $kategoriEventModel->find($idKategoriEvent);

        if (!$kategori) {
            return redirect()->back()->withInput()->with('errors', ['ID kategori event tidak valid.']);
        }

        // Ambil data dari form
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'id_event' => $this->request->getPost('id_event'),
            'kategori_event' => $idKategoriEvent, // Pastikan `kategori_event` terisi
            'rute' => $kategori['rute'] ?? null, // Gunakan null jika 'rute' tidak ada
            'biaya' => $kategori['biaya'] ?? 0, // Gunakan 0 jika 'biaya' tidak ada
            'id_provinsi' => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'nama_bib' => $this->request->getPost('nama_bib'),
            'no_identitas' => $this->request->getPost('no_identitas'),
            'golongan_darah' => $this->request->getPost('golongan_darah'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'riwayat_penyakit' => $this->request->getPost('riwayat_penyakit'),
            'ukuran_kaos' => $this->request->getPost('ukuran_kaos'),
            'kontak_darurat_nama_lengkap' => $this->request->getPost('kontak_darurat_nama_lengkap'),
            'kontak_darurat_no_hp' => $this->request->getPost('kontak_darurat_no_hp'),
            'kontak_darurat_hubungan' => $this->request->getPost('kontak_darurat_hubungan'),
            'persetujuan_peserta' => $this->request->getPost('persetujuan_peserta'),
            'jenis_pendaftaran' => 'berbayar' // Menandai sebagai pendaftaran berbayar
        ];

        // Simpan ke tabel pendaftaran
        $this->pendaftaranModel->save($data);

        // Redirect ke halaman dashboard pengguna
        return redirect()->to('/event/peserta')->with('message', 'Pendaftaran Berbayar Berhasil');
    }

    // Store Gratis
    public function storeGratis()
    {
        // Validasi data
        $this->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|valid_email',
            'no_hp' => 'required',
            'alamat_lengkap' => 'required',
            'id_event' => 'required',
            'kategori_event' => 'required',
            'id_provinsi' => 'required',
            'id_kabupaten' => 'required',
            'kewarganegaraan' => 'required',
            'nama_bib' => 'required',
            'no_identitas' => 'required',
            'golongan_darah' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'riwayat_penyakit' => 'required',
            'ukuran_kaos' => 'required',
            'kontak_darurat_nama_lengkap' => 'required',
            'kontak_darurat_no_hp' => 'required',
            'kontak_darurat_hubungan' => 'required',
            'persetujuan_peserta' => 'required'
        ]);

        // Ambil kategori event berdasarkan ID kategori event
        $kategoriEventModel = new KategoriEventModel();
        $idKategoriEvent = $this->request->getPost('kategori_event'); // Ambil ID kategori dari request
        $kategori = $kategoriEventModel->find($idKategoriEvent);

        // Cek apakah kategori ditemukan dan memiliki rute
        if (!$kategori || !isset($kategori['rute'])) {
            return redirect()->back()->withInput()->with('errors', ['ID kategori event tidak valid atau rute tidak ditemukan.']);
        }

        // Ambil data dari form
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'id_event' => $this->request->getPost('id_event'),
            'kategori_event' => $this->request->getPost('kategori_event'),
            'rute' => $kategori['rute'], // Ambil rute dari kategori
            'biaya' => 0, // Biaya gratis // Ambil biaya dari kategori
            'id_provinsi' => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'nama_bib' => $this->request->getPost('nama_bib'),
            'no_identitas' => $this->request->getPost('no_identitas'),
            'golongan_darah' => $this->request->getPost('golongan_darah'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'riwayat_penyakit' => $this->request->getPost('riwayat_penyakit'),
            'ukuran_kaos' => $this->request->getPost('ukuran_kaos'),
            'kontak_darurat_nama_lengkap' => $this->request->getPost('kontak_darurat_nama_lengkap'),
            'kontak_darurat_no_hp' => $this->request->getPost('kontak_darurat_no_hp'),
            'kontak_darurat_hubungan' => $this->request->getPost('kontak_darurat_hubungan'),
            'persetujuan_peserta' => $this->request->getPost('persetujuan_peserta'),
            'jenis_pendaftaran' => 'berbayar' // Menandai sebagai pendaftaran berbayar
        ];

        if ($pendaftaranModel->insert($data)) {
            return redirect()->to('pendaftaran/peserta')->with('success', 'Pendaftaran berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function edit($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $peserta = $this->pendaftaranModel->find($id);
        if (!$peserta) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Peserta dengan ID $id tidak ditemukan.");
        }

        // Data tambahan, misalnya daftar provinsi, kategori, dll.
        $provinsi = $this->provinsiModel->findAll();
        $kategori_event = $this->kategoriEventModel->findAll(); // Panggilan model kategori event

        // Kirim data ke view
        return view('pendaftaran/edit', [
            'peserta' => $peserta,
            'provinsi' => $provinsi,
            'kategori_event' => $kategori_event,
        ]);
    }

}

