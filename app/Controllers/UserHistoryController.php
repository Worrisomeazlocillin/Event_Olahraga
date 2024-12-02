<?php

namespace App\Controllers;

use App\Models\EventHistoryModel;

class UserHistoryController extends BaseController
{
    public function index()
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
