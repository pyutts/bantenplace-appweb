<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'nama', 'email', 'password', 
        'level', 'no_telepon', 'kode_pos', 
        'alamat', 'profil_gambar', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

}
