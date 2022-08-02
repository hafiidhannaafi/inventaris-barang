<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\StatusPeminjaman;
use App\Models\StatusKonfirmasi;
use App\Models\Satuan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;

class PeminjamanController extends Controller
{
    //MENAMPILKAN DATA MASTER KE FORM //STAFF
    public function index()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $jenisbarang = JenisBarang::all();


        return view('peminjaman.form',[
            "title" => "riwayat",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "jenisbarang" => $jenisbarang
            
        ]);
       
    }


    //MENAMPILKAN DATA PEMINJAMAN //STAFF
    public function peminjamanstaff()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $kode_peminjaman = request()->user();
         $status = DetailPeminjaman::where('kode_peminjaman' , $kode_peminjaman)->get();
        // $akun = User::all();
        $akun = request()->user();
        $peminjaman = Peminjaman::where('users_id' , $akun->id)->latest()->get();
         
      
        return view('staff.peminjaman',[
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
           
            "peminjaman"=> $peminjaman,
            "akun"=> $akun,
            "status" => $status,
           
        ]);
       
    }

    public function riwayatstaff()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $kode_peminjaman = request()->user();
         $status = DetailPeminjaman::where('kode_peminjaman' , $kode_peminjaman)->get();
        // $akun = User::all();

        $akun = request()->user();
        $peminjaman = Peminjaman::where('users_id' , $akun->id)->latest()->get();
       
        return view('staff.riwayat',[
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "peminjaman"=> $peminjaman,
            "akun"=> $akun,
           
        ]);
       
    }

     public function detail_barang($id)
    {
        $data = DetailPeminjaman::where('kode_peminjaman', $id)->get(); //kode_peminjaman = $id didapatkan
        $peminjaman = Peminjaman::where('kode_peminjaman', $id)->get();
        return view('staff.data_peminjaman',[
            "title" => "pengajuan",
            "data" => $data,
            "peminjaman" => $peminjaman,
        ]);
       
    }

     public function detail_riwayat($id)
    {
        $data = DetailPeminjaman::where('kode_peminjaman', $id)->get(); //kode_peminjaman = $id didapatkan
        $peminjaman = Peminjaman::where('kode_peminjaman', $id)->get();
        return view('staff.data_riwayat',[
            "title" => "pengajuan",
            "data" => $data,
            "peminjaman" => $peminjaman,
        ]);
       
    }

    //MENAMPILKAN DATA PEMINJAMAN //ADMIN
    public function peminjamanadmin()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
        $peminjaman = Peminjaman::latest()->get();
        return view('peminjaman.peminjaman',[
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "peminjaman"=> $peminjaman,
            "akun"=> $akun
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
        $peminjaman = Peminjaman::latest()->get();
        return view('peminjaman.riwayat',[
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "peminjaman"=> $peminjaman,
            "akun"=> $akun
        ]);
       
    }

    public function pengembalianadmin()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
           
        $peminjaman = Peminjaman::latest()->get();
        return view('peminjaman.pengembalian',[
            "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "peminjaman"=> $peminjaman,
            "akun"=> $akun
        ]);
       
    }

    public function detail_barang_admin($id)
    {
        $data = DetailPeminjaman::where('kode_peminjaman', $id)->get(); //kode_peminjaman = $id didapatkan
        $peminjaman = Peminjaman::where('kode_peminjaman', $id)->get();
        return view('peminjaman.data_peminjaman',[
            "title" => "pengajuan",
            "data" => $data,
            "peminjaman" => $peminjaman,
        ]);
       
    }

    public function detail_riwayat_admin($id)
    {
        $data = DetailPeminjaman::where('kode_peminjaman', $id)->get(); //kode_peminjaman = $id didapatkan
        $peminjaman = Peminjaman::where('kode_peminjaman', $id)->get();
        return view('peminjaman.data_riwayat',[
            "title" => "pengajuan",
            "data" => $data,
            "peminjaman" => $peminjaman,
        ]);
       
    }

    public function editpeminjaman($id)
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
        $akun = User::all();
       $peminjaman = \App\Models\Peminjaman::find($id);
        return view('peminjaman.edit', [
           "title" => "pengajuan",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "peminjaman"=> $peminjaman,
            "akun"=> $akun

        ]);
    }

    public function updatepeminjaman(Request $request, $id)
    {
       $peminjaman = Peminjaman::find($id);
        $peminjaman->update([
        'tgl_ambil' => $request->input('tgl_ambil'),
        'tgl_konfirmasikembali' => $request->input('tgl_konfirmasikembali'),
                ]);

        return redirect ('/peminjaman/pengembalian')->with('success', 'Tanggal Konfirmasi Berhasil ditambahkan!');
    }



    //MENAMPILKAN  PEMINJAMAN// KEPALA UNIT
    public function pengajuan()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
       $peminjaman = Peminjaman::latest()->get();
        $akun = User::all();
        return view('kepalaunit.pengajuan',[
            "title" => "riwayat",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "peminjaman"=> $peminjaman,
            "akun" => $akun
        ]);
       
    }

     public function detail_pengajuan($id)
    {
        $data = DetailPeminjaman::where('kode_peminjaman', $id)->get(); //kode_peminjaman = $id didapatkan
        $peminjaman = Peminjaman::where('kode_peminjaman', $id)->get();
        return view('kepalaunit.data_pengajuan',[
            "title" => "pengajuan",
            "data" => $data,
            "peminjaman" => $peminjaman,
        ]);
       
    }

    public function detail_konfirmasi($id)
    {
        $data = DetailPeminjaman::where('kode_peminjaman', $id)->get(); //kode_peminjaman = $id didapatkan
        $peminjaman = Peminjaman::where('kode_peminjaman', $id)->get();
        return view('peminjaman.konfirmasi',[
            "title" => "pengajuan",
            "data" => $data,
            "peminjaman" => $peminjaman,
        ]);
       
    }

   
      
   
    
       
