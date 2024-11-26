<?php

namespace App\Controllers;

use App\Models\EventModel;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    protected $eventModel;

    public function __construct()
    {
        // Memanggil EventModel
        $this->eventModel = new EventModel();
    }

    public function index()
    {
        // Mengecek apakah user sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');  // Mengarahkan ke halaman login jika belum login
        }

        // Mengambil semua data event dari database
        $events = $this->eventModel->findAll();

        // Data yang akan dikirim ke view
        $data = [
            'activePage' => 'dashboard', // Untuk menandai menu yang aktif
            'events' => $events           // Data event
        ];

        // Memuat view dengan header, dashboard, dan footer
        echo view('header', $data);       // View header
        echo view('dashboard', $data);    // View utama dashboard
        echo view('footer');              // View footer
    }
}
