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
        'Jurusan',
        'Email',
        'Alamat',
        'Tanggal_lahir',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public static function getByNim($Nim)
    {
        return self::where('nim', $Nim)->firstOrFail();
    }

    public function khs()
    {
        return $this->hasMany(Mahasiswa_MataKuliah::class, 'mahasiswa_id');
    }
}
