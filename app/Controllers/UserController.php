<?php

namespace App\Controllers;

use App\Models\EventModel;

class UserController extends BaseController
{
    public function dashboard()
    {
        $eventModel = new EventModel();
        $data['events'] = $eventModel->findAll(); // Mengambil semua event dari database
        
        return view('user/user_dashboard', $data); // Pastikan path ke view sudah benar
    }
}
