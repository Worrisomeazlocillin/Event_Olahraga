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

    public function __construct()
    {
        $this->eventModel = new EventModel(); // Inisialisasi EventModel
        $this->kategorieventModel = new KategoriEventModel();
        $this->pendaftaranModel = new PendaftaranModel(); // Inisialisasi model pendaftaran jika diperlukan
        $this->provinsiModel = new ProvinsiModel();
    }

    //Fungsi Index
    public function index()
    {
        // Menginstansiasi model PendaftaranModel
        $pendaftaranModel = new PendaftaranModel();

        // Mengambil data pendaftaran dengan detail menggunakan fungsi getPesertaWithDetails
        $data['pendaftaran'] = $pendaftaranModel->getPesertaWithDetails();

        // Mengembalikan view dengan data pendaftaran
        return view('pendaftaran/index', $data);
    }

    // Fungsi Create
    public function create()
    {

        // Ambil semua event gratis (biaya 0), kategori event, dan provinsi untuk dropdown
        $data['events'] = $this->eventModel->where('biaya', 0)->findAll(); // Ambil event dengan biaya 0
        $data['kategori_events'] = $this->kategorieventModel->findAll();
        $data['provinsi'] = $this->provinsiModel->findAll();

        return view('pendaftaran/pendaftaran_gratis', $data); // Ganti dengan nama view yang sesuai
    }

    // Fungsi Get Kabupaten
    public function get_kabupaten($id_provinsi)
    {
        $kabupatenModel = new KabupatenModel();
        $kabupaten = $kabupatenModel->where('id_provinsi', $id_provinsi)->findAll();
        return $this->response->setJSON($kabupaten);
    }

    // Fungsi Store
    public function store()
    {
        if (!$this->validate([
            'id_kabupaten' => 'required',
            'id_event' => 'required',
            'kategori_event' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $idKategoriEvent = $this->request->getPost('kategori_event');
        $kategori = $this->kategorieventModel->find($idKategoriEvent);

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

        return redirect()->to('/pendaftaran/peserta'); // Ganti dengan rute yang sesuai
    }

    public function peserta($id_event = null)
    {
        // Pastikan ID event telah diteruskan
        if ($id_event === null) {
            return redirect()->to('/pendaftaran')->with('error', 'Event tidak ditemukan.');
        }

        // Ambil data event berdasarkan ID
        $eventModel = new EventModel();
        $event = $eventModel->find($id_event);

        if (!$event) {
            return redirect()->to('/pendaftaran')->with('error', 'Event tidak ditemukan.');
        }

        // Mengambil daftar peserta untuk event tertentu
        $pendaftaranModel = new PendaftaranModel();
        $pesertaList = $pendaftaranModel->where('id_event', $id_event)->findAll();

        // Inisialisasi model untuk kategori event
        $kategoriEventModel = new KategoriEventModel();

        // Memproses daftar peserta dan menambahkan nama kategori event
        foreach ($pesertaList as &$peserta) {
            // Ambil data kategori event berdasarkan ID kategori
            $kategori = $kategoriEventModel->find($peserta['kategori_event']);

            // Tambahkan nama kategori ke peserta jika data ditemukan
            $peserta['kategori_event_nama'] = $kategori ? $kategori['nama_kategori'] : 'Kategori Tidak Ditemukan';

            // Konversi status persetujuan menjadi 'Y' atau 'N'
            $peserta['persetujuan_peserta'] = $peserta['persetujuan_peserta'] ? 'Y' : 'N';
        }

        // Kirim data ke view
        $data = [
            'event' => $event, // Data event untuk ditampilkan di view
            'pesertaList' => $pesertaList, // Daftar peserta yang sudah dikonversi
        ];

        // Mengembalikan view peserta dengan data event dan peserta
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

        // Ambil semua provinsi untuk dropdown
        $provinsi = $provinsiModel->findAll();

        // Kirim data ke view
        return view('pendaftaran/form_gratis', [
            'event_id' => $event_id,
            'event' => $event,
            'events' => $eventModel->findAll(),
            'kategori_events' => $kategori_events, // Kirim kategori event terkait ke view
            'provinsi' => $provinsi
        ]);
    }

    public function delete($id)
    {
        $model = new PendaftaranModel();

        // Hapus data berdasarkan ID
        if ($model->delete($id)) {
            return redirect()->to('/pendaftaran')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('/pendaftaran')->with('error', 'Data gagal dihapus');
        }
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
            'rute' => $kategori['rute'], // Gunakan null jika 'rute' tidak ada
            'biaya' => $kategori['biaya'], // Gunakan 0 jika 'biaya' tidak ada
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
        $idEvent = $this->request->getPost('id_event');
        return redirect()->to(site_url("payment/form/" . $idEvent))
            ->with('success', 'Pendaftaran berhasil! Silakan lanjutkan ke pembayaran.');
    }

    // // Store Gratis
    // public function storeGratis()
    // {
    //     // Validasi input form
    //     if (!$this->validate([
    //         'nama_lengkap' => 'required',
    //         'email' => 'required|valid_email',
    //         'no_hp' => 'required',
    //         'alamat_lengkap' => 'required',
    //         'id_event' => 'required',
    //         'kategori_event' => 'required',
    //         'id_provinsi' => 'required',
    //         'id_kabupaten' => 'required',
    //         'kewarganegaraan' => 'required',
    //         'nama_bib' => 'required',
    //         'no_identitas' => 'required',
    //         'golongan_darah' => 'required',
    //         'jenis_kelamin' => 'required',
    //         'tanggal_lahir' => 'required',
    //         'riwayat_penyakit' => 'required',
    //         'ukuran_kaos' => 'required',
    //         'kontak_darurat_nama_lengkap' => 'required',
    //         'kontak_darurat_no_hp' => 'required',
    //         'kontak_darurat_hubungan' => 'required',
    //         'persetujuan_peserta' => 'required'
    //     ])) {
    //         // Jika validasi gagal, kembali ke form dengan pesan error
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     // Ambil kategori event berdasarkan ID kategori event
    //     $kategoriEventModel = new KategoriEventModel();
    //     $idKategoriEvent = $this->request->getPost('kategori_event'); // Ambil ID kategori dari request

    //     // Tambahkan pengecekan jika `kategori_event` kosong
    //     if (empty($idKategoriEvent)) {
    //         return redirect()->back()->withInput()->with('errors', ['Kategori event tidak boleh kosong.']);
    //     }

    //     $kategori = $kategoriEventModel->find($idKategoriEvent);

    //     if (!$kategori) {
    //         return redirect()->back()->withInput()->with('errors', ['ID kategori event tidak valid.']);
    //     }

    //     // Ambil data dari form
    //     $data = [
    //         'nama_lengkap' => $this->request->getPost('nama_lengkap'),
    //         'email' => $this->request->getPost('email'),
    //         'no_hp' => $this->request->getPost('no_hp'),
    //         'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
    //         'id_event' => $this->request->getPost('id_event'),
    //         'kategori_event' => $idKategoriEvent, // Pastikan `kategori_event` terisi
    //         'rute' => $kategori['rute'] ?? null, // Gunakan null jika 'rute' tidak ada
    //         'biaya' => 0, // Set biaya menjadi 0 untuk pendaftaran gratis
    //         'id_provinsi' => $this->request->getPost('id_provinsi'),
    //         'id_kabupaten' => $this->request->getPost('id_kabupaten'),
    //         'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
    //         'nama_bib' => $this->request->getPost('nama_bib'),
    //         'no_identitas' => $this->request->getPost('no_identitas'),
    //         'golongan_darah' => $this->request->getPost('golongan_darah'),
    //         'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
    //         'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
    //         'riwayat_penyakit' => $this->request->getPost('riwayat_penyakit'),
    //         'ukuran_kaos' => $this->request->getPost('ukuran_kaos'),
    //         'kontak_darurat_nama_lengkap' => $this->request->getPost('kontak_darurat_nama_lengkap'),
    //         'kontak_darurat_no_hp' => $this->request->getPost('kontak_darurat_no_hp'),
    //         'kontak_darurat_hubungan' => $this->request->getPost('kontak_darurat_hubungan'),
    //         'persetujuan_peserta' => $this->request->getPost('persetujuan_peserta'),
    //         'jenis_pendaftaran' => 'gratis' // Menandai sebagai pendaftaran gratis
    //     ];

    //     // Simpan ke tabel pendaftaran
    //     $this->pendaftaranModel->save($data);
    //     // Redirect ke halaman detail event setelah berhasil
    //     return redirect()->to('pendaftaran/peserta/' . $this->request->getPost('event_id'));
    // }
    // app/Controllers/PendaftaranController.php

    public function edit($idPeserta)
    {
        // Ambil data peserta berdasarkan ID peserta
        $pendaftaran = $this->pendaftaranModel->find($idPeserta);

        // Periksa apakah data peserta ditemukan
        if (!$pendaftaran) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Peserta dengan ID $idPeserta tidak ditemukan");
        }

        // Ambil data event terkait menggunakan `id_event` dari peserta
        $eventModel = new \App\Models\EventModel();
        $event = $eventModel->find($pendaftaran['id_event']);

        // Periksa apakah event terkait ditemukan
        if (!$event) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Event dengan ID " . $pendaftaran['id_event'] . " tidak ditemukan");
        }

        // Ambil data semua event untuk dropdown
        $events = $eventModel->findAll();

        // Ambil data kategori event dan provinsi untuk dropdown
        $data = [
            'pendaftaran' => $pendaftaran,
            'event' => $event,
            'events' => $events, // Tambahkan ini
            'kategori_events' => $this->kategorieventModel->findAll(),
            'provinsi' => $this->provinsiModel->findAll(),
        ];

        // Menampilkan form edit dengan data peserta yang sudah ada
        return view('pendaftaran/edit', $data);
    }

    public function update($idPeserta)
    {
        // Validasi input
        if (!$this->validate([
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
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data kategori event berdasarkan ID kategori event
        $kategoriEventModel = new KategoriEventModel();
        $idKategoriEvent = $this->request->getPost('kategori_event');
        $kategori = $kategoriEventModel->find($idKategoriEvent);

        // Cek jika `kategori_event` valid
        if (!$kategori) {
            return redirect()->back()->withInput()->with('errors', ['Kategori event tidak valid atau tidak ditemukan.']);
        }

        // Ambil data dari form untuk update
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'id_event' => $this->request->getPost('id_event'),
            'kategori_event' => $idKategoriEvent,
            'rute' => $kategori['rute'] ?? null,
            'biaya' => $kategori['biaya'] ?? 0,
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
            'jenis_pendaftaran' => 'berbayar'
        ];

        // Update data ke database
        $this->pendaftaranModel->update($idPeserta, $data);

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->to('/pendaftaran/index')->with('success', 'Data berhasil diperbarui');
    }
}
