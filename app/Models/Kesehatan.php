<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesehatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_tempat',
        'jenis_fasilitas',
        'jam_operasional',
        'deskripsi',
        'alamat',
        'nomor_hp',
        'latitude',
        'longitude',
        'marker_color',
    ];
}
