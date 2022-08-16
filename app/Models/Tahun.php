<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $table = "tahuns";
    protected $fillable = [
        'tahuns'
    ];

    public function trxstatus() //relasi tabel employee ke jenis posisi
    {

        return $this->hasMany(Pinjam::class);
    }
}