// INPUT PEMINJAMAN
    public function create(Request $request)
    {  
        // dd($request);
            $data = Peminjaman::max('kode_peminjaman');
            $huruf = "PB";
            $urutan = (int)substr($data, 3, 3);
            $urutan++;
            $book_id = $huruf . sprintf("%04s", $urutan);

       
        $barangs_id=array();
        $jumlah_pinjam=array();

        foreach($request->barangs_id as $i)
        {
            array_push($barangs_id,$i);
        }
     
        foreach($request->jumlah_pinjam as $k)
        {
            array_push($jumlah_pinjam,$k);
        }
            

    //    $jml = $request->jml_barang;
       $jml = count($jumlah_pinjam);
       
        // for($i=0; $i< $jml; $i++)
        // {
        //     $dtpeminjaman =new DetailPeminjaman();
        //     $dtpeminjaman->kode_peminjaman = $book_id;
        //     $dtpeminjaman->status_konfirmasis_id = $request->status_konfirmasis_id;
        //     $dtpeminjaman->status_peminjamans_id = $request->status_peminjamans_id;
        //     $dtpeminjaman->barangs_id = $barangs_id[$i];
        //     $dtpeminjaman ->jumlah_pinjam = $jumlah_pinjam[$i];
        //     $dtpeminjaman->save();
        // }
    for($i=0; $i< $jml; $i++)
        { $b = Barang::where('id',$barangs_id[$i])->first();
            if($b->jumlah < $jumlah_pinjam[$i] || $b->kode < $jml)
            {
                        return redirect()->back()->with('warning', 'Maaf jumlah barang yang anda pinjam melebihi dari sisa stok yang ada');

            // }
            // else
            // {
            //     if(($b->jenis_asets_id ==1 || $b->jenis_asets_id ==3 )&&   $jumlah_pinjam > 1)   {
            //             return redirect()->back()->with('warning', 'Maaf barang bergerak, elektronik, peralatan max pinjam per item 1!');

            }
            
            else
            {
            $dtpeminjaman =new DetailPeminjaman();
            $dtpeminjaman->kode_peminjaman = $book_id;
            $dtpeminjaman->status_konfirmasis_id = $request->status_konfirmasis_id;
            $dtpeminjaman->status_peminjamans_id = $request->status_peminjamans_id;
            $dtpeminjaman->barangs_id = $barangs_id[$i];
            $dtpeminjaman ->jumlah_pinjam = $jumlah_pinjam[$i];
            $dtpeminjaman->save();
        }

        // $datadetail = DetailPeminjaman::where('kode_peminjaman',  $book_id)->get();
        // foreach($datadetail as $d){
        //     $datadetail = DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get();
        //     DetailPeminjaman::where('kode_peminjaman', $dtpeminjaman->kode_peminjaman)->get(); as $d {
                
        //       foreach(Barang::where('id',  $d->barangs_id)->get() as $b) 
        // {
        //     $b->jumlah -= (int)$d->jumlah_pinjam;
        //     $b->save();

        // }
        // }
    }
        $peminjaman =new Peminjaman();
            $peminjaman->kode_peminjaman = $book_id;
            $peminjaman ->users_id = $request->users_id;
            $peminjaman ->nama_peminjam = $request->nama_peminjam;
            $peminjaman ->jenis_peminjaman = $request->jenis_peminjaman;
            $peminjaman ->tujuan = $request->tujuan;
            $peminjaman ->tgl_pengajuan= $request->tgl_pengajuan;
            $peminjaman ->tgl_pinjam = $request->tgl_pinjam;
            $peminjaman ->tgl_kembali = $request->tgl_kembali;
            $peminjaman ->surat_pinjam = $request->surat_pinjam;
            if($request->hasFile('surat_pinjam'))
            {
                 $request->file('surat_pinjam')->move('surat/', $request->file('surat_pinjam')->getClientOriginalName());
                 $peminjaman->surat_pinjam = $request->file('surat_pinjam')->getClientOriginalName();
                 $peminjaman->save();  

             }
      $id =$peminjaman->kode_peminjaman ;
        return redirect('peminjaman/konfirmasi/'.$id)->with('success', 'Data Berhasil Ditambahkan!');
               }
            
            
            
            

     public function download(Request $request, $surat_pinjam)
    {
        
        return response()->download(public_path('surat/'. $surat_pinjam));

       
    }
