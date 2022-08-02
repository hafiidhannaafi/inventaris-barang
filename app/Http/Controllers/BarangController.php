<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Models\Pinjam;
use App\Models\Satuan;
use Barryvdh\DomPDF\Facade\PDF;


class BarangController extends Controller
{

    //MENAMPILKAN DATA MASTER KE FORM
    public function formasettidakbergerak() //aset tidak bergerak
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $dataaset = Barang::all();
        return view('dataaset.form', [
            "title" => "dataaset",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "dataaset" => $dataaset
        ]);
    }

    public function formasetbergerak() // formbergerak
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $dataaset = Barang::all();
        return view('dataasetbergerak.form', [
            "title" => "dataasetbergerak",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "dataaset" => $dataaset
        ]);
    }

    public function formperalatan() // form peralatan
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $dataaset = Barang::all();
        return view('dataperalatan.form', [
            "title" => "peralatan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "dataaset" => $dataaset
        ]);
    }

    public function formperlengkapan() // form perlengkapan
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $dataaset = Barang::all();
        return view('dataperlengkapan.form', [
            "title" => "perlengkapan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "dataaset" => $dataaset
        ]);
    }

    //MENAMPILKAN DATA HASIL INPUT ADMIN
    public function dataaset()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('dataaset.index', [
            "title" => "asettidakbergerak",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function dataasetbergerak()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $pinjam = Pinjam::all();
        return view('dataasetbergerak.index', [
            "title" => "asetbergerak",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "pinjam" => $pinjam
        ]);
    }

    public function dataasetperalatan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('dataperalatan.index', [
            "title" => "peralatan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function dataasetperlengkapan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('dataperlengkapan.index', [
            "title" => "perlengkapan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    //MENAMPILKAN DATA HASIL INPUT KEPALA UNIT DAN STAFF 

    public function cekdata()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('cekdata', [
            "title" => "peralatan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function asetbergerak()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('aset.bergerak', [
            "title" => "asetbergerak",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function laporanasetbergerak()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('laporan.asetbergerak', [
            "title" => "laporanasetbergerak",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function asettidakbergerak()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('aset.tidakbergerak', [
            "title" => "asettidakbergerak",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function laporanasettidakbergerak()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('laporan.asettidakbergerak', [
            "title" => "laporanasettidakbergerak",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function asetperalatan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('aset.peralatan', [
            "title" => "asetperalatan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function laporanasetperalatan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('laporan.peralatan', [
            "title" => "laporanasetperalatan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function asetperlengkapan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('aset.perlengkapan', [
            "title" => "asetperlengkapan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }

    public function laporanasetperlengkapan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        return view('laporan.perlengkapan', [
            "title" => "laporanasetperlengkapan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang
        ]);
    }


    //INPUT DATA
    public function create(Request $request)
    {
        // $inputbarang = \App\Models\Barang::create($request->all());
        $inputbarang = new Barang();
        $inputbarang->jenis_asets_id = $request->jenis_asets_id;
        $inputbarang->jenis_barangs_id = $request->jenis_barangs_id;
        $inputbarang->asal_perolehans_id = $request->asal_perolehans_id;
        $inputbarang->satuans_id = $request->satuans_id;
        $inputbarang->kode = $request->kode;
        $inputbarang->spesifikasi = $request->spesifikasi;
        $inputbarang->foto = $request->foto;
        $inputbarang->kegunaan = $request->kegunaan;
        $inputbarang->tanggal_perolehan = $request->tanggal_perolehan;
        $inputbarang->nilai_perolehan = $request->nilai_perolehan;
        $inputbarang->legalitas = $request->legalitas;
        $inputbarang->luas = $request->luas;
        $inputbarang->beban_penyusutan = $request->beban_penyusutan;
        $inputbarang->nilai_buku = $request->nilai_buku;
        $inputbarang->lokasi = $request->lokasi;
        $inputbarang->penanggung_jawab = $request->penanggung_jawab;
        $inputbarang->jumlah_awal = $request->jumlah_awal;
        $inputbarang->jumlah = $request->jumlah_awal;
        $inputbarang->kondisi = $request->kondisi;
        $inputbarang->ket = $request->ket;
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotobarang/', $request->file('foto')->getClientOriginalName());
            $inputbarang->foto = $request->file('foto')->getClientOriginalName();
            $inputbarang->save();
        }
        if ($inputbarang->jenis_asets_id == 2) {
            return redirect('/data-aset')->with('success', 'Data Berhasil Ditambahkan!');
        } elseif ($inputbarang->jenis_asets_id == 1) {
            return redirect('/data-asetbergerak')->with('success', 'Data Berhasil Ditambahkan!');
        } elseif ($inputbarang->jenis_asets_id == 3) {
            return redirect('/data-peralatan')->with('success', 'Data Berhasil Ditambahkan!');
        } elseif ($inputbarang->jenis_asets_id == 4) {
            return redirect('/data-perlengkapan')->with('success', 'Data Berhasil Ditambahkan!');
        }
    }


    //EDIT DATA
    public function editdataaset($id)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = \App\Models\Barang::find($id);
        return view('dataaset.edit', [
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            'inputbarang' => $inputbarang

        ]);
    }

    public function editasetbergerak($id)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = \App\Models\Barang::find($id);
        return view('dataasetbergerak.edit', [
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            'inputbarang' => $inputbarang

        ]);
    }

    public function editperalatan($id)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = \App\Models\Barang::find($id);
        return view('dataperalatan.edit', [
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            'inputbarang' => $inputbarang

        ]);
    }

    public function editperlengkapan($id)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = \App\Models\Barang::find($id);
        return view('dataperlengkapan.edit', [
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            'inputbarang' => $inputbarang

        ]);
    }


    //UPDATE DATA
    public function update(Request $request, $id)
    {

        $inputbarang = \App\Models\Barang::find($id);

        // $inputbarang->update($request);
        //  $inputbarang =new Barang();
        if ($request->file('foto') == "") {
            $inputbarang->update([

                //         'jenis_asets_id' => $request->input ('jenis_asets_id'),
                'jenis_barangs_id' => $request->input('jenis_barangs_id'),
                'asal_perolehans_id' => $request->input('asal_perolehans_id'),
                'satuans_id' => $request->input('satuans_id'),
                'kode' => $request->input('kode'),
                'spesifikasi' => $request->input('spesifikasi'),
                //  'foto' => $request->input ('foto'),
                'kegunaan' => $request->input('kegunaan'),
                'tanggal_perolehan' => $request->input('tanggal_perolehan'),
                'nilai_perolehan' => $request->input('nilai_perolehan'),
                'legalitas' => $request->input('legalitas'),
                'luas' => $request->input('luas'),
                'beban_penyusutan' => $request->input('beban_penyusutan'),
                'nilai_buku' => $request->input('nilai_buku'),
                'lokasi' => $request->input('lokasi'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'jumlah_awal' => $request->input('jumlah_awal'),
                'jumlah' => $request->input('jumlah_awal'),
                'kondisi' => $request->input('kondisi'),
                'ket' => $request->input('ket'),
            ]);
        } elseif ($request->hasFile('foto')) {
            $request->file('foto')->move('fotobarang/', $request->file('foto')->getClientOriginalName());
            $inputbarang->foto = $request->file('foto')->getClientOriginalName();
            // $inputbarang->update(['foto' => $request->file('foto')]);
            $inputbarang->update([
                'foto' =>  $request->file('foto')->getClientOriginalName(),
            ]);
        }


        if ($inputbarang->jenis_asets_id == 2) {
            return redirect('/data-aset')->with('success', 'Data Berhasil Diupdate!');
        } elseif ($inputbarang->jenis_asets_id == 1) {
            return redirect('/data-asetbergerak')->with('success', 'Data Berhasil Diupdate!');
        } elseif ($inputbarang->jenis_asets_id == 3) {
            return redirect('/data-peralatan')->with('success', 'Data Berhasil Diupdate!');
        } elseif ($inputbarang->jenis_asets_id == 4) {
            return redirect('/data-perlengkapan')->with('success', 'Data Berhasil Diupdate!');
        }
    }

    //HAPUS DATA
    // public function hapusdataaset($id)
    // {
    //     $inputbarang=  Barang::find($id);
    //     $inputbarang->delete();
    //     return redirect('/data-aset')->with('success', 'Data Berhasil Dihapus!');
    // }

    public function hapusasetbergerak($id)
    {
        $inputbarang =  Barang::find($id);
        $inputbarang->delete();
        return redirect('/data-asetbergerak')->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapusperalatan($id)
    {
        $inputbarang =  Barang::find($id);
        $inputbarang->delete();
        return redirect('/data-peralatan')->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapusperlengkapan($id)
    {
        $inputbarang =  Barang::find($id);
        $inputbarang->delete();
        return redirect('/data-perlengkapan')->with('success', 'Data Berhasil Dihapus!');
    }

    public function select2Barang(Request $request)
    {
        $id = $request->id ?? [];

        return Barang::select('barangs.id', DB::raw('CONCAT(kode," - ", jenis_barang ," - ",spesifikasi) as spesifikasi'))
            ->where(DB::raw('CONCAT(kode," - ", jenis_barang ," - ",spesifikasi)'), 'like', '%' . $request->q . '%')
            ->join('jenis_barangs', 'jenis_barangs.id', '=', 'barangs.jenis_barangs_id')
            ->whereNotIn('barangs.id', $id)
            ->where('jumlah', '>', 0)
            ->whereIn('jenis_asets_id', [1, 3, 4])
            ->get();
    }

    //LAPORAN ASET BERGERAK
    public function sortirasetbergerak(Request $request)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        // $barangkeluar = Barangkeluar::all();
        $startDate = ($request->tglawal);
        $endDate = ($request->tglakhir);

        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);
        return view('laporan.asetbergerak', [
            "title" => "barangmasuk",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "data" => $data,
            "startDate" =>   $startDate,
            "endDate" =>   $endDate,

        ]);
    }

    public function cetakLaporanBergerak($start, $end)
    {

        $startDate = $start;
        $endDate = $end;
        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);

        $pdf = PDF::loadview('laporan.cetakasetbergerak', ['data' => $data])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');

        return $pdf->download('Laporan Data Aset Bergerak.pdf');
    }

    //LAPORAN TIDAK BERGERAK
    public function sortirasettidakbergerak(Request $request)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        // $barangkeluar = Barangkeluar::all();
        $startDate = ($request->tglawal);
        $endDate = ($request->tglakhir);

        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);
        return view('laporan.asettidakbergerak', [
            "title" => "barangmasuk",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "data" => $data,
            "startDate" =>   $startDate,
            "endDate" =>   $endDate,

        ]);
    }

    public function cetakLaporanTidakBergerak($start, $end)
    {

        $startDate = $start;
        $endDate = $end;
        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);

        $pdf = PDF::loadview('laporan.cetakasettidakbergerak', ['data' => $data])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');

        return $pdf->download('Laporan Data Aset Tidak Bergerak.pdf');
    }

    //LAPORAN PERALATAN
    public function sortirasetperalatan(Request $request)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        // $barangkeluar = Barangkeluar::all();
        $startDate = ($request->tglawal);
        $endDate = ($request->tglakhir);

        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);
        return view('laporan.peralatan', [
            "title" => "barangmasuk",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "data" => $data,
            "startDate" =>   $startDate,
            "endDate" =>   $endDate,

        ]);
    }

    public function cetakLaporanPeralatan($start, $end)
    {

        $startDate = $start;
        $endDate = $end;
        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);

        $pdf = PDF::loadview('laporan.cetakasetperalatan', ['data' => $data])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');

        return $pdf->download('Laporan Data Aset Peralatan.pdf');
    }

    //LAPORAN PERLENGKAPAN
    public function sortirasetperlengkapan(Request $request)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        // $barangkeluar = Barangkeluar::all();
        $startDate = ($request->tglawal);
        $endDate = ($request->tglakhir);

        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);
        return view('laporan.perlengkapan', [
            "title" => "barangmasuk",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "data" => $data,
            "startDate" =>   $startDate,
            "endDate" =>   $endDate,

        ]);
    }

    public function cetakLaporanPerlengkapan($start, $end)
    {

        $startDate = $start;
        $endDate = $end;
        $data = Barang::all()
            ->whereBetween('created_at', [$startDate, $endDate]);

        $pdf = PDF::loadview('laporan.cetakasetperlengkapan', ['data' => $data])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');

        return $pdf->download('Laporan Data Aset Perlengkapan.pdf');
    }
}
