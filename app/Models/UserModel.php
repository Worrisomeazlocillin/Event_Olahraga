<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Tabel users dari database
    protected $primaryKey = 'id';

    // Kolom yang diizinkan untuk diisi
    protected $allowedFields = ['username', 'email', 'password', 'created_at', 'deleted_at'];

    // Ambil semua data pengguna dari tabel
    public function getUsers()
    {
        return $this->findAll();
    }

    // Tambahkan metode lain jika diperlukan, misalnya untuk mendapatkan pengguna berdasarkan ID
    public function getUserById($id)
    {
        return $this->find($id);
    }

    // Metode tambahan untuk mendapatkan pengguna berdasarkan username
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first(); // Mengembalikan pengguna berdasarkan username
    }

    // Metode tambahan untuk mendapatkan pengguna berdasarkan email
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first(); // Mengembalikan pengguna berdasarkan email
    }
}