// UBAH STATUS KONFIRMASI KEPALA UNIT
    public function status_ditolak($kode_peminjaman)
    {
        // $datadetail = DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get();
        foreach(DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get() as $d){
            $d->status_konfirmasis_id = 3;
            $d->save();

        foreach(Barang::where('id', $d->barangs_id)->get() as $b) //perulngan dimana id barang = barangs_id yg ada di detail peminjaman
        {
            $b->jumlah += (int)$d->jumlah_pinjam;
            $b->save();

        }
        }
        return redirect()->back()->with('warning', 'Peminjaman di tolak');
    }


     public function status_setuju($kode_peminjaman)
    {
        $datadetail = DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get();
        foreach($datadetail as $d){
            $d->status_konfirmasis_id = 2;
            $d->save();


        }
        return redirect()->back()->with('success', 'Peminjaman disetujui');
    }

// UBAH STATUS KONFIRMASI STAFF 
        public function status_pengajuan($kode_peminjaman) 
    {
        // $datadetail = DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get();
        foreach(DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get() as $d){
            $d->status_konfirmasis_id = 1;
            $d->save();

        foreach(Barang::where('id', $d->barangs_id)->get() as $b) //perulngan dimana id barang = barangs_id yg ada di detail peminjaman
        {
            $b->jumlah -= (int)$d->jumlah_pinjam;
            $b->save();

        }
        }
         return redirect('/staff/peminjaman/')->with('success', 'Peminjaman berhasil diajukan!');
       

    }

     public function status_batal($kode_peminjaman)
    {
        // $datadetail = DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get();
        foreach(DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get() as $d){
            $d->status_konfirmasis_id = 5;
            $d->save();

        foreach(Barang::where('id', $d->barangs_id)->get() as $b) //perulngan dimana id barang = barangs_id yg ada di detail peminjaman
        {
            $b->jumlah += (int)$d->jumlah_pinjam;
            $b->save();

        }
        }
        return redirect()->back()->with('success', 'pengajuan berhasil dibatalkan');
    }

    // UBAH STATUS KONFIRMASI STAFF 

