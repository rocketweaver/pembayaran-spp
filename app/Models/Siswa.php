<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'siswa';

    protected $primaryKey = 'nisn';

    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
        'id_spp'
    ];
}
