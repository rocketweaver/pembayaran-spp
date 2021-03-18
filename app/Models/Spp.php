<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $table = 'spp';
    
    public $timestamps = false;

    protected $primaryKey = 'id_spp';

    protected $fillable = [
        'tahun',
        'nominal'
    ];
}
