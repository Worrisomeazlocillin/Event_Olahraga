<?php

namespace App\Controllers;

use App\Models\EventModel;

class UserDashboardController extends BaseController
{
    public function index()
    {
        $eventModel = new EventModel();
        $data['events'] = $eventModel->getEvents(); // Ambil semua data event

        return view('user/dashboard', $data); // Panggil view dashboard
    }
}
