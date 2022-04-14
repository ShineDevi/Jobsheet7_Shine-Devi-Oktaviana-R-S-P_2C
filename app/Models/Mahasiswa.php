<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table='mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = [
        'Nim',
        'Nama',
        'Kelas',
        'Jurusan',
        'Email',
        'Alamat',
        'Tanggal_lahir',
    ];
}
