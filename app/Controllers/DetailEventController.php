<?php

namespace App\Controllers;

use App\Models\DetailEventModel;
use App\Models\EventModel;
use App\Models\KategoriEventModel;

class DetailEventController extends BaseController
{
    protected $detailEventModel;
    protected $eventModel;
    protected $kategoriEventModel;

    public function __construct()
    {
        $this->detailEventModel = new DetailEventModel();
        $this->eventModel = new EventModel();
        $this->kategoriEventModel = new KategoriEventModel();
    }

    // Fungsi untuk menampilkan detail event berdasarkan ID event
    public function detail($eventId)
    {
        // Ambil data detail event berdasarkan ID
        $event = $this->eventModel->find($eventId);

        // Jika data event tidak ditemukan, tampilkan error 404
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Event tidak ditemukan.');
        }

        // Ambil kategori event yang terkait dengan event ini
        $categories = $this->kategoriEventModel->where('id_event', $eventId)->findAll();

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
            'categories' => $categories,
            'hasFreeCategory' => $hasFreeCategory,
            'hasPaidCategory' => $hasPaidCategory,
        ]);
    }
}
