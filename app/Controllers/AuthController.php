<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username'      => 'required|min_length[3]|max_length[20]',
                'email'         => 'required|valid_email|is_unique[users.email]',
                'password'      => 'required|min_length[8]',
                'confpassword'  => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $data = [
                    'username' => $this->request->getPost('username'),
                    'email'    => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
                ];
                $userModel->save($data);

                return redirect()->to('/auth/login')->with('success', 'Registration successful. You can now log in.');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/register', $data ?? []);
    }

    public function login()
    {
        // Hapus redirect jika sudah login
        if (session()->has('user_id')) {
            return redirect()->to('/dashboard'); // Jika sudah login
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);
            log_message('info', 'User ID: ' . $user['id'] . ' logged in.');
            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Invalid username or password');
            return redirect()->to('/auth/login');
        }
    }

    public function createAdmin()
    {
        $userModel = new UserModel();

        // Cek apakah admin sudah ada
        $existingAdmin = $userModel->where('username', 'admin')->first();
        if (!$existingAdmin) {
            // Hash password menggunakan password_hash
            $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);

            // Simpan admin ke database dengan password hashed
            $userModel->save([
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => $hashedPassword,
            ]);

            return "Admin dengan username 'admin' berhasil dibuat!";
        } else {
            return "Admin sudah ada di database.";
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
