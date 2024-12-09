<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\EventModel;
use App\Models\KategoriEventModel;

class PembayaranController extends BaseController
{
    public function index($id_event)
    {
        $eventModel = new EventModel();
        $kategoriEventModel = new KategoriEventModel();

        // Ambil detail event
        $event = $eventModel->find($id_event);
        $kategori_event = $kategoriEventModel->find($event['event_kategori']);

        $data = [
            'event_name' => $event['event_name'],
            'event_kategori' => $kategori_event['nama_kategori'],
            'biaya' => $kategori_event['category_price'],
        ];

        return view('payment/pembayaran', $data);
    }

    public function submit_payment()
    {
        $pembayaranModel = new PembayaranModel();

        // Define validation rules for file uploads
        $validationRules = [
            'bukti_transfer' => [
                'uploaded[bukti_transfer]',
                'mime_in[bukti_transfer,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[bukti_transfer,10240]',  // Max file size in KB (10MB)
            ],
        ];

        // Validate the form inputs and files
        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('error', $this->validator->getErrors());
        }

        // Get user_id from the form, assuming the user ID is part of the request
        $id_user = $this->request->getPost('id_user'); // You can pass this field in the form if needed

        // Prepare the data for insertion
        $data = [
            'id_user' => $id_user, // Use the user ID from the form input
            'id_event' => $this->request->getPost('id_event'),
            'event_kategori' => $this->request->getPost('event_kategori'),
            'biaya' => $this->request->getPost('biaya'),
            'jumlah_pembayaran' => $this->request->getPost('jumlah_pembayaran'),
            'status_pembayaran' => ($this->request->getPost('jumlah_pembayaran') >= $this->request->getPost('biaya')) ? 'lunas' : 'belum lunas',
            'bukti_transfer' => $this->uploadFile('bukti_transfer') // Menghapus scan_ktp
        ];

        // Insert the data into the database
        $pembayaranModel->insert($data);

        // Set flashdata to show success message
        session()->setFlashdata('success_message', 'Selamat Mendaftar, Pembayaran Anda sedang Kami proses');

        // Redirect to the user dashboard or a relevant page with a success message
        return redirect()->to('/user/user_dashboard');
    }

    public function uploadFile($fileInputName)
    {
        // Get the uploaded file
        $file = $this->request->getFile($fileInputName);

        // Check if the file is valid and has not been moved
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the file to the uploads directory
            $fileName = $file->getName(); // Get original file name
            $file->move(WRITEPATH . 'uploads/', $fileName); // Move the file to the uploads folder

            // Return the file name to save it to the database
            return $fileName;
        }

        // If file upload failed, return an empty string or error message
        return '';
    }

    public function form($idEvent)
    {
        $eventModel = new EventModel();
        $event = $eventModel->getEventWithKategori($idEvent); // Pastikan memanggil metode yang benar

        if (!$event) {
            return redirect()->back()->with('error', 'Event tidak ditemukan');
        }

        return view('payment/pembayaran', [
            'event_name' => $event['event_name'],            // Ambil nama event dari hasil query
            'event_kategori' => $event['nama_kategori'],     // Gantilah event_kategori menjadi nama_kategori
            'rute' => $event['rute'],                        // Tambahkan rute di sini
            'biaya' => $event['biaya']                       // Gantilah biaya menjadi biaya dari kategori_event
        ]);
    }
}
