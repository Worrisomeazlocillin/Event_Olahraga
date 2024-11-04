<?php

namespace App\Controllers;

use App\Models\KategoriEventModel;
use App\Models\EventModel;

class KategoriEventController extends BaseController
{
    public function index()
    {
        // Inisialisasi model kategori event dan event
        $categoryModel = new \App\Models\KategoriEventModel(); // Pastikan Anda sudah menginisialisasi model yang benar
        $eventModel = new \App\Models\EventModel(); // Untuk mengambil nama event dari tabel events

        // Ambil parameter pencarian dari URL
        $search = $this->request->getGet('search');

        // Ambil data kategori dengan nama event
        if ($search) {
            // Jika ada parameter pencarian, lakukan query pencarian berdasarkan nama event
            $categories = $categoryModel->select('kategori_event.*, events.event_name')
                ->join('events', 'events.id = kategori_event.id_event', 'left')
                ->like('events.event_name', $search)
                ->findAll();
        } else {
            // Jika tidak ada parameter pencarian, ambil semua data
            $categories = $categoryModel->select('kategori_event.*, events.event_name')
                ->join('events', 'events.id = kategori_event.id_event', 'left')
                ->findAll();
        }

        // Ambil semua event untuk digunakan dalam tampilan
        $events = $eventModel->findAll();

        // Render view dan kirim data kategori dan event ke view
        return view('categories/index', [
            'categories' => $categories,
            'events' => $events // Mengirimkan data events ke view
        ]);
    }

    public function create()
    {
        // Ambil event dari tabel events
        $eventModel = new \App\Models\EventModel();
        
        // Simpan data events ke variabel $data['events']
        $data['events'] = $eventModel->findAll(); // Mengambil semua event
        
        // Load view untuk menampilkan form create kategori event dan passing data event
        return view('categories/create', $data);
    }

    public function store()
    {
        // Load model KategoriEvent
        $kategoriEventModel = new KategoriEventModel();

        // Ambil data dari form input
        $data = [
            'id_event'          => $this->request->getPost('event_id'), // Sesuaikan dengan input name di form
            'nama_kategori'     => $this->request->getPost('nama_kategori'),
            'deskripsi_kategori' => $this->request->getPost('deskripsi_kategori'),
            'biaya'             => $this->request->getPost('biaya'),
            'rute'              => $this->request->getPost('rute'),
            'start_date'        => $this->request->getPost('start_date'),
            'start_jam'         => $this->request->getPost('start_jam'),
            'cut_off_time'      => $this->request->getPost('cut_off_time'),
            'keterangan'        => $this->request->getPost('keterangan'),
        ];

        // Simpan data ke tabel kategori_event
        $kategoriEventModel->insert($data);

        // Redirect ke halaman index categories setelah berhasil simpan
        return redirect()->to(site_url('categories'));
    }

    public function edit($id)
    {
        $model = new KategoriEventModel();
        $kategori = $model->find($id);
        
        if (!$kategori) {
            return redirect()->to('categories')->with('error', 'Kategori tidak ditemukan!');
        }

        // Ambil semua event untuk ditampilkan di dropdown
        $eventModel = new EventModel();
        $events = $eventModel->findAll();

        return view('categories/edit', [
            'kategori' => $kategori,
            'events' => $events // Mengirim data event ke view
        ]);
    }

    public function update($id)
    {
        $model = new KategoriEventModel();

        // Ambil data dari form
        $data = [
            'id_event' => $this->request->getPost('id_event'), // Jangan lupa tambahkan id_event pada update
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi_kategori' => $this->request->getPost('deskripsi_kategori'),
            'biaya' => $this->request->getPost('biaya'),
            'rute' => $this->request->getPost('rute'),
            'start_date' => $this->request->getPost('start_date'),
            'start_jam' => $this->request->getPost('start_jam'),
            'cut_off_time' => $this->request->getPost('cut_off_time'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // Update data di database
        $model->update($id, $data);
        return redirect()->to('categories')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function delete($id)
    {
        $model = new KategoriEventModel();
        $model->delete($id);
        return redirect()->to('categories')->with('success', 'Kategori berhasil dihapus!');
    }
}
