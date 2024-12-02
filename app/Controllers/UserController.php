<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\EventHistoryModel;

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

    public function history_event()
    {
        $search = $this->request->getGet('search');
        $eventHistoryModel = new EventHistoryModel();
        $eventHistory = $eventHistoryModel->getEventHistory($search);

        return view('user/history_event', [
            'eventHistory' => $eventHistory,
            'search' => $search
        ]);
    }
}
