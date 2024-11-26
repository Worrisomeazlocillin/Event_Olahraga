<?php

namespace App\Controllers;

use App\Models\EventModel;

class UserController extends BaseController
{
    public function dashboard()
    {
        $eventModel = new EventModel();
        $data['events'] = $eventModel->findAll(); // Mengambil semua event dari database
        // Ambil event yang belum lewat dari tanggal sekarang
        $data['events'] = $eventModel->where('event_date >=', date('Y-m-d'))->findAll();

        return view('user/user_dashboard', $data); // Pastikan path ke view sudah benar
    }
}
