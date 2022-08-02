<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;
    protected $table = "pinjams";
    protected $fillable = [
        'kode_peminjaman',
        'users_id',
        'barangs_id',
        // 'detail_peminjamans_id',
        'nama_peminjam',
        'jenis_peminjaman',
        'tujuan',
        'tgl_pengajuan',
        'tgl_pinjam',
        'tgl_kembali',
        'surat_pinjam',
        'jumlah_pinjam',
        'ket'

    ];

    public function trxstatus() //relasi tabel employee ke jenis posisi
    {

        return $this->hasMany(Pinjam::class);
    }

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barangs_id'); //1 karyawan mempunyai 1 posisi
    }

    public function status_konfirmasis()
    {
        return $this->belongsTo(StatusKonfirmasi::class, 'status_konfirmasis_id');
    }

    public function status_peminjamans()
    {
        return $this->belongsTo(StatusPeminjaman::class, 'status_peminjamans_id'); //1 karyawan mempunyai 1 posisi
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id'); //1 karyawan mempunyai 1 posisi
    }
}
