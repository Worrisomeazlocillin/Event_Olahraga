<?php

namespace App\Controllers;

use App\Models\OnlyUserModel;
use CodeIgniter\Controller;

class AuthUserController extends Controller
{
    public function login()
    {
        helper(['form']);
        echo view('user/login');
    }

    public function register()
    {
        helper(['form']);
        echo view('user/register');
    }

    public function registerUser()
    {
        $model = new OnlyUserModel();
        $validation = \Config\Services::validation();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cek apakah username sudah ada di database
        $existingUser = $model->where('username', $username)->first();

        if ($existingUser) {
            // Jika username sudah ada
            session()->setFlashdata('error_message', 'Mohon maaf, username anda sudah ada');
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        if ($this->validate([
            'username' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ])) {
            $model->save($data);

            // Menyimpan pesan flashdata "Selamat Username anda sudah terdata"
            session()->setFlashdata('success_message', 'Selamat, username anda sudah terdata');

            return redirect()->to('/user/login');
        } else {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
    }

    public function loginUser()
    {
        $model = new OnlyUserModel(); // Model untuk mengambil data user
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Mengambil pengguna berdasarkan email
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Menyimpan data ke session jika login berhasil
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'], // Ambil username
                'email' => $user['email'], // Ambil email
                'is_logged_in' => true
            ]);

            // Menyimpan pesan flashdata "Selamat Datang"
            session()->setFlashdata('welcome_message', 'Selamat Datang, ' . $user['username'] . '!');

            return redirect()->to('/user/user_dashboard'); // Redirect ke halaman dashboard
        } else {
            // Jika login gagal
            return redirect()->back()->with('error', 'Invalid login credentials.');
        }
    }

    public function logout()
    {
        // Menghapus seluruh data session pengguna
        session()->destroy();  // Menghancurkan session secara keseluruhan

        session()->setFlashdata('message', 'Anda telah berhasil logout.');
        return redirect()->to(site_url('user/login'));  // Arahkan ke halaman login
    }

    public function profil()
    {
        $userId = session()->get('user_id');
        $model = new OnlyUserModel();
        $user = $model->find($userId);

        echo view('user/profil_user', ['user' => $user]);
    }
}
