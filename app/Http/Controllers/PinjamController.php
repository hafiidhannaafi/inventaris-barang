<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\Status;
use App\Models\TrxStatus;
use App\Models\Peminjaman;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\DetailPeminjaman;
use App\Models\StatusKonfirmasi;
use App\Models\StatusPeminjaman;
use App\Models\DataAsalPerolehan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    //MENAMPILKAN DATA MASTER KE FORM //STAFF
    public function index($id)
    {

        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $pinjam = Pinjam::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $jenisbarang = JenisBarang::all();
        $inputbarang = Barang::find($id);
        return view('pinjam.formulir', [
            "title" => " ",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "jenisbarang" => $jenisbarang,
            "pinjam" => $pinjam

        ]);
    }


    public function pinjamstaff()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('staff.pinjam', [
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "status" => $status,
            "pinjam" => $pinjam,
            "akun" => $akun,
            "trxstatus" => $trxstatus

        ]);
    }

    public function riwayatstaff()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('staff.riwayat', [
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "status" => $status,
            "pinjam" => $pinjam,
            "akun" => $akun,
            "trxstatus" => $trxstatus

        ]);
    }

    public function pengajuan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('kepalaunit.pengajuan', [
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "status" => $status,
            "pinjam" => $pinjam,
            "akun" => $akun,
            "trxstatus" => $trxstatus

        ]);
    }

    public function riwayatkepala()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('kepalaunit.riwayat', [
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "status" => $status,
            "pinjam" => $pinjam,
            "akun" => $akun,
            "trxstatus" => $trxstatus

        ]);
    }

    public function peminjaman()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('peminjaman.peminjaman', [
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "status" => $status,
            "pinjam" => $pinjam,
            "akun" => $akun,
            "trxstatus" => $trxstatus

        ]);
    }

    public function riwayatadmin()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $pinjam = Pinjam::latest()->get();
        $status = Status::all();
        $trxstatus = TrxStatus::all();
        return view('peminjaman.riwayatpinjam', [
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" => $datasatuan,
            "inputbarang" => $inputbarang,
            "status" => $status,
            "pinjam" => $pinjam,
            "akun" => $akun,
            "trxstatus" => $trxstatus

        ]);
    }


    public function create(Request $request)
    {
        // dd($request);
        $data = Pinjam::max('kode_peminjaman');
        $huruf = "PB";
        $urutan = (int)substr($data, 3, 3);
        $urutan++;
        $book_id = $huruf . uniqid();
        $pinjam = new Pinjam();

        $pinjam->kode_peminjaman = $book_id;
        $pinjam->barangs_id = $request->barangs_id;
        $pinjam->users_id = $request->users_id;
        $pinjam->nama_peminjam = $request->nama_peminjam;
        $pinjam->jenis_peminjaman = $request->jenis_peminjaman;
        $pinjam->tujuan = $request->tujuan;
        $pinjam->tgl_pengajuan = $request->tgl_pengajuan;
        $pinjam->tgl_pinjam = $request->tgl_pinjam;
        $pinjam->tgl_kembali = $request->tgl_kembali;
        $pinjam->jumlah_pinjam = $request->jumlah_pinjam;
        $pinjam->surat_pinjam = $request->surat_pinjam;
        if ($request->hasFile('surat_pinjam')) {
            $request->file('surat_pinjam')->move('surat/', $request->file('surat_pinjam')->getClientOriginalName());
            $pinjam->surat_pinjam = $request->file('surat_pinjam')->getClientOriginalName();
            $pinjam->save();
        }

        $b = Barang::where('id', $request->barangs_id)->first();
        if ($b->jumlah < $pinjam->jumlah_pinjam) {
            return redirect()->back()->with('warning', 'Maaf jumlah barang yang anda pinjam melebihi dari sisa stok yang ada');
        } else {

            $trxstatus = new TrxStatus;
            $trxstatus->kode_peminjaman = $book_id;
            $trxstatus->users_id = $request->input('users_id');
            $trxstatus->status_id = 5;
            $trxstatus->save();

            return redirect()->back()->with('success', 'Pengajuan Peminjaman Sukses');
        }
    }


    public function insertstatus(Request $request)
    {
        $data = Pinjam::max('kode_peminjaman');
        $huruf = "PB";
        $urutan = (int)substr($data, 3, 3);
        $urutan++;
        $book_id = $huruf . uniqid();


        $pinjam = Pinjam::where('kode_peminjaman', $book_id)->first();
        $trxstatus = new TrxStatus;
        $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
        $trxstatus->users_id = $request->input('users_id');
        $trxstatus->status_id = $request->input('status_id');
        $trxstatus->ket = $request->input('ket');
        $trxstatus->save();

        return redirect()->back()->with('success', 'Verifikasi status berhasil');
    }

    public function menyetujui(Request $request, $id)
    {
        $pinjams = Pinjam::where('id', $id)->first();
        // dd($id);
        // $pinjam = Pinjam::where('kode_peminjaman', $pinjams->kode_peminjaman)->first();
        // $pinjams = Pinjam::where('id', $pinjam->id)->first();
        $trxstatus = new TrxStatus;
        $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
        $trxstatus->users_id = $request->input('users_id');
        $trxstatus->status_id = 1;
        $trxstatus->save();

        $brg = Barang::where('id', $pinjams->barangs_id)->first(); {
            $brg->jumlah -= (int) $pinjams->jumlah_pinjam;
            $brg->save();
        }
        return redirect()->back()->with('success', 'Verifikasi status berhasil');
    }

    public function mengembalikan(Request $request, $id)
    {
        $pinjams = Pinjam::where('id', $id)->first();
        $tgl_sekarang = Carbon::now()->format('Y-m-d');
        if ($tgl_sekarang > $pinjams->tgl_kembali) {
            $trxstatus = new TrxStatus;
            $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
            $trxstatus->users_id = $request->input('users_id');
            $trxstatus->ket = $request->input('ket');
            $trxstatus->status_id = 6;
            $trxstatus->save();
        } else {
            $trxstatus = new TrxStatus;
            $trxstatus->kode_peminjaman = $request->input('kode_peminjaman');
            $trxstatus->users_id = $request->input('users_id');
            $trxstatus->ket = $request->input('ket');
            $trxstatus->status_id = 4;
            $trxstatus->save();
        }
        $brg = Barang::where('id', $pinjams->barangs_id)->first();
        $brg->jumlah += (int) $pinjams->jumlah_pinjam;
        $brg->save();


        return redirect()->back()->with('success', 'Verifikasi status berhasil');
    }
}
