<?php

namespace App\Http\Controllers;

use index;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Models\Peminjaman;
use App\Models\Satuan;
use App\Models\DetailPeminjaman;
use App\Models\Pinjam;
use Carbon\Carbon;


class HomeController extends Controller
{


    public function index()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $detailpeminjaman = DetailPeminjaman::all();
        $pinjam = Pinjam::all();
        $role = Auth::user()->roles_id;

        // return $inputbarang;
        if ($role == '1') {
            $thn_sekarang = Carbon::now()->isoFormat('YYYY');
            $total_jan = 0;
            $total_feb = 0;
            $total_mar = 0;
            $total_apr = 0;
            $total_mei = 0;
            $total_jun = 0;
            $total_juli = 0;
            $total_agus = 0;
            $total_sept = 0;
            $total_okto = 0;
            $total_nove = 0;
            $total_dese = 0;
            foreach (Pinjam::get() as $ff) {
                $k = date('m', strtotime($ff->created_at));
                $y = date('Y', strtotime($ff->created_at));

                if ($y == $thn_sekarang) {
                    if ($k == '07') {
                        $total_juli += 1;
                    } elseif ($k == '01') {
                        $total_jan += 1;
                    } elseif ($k == '02') {
                        $total_feb += 1;
                    } elseif ($k == '03') {
                        $total_mar += 1;
                    } elseif ($k == '04') {
                        $total_apr += 1;
                    } elseif ($k == '05') {
                        $total_mei += 1;
                    } elseif ($k == '06') {
                        $total_jun += 1;
                    } elseif ($k == '08') {
                        $total_agus += 1;
                    } elseif ($k == '09') {
                        $total_sept += 1;
                    } elseif ($k == '10') {
                        $total_okto += 1;
                    } elseif ($k == '11') {
                        $total_nove += 1;
                    } elseif ($k == '12') {
                        $total_dese += 1;
                    }
                }
            }
            $jumlah = Barang::count();
            $asetbergerak = Barang::where('jenis_asets_id', 1)->count();
            $asettidakbergerak = Barang::where('jenis_asets_id', 2)->count();
            $asetperlengkapan = Barang::where('jenis_asets_id', 4)->count();
            $asetperalatan = Barang::where('jenis_asets_id', 3)->count();
            $pengajuan = DetailPeminjaman::where('status_konfirmasis_id', 1)->count();
            $disetujui = DetailPeminjaman::where('status_konfirmasis_id', 2 && 'status_peminjamans_id', 2)->count();
            $dikembalikan = DetailPeminjaman::where('status_konfirmasis_id', 2 && 'status_peminjamans_id', 3)->count();
            $ditolak = DetailPeminjaman::where('status_konfirmasis_id', 3)->count();
            $dibatalkan = DetailPeminjaman::where('status_konfirmasis_id', 5)->count();
            $pinjam = Pinjam::count();
            return view('admin', [
                "title" => "perlengkapan",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" => $datasatuan,
                "inputbarang" => $inputbarang,
                "detailpeminjaman" => $detailpeminjaman,
                "pinjam" => $pinjam,
                "pengajuan" => $pengajuan,
                "disetujui" => $disetujui,
                "dikembalikan" => $dikembalikan,
                "ditolak" => $ditolak,
                "dibatalkan" => $dibatalkan,
                "jumlah" => $jumlah,
                "asetbergerak" => $asetbergerak,
                "asettidakbergerak" => $asettidakbergerak,
                "asetperlengkapan" => $asetperlengkapan,
                "asetperalatan" => $asetperalatan,
                "total_jan" => $total_jan,
                "total_feb" =>  $total_feb,
                "total_mar" =>  $total_mar,
                "total_apr" =>  $total_apr,
                "total_mei" =>  $total_mei,
                "total_jun" =>  $total_jun,
                "total_juli" =>  $total_juli,
                "total_agus" =>  $total_agus,
                "total_sept" =>  $total_sept,
                "total_okto" =>  $total_okto,
                "total_nove" =>  $total_nove,
                "total_dese" =>  $total_dese,
            ]);
        }

        if ($role == '2') {
            return view('kepalaunit', [
                "title" => "perlengkapan",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" => $datasatuan,
                "inputbarang" => $inputbarang
            ]);
        }

        if ($role == '3') {
            return view('staff', [
                "title" => "perlengkapan",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" => $datasatuan,
                "inputbarang" => $inputbarang
            ]);
        } else {
            return view('dashboard', [
                "title" => "perlengkapan",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" => $datasatuan,
                "inputbarang" => $inputbarang
            ]);
        }
    }
}
