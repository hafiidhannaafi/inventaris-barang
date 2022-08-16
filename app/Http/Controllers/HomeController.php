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
use App\Models\Tahun;
use App\Models\TrxStatus;
use Carbon\Carbon;


class HomeController extends Controller
{ 
    
    public function index()
    {
        $role = Auth::user()->roles_id;
        if ($role == '1') {
            return view('admin');
        }

        if ($role == '2') {
            return view('kepalaunit');
        }

        if ($role == '3') {
            return view('staff');
        } else {
            return view('dashboard');
        }
    }


 //function dashhboard
    private function multiSearch(array $array, array $pairs)
    {
        $found = array();
        foreach ($array as $aKey => $aVal) {
            $coincidences = 0;
            foreach ($pairs as $pKey => $pVal) {
                if (array_key_exists($pKey, $aVal) && $aVal[$pKey] == $pVal) {
                    $coincidences++;
                }
            }
            if ($coincidences == count($pairs)) {
                $found[$aKey] = $aVal;
            }
        }

        return $found;
    }

    private function searchByValue($id, $array)
    {
        foreach ($array as $key => $val) {
            if ($val['barangs_id'] === $id) {
                return $key;
            }
        }
        return null;
    } 

    public function maindashboard()
    {
        $tt = 0;
        $barang = 0;
        $d = 0;
        $data = DB::select("SELECT pinjams.barangs_id, sum(pinjams.jumlah_pinjam) as jumlah FROM pinjams INNER JOIN barangs ON (pinjams.barangs_id = barangs.id) GROUP BY pinjams.barangs_id");
        $datas = DB::table('pinjams')->select('pinjams.barangs_id', 'barangs.kode', 'barangs.spesifikasi', 'pinjams.jumlah_pinjam')
        ->join('barangs', 'barangs.id', '=', 'pinjams.barangs_id')
        ->get()
            ->toArray();

        // // dd($datas);
        $datap = array();
        $i = 0;

        foreach ($datas as $row_product) {
            if (count($datap) == 0) {
                # code...
                $datap[$i]["barangs_id"] = $row_product->barangs_id;
                $datap[$i]["kode"] = $row_product->kode;
                $datap[$i]["spesifikasi"] = $row_product->spesifikasi;
                // $datap[$i]["jenis_asets_id"] = $row_product->jenis_asets_id;
                $datap[$i]["jumlah"] = (int)$row_product->jumlah_pinjam;
                $i++;
            } else {
                $dump = $this->multiSearch($datap, array('barangs_id' => $row_product->barangs_id));
                if (count($dump) == 0) {
                    # code...
                    $datap[$i]["barangs_id"] = $row_product->barangs_id;
                    $datap[$i]["kode"] = $row_product->kode;
                    $datap[$i]["spesifikasi"] = $row_product->spesifikasi;
                    // $datap[$i]["jenis_asets_id"] = $row_product->jenis_asets_id;
                    $datap[$i]["jumlah"] = (int)$row_product->jumlah_pinjam;
                    $i++;
                } else {
                    $key = $this->searchByValue($row_product->barangs_id, $datap);
                    $datap[$key]["jumlah"] = $datap[$key]["jumlah"] + (int)$row_product->jumlah_pinjam;
                }
            }
        }
        // foreach ($data as $d) {
        //     foreach (Barang::where('id', $d->barangs_id)->get() as $barang) {
        //         echo $barang->kode . '</br>' . $d->jumlah . '</br>';
        //     }
        // }
        // dd($data);


        //         select SUM(jumlah_pinjam)
        //     from pinjams
        //     group by barangs_id
        //    ORDER BY jumlah_pinjam ASC
        //    LIMIT 1;
        $thn = Tahun::all();
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $detailpeminjaman = DetailPeminjaman::all();
        $pinjam = Pinjam::all();
        $role = Auth::user()->roles_id;

        // return $inputbarang;
        if ($role == '2') {
            $thn_sekarang = Carbon::now()->isoFormat('YYYY');
            $bergerak_jan = 0;
            $bergerak_feb = 0;
            $bergerak_mar = 0;
            $bergerak_apr = 0;
            $bergerak_mei = 0;
            $bergerak_jun = 0;
            $bergerak_juli = 0;
            $bergerak_agus = 0;
            $bergerak_sept = 0;
            $bergerak_okto = 0;
            $bergerak_nove = 0;
            $bergerak_dese = 0;

            $tdkbergerak_jan = 0;
            $tdkbergerak_feb = 0;
            $tdkbergerak_mar = 0;
            $tdkbergerak_apr = 0;
            $tdkbergerak_mei = 0;
            $tdkbergerak_jun = 0;
            $tdkbergerak_juli = 0;
            $tdkbergerak_agus = 0;
            $tdkbergerak_sept = 0;
            $tdkbergerak_okto = 0;
            $tdkbergerak_nove = 0;
            $tdkbergerak_dese = 0;

            $peralatan_jan = 0;
            $peralatan_feb = 0;
            $peralatan_mar = 0;
            $peralatan_apr = 0;
            $peralatan_mei = 0;
            $peralatan_jun = 0;
            $peralatan_juli = 0;
            $peralatan_agus = 0;
            $peralatan_sept = 0;
            $peralatan_okto = 0;
            $peralatan_nove = 0;
            $peralatan_dese = 0;

            $perlengkapan_jan = 0;
            $perlengkapan_feb = 0;
            $perlengkapan_mar = 0;
            $perlengkapan_apr = 0;
            $perlengkapan_mei = 0;
            $perlengkapan_jun = 0;
            $perlengkapan_juli = 0;
            $perlengkapan_agus = 0;
            $perlengkapan_sept = 0;
            $perlengkapan_okto = 0;
            $perlengkapan_nove = 0;
            $perlengkapan_dese = 0;

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

            $disetujui_jan = 0;
            $disetujui_feb = 0;
            $disetujui_mar = 0;
            $disetujui_apr = 0;
            $disetujui_mei = 0;
            $disetujui_jun = 0;
            $disetujui_juli = 0;
            $disetujui_agus = 0;
            $disetujui_sept = 0;
            $disetujui_okto = 0;
            $disetujui_nove = 0;
            $disetujui_dese = 0;

            $ditolak_jan = 0;
            $ditolak_feb = 0;
            $ditolak_mar = 0;
            $ditolak_apr = 0;
            $ditolak_mei = 0;
            $ditolak_jun = 0;
            $ditolak_juli = 0;
            $ditolak_agus = 0;
            $ditolak_sept = 0;
            $ditolak_okto = 0;
            $ditolak_nove = 0;
            $ditolak_dese = 0;

            $ambilbarang_jan = 0;
            $ambilbarang_feb = 0;
            $ambilbarang_mar = 0;
            $ambilbarang_apr = 0;
            $ambilbarang_mei = 0;
            $ambilbarang_jun = 0;
            $ambilbarang_juli = 0;
            $ambilbarang_agus = 0;
            $ambilbarang_sept = 0;
            $ambilbarang_okto = 0;
            $ambilbarang_nove = 0;
            $ambilbarang_dese = 0;

            $dikembalikan_jan = 0;
            $dikembalikan_feb = 0;
            $dikembalikan_mar = 0;
            $dikembalikan_apr = 0;
            $dikembalikan_mei = 0;
            $dikembalikan_jun = 0;
            $dikembalikan_juli = 0;
            $dikembalikan_agus = 0;
            $dikembalikan_sept = 0;
            $dikembalikan_okto = 0;
            $dikembalikan_nove = 0;
            $dikembalikan_dese = 0;

            $terlambat_jan = 0;
            $terlambat_feb = 0;
            $terlambat_mar = 0;
            $terlambat_apr = 0;
            $terlambat_mei = 0;
            $terlambat_jun = 0;
            $terlambat_juli = 0;
            $terlambat_agus = 0;
            $terlambat_sept = 0;
            $terlambat_okto = 0;
            $terlambat_nove = 0;
            $terlambat_dese = 0;
            foreach (Pinjam::get() as $ff) {
                $tr = TrxStatus::where('kode_peminjaman', $ff->kode_peminjaman)->orderby('id', 'desc')->first();
                $k = date('m', strtotime($tr->created_at));
                $y = date('Y', strtotime($tr->created_at));

                if ($y == $thn_sekarang && $tr->status_id == 5) {
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
                } elseif ($y == $thn_sekarang && $tr->status_id == 1) {
                    if ($k == '07') {
                        $disetujui_juli += 1;
                    } elseif ($k == '01') {
                        $disetujui_jan += 1;
                    } elseif ($k == '02') {
                        $disetujui_feb += 1;
                    } elseif ($k == '03') {
                        $disetujui_mar += 1;
                    } elseif ($k == '04') {
                        $disetujui_apr += 1;
                    } elseif ($k == '05') {
                        $disetujui_mei += 1;
                    } elseif ($k == '06') {
                        $disetujui_jun += 1;
                    } elseif ($k == '08') {
                        $disetujui_agus += 1;
                    } elseif ($k == '09') {
                        $disetujui_sept += 1;
                    } elseif ($k == '10') {
                        $disetujui_okto += 1;
                    } elseif ($k == '11') {
                        $disetujui_nove += 1;
                    } elseif ($k == '12') {
                        $disetujui_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 2) {
                    if ($k == '07') {
                        $ditolak_juli += 1;
                    } elseif ($k == '01') {
                        $ditolak_jan += 1;
                    } elseif ($k == '02') {
                        $ditolak_feb += 1;
                    } elseif ($k == '03') {
                        $ditolak_mar += 1;
                    } elseif ($k == '04') {
                        $ditolak_apr += 1;
                    } elseif ($k == '05') {
                        $ditolak_mei += 1;
                    } elseif ($k == '06') {
                        $ditolak_jun += 1;
                    } elseif ($k == '08') {
                        $ditolak_agus += 1;
                    } elseif ($k == '09') {
                        $ditolak_sept += 1;
                    } elseif ($k == '10') {
                        $ditolak_okto += 1;
                    } elseif ($k == '11') {
                        $ditolak_nove += 1;
                    } elseif ($k == '12') {
                        $ditolak_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 3) {
                    if ($k == '07') {
                        $ambilbarang_juli += 1;
                    } elseif ($k == '01') {
                        $ambilbarang_jan += 1;
                    } elseif ($k == '02') {
                        $ambilbarang_feb += 1;
                    } elseif ($k == '03') {
                        $ambilbarang_mar += 1;
                    } elseif ($k == '04') {
                        $ambilbarang_apr += 1;
                    } elseif ($k == '05') {
                        $ambilbarang_mei += 1;
                    } elseif ($k == '06') {
                        $ambilbarang_jun += 1;
                    } elseif ($k == '08') {
                        $ambilbarang_agus += 1;
                    } elseif ($k == '09') {
                        $ambilbarang_sept += 1;
                    } elseif ($k == '10') {
                        $ambilbarang_okto += 1;
                    } elseif ($k == '11') {
                        $ambilbarang_nove += 1;
                    } elseif ($k == '12') {
                        $ambilbarang_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 4) {
                    if ($k == '07') {
                        $dikembalikan_juli += 1;
                    } elseif ($k == '01') {
                        $dikembalikan_jan += 1;
                    } elseif ($k == '02') {
                        $dikembalikan_feb += 1;
                    } elseif ($k == '03') {
                        $dikembalikan_mar += 1;
                    } elseif ($k == '04') {
                        $dikembalikan_apr += 1;
                    } elseif ($k == '05') {
                        $dikembalikan_mei += 1;
                    } elseif ($k == '06') {
                        $dikembalikan_jun += 1;
                    } elseif ($k == '08') {
                        $dikembalikan_agus += 1;
                    } elseif ($k == '09') {
                        $dikembalikan_sept += 1;
                    } elseif ($k == '10') {
                        $dikembalikan_okto += 1;
                    } elseif ($k == '11') {
                        $dikembalikan_nove += 1;
                    } elseif ($k == '12') {
                        $dikembalikan_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 6) {
                    if ($k == '07') {
                        $terlambat_juli += 1;
                    } elseif ($k == '01') {
                        $terlambat_jan += 1;
                    } elseif ($k == '02') {
                        $terlambat_feb += 1;
                    } elseif ($k == '03') {
                        $terlambat_mar += 1;
                    } elseif ($k == '04') {
                        $terlambat_apr += 1;
                    } elseif ($k == '05') {
                        $terlambat_mei += 1;
                    } elseif ($k == '06') {
                        $terlambat_jun += 1;
                    } elseif ($k == '08') {
                        $terlambat_agus += 1;
                    } elseif ($k == '09') {
                        $terlambat_sept += 1;
                    } elseif ($k == '10') {
                        $terlambat_okto += 1;
                    } elseif ($k == '11') {
                        $terlambat_nove += 1;
                    } elseif ($k == '12') {
                        $terlambat_dese += 1;
                    }
                }
            }

            foreach (Barang::get() as $bb) {
                $ty = Barang::where('id', $bb->id)->first();
                $x = date('m', strtotime($ty->created_at));
                $z = date('Y', strtotime($ty->created_at));

                if ($z == $thn_sekarang && $ty->jenis_asets_id == 1) {
                    if ($x == '07') {
                        $bergerak_juli += 1;
                    } elseif ($x == '01') {
                        $bergerak_jan += 1;
                    } elseif ($x == '02') {
                        $bergerak_feb += 1;
                    } elseif ($x == '03') {
                        $bergerak_mar += 1;
                    } elseif ($x == '04') {
                        $bergerak_apr += 1;
                    } elseif ($x == '05') {
                        $bergerak_mei += 1;
                    } elseif ($x == '06') {
                        $bergerak_jun += 1;
                    } elseif ($x == '08') {
                        $bergerak_agus += 1;
                    } elseif ($x == '09') {
                        $bergerak_sept += 1;
                    } elseif ($x == '10') {
                        $bergerak_okto += 1;
                    } elseif ($x == '11') {
                        $bergerak_nove += 1;
                    } elseif ($x == '12') {
                        $bergerak_dese += 1;
                    }
                } elseif ($z == $thn_sekarang && $ty->jenis_asets_id == 2) {
                    if ($x == '07') {
                        $tdkbergerak_juli += 1;
                    } elseif ($x == '01') {
                        $tdkbergerak_jan += 1;
                    } elseif ($x == '02') {
                        $tdkbergerak_feb += 1;
                    } elseif ($x == '03') {
                        $tdkbergerak_mar += 1;
                    } elseif ($x == '04') {
                        $tdkbergerak_apr += 1;
                    } elseif ($x == '05') {
                        $tdkbergerak_mei += 1;
                    } elseif ($x == '06') {
                        $tdkbergerak_jun += 1;
                    } elseif ($x == '08') {
                        $tdkbergerak_agus += 1;
                    } elseif ($x == '09') {
                        $tdkbergerak_sept += 1;
                    } elseif ($x == '10') {
                        $tdkbergerak_okto += 1;
                    } elseif ($x == '11') {
                        $tdkbergerak_nove += 1;
                    } elseif ($x == '12') {
                        $tdkbergerak_dese += 1;
                    }
                } elseif ($z == $thn_sekarang && $ty->jenis_asets_id == 3) {
                    if ($x == '07') {
                        $peralatan_juli += 1;
                    } elseif ($x == '01') {
                        $peralatan_jan += 1;
                    } elseif ($x == '02') {
                        $peralatan_feb += 1;
                    } elseif ($x == '03') {
                        $peralatan_mar += 1;
                    } elseif ($x == '04') {
                        $peralatan_apr += 1;
                    } elseif ($x == '05') {
                        $peralatan_mei += 1;
                    } elseif ($x == '06') {
                        $peralatan_jun += 1;
                    } elseif ($x == '08') {
                        $peralatan_agus += 1;
                    } elseif ($x == '09') {
                        $peralatan_sept += 1;
                    } elseif ($x == '10') {
                        $peralatan_okto += 1;
                    } elseif ($x == '11') {
                        $peralatan_nove += 1;
                    } elseif ($x == '12') {
                        $peralatan_dese += 1;
                    }
                } elseif ($z == $thn_sekarang && $ty->jenis_asets_id == 4) {
                    if ($x == '07') {
                        $perlengkapan_juli += 1;
                    } elseif ($x == '01') {
                        $perlengkapan_jan += 1;
                    } elseif ($x == '02') {
                        $perlengkapan_feb += 1;
                    } elseif ($x == '03') {
                        $perlengkapan_mar += 1;
                    } elseif ($x == '04') {
                        $perlengkapan_apr += 1;
                    } elseif ($x == '05') {
                        $perlengkapan_mei += 1;
                    } elseif ($x == '06') {
                        $perlengkapan_jun += 1;
                    } elseif ($x == '08') {
                        $perlengkapan_agus += 1;
                    } elseif ($x == '09') {
                        $perlengkapan_sept += 1;
                    } elseif ($x == '10') {
                        $perlengkapan_okto += 1;
                    } elseif ($x == '11') {
                        $perlengkapan_nove += 1;
                    } elseif ($x == '12') {
                        $perlengkapan_dese += 1;
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

            return view(
                'kepalaunit',
                compact(
                    'data',
                    'datap',
                    // 'data',
                    'datas',
                    'jenisbarang',
                    // 'jenisaset',
                    'dataasalperolehan',
                    'datasatuan',
                    'inputbarang',
                    'pinjam',
                    'disetujui_jan',
                    'disetujui_feb',
                    'disetujui_mar',
                    'disetujui_apr',
                    'disetujui_mei',
                    'disetujui_jun',
                    'disetujui_juli',
                    'disetujui_agus',
                    'disetujui_sept',
                    'disetujui_okto',
                    'disetujui_nove',
                    'disetujui_dese',

                    'total_jan',
                    'total_feb',
                    'total_mar',
                    'total_apr',
                    'total_mei',
                    'total_jun',
                    'total_juli',
                    'total_agus',
                    'total_sept',
                    'total_okto',
                    'total_nove',
                    'total_dese',

                    'ditolak_jan',
                    'ditolak_feb',
                    'ditolak_mar',
                    'ditolak_apr',
                    'ditolak_mei',
                    'ditolak_jun',
                    'ditolak_juli',
                    'ditolak_agus',
                    'ditolak_sept',
                    'ditolak_okto',
                    'ditolak_nove',
                    'ditolak_dese',

                    'ambilbarang_jan',
                    'ambilbarang_feb',
                    'ambilbarang_mar',
                    'ambilbarang_apr',
                    'ambilbarang_mei',
                    'ambilbarang_jun',
                    'ambilbarang_juli',
                    'ambilbarang_agus',
                    'ambilbarang_sept',
                    'ambilbarang_okto',
                    'ambilbarang_nove',
                    'ambilbarang_dese',

                    'dikembalikan_jan',
                    'dikembalikan_feb',
                    'dikembalikan_mar',
                    'dikembalikan_apr',
                    'dikembalikan_mei',
                    'dikembalikan_jun',
                    'dikembalikan_juli',
                    'dikembalikan_agus',
                    'dikembalikan_sept',
                    'dikembalikan_okto',
                    'dikembalikan_nove',
                    'dikembalikan_dese',

                    'terlambat_jan',
                    'terlambat_feb',
                    'terlambat_mar',
                    'terlambat_apr',
                    'terlambat_mei',
                    'terlambat_jun',
                    'terlambat_juli',
                    'terlambat_agus',
                    'terlambat_sept',
                    'terlambat_okto',
                    'terlambat_nove',
                    'terlambat_dese',

                    'bergerak_jan',
                    'bergerak_feb',
                    'bergerak_mar',
                    'bergerak_apr',
                    'bergerak_mei',
                    'bergerak_jun',
                    'bergerak_juli',
                    'bergerak_agus',
                    'bergerak_sept',
                    'bergerak_okto',
                    'bergerak_nove',
                    'bergerak_dese',

                    'tdkbergerak_jan',
                    'tdkbergerak_feb',
                    'tdkbergerak_mar',
                    'tdkbergerak_apr',
                    'tdkbergerak_mei',
                    'tdkbergerak_jun',
                    'tdkbergerak_juli',
                    'tdkbergerak_agus',
                    'tdkbergerak_sept',
                    'tdkbergerak_okto',
                    'tdkbergerak_nove',
                    'tdkbergerak_dese',

                    'peralatan_jan',
                    'peralatan_feb',
                    'peralatan_mar',
                    'peralatan_apr',
                    'peralatan_mei',
                    'peralatan_jun',
                    'peralatan_juli',
                    'peralatan_agus',
                    'peralatan_sept',
                    'peralatan_okto',
                    'peralatan_nove',
                    'peralatan_dese',

                    'perlengkapan_jan',
                    'perlengkapan_feb',
                    'perlengkapan_mar',
                    'perlengkapan_apr',
                    'perlengkapan_mei',
                    'perlengkapan_jun',
                    'perlengkapan_juli',
                    'perlengkapan_agus',
                    'perlengkapan_sept',
                    'perlengkapan_okto',
                    'perlengkapan_nove',
                    'perlengkapan_dese',
                    'thn'
                )
            );
        }
        //role admin
        if ($role == '1') {
            $thn_sekarang = Carbon::now()->isoFormat('YYYY');
            $bergerak_jan = 0;
            $bergerak_feb = 0;
            $bergerak_mar = 0;
            $bergerak_apr = 0;
            $bergerak_mei = 0;
            $bergerak_jun = 0;
            $bergerak_juli = 0;
            $bergerak_agus = 0;
            $bergerak_sept = 0;
            $bergerak_okto = 0;
            $bergerak_nove = 0;
            $bergerak_dese = 0;

            $tdkbergerak_jan = 0;
            $tdkbergerak_feb = 0;
            $tdkbergerak_mar = 0;
            $tdkbergerak_apr = 0;
            $tdkbergerak_mei = 0;
            $tdkbergerak_jun = 0;
            $tdkbergerak_juli = 0;
            $tdkbergerak_agus = 0;
            $tdkbergerak_sept = 0;
            $tdkbergerak_okto = 0;
            $tdkbergerak_nove = 0;
            $tdkbergerak_dese = 0;

            $peralatan_jan = 0;
            $peralatan_feb = 0;
            $peralatan_mar = 0;
            $peralatan_apr = 0;
            $peralatan_mei = 0;
            $peralatan_jun = 0;
            $peralatan_juli = 0;
            $peralatan_agus = 0;
            $peralatan_sept = 0;
            $peralatan_okto = 0;
            $peralatan_nove = 0;
            $peralatan_dese = 0;

            $perlengkapan_jan = 0;
            $perlengkapan_feb = 0;
            $perlengkapan_mar = 0;
            $perlengkapan_apr = 0;
            $perlengkapan_mei = 0;
            $perlengkapan_jun = 0;
            $perlengkapan_juli = 0;
            $perlengkapan_agus = 0;
            $perlengkapan_sept = 0;
            $perlengkapan_okto = 0;
            $perlengkapan_nove = 0;
            $perlengkapan_dese = 0;

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

            $disetujui_jan = 0;
            $disetujui_feb = 0;
            $disetujui_mar = 0;
            $disetujui_apr = 0;
            $disetujui_mei = 0;
            $disetujui_jun = 0;
            $disetujui_juli = 0;
            $disetujui_agus = 0;
            $disetujui_sept = 0;
            $disetujui_okto = 0;
            $disetujui_nove = 0;
            $disetujui_dese = 0;

            $ditolak_jan = 0;
            $ditolak_feb = 0;
            $ditolak_mar = 0;
            $ditolak_apr = 0;
            $ditolak_mei = 0;
            $ditolak_jun = 0;
            $ditolak_juli = 0;
            $ditolak_agus = 0;
            $ditolak_sept = 0;
            $ditolak_okto = 0;
            $ditolak_nove = 0;
            $ditolak_dese = 0;

            $ambilbarang_jan = 0;
            $ambilbarang_feb = 0;
            $ambilbarang_mar = 0;
            $ambilbarang_apr = 0;
            $ambilbarang_mei = 0;
            $ambilbarang_jun = 0;
            $ambilbarang_juli = 0;
            $ambilbarang_agus = 0;
            $ambilbarang_sept = 0;
            $ambilbarang_okto = 0;
            $ambilbarang_nove = 0;
            $ambilbarang_dese = 0;

            $dikembalikan_jan = 0;
            $dikembalikan_feb = 0;
            $dikembalikan_mar = 0;
            $dikembalikan_apr = 0;
            $dikembalikan_mei = 0;
            $dikembalikan_jun = 0;
            $dikembalikan_juli = 0;
            $dikembalikan_agus = 0;
            $dikembalikan_sept = 0;
            $dikembalikan_okto = 0;
            $dikembalikan_nove = 0;
            $dikembalikan_dese = 0;

            $terlambat_jan = 0;
            $terlambat_feb = 0;
            $terlambat_mar = 0;
            $terlambat_apr = 0;
            $terlambat_mei = 0;
            $terlambat_jun = 0;
            $terlambat_juli = 0;
            $terlambat_agus = 0;
            $terlambat_sept = 0;
            $terlambat_okto = 0;
            $terlambat_nove = 0;
            $terlambat_dese = 0;
            foreach (Pinjam::get() as $ff) {
                $tr = TrxStatus::where('kode_peminjaman', $ff->kode_peminjaman)->orderby('id', 'desc')->first();
                $k = date('m', strtotime($tr->created_at));
                $y = date('Y', strtotime($tr->created_at));

                if ($y == $thn_sekarang && $tr->status_id == 5) {
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
                } elseif ($y == $thn_sekarang && $tr->status_id == 1) {
                    if ($k == '07') {
                        $disetujui_juli += 1;
                    } elseif ($k == '01') {
                        $disetujui_jan += 1;
                    } elseif ($k == '02') {
                        $disetujui_feb += 1;
                    } elseif ($k == '03') {
                        $disetujui_mar += 1;
                    } elseif ($k == '04') {
                        $disetujui_apr += 1;
                    } elseif ($k == '05') {
                        $disetujui_mei += 1;
                    } elseif ($k == '06') {
                        $disetujui_jun += 1;
                    } elseif ($k == '08') {
                        $disetujui_agus += 1;
                    } elseif ($k == '09') {
                        $disetujui_sept += 1;
                    } elseif ($k == '10') {
                        $disetujui_okto += 1;
                    } elseif ($k == '11') {
                        $disetujui_nove += 1;
                    } elseif ($k == '12') {
                        $disetujui_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 2) {
                    if ($k == '07') {
                        $ditolak_juli += 1;
                    } elseif ($k == '01') {
                        $ditolak_jan += 1;
                    } elseif ($k == '02') {
                        $ditolak_feb += 1;
                    } elseif ($k == '03') {
                        $ditolak_mar += 1;
                    } elseif ($k == '04') {
                        $ditolak_apr += 1;
                    } elseif ($k == '05') {
                        $ditolak_mei += 1;
                    } elseif ($k == '06') {
                        $ditolak_jun += 1;
                    } elseif ($k == '08') {
                        $ditolak_agus += 1;
                    } elseif ($k == '09') {
                        $ditolak_sept += 1;
                    } elseif ($k == '10') {
                        $ditolak_okto += 1;
                    } elseif ($k == '11') {
                        $ditolak_nove += 1;
                    } elseif ($k == '12') {
                        $ditolak_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 3) {
                    if ($k == '07') {
                        $ambilbarang_juli += 1;
                    } elseif ($k == '01') {
                        $ambilbarang_jan += 1;
                    } elseif ($k == '02') {
                        $ambilbarang_feb += 1;
                    } elseif ($k == '03') {
                        $ambilbarang_mar += 1;
                    } elseif ($k == '04') {
                        $ambilbarang_apr += 1;
                    } elseif ($k == '05') {
                        $ambilbarang_mei += 1;
                    } elseif ($k == '06') {
                        $ambilbarang_jun += 1;
                    } elseif ($k == '08') {
                        $ambilbarang_agus += 1;
                    } elseif ($k == '09') {
                        $ambilbarang_sept += 1;
                    } elseif ($k == '10') {
                        $ambilbarang_okto += 1;
                    } elseif ($k == '11') {
                        $ambilbarang_nove += 1;
                    } elseif ($k == '12') {
                        $ambilbarang_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 4) {
                    if ($k == '07') {
                        $dikembalikan_juli += 1;
                    } elseif ($k == '01') {
                        $dikembalikan_jan += 1;
                    } elseif ($k == '02') {
                        $dikembalikan_feb += 1;
                    } elseif ($k == '03') {
                        $dikembalikan_mar += 1;
                    } elseif ($k == '04') {
                        $dikembalikan_apr += 1;
                    } elseif ($k == '05') {
                        $dikembalikan_mei += 1;
                    } elseif ($k == '06') {
                        $dikembalikan_jun += 1;
                    } elseif ($k == '08') {
                        $dikembalikan_agus += 1;
                    } elseif ($k == '09') {
                        $dikembalikan_sept += 1;
                    } elseif ($k == '10') {
                        $dikembalikan_okto += 1;
                    } elseif ($k == '11') {
                        $dikembalikan_nove += 1;
                    } elseif ($k == '12') {
                        $dikembalikan_dese += 1;
                    }
                } elseif ($y == $thn_sekarang && $tr->status_id == 6) {
                    if ($k == '07') {
                        $terlambat_juli += 1;
                    } elseif ($k == '01') {
                        $terlambat_jan += 1;
                    } elseif ($k == '02') {
                        $terlambat_feb += 1;
                    } elseif ($k == '03') {
                        $terlambat_mar += 1;
                    } elseif ($k == '04') {
                        $terlambat_apr += 1;
                    } elseif ($k == '05') {
                        $terlambat_mei += 1;
                    } elseif ($k == '06') {
                        $terlambat_jun += 1;
                    } elseif ($k == '08') {
                        $terlambat_agus += 1;
                    } elseif ($k == '09') {
                        $terlambat_sept += 1;
                    } elseif ($k == '10') {
                        $terlambat_okto += 1;
                    } elseif ($k == '11') {
                        $terlambat_nove += 1;
                    } elseif ($k == '12') {
                        $terlambat_dese += 1;
                    }
                }
            }

            foreach (Barang::get() as $bb) {
                $ty = Barang::where('id', $bb->id)->first();
                $x = date('m', strtotime($ty->created_at));
                $z = date('Y', strtotime($ty->created_at));

                if ($z == $thn_sekarang && $ty->jenis_asets_id == 1) {
                    if ($x == '07') {
                        $bergerak_juli += 1;
                    } elseif ($x == '01') {
                        $bergerak_jan += 1;
                    } elseif ($x == '02') {
                        $bergerak_feb += 1;
                    } elseif ($x == '03') {
                        $bergerak_mar += 1;
                    } elseif ($x == '04') {
                        $bergerak_apr += 1;
                    } elseif ($x == '05') {
                        $bergerak_mei += 1;
                    } elseif ($x == '06') {
                        $bergerak_jun += 1;
                    } elseif ($x == '08') {
                        $bergerak_agus += 1;
                    } elseif ($x == '09') {
                        $bergerak_sept += 1;
                    } elseif ($x == '10') {
                        $bergerak_okto += 1;
                    } elseif ($x == '11') {
                        $bergerak_nove += 1;
                    } elseif ($x == '12') {
                        $bergerak_dese += 1;
                    }
                } elseif ($z == $thn_sekarang && $ty->jenis_asets_id == 2) {
                    if ($x == '07') {
                        $tdkbergerak_juli += 1;
                    } elseif ($x == '01') {
                        $tdkbergerak_jan += 1;
                    } elseif ($x == '02') {
                        $tdkbergerak_feb += 1;
                    } elseif ($x == '03') {
                        $tdkbergerak_mar += 1;
                    } elseif ($x == '04') {
                        $tdkbergerak_apr += 1;
                    } elseif ($x == '05') {
                        $tdkbergerak_mei += 1;
                    } elseif ($x == '06') {
                        $tdkbergerak_jun += 1;
                    } elseif ($x == '08') {
                        $tdkbergerak_agus += 1;
                    } elseif ($x == '09') {
                        $tdkbergerak_sept += 1;
                    } elseif ($x == '10') {
                        $tdkbergerak_okto += 1;
                    } elseif ($x == '11') {
                        $tdkbergerak_nove += 1;
                    } elseif ($x == '12') {
                        $tdkbergerak_dese += 1;
                    }
                } elseif ($z == $thn_sekarang && $ty->jenis_asets_id == 3) {
                    if ($x == '07') {
                        $peralatan_juli += 1;
                    } elseif ($x == '01') {
                        $peralatan_jan += 1;
                    } elseif ($x == '02') {
                        $peralatan_feb += 1;
                    } elseif ($x == '03') {
                        $peralatan_mar += 1;
                    } elseif ($x == '04') {
                        $peralatan_apr += 1;
                    } elseif ($x == '05') {
                        $peralatan_mei += 1;
                    } elseif ($x == '06') {
                        $peralatan_jun += 1;
                    } elseif ($x == '08') {
                        $peralatan_agus += 1;
                    } elseif ($x == '09') {
                        $peralatan_sept += 1;
                    } elseif ($x == '10') {
                        $peralatan_okto += 1;
                    } elseif ($x == '11') {
                        $peralatan_nove += 1;
                    } elseif ($x == '12') {
                        $peralatan_dese += 1;
                    }
                } elseif ($z == $thn_sekarang && $ty->jenis_asets_id == 4) {
                    if ($x == '07') {
                        $perlengkapan_juli += 1;
                    } elseif ($x == '01') {
                        $perlengkapan_jan += 1;
                    } elseif ($x == '02') {
                        $perlengkapan_feb += 1;
                    } elseif ($x == '03') {
                        $perlengkapan_mar += 1;
                    } elseif ($x == '04') {
                        $perlengkapan_apr += 1;
                    } elseif ($x == '05') {
                        $perlengkapan_mei += 1;
                    } elseif ($x == '06') {
                        $perlengkapan_jun += 1;
                    } elseif ($x == '08') {
                        $perlengkapan_agus += 1;
                    } elseif ($x == '09') {
                        $perlengkapan_sept += 1;
                    } elseif ($x == '10') {
                        $perlengkapan_okto += 1;
                    } elseif ($x == '11') {
                        $perlengkapan_nove += 1;
                    } elseif ($x == '12') {
                        $perlengkapan_dese += 1;
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

            return view(
                'admin',
                compact(
                    'datap',
                    // 'barang',
                    'data',
                    'datas',
                    'jenisbarang',
                    // 'jenisaset',
                    'dataasalperolehan',
                    'datasatuan',
                    'inputbarang',
                    'pinjam',
                    'disetujui_jan',
                    'disetujui_feb',
                    'disetujui_mar',
                    'disetujui_apr',
                    'disetujui_mei',
                    'disetujui_jun',
                    'disetujui_juli',
                    'disetujui_agus',
                    'disetujui_sept',
                    'disetujui_okto',
                    'disetujui_nove',
                    'disetujui_dese',

                    'total_jan',
                    'total_feb',
                    'total_mar',
                    'total_apr',
                    'total_mei',
                    'total_jun',
                    'total_juli',
                    'total_agus',
                    'total_sept',
                    'total_okto',
                    'total_nove',
                    'total_dese',

                    'ditolak_jan',
                    'ditolak_feb',
                    'ditolak_mar',
                    'ditolak_apr',
                    'ditolak_mei',
                    'ditolak_jun',
                    'ditolak_juli',
                    'ditolak_agus',
                    'ditolak_sept',
                    'ditolak_okto',
                    'ditolak_nove',
                    'ditolak_dese',

                    'ambilbarang_jan',
                    'ambilbarang_feb',
                    'ambilbarang_mar',
                    'ambilbarang_apr',
                    'ambilbarang_mei',
                    'ambilbarang_jun',
                    'ambilbarang_juli',
                    'ambilbarang_agus',
                    'ambilbarang_sept',
                    'ambilbarang_okto',
                    'ambilbarang_nove',
                    'ambilbarang_dese',

                    'dikembalikan_jan',
                    'dikembalikan_feb',
                    'dikembalikan_mar',
                    'dikembalikan_apr',
                    'dikembalikan_mei',
                    'dikembalikan_jun',
                    'dikembalikan_juli',
                    'dikembalikan_agus',
                    'dikembalikan_sept',
                    'dikembalikan_okto',
                    'dikembalikan_nove',
                    'dikembalikan_dese',

                    'terlambat_jan',
                    'terlambat_feb',
                    'terlambat_mar',
                    'terlambat_apr',
                    'terlambat_mei',
                    'terlambat_jun',
                    'terlambat_juli',
                    'terlambat_agus',
                    'terlambat_sept',
                    'terlambat_okto',
                    'terlambat_nove',
                    'terlambat_dese',

                    'bergerak_jan',
                    'bergerak_feb',
                    'bergerak_mar',
                    'bergerak_apr',
                    'bergerak_mei',
                    'bergerak_jun',
                    'bergerak_juli',
                    'bergerak_agus',
                    'bergerak_sept',
                    'bergerak_okto',
                    'bergerak_nove',
                    'bergerak_dese',

                    'tdkbergerak_jan',
                    'tdkbergerak_feb',
                    'tdkbergerak_mar',
                    'tdkbergerak_apr',
                    'tdkbergerak_mei',
                    'tdkbergerak_jun',
                    'tdkbergerak_juli',
                    'tdkbergerak_agus',
                    'tdkbergerak_sept',
                    'tdkbergerak_okto',
                    'tdkbergerak_nove',
                    'tdkbergerak_dese',

                    'peralatan_jan',
                    'peralatan_feb',
                    'peralatan_mar',
                    'peralatan_apr',
                    'peralatan_mei',
                    'peralatan_jun',
                    'peralatan_juli',
                    'peralatan_agus',
                    'peralatan_sept',
                    'peralatan_okto',
                    'peralatan_nove',
                    'peralatan_dese',

                    'perlengkapan_jan',
                    'perlengkapan_feb',
                    'perlengkapan_mar',
                    'perlengkapan_apr',
                    'perlengkapan_mei',
                    'perlengkapan_jun',
                    'perlengkapan_juli',
                    'perlengkapan_agus',
                    'perlengkapan_sept',
                    'perlengkapan_okto',
                    'perlengkapan_nove',
                    'perlengkapan_dese',

                    'thn',
                )
            );
        }

        //role staff
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



 // function filter tahun
    // private function multiSearch(array $array, array $pairs)
    // {
    //     $found = array();
    //     foreach ($array as $aKey => $aVal) {
    //         $coincidences = 0;
    //         foreach ($pairs as $pKey => $pVal) {
    //             if (array_key_exists($pKey, $aVal) && $aVal[$pKey] == $pVal) {
    //                 $coincidences++;
    //             }
    //         }
    //         if ($coincidences == count($pairs)) {
    //             $found[$aKey] = $aVal;
    //         }
    //     }

    //     return $found;
    // }

    // private function searchByValue($id, $array)
    // {
    //     foreach ($array as $key => $val) {
    //         if ($val['barangs_id'] === $id) {
    //             return $key;
    //         }
    //     }
    //     return null;
    // }

    public function rekap_tahun(Request $request, $tahun)
    {
        $tt = 0;
        $barang = 0;
        $d = 0;
        $data = DB::select("SELECT pinjams.barangs_id, sum(pinjams.jumlah_pinjam) as jumlah FROM pinjams INNER JOIN barangs ON (pinjams.barangs_id = barangs.id) GROUP BY pinjams.barangs_id");
        $datas = DB::table('pinjams')->select('pinjams.barangs_id', 'barangs.kode', 'barangs.spesifikasi', 'pinjams.jumlah_pinjam')
            ->join('barangs', 'barangs.id', '=', 'pinjams.barangs_id')
            ->get()
            ->toArray();

        // // dd($datas);
        $datap = array();
        $i = 0;

        foreach ($datas as $row_product) {
            if (count($datap) == 0) {
                # code...
                $datap[$i]["barangs_id"] = $row_product->barangs_id;
                $datap[$i]["kode"] = $row_product->kode;
                $datap[$i]["spesifikasi"] = $row_product->spesifikasi;
                // $datap[$i]["jenis_asets_id"] = $row_product->jenis_asets_id;
                $datap[$i]["jumlah"] = (int)$row_product->jumlah_pinjam;
                $i++;
            } else {
                $dump = $this->multiSearch($datap, array('barangs_id' => $row_product->barangs_id));
                if (count($dump) == 0) {
                    # code...
                    $datap[$i]["barangs_id"] = $row_product->barangs_id;
                    $datap[$i]["kode"] = $row_product->kode;
                    $datap[$i]["spesifikasi"] = $row_product->spesifikasi;
                    // $datap[$i]["jenis_asets_id"] = $row_product->jenis_asets_id;
                    $datap[$i]["jumlah"] = (int)$row_product->jumlah_pinjam;
                    $i++;
                } else {
                    $key = $this->searchByValue($row_product->barangs_id, $datap);
                    $datap[$key]["jumlah"] = $datap[$key]["jumlah"] + (int)$row_product->jumlah_pinjam;
                }
            }
        }
        // $data = DB::select("SELECT pinjams.barangs_id, sum(pinjams.jumlah_pinjam) as jumlah FROM pinjams INNER JOIN barangs ON (pinjams.barangs_id = barangs.id) GROUP BY pinjams.barangs_id");
        // foreach ($data as $d) {
        //     foreach (Barang::where('id', $d->barangs_id)->get() as $barang) {
        //         echo $barang->kode . '</br>' . $d->jumlah . '</br>';
        //     }
        // }


        //         select SUM(jumlah_pinjam)
        //     from pinjams
        //     group by barangs_id
        //    ORDER BY jumlah_pinjam ASC
        //    LIMIT 1;

        $dataasalperolehan = DataAsalPerolehan::all();
        $thn = Tahun::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $detailpeminjaman = DetailPeminjaman::all();
        $pinjam = Pinjam::all();
        $role = Auth::user()->roles_id;

        // return $inputbarang;
        if ($role == '2') {
            $thn_sekarang = Carbon::now()->isoFormat('YYYY');
            $bergerak_jan = 0;
            $bergerak_feb = 0;
            $bergerak_mar = 0;
            $bergerak_apr = 0;
            $bergerak_mei = 0;
            $bergerak_jun = 0;
            $bergerak_juli = 0;
            $bergerak_agus = 0;
            $bergerak_sept = 0;
            $bergerak_okto = 0;
            $bergerak_nove = 0;
            $bergerak_dese = 0;

            $tdkbergerak_jan = 0;
            $tdkbergerak_feb = 0;
            $tdkbergerak_mar = 0;
            $tdkbergerak_apr = 0;
            $tdkbergerak_mei = 0;
            $tdkbergerak_jun = 0;
            $tdkbergerak_juli = 0;
            $tdkbergerak_agus = 0;
            $tdkbergerak_sept = 0;
            $tdkbergerak_okto = 0;
            $tdkbergerak_nove = 0;
            $tdkbergerak_dese = 0;

            $peralatan_jan = 0;
            $peralatan_feb = 0;
            $peralatan_mar = 0;
            $peralatan_apr = 0;
            $peralatan_mei = 0;
            $peralatan_jun = 0;
            $peralatan_juli = 0;
            $peralatan_agus = 0;
            $peralatan_sept = 0;
            $peralatan_okto = 0;
            $peralatan_nove = 0;
            $peralatan_dese = 0;

            $perlengkapan_jan = 0;
            $perlengkapan_feb = 0;
            $perlengkapan_mar = 0;
            $perlengkapan_apr = 0;
            $perlengkapan_mei = 0;
            $perlengkapan_jun = 0;
            $perlengkapan_juli = 0;
            $perlengkapan_agus = 0;
            $perlengkapan_sept = 0;
            $perlengkapan_okto = 0;
            $perlengkapan_nove = 0;
            $perlengkapan_dese = 0;

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

            $disetujui_jan = 0;
            $disetujui_feb = 0;
            $disetujui_mar = 0;
            $disetujui_apr = 0;
            $disetujui_mei = 0;
            $disetujui_jun = 0;
            $disetujui_juli = 0;
            $disetujui_agus = 0;
            $disetujui_sept = 0;
            $disetujui_okto = 0;
            $disetujui_nove = 0;
            $disetujui_dese = 0;

            $ditolak_jan = 0;
            $ditolak_feb = 0;
            $ditolak_mar = 0;
            $ditolak_apr = 0;
            $ditolak_mei = 0;
            $ditolak_jun = 0;
            $ditolak_juli = 0;
            $ditolak_agus = 0;
            $ditolak_sept = 0;
            $ditolak_okto = 0;
            $ditolak_nove = 0;
            $ditolak_dese = 0;

            $ambilbarang_jan = 0;
            $ambilbarang_feb = 0;
            $ambilbarang_mar = 0;
            $ambilbarang_apr = 0;
            $ambilbarang_mei = 0;
            $ambilbarang_jun = 0;
            $ambilbarang_juli = 0;
            $ambilbarang_agus = 0;
            $ambilbarang_sept = 0;
            $ambilbarang_okto = 0;
            $ambilbarang_nove = 0;
            $ambilbarang_dese = 0;

            $dikembalikan_jan = 0;
            $dikembalikan_feb = 0;
            $dikembalikan_mar = 0;
            $dikembalikan_apr = 0;
            $dikembalikan_mei = 0;
            $dikembalikan_jun = 0;
            $dikembalikan_juli = 0;
            $dikembalikan_agus = 0;
            $dikembalikan_sept = 0;
            $dikembalikan_okto = 0;
            $dikembalikan_nove = 0;
            $dikembalikan_dese = 0;

            $terlambat_jan = 0;
            $terlambat_feb = 0;
            $terlambat_mar = 0;
            $terlambat_apr = 0;
            $terlambat_mei = 0;
            $terlambat_jun = 0;
            $terlambat_juli = 0;
            $terlambat_agus = 0;
            $terlambat_sept = 0;
            $terlambat_okto = 0;
            $terlambat_nove = 0;
            $terlambat_dese = 0;
            foreach (Pinjam::get() as $ff) {
                foreach (TrxStatus::where('kode_peminjaman', $ff->kode_peminjaman)->whereYear('created_at', $tahun)->orderby('id', 'desc')->get() as $tr) {
                    // $ty = Barang::where('id', $bb->id)->whereYear('created_at', $bb->created_at)->first();

                    $k = date('m', strtotime($tr->created_at));
                    $y = date('Y', strtotime($tr->created_at));

                    if ($y == $tahun && $tr->status_id == 5) {
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
                    } elseif ($y == $tahun && $tr->status_id == 1) {
                        if ($k == '07') {
                            $disetujui_juli += 1;
                        } elseif ($k == '01') {
                            $disetujui_jan += 1;
                        } elseif ($k == '02') {
                            $disetujui_feb += 1;
                        } elseif ($k == '03') {
                            $disetujui_mar += 1;
                        } elseif ($k == '04') {
                            $disetujui_apr += 1;
                        } elseif ($k == '05') {
                            $disetujui_mei += 1;
                        } elseif ($k == '06') {
                            $disetujui_jun += 1;
                        } elseif ($k == '08') {
                            $disetujui_agus += 1;
                        } elseif ($k == '09') {
                            $disetujui_sept += 1;
                        } elseif ($k == '10') {
                            $disetujui_okto += 1;
                        } elseif ($k == '11') {
                            $disetujui_nove += 1;
                        } elseif ($k == '12') {
                            $disetujui_dese += 1;
                        }
                    } elseif ($y == $tahun && $tr->status_id == 2) {
                        if ($k == '07') {
                            $ditolak_juli += 1;
                        } elseif ($k == '01') {
                            $ditolak_jan += 1;
                        } elseif ($k == '02') {
                            $ditolak_feb += 1;
                        } elseif ($k == '03') {
                            $ditolak_mar += 1;
                        } elseif ($k == '04') {
                            $ditolak_apr += 1;
                        } elseif ($k == '05') {
                            $ditolak_mei += 1;
                        } elseif ($k == '06') {
                            $ditolak_jun += 1;
                        } elseif ($k == '08') {
                            $ditolak_agus += 1;
                        } elseif ($k == '09') {
                            $ditolak_sept += 1;
                        } elseif ($k == '10') {
                            $ditolak_okto += 1;
                        } elseif ($k == '11') {
                            $ditolak_nove += 1;
                        } elseif ($k == '12') {
                            $ditolak_dese += 1;
                        }
                    } elseif ($y == $tahun && $tr->status_id == 3) {
                        if ($k == '07') {
                            $ambilbarang_juli += 1;
                        } elseif ($k == '01') {
                            $ambilbarang_jan += 1;
                        } elseif ($k == '02') {
                            $ambilbarang_feb += 1;
                        } elseif ($k == '03') {
                            $ambilbarang_mar += 1;
                        } elseif ($k == '04') {
                            $ambilbarang_apr += 1;
                        } elseif ($k == '05') {
                            $ambilbarang_mei += 1;
                        } elseif ($k == '06') {
                            $ambilbarang_jun += 1;
                        } elseif ($k == '08') {
                            $ambilbarang_agus += 1;
                        } elseif ($k == '09') {
                            $ambilbarang_sept += 1;
                        } elseif ($k == '10') {
                            $ambilbarang_okto += 1;
                        } elseif ($k == '11') {
                            $ambilbarang_nove += 1;
                        } elseif ($k == '12') {
                            $ambilbarang_dese += 1;
                        }
                    } elseif ($y == $tahun && $tr->status_id == 4) {
                        if ($k == '07') {
                            $dikembalikan_juli += 1;
                        } elseif ($k == '01') {
                            $dikembalikan_jan += 1;
                        } elseif ($k == '02') {
                            $dikembalikan_feb += 1;
                        } elseif ($k == '03') {
                            $dikembalikan_mar += 1;
                        } elseif ($k == '04') {
                            $dikembalikan_apr += 1;
                        } elseif ($k == '05') {
                            $dikembalikan_mei += 1;
                        } elseif ($k == '06') {
                            $dikembalikan_jun += 1;
                        } elseif ($k == '08') {
                            $dikembalikan_agus += 1;
                        } elseif ($k == '09') {
                            $dikembalikan_sept += 1;
                        } elseif ($k == '10') {
                            $dikembalikan_okto += 1;
                        } elseif ($k == '11') {
                            $dikembalikan_nove += 1;
                        } elseif ($k == '12') {
                            $dikembalikan_dese += 1;
                        }
                    } elseif ($y == $tahun && $tr->status_id == 6) {
                        if ($k == '07') {
                            $terlambat_juli += 1;
                        } elseif ($k == '01') {
                            $terlambat_jan += 1;
                        } elseif ($k == '02') {
                            $terlambat_feb += 1;
                        } elseif ($k == '03') {
                            $terlambat_mar += 1;
                        } elseif ($k == '04') {
                            $terlambat_apr += 1;
                        } elseif ($k == '05') {
                            $terlambat_mei += 1;
                        } elseif ($k == '06') {
                            $terlambat_jun += 1;
                        } elseif ($k == '08') {
                            $terlambat_agus += 1;
                        } elseif ($k == '09') {
                            $terlambat_sept += 1;
                        } elseif ($k == '10') {
                            $terlambat_okto += 1;
                        } elseif ($k == '11') {
                            $terlambat_nove += 1;
                        } elseif ($k == '12') {
                            $terlambat_dese += 1;
                        }
                    }
                }
            }

            // foreach (Barang::get() as $bb) {
            foreach (Barang::whereYear('created_at', $tahun)->get() as $ty) {

                $x = date('m', strtotime($ty->created_at));
                $z = date('Y', strtotime($ty->created_at));

                if ($z == $tahun && $ty->jenis_asets_id == 1) {
                    if ($x == '07') {
                        $bergerak_juli += 1;
                    } elseif ($x == '01') {
                        $bergerak_jan += 1;
                    } elseif ($x == '02') {
                        $bergerak_feb += 1;
                    } elseif ($x == '03') {
                        $bergerak_mar += 1;
                    } elseif ($x == '04') {
                        $bergerak_apr += 1;
                    } elseif ($x == '05') {
                        $bergerak_mei += 1;
                    } elseif ($x == '06') {
                        $bergerak_jun += 1;
                    } elseif ($x == '08') {
                        $bergerak_agus += 1;
                    } elseif ($x == '09') {
                        $bergerak_sept += 1;
                    } elseif ($x == '10') {
                        $bergerak_okto += 1;
                    } elseif ($x == '11') {
                        $bergerak_nove += 1;
                    } elseif ($x == '12') {
                        $bergerak_dese += 1;
                    }
                } elseif ($z == $tahun && $ty->jenis_asets_id == 2) {
                    if ($x == '07') {
                        $tdkbergerak_juli += 1;
                    } elseif ($x == '01') {
                        $tdkbergerak_jan += 1;
                    } elseif ($x == '02') {
                        $tdkbergerak_feb += 1;
                    } elseif ($x == '03') {
                        $tdkbergerak_mar += 1;
                    } elseif ($x == '04') {
                        $tdkbergerak_apr += 1;
                    } elseif ($x == '05') {
                        $tdkbergerak_mei += 1;
                    } elseif ($x == '06') {
                        $tdkbergerak_jun += 1;
                    } elseif ($x == '08') {
                        $tdkbergerak_agus += 1;
                    } elseif ($x == '09') {
                        $tdkbergerak_sept += 1;
                    } elseif ($x == '10') {
                        $tdkbergerak_okto += 1;
                    } elseif ($x == '11') {
                        $tdkbergerak_nove += 1;
                    } elseif ($x == '12') {
                        $tdkbergerak_dese += 1;
                    }
                } elseif ($z == $tahun && $ty->jenis_asets_id == 3) {
                    if ($x == '07') {
                        $peralatan_juli += 1;
                    } elseif ($x == '01') {
                        $peralatan_jan += 1;
                    } elseif ($x == '02') {
                        $peralatan_feb += 1;
                    } elseif ($x == '03') {
                        $peralatan_mar += 1;
                    } elseif ($x == '04') {
                        $peralatan_apr += 1;
                    } elseif ($x == '05') {
                        $peralatan_mei += 1;
                    } elseif ($x == '06') {
                        $peralatan_jun += 1;
                    } elseif ($x == '08') {
                        $peralatan_agus += 1;
                    } elseif ($x == '09') {
                        $peralatan_sept += 1;
                    } elseif ($x == '10') {
                        $peralatan_okto += 1;
                    } elseif ($x == '11') {
                        $peralatan_nove += 1;
                    } elseif ($x == '12') {
                        $peralatan_dese += 1;
                    }
                } elseif ($z == $tahun && $ty->jenis_asets_id == 4) {
                    if ($x == '07') {
                        $perlengkapan_juli += 1;
                    } elseif ($x == '01') {
                        $perlengkapan_jan += 1;
                    } elseif ($x == '02') {
                        $perlengkapan_feb += 1;
                    } elseif ($x == '03') {
                        $perlengkapan_mar += 1;
                    } elseif ($x == '04') {
                        $perlengkapan_apr += 1;
                    } elseif ($x == '05') {
                        $perlengkapan_mei += 1;
                    } elseif ($x == '06') {
                        $perlengkapan_jun += 1;
                    } elseif ($x == '08') {
                        $perlengkapan_agus += 1;
                    } elseif ($x == '09') {
                        $perlengkapan_sept += 1;
                    } elseif ($x == '10') {
                        $perlengkapan_okto += 1;
                    } elseif ($x == '11') {
                        $perlengkapan_nove += 1;
                    } elseif ($x == '12') {
                        $perlengkapan_dese += 1;
                    }
                }
            }
            // }


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

            return view(
                'kepalaunit',
                compact(
                    'data',
                    'datap',
                    'jenisbarang',
                    // 'jenisaset',
                    'dataasalperolehan',
                    'datasatuan',
                    'inputbarang',
                    'pinjam',
                    'disetujui_jan',
                    'disetujui_feb',
                    'disetujui_mar',
                    'disetujui_apr',
                    'disetujui_mei',
                    'disetujui_jun',
                    'disetujui_juli',
                    'disetujui_agus',
                    'disetujui_sept',
                    'disetujui_okto',
                    'disetujui_nove',
                    'disetujui_dese',

                    'total_jan',
                    'total_feb',
                    'total_mar',
                    'total_apr',
                    'total_mei',
                    'total_jun',
                    'total_juli',
                    'total_agus',
                    'total_sept',
                    'total_okto',
                    'total_nove',
                    'total_dese',

                    'ditolak_jan',
                    'ditolak_feb',
                    'ditolak_mar',
                    'ditolak_apr',
                    'ditolak_mei',
                    'ditolak_jun',
                    'ditolak_juli',
                    'ditolak_agus',
                    'ditolak_sept',
                    'ditolak_okto',
                    'ditolak_nove',
                    'ditolak_dese',

                    'ambilbarang_jan',
                    'ambilbarang_feb',
                    'ambilbarang_mar',
                    'ambilbarang_apr',
                    'ambilbarang_mei',
                    'ambilbarang_jun',
                    'ambilbarang_juli',
                    'ambilbarang_agus',
                    'ambilbarang_sept',
                    'ambilbarang_okto',
                    'ambilbarang_nove',
                    'ambilbarang_dese',

                    'dikembalikan_jan',
                    'dikembalikan_feb',
                    'dikembalikan_mar',
                    'dikembalikan_apr',
                    'dikembalikan_mei',
                    'dikembalikan_jun',
                    'dikembalikan_juli',
                    'dikembalikan_agus',
                    'dikembalikan_sept',
                    'dikembalikan_okto',
                    'dikembalikan_nove',
                    'dikembalikan_dese',

                    'terlambat_jan',
                    'terlambat_feb',
                    'terlambat_mar',
                    'terlambat_apr',
                    'terlambat_mei',
                    'terlambat_jun',
                    'terlambat_juli',
                    'terlambat_agus',
                    'terlambat_sept',
                    'terlambat_okto',
                    'terlambat_nove',
                    'terlambat_dese',

                    'bergerak_jan',
                    'bergerak_feb',
                    'bergerak_mar',
                    'bergerak_apr',
                    'bergerak_mei',
                    'bergerak_jun',
                    'bergerak_juli',
                    'bergerak_agus',
                    'bergerak_sept',
                    'bergerak_okto',
                    'bergerak_nove',
                    'bergerak_dese',

                    'tdkbergerak_jan',
                    'tdkbergerak_feb',
                    'tdkbergerak_mar',
                    'tdkbergerak_apr',
                    'tdkbergerak_mei',
                    'tdkbergerak_jun',
                    'tdkbergerak_juli',
                    'tdkbergerak_agus',
                    'tdkbergerak_sept',
                    'tdkbergerak_okto',
                    'tdkbergerak_nove',
                    'tdkbergerak_dese',

                    'peralatan_jan',
                    'peralatan_feb',
                    'peralatan_mar',
                    'peralatan_apr',
                    'peralatan_mei',
                    'peralatan_jun',
                    'peralatan_juli',
                    'peralatan_agus',
                    'peralatan_sept',
                    'peralatan_okto',
                    'peralatan_nove',
                    'peralatan_dese',

                    'perlengkapan_jan',
                    'perlengkapan_feb',
                    'perlengkapan_mar',
                    'perlengkapan_apr',
                    'perlengkapan_mei',
                    'perlengkapan_jun',
                    'perlengkapan_juli',
                    'perlengkapan_agus',
                    'perlengkapan_sept',
                    'perlengkapan_okto',
                    'perlengkapan_nove',
                    'perlengkapan_dese',
                    'tahun',
                    'thn',
                )
            );
        }
        //role admin
        if ($role == '1') {
            $thn_sekarang = Carbon::now()->isoFormat('YYYY');
            $bergerak_jan = 0;
            $bergerak_feb = 0;
            $bergerak_mar = 0;
            $bergerak_apr = 0;
            $bergerak_mei = 0;
            $bergerak_jun = 0;
            $bergerak_juli = 0;
            $bergerak_agus = 0;
            $bergerak_sept = 0;
            $bergerak_okto = 0;
            $bergerak_nove = 0;
            $bergerak_dese = 0;

            $tdkbergerak_jan = 0;
            $tdkbergerak_feb = 0;
            $tdkbergerak_mar = 0;
            $tdkbergerak_apr = 0;
            $tdkbergerak_mei = 0;
            $tdkbergerak_jun = 0;
            $tdkbergerak_juli = 0;
            $tdkbergerak_agus = 0;
            $tdkbergerak_sept = 0;
            $tdkbergerak_okto = 0;
            $tdkbergerak_nove = 0;
            $tdkbergerak_dese = 0;

            $peralatan_jan = 0;
            $peralatan_feb = 0;
            $peralatan_mar = 0;
            $peralatan_apr = 0;
            $peralatan_mei = 0;
            $peralatan_jun = 0;
            $peralatan_juli = 0;
            $peralatan_agus = 0;
            $peralatan_sept = 0;
            $peralatan_okto = 0;
            $peralatan_nove = 0;
            $peralatan_dese = 0;

            $perlengkapan_jan = 0;
            $perlengkapan_feb = 0;
            $perlengkapan_mar = 0;
            $perlengkapan_apr = 0;
            $perlengkapan_mei = 0;
            $perlengkapan_jun = 0;
            $perlengkapan_juli = 0;
            $perlengkapan_agus = 0;
            $perlengkapan_sept = 0;
            $perlengkapan_okto = 0;
            $perlengkapan_nove = 0;
            $perlengkapan_dese = 0;

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

            $disetujui_jan = 0;
            $disetujui_feb = 0;
            $disetujui_mar = 0;
            $disetujui_apr = 0;
            $disetujui_mei = 0;
            $disetujui_jun = 0;
            $disetujui_juli = 0;
            $disetujui_agus = 0;
            $disetujui_sept = 0;
            $disetujui_okto = 0;
            $disetujui_nove = 0;
            $disetujui_dese = 0;

            $ditolak_jan = 0;
            $ditolak_feb = 0;
            $ditolak_mar = 0;
            $ditolak_apr = 0;
            $ditolak_mei = 0;
            $ditolak_jun = 0;
            $ditolak_juli = 0;
            $ditolak_agus = 0;
            $ditolak_sept = 0;
            $ditolak_okto = 0;
            $ditolak_nove = 0;
            $ditolak_dese = 0;

            $ambilbarang_jan = 0;
            $ambilbarang_feb = 0;
            $ambilbarang_mar = 0;
            $ambilbarang_apr = 0;
            $ambilbarang_mei = 0;
            $ambilbarang_jun = 0;
            $ambilbarang_juli = 0;
            $ambilbarang_agus = 0;
            $ambilbarang_sept = 0;
            $ambilbarang_okto = 0;
            $ambilbarang_nove = 0;
            $ambilbarang_dese = 0;

            $dikembalikan_jan = 0;
            $dikembalikan_feb = 0;
            $dikembalikan_mar = 0;
            $dikembalikan_apr = 0;
            $dikembalikan_mei = 0;
            $dikembalikan_jun = 0;
            $dikembalikan_juli = 0;
            $dikembalikan_agus = 0;
            $dikembalikan_sept = 0;
            $dikembalikan_okto = 0;
            $dikembalikan_nove = 0;
            $dikembalikan_dese = 0;

            $terlambat_jan = 0;
            $terlambat_feb = 0;
            $terlambat_mar = 0;
            $terlambat_apr = 0;
            $terlambat_mei = 0;
            $terlambat_jun = 0;
            $terlambat_juli = 0;
            $terlambat_agus = 0;
            $terlambat_sept = 0;
            $terlambat_okto = 0;
            $terlambat_nove = 0;
            $terlambat_dese = 0;
            foreach (Pinjam::get() as $ff) {
                $tr = TrxStatus::where('kode_peminjaman', $ff->kode_peminjaman)->whereYear('created_at', $tahun)->orderby('id', 'desc')->first();
                $k = date('m', strtotime($tr->created_at));
                $y = date('Y', strtotime($tr->created_at));

                if ($y == $tahun && $tr->status_id == 5) {
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
                } elseif ($y == $tahun && $tr->status_id == 1) {
                    if ($k == '07') {
                        $disetujui_juli += 1;
                    } elseif ($k == '01') {
                        $disetujui_jan += 1;
                    } elseif ($k == '02') {
                        $disetujui_feb += 1;
                    } elseif ($k == '03') {
                        $disetujui_mar += 1;
                    } elseif ($k == '04') {
                        $disetujui_apr += 1;
                    } elseif ($k == '05') {
                        $disetujui_mei += 1;
                    } elseif ($k == '06') {
                        $disetujui_jun += 1;
                    } elseif ($k == '08') {
                        $disetujui_agus += 1;
                    } elseif ($k == '09') {
                        $disetujui_sept += 1;
                    } elseif ($k == '10') {
                        $disetujui_okto += 1;
                    } elseif ($k == '11') {
                        $disetujui_nove += 1;
                    } elseif ($k == '12') {
                        $disetujui_dese += 1;
                    }
                } elseif ($y == $tahun && $tr->status_id == 2) {
                    if ($k == '07') {
                        $ditolak_juli += 1;
                    } elseif ($k == '01') {
                        $ditolak_jan += 1;
                    } elseif ($k == '02') {
                        $ditolak_feb += 1;
                    } elseif ($k == '03') {
                        $ditolak_mar += 1;
                    } elseif ($k == '04') {
                        $ditolak_apr += 1;
                    } elseif ($k == '05') {
                        $ditolak_mei += 1;
                    } elseif ($k == '06') {
                        $ditolak_jun += 1;
                    } elseif ($k == '08') {
                        $ditolak_agus += 1;
                    } elseif ($k == '09') {
                        $ditolak_sept += 1;
                    } elseif ($k == '10') {
                        $ditolak_okto += 1;
                    } elseif ($k == '11') {
                        $ditolak_nove += 1;
                    } elseif ($k == '12') {
                        $ditolak_dese += 1;
                    }
                } elseif ($y == $tahun && $tr->status_id == 3) {
                    if ($k == '07') {
                        $ambilbarang_juli += 1;
                    } elseif ($k == '01') {
                        $ambilbarang_jan += 1;
                    } elseif ($k == '02') {
                        $ambilbarang_feb += 1;
                    } elseif ($k == '03') {
                        $ambilbarang_mar += 1;
                    } elseif ($k == '04') {
                        $ambilbarang_apr += 1;
                    } elseif ($k == '05') {
                        $ambilbarang_mei += 1;
                    } elseif ($k == '06') {
                        $ambilbarang_jun += 1;
                    } elseif ($k == '08') {
                        $ambilbarang_agus += 1;
                    } elseif ($k == '09') {
                        $ambilbarang_sept += 1;
                    } elseif ($k == '10') {
                        $ambilbarang_okto += 1;
                    } elseif ($k == '11') {
                        $ambilbarang_nove += 1;
                    } elseif ($k == '12') {
                        $ambilbarang_dese += 1;
                    }
                } elseif ($y == $tahun && $tr->status_id == 4) {
                    if ($k == '07') {
                        $dikembalikan_juli += 1;
                    } elseif ($k == '01') {
                        $dikembalikan_jan += 1;
                    } elseif ($k == '02') {
                        $dikembalikan_feb += 1;
                    } elseif ($k == '03') {
                        $dikembalikan_mar += 1;
                    } elseif ($k == '04') {
                        $dikembalikan_apr += 1;
                    } elseif ($k == '05') {
                        $dikembalikan_mei += 1;
                    } elseif ($k == '06') {
                        $dikembalikan_jun += 1;
                    } elseif ($k == '08') {
                        $dikembalikan_agus += 1;
                    } elseif ($k == '09') {
                        $dikembalikan_sept += 1;
                    } elseif ($k == '10') {
                        $dikembalikan_okto += 1;
                    } elseif ($k == '11') {
                        $dikembalikan_nove += 1;
                    } elseif ($k == '12') {
                        $dikembalikan_dese += 1;
                    }
                } elseif ($y == $tahun && $tr->status_id == 6) {
                    if ($k == '07') {
                        $terlambat_juli += 1;
                    } elseif ($k == '01') {
                        $terlambat_jan += 1;
                    } elseif ($k == '02') {
                        $terlambat_feb += 1;
                    } elseif ($k == '03') {
                        $terlambat_mar += 1;
                    } elseif ($k == '04') {
                        $terlambat_apr += 1;
                    } elseif ($k == '05') {
                        $terlambat_mei += 1;
                    } elseif ($k == '06') {
                        $terlambat_jun += 1;
                    } elseif ($k == '08') {
                        $terlambat_agus += 1;
                    } elseif ($k == '09') {
                        $terlambat_sept += 1;
                    } elseif ($k == '10') {
                        $terlambat_okto += 1;
                    } elseif ($k == '11') {
                        $terlambat_nove += 1;
                    } elseif ($k == '12') {
                        $terlambat_dese += 1;
                    }
                }
            }

            foreach (Barang::get() as $bb) {
                $ty = Barang::where('id', $bb->id)->whereYear('created_at', $tahun)->first();
                // foreach (Perizinan::whereYear('tgl_uploadsurat', $tahun)->get() as $ff) {

                $x = date('m', strtotime($ty->created_at));
                $z = date('Y', strtotime($ty->created_at));

                if ($z == $tahun && $ty->jenis_asets_id == 1) {
                    if ($x == '07') {
                        $bergerak_juli += 1;
                    } elseif ($x == '01') {
                        $bergerak_jan += 1;
                    } elseif ($x == '02') {
                        $bergerak_feb += 1;
                    } elseif ($x == '03') {
                        $bergerak_mar += 1;
                    } elseif ($x == '04') {
                        $bergerak_apr += 1;
                    } elseif ($x == '05') {
                        $bergerak_mei += 1;
                    } elseif ($x == '06') {
                        $bergerak_jun += 1;
                    } elseif ($x == '08') {
                        $bergerak_agus += 1;
                    } elseif ($x == '09') {
                        $bergerak_sept += 1;
                    } elseif ($x == '10') {
                        $bergerak_okto += 1;
                    } elseif ($x == '11') {
                        $bergerak_nove += 1;
                    } elseif ($x == '12') {
                        $bergerak_dese += 1;
                    }
                } elseif ($z == $tahun && $ty->jenis_asets_id == 2) {
                    if ($x == '07') {
                        $tdkbergerak_juli += 1;
                    } elseif ($x == '01') {
                        $tdkbergerak_jan += 1;
                    } elseif ($x == '02') {
                        $tdkbergerak_feb += 1;
                    } elseif ($x == '03') {
                        $tdkbergerak_mar += 1;
                    } elseif ($x == '04') {
                        $tdkbergerak_apr += 1;
                    } elseif ($x == '05') {
                        $tdkbergerak_mei += 1;
                    } elseif ($x == '06') {
                        $tdkbergerak_jun += 1;
                    } elseif ($x == '08') {
                        $tdkbergerak_agus += 1;
                    } elseif ($x == '09') {
                        $tdkbergerak_sept += 1;
                    } elseif ($x == '10') {
                        $tdkbergerak_okto += 1;
                    } elseif ($x == '11') {
                        $tdkbergerak_nove += 1;
                    } elseif ($x == '12') {
                        $tdkbergerak_dese += 1;
                    }
                } elseif ($z == $tahun && $ty->jenis_asets_id == 3) {
                    if ($x == '07') {
                        $peralatan_juli += 1;
                    } elseif ($x == '01') {
                        $peralatan_jan += 1;
                    } elseif ($x == '02') {
                        $peralatan_feb += 1;
                    } elseif ($x == '03') {
                        $peralatan_mar += 1;
                    } elseif ($x == '04') {
                        $peralatan_apr += 1;
                    } elseif ($x == '05') {
                        $peralatan_mei += 1;
                    } elseif ($x == '06') {
                        $peralatan_jun += 1;
                    } elseif ($x == '08') {
                        $peralatan_agus += 1;
                    } elseif ($x == '09') {
                        $peralatan_sept += 1;
                    } elseif ($x == '10') {
                        $peralatan_okto += 1;
                    } elseif ($x == '11') {
                        $peralatan_nove += 1;
                    } elseif ($x == '12') {
                        $peralatan_dese += 1;
                    }
                } elseif ($z == $tahun && $ty->jenis_asets_id == 4) {
                    if ($x == '07') {
                        $perlengkapan_juli += 1;
                    } elseif ($x == '01') {
                        $perlengkapan_jan += 1;
                    } elseif ($x == '02') {
                        $perlengkapan_feb += 1;
                    } elseif ($x == '03') {
                        $perlengkapan_mar += 1;
                    } elseif ($x == '04') {
                        $perlengkapan_apr += 1;
                    } elseif ($x == '05') {
                        $perlengkapan_mei += 1;
                    } elseif ($x == '06') {
                        $perlengkapan_jun += 1;
                    } elseif ($x == '08') {
                        $perlengkapan_agus += 1;
                    } elseif ($x == '09') {
                        $perlengkapan_sept += 1;
                    } elseif ($x == '10') {
                        $perlengkapan_okto += 1;
                    } elseif ($x == '11') {
                        $perlengkapan_nove += 1;
                    } elseif ($x == '12') {
                        $perlengkapan_dese += 1;
                    }
                }
            }

            $jumlah = Barang::count();
            // $thn = Tahun::all();
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

            return view(
                'admin',
                compact(
                    // 'data',
                    'datap',
                    // 'barang',
                    'jenisbarang',
                    // 'jenisaset',
                    'dataasalperolehan',
                    'datasatuan',
                    'inputbarang',
                    'pinjam',
                    'disetujui_jan',
                    'disetujui_feb',
                    'disetujui_mar',
                    'disetujui_apr',
                    'disetujui_mei',
                    'disetujui_jun',
                    'disetujui_juli',
                    'disetujui_agus',
                    'disetujui_sept',
                    'disetujui_okto',
                    'disetujui_nove',
                    'disetujui_dese',

                    'total_jan',
                    'total_feb',
                    'total_mar',
                    'total_apr',
                    'total_mei',
                    'total_jun',
                    'total_juli',
                    'total_agus',
                    'total_sept',
                    'total_okto',
                    'total_nove',
                    'total_dese',

                    'ditolak_jan',
                    'ditolak_feb',
                    'ditolak_mar',
                    'ditolak_apr',
                    'ditolak_mei',
                    'ditolak_jun',
                    'ditolak_juli',
                    'ditolak_agus',
                    'ditolak_sept',
                    'ditolak_okto',
                    'ditolak_nove',
                    'ditolak_dese',

                    'ambilbarang_jan',
                    'ambilbarang_feb',
                    'ambilbarang_mar',
                    'ambilbarang_apr',
                    'ambilbarang_mei',
                    'ambilbarang_jun',
                    'ambilbarang_juli',
                    'ambilbarang_agus',
                    'ambilbarang_sept',
                    'ambilbarang_okto',
                    'ambilbarang_nove',
                    'ambilbarang_dese',

                    'dikembalikan_jan',
                    'dikembalikan_feb',
                    'dikembalikan_mar',
                    'dikembalikan_apr',
                    'dikembalikan_mei',
                    'dikembalikan_jun',
                    'dikembalikan_juli',
                    'dikembalikan_agus',
                    'dikembalikan_sept',
                    'dikembalikan_okto',
                    'dikembalikan_nove',
                    'dikembalikan_dese',

                    'terlambat_jan',
                    'terlambat_feb',
                    'terlambat_mar',
                    'terlambat_apr',
                    'terlambat_mei',
                    'terlambat_jun',
                    'terlambat_juli',
                    'terlambat_agus',
                    'terlambat_sept',
                    'terlambat_okto',
                    'terlambat_nove',
                    'terlambat_dese',

                    'bergerak_jan',
                    'bergerak_feb',
                    'bergerak_mar',
                    'bergerak_apr',
                    'bergerak_mei',
                    'bergerak_jun',
                    'bergerak_juli',
                    'bergerak_agus',
                    'bergerak_sept',
                    'bergerak_okto',
                    'bergerak_nove',
                    'bergerak_dese',

                    'tdkbergerak_jan',
                    'tdkbergerak_feb',
                    'tdkbergerak_mar',
                    'tdkbergerak_apr',
                    'tdkbergerak_mei',
                    'tdkbergerak_jun',
                    'tdkbergerak_juli',
                    'tdkbergerak_agus',
                    'tdkbergerak_sept',
                    'tdkbergerak_okto',
                    'tdkbergerak_nove',
                    'tdkbergerak_dese',

                    'peralatan_jan',
                    'peralatan_feb',
                    'peralatan_mar',
                    'peralatan_apr',
                    'peralatan_mei',
                    'peralatan_jun',
                    'peralatan_juli',
                    'peralatan_agus',
                    'peralatan_sept',
                    'peralatan_okto',
                    'peralatan_nove',
                    'peralatan_dese',

                    'perlengkapan_jan',
                    'perlengkapan_feb',
                    'perlengkapan_mar',
                    'perlengkapan_apr',
                    'perlengkapan_mei',
                    'perlengkapan_jun',
                    'perlengkapan_juli',
                    'perlengkapan_agus',
                    'perlengkapan_sept',
                    'perlengkapan_okto',
                    'perlengkapan_nove',
                    'perlengkapan_dese',

                    'tahun',
                    'thn',
                )
            );
        }

        //role staff
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
