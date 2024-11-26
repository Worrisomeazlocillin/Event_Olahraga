<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\DetailEventModel;
use App\Models\KategoriEventModel;
use App\Models\BiayaModel;
use App\Models\PendaftaranModel;
use CodeIgniter\Controller;

class EventController extends Controller
{
    protected $eventModel;
    protected $kategoriEventModel;
    protected $biayaModel;
    protected $detailEventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->detailEventModel = new DetailEventModel();
        $this->kategoriEventModel = new KategoriEventModel(); // Inisialisasi model
        $this->biayaModel = new BiayaModel();
    }

    public function index()
    {
        $events = $this->eventModel->findAll(); // Mengambil semua event dari database

        return view('events/index', ['events' => $events]);
    }

    public function create()
    {
        return view('events/create'); // Menampilkan form untuk membuat event
    }

    public function store()
    {
        // Ambil data dari form
        $data = [
            'event_name'   => $this->request->getPost('event_name'),
            'event_date'   => $this->request->getPost('event_date'),
            'location'     => $this->request->getPost('location'),
            'description'  => $this->request->getPost('description'),
            'event_image'  => $this->request->getFile('event_image'), // File upload
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        // Proses upload gambar
        if ($data['event_image']->isValid() && !$data['event_image']->hasMoved()) {
            $newName = $data['event_image']->getRandomName();
            $data['event_image']->move('uploads/', $newName);
            $data['event_image'] = $newName; // Simpan nama file gambar
        }

        // Simpan data ke database
        $this->eventModel->save($data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->to('/events')->with('success', 'Event berhasil dibuat!');
    }

    // Metode untuk menampilkan form edit event
    public function edit($id)
    {
        // Use the initialized model property to find the event
        $event = $this->eventModel->find($id);
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Event not found');
        }

        $data['event'] = $event;
        return view('events/edit', $data);
    }

    // Metode untuk memperbarui event
    public function update($id)
    {
        $eventModel = new EventModel();

        $data = [
            'event_name' => $this->request->getPost('event_name'),
            'event_date' => $this->request->getPost('event_date'),
            'location' => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
        ];

        // Cek jika ada gambar yang diunggah
        if ($this->request->getFile('event_image')->isValid()) {
            $file = $this->request->getFile('event_image');
            $newName = $file->getRandomName(); // Nama file baru
            $file->move('uploads', $newName); // Pindahkan file ke folder uploads
            $data['event_image'] = $newName; // Simpan nama file gambar di data
        }

        // Update event ke database
        $eventModel->update($id, $data);

        return redirect()->to('/events'); // Redirect ke halaman event
    }

    // Metode untuk menghapus event
    public function delete($id)
    {
        // Use the initialized model property to delete the event
        $this->eventModel->delete($id);
        return redirect()->to('/events');
    }

    public function storeAndProceed()
    {
        // Validasi dan penyimpanan event
        $data = [
            'event_name' => $this->request->getPost('event_name'),
            'event_date' => $this->request->getPost('event_date'),
            'location' => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
        ];
        
        // Simpan event ke database
        $this->eventModel->save($data);

        return redirect()->to('/events')->with('success', 'Event berhasil disimpan!');
    }

    public function detail($id)
    {
        // Inisialisasi model yang diperlukan
        $eventModel = new \App\Models\EventModel();
        $kategoriEventModel = new \App\Models\KategoriEventModel(); // Model untuk kategori_event

        // Ambil data event berdasarkan ID
        $event = $eventModel->find($id);

        if (!$event) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Event tidak ditemukan');
        }

        // Ambil data kategori berdasarkan id_event
        $categories = $kategoriEventModel->where('id_event', $id)->findAll();

        // Pastikan ada kategori yang ditemukan
        if (empty($categories)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori tidak ditemukan untuk event ini');
        }

        // Cek apakah ada kategori dengan biaya 0 (gratis) dan biaya > 0 (berbayar)
        $hasFreeCategory = false;
        $hasPaidCategory = false;

        foreach ($categories as $category) {
            if ($category['biaya'] == 0) {
                $hasFreeCategory = true;
            } else {
                $hasPaidCategory = true;
            }
        }

        // Kirim data ke view
        return view('events/detail', [
            'event' => $event,
            'categories' => $categories, // Mengirim data kategori ke view
            'hasFreeCategory' => $hasFreeCategory,
            'hasPaidCategory' => $hasPaidCategory,
        ]);
    }

    public function peserta($id_event)
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data event
        $event = $this->getEventById($id_event); // Pastikan metode ini ada untuk mendapatkan detail event

        // Ambil peserta berdasarkan id_event
        $data['peserta'] = $pendaftaranModel->where('id_event', $id_event)->findAll();
        $data['event'] = $event; // Mengirim data event ke view

        return view('pendaftaran/peserta', $data); // Tampilkan view dengan data
    }

    private function getEventById($id_event)
    {
        $eventModel = new EventModel(); // Pastikan Anda memiliki model untuk mengambil event
        return $eventModel->find($id_event);
    }

    public function search()
    {
        $eventModel = new EventModel();
        $searchQuery = $this->request->getGet('query');

        // Cari event berdasarkan nama event yang cocok dengan query pencarian
        if ($searchQuery) {
            $events = $eventModel->like('event_name', $searchQuery)->findAll();
        } else {
            $events = $eventModel->findAll();
        }

        // Kirim hasil pencarian ke view
        return view('user/user_dashboard', [
            'events' => $events,
            'searchQuery' => $searchQuery // Mengirim query ke view untuk ditampilkan di search bar
        ]);
    }
}