public function status_barangdiambil($kode_peminjaman)
    {
        $datadetail = DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get();
        foreach($datadetail as $d){
            $d->status_peminjamans_id = 2;
            // $d->status =1;
            $d->save();


        }
        return redirect()->back()->with('success', 'Barang telah dipinjam');
    }

    public function status_kembali($kode_peminjaman)
    {
        // $datadetail = DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get();
        foreach(DetailPeminjaman::where('kode_peminjaman', $kode_peminjaman)->get() as $d){
            $d->status_peminjamans_id = 3;
            $d->save();

        foreach(Barang::where('id', $d->barangs_id)->get() as $b) //perulngan dimana id barang = barangs_id yg ada di detail peminjaman
        {
            $b->jumlah += (int)$d->jumlah_pinjam;
            $b->save();

        }
        }
        return redirect()->back()->with('success', 'Peminjaman Selesai & Barang telah dikembalikan ');
    }

   


     public function hapuspeminjaman($id)
    {
        $peminjaman= Peminjaman::find($id);
        // dd($peminjaman);
        foreach(DetailPeminjaman::where('kode_peminjaman', $peminjaman->kode_peminjaman)->get() as $dt){
            $dt->delete($dt);
            
        }
        $peminjaman->delete($peminjaman);
        return redirect('/peminjaman/peminjaman')->with('success', 'Data Berhasil Dihapus!');
        
    }

    public function laporanpeminjaman()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
        $datajenisaset = DataJenisAset::all();
        $jenisbarang = JenisBarang::all();
        $datasatuan = Satuan::all();
        $inputbarang = Barang::all();
       $peminjaman = Peminjaman::latest()->get();
        $akun = User::all();
        return view('laporan.peminjaman',[
            "title" => "riwayat",
            "jenisbarang" => $jenisbarang,
            "jenisaset" => $datajenisaset,
            "dataasalperolehan" => $dataasalperolehan,
            "datasatuan" =>$datasatuan,
            "inputbarang"=> $inputbarang,
            "peminjaman"=> $peminjaman,
            "akun" => $akun
        ]);
       
    }


    public function sortirpeminjaman (Request $request)
        {
        $dataasalperolehan = DataAsalPerolehan::all();
            $datajenisaset = DataJenisAset::all();
            $jenisbarang = JenisBarang::all();
            $datasatuan = Satuan::all();
            $inputbarang = Barang::all();
            // $barangkeluar = Barangkeluar::all();
            $startDate = ($request->tglawal);
        $endDate = ($request->tglakhir);

                $data = Peminjaman::all()
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate]);
            return view('laporan.peminjaman',[
                "title" => "barangmasuk",
                "jenisbarang" => $jenisbarang,
                "jenisaset" => $datajenisaset,
                "dataasalperolehan" => $dataasalperolehan,
                "datasatuan" =>$datasatuan,
                "inputbarang"=> $inputbarang,
                "data"=> $data,
                "startDate" =>   $startDate,
                 "endDate" =>   $endDate,

            ]);

       

    }

    public function cetakLaporanPeminjaman($start, $end){

        $startDate = $start;
        $endDate =$end;
        $data = Peminjaman::all()
                    ->whereBetween('tgl_pengajuan', [$startDate, $endDate]);
        
        $pdf = PDF::loadview('laporan.cetakpeminjaman',['data' => $data])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape');
      
         return $pdf->download('Laporan Data Peminjaman.pdf');
    }
}