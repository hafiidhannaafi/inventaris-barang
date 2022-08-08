@extends('layouts.master')
@section('content')

@section('title', 'pengajuan')
@section('pengajuan', 'active')
@section('iconss-nav', 'show')

<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Data Jenis Aset</h1> --}}
        {{-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-14">


                <div class="card">
                    <div class="card-body">

                        <center>
                            <h5 style="align-content: center" class="card-title">Data Peminjaman

                            </h5>
                            <center>


                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col sm">No</th>
                                            <th scope="col">Kode </th>
                                            <th scope="col">Nama </th>
                                            <th scope="col">Tgl Pengajuan</th>
                                            <th scope="col">Tgl Peminjaman</th>
                                            <th scope="col">Tgl Pengembalian</th>
                                            {{-- <th scope="col">Tujuan</th>
                                            <th scope="col">barang pinjam</th>
                                            <th scope="col">jumlah pinjam </th> --}}
                                            <th scope="col">Detail</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        ?>
                                        @foreach ($pinjam as $data)
                                            <tr role="row">
                                                <td>{{ $nomor++ }}</td>
                                                <td> {{ $data->kode_peminjaman }}</td>
                                                <td> {{ $data->nama_peminjam }}</td>
                                                <td> <?php echo date('d F Y', strtotime($data->tgl_pengajuan)); ?> </td>
                                                <td> <?php echo date('d F Y', strtotime($data->tgl_pinjam)); ?> </td>
                                                <td>

                                                    <?php
                                                    $d = Carbon\Carbon::parse($data->tgl_kembali);
                                                    $e = Carbon\Carbon::parse(now());
                                                    if ($d >= $e) {
                                                        $waktu = $d->diffInDays($e) + 1;
                                                    } else {
                                                        $waktu = -$d->diffInDays($e);
                                                    } ?>


                                                    {{ date('d F Y', strtotime($data->tgl_kembali)) }}


                                                    @if ($waktu < 0)
                                                        <p style="color:#cd0b30;" class="small fst-italic">Sudah
                                                            Terlewat {{ -$waktu }}
                                                            hari</p>
                                                    @elseif($waktu > 0)
                                                        <p style="color:#012970;" class="small fst-italic"><b>
                                                                {{ $waktu }} Hari Lagi </b>
                                                        </p>
                                                    @else
                                                        <p style="color:#012970;" class="small fst-italic"><b>Hari
                                                                Terakhir</b></p>
                                                    @endif


                                                </td>
                                                {{-- <td>{{ $data->tujuan }} </td>
                                                <td>{{ $data->barangs->kode }}
                                                    {{ $data->barangs->jenis_barangs->jenis_barang }}
                                                    {{ $data->barangs->spesifikasi }}
                                                </td>
                                                <td>{{ $data->jumlah_pinjam }} </td> --}}
                                                <td>

                                                    <!-- Basic Modal -->
                                                    <button type="button" class="btn btn-sm"
                                                        style="background-color:  #012970; color:#FFFFFF"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modaldetail{{ $data->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <div class="modal fade" id="modaldetail{{ $data->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    {{-- <h5 class="modal-title">Basic Modal</h5> --}}
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Card with an image on left -->


                                                                    <div class="card mb-3">
                                                                        <div class="row g-0">
                                                                            <div class="col-md-4">


                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title text-center">
                                                                                        Detail Data Peminjaman</h5>

                                                                                    <p class="card-text">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label ">
                                                                                            Kode peminjaman </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->kode_peminjaman }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Peminjam </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->nama_peminjam }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            jenis peminjaman </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->jenis_peminjaman }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Tujuan </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->tujuan }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Tanggal ajuan </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->tgl_pengajuan }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Tanggal pinjam </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->tgl_pinjam }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Tanggal kembali :</div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->tgl_kembali }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Surat pengantar :</div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :{{ $data->surat_pinjam }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Barang Pinjam </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :
                                                                                            {{ $data->barangs->kode }}
                                                                                            {{ $data->barangs->jenis_barangs->jenis_barang }}
                                                                                            {{ $data->barangs->spesifikasi }}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-lg-5 col-md-4 label">
                                                                                            Jumlah Pinjam </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :
                                                                                            {{ $data->jumlah_pinjam }}
                                                                                        </div>
                                                                                    </div>

                                                                                    </p>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- End Card with an image on left -->
                                                                </div>
                                                                <div class="modal-footer">


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- End Basic Modal-->

                                                </td>


                                                <td>
                                                    <?php $belumada_status = '<div class="badge bg-secondary btn-sm"></i> pengajuan</div>'; ?>
                                                    @foreach ($trxstatus as $a)
                                                        @if ($data->kode_peminjaman == $a->kode_peminjaman)
                                                            @foreach ($status as $b)
                                                                @if ($a->status_id == $b->id && $b->id == 4)
                                                                    <?php $belumada_status = '<div class="badge bg-info btn-sm dropdown-toggle ' . $data->kode_peminjaman . '" data-bs-toggle="modal" data-bs-target="#status' . $data->kode_peminjaman . '"id="#status' . $data->kode_peminjaman . '"> ' . $b->status . ' </div>'; ?>
                                                                @elseif($a->status_id == $b->id && $b->id == 2)
                                                                    <?php $belumada_status = '<div class="badge bg-danger btn-sm dropdown-toggle ' . $data->kode_peminjaman . '" data-bs-toggle="modal" data-bs-target="#status' . $data->kode_peminjaman . '"id="#status' . $data->kode_peminjaman . '"> ' . $b->status . ' </div>'; ?>
                                                                @elseif($a->status_id == $b->id && $b->id == 3)
                                                                    <?php $belumada_status = '<div class="badge bg-warning btn-sm dropdown-toggle ' . $data->kode_peminjaman . '" data-bs-toggle="modal" data-bs-target="#status' . $data->kode_peminjaman . '"id="#status' . $data->kode_peminjaman . '"> ' . $b->status . ' </div>'; ?>
                                                                @elseif($a->status_id == $b->id && $b->id == 1)
                                                                    <?php $belumada_status = '<div class="badge bg-success btn-sm dropdown-toggle ' . $data->kode_peminjaman . '" data-bs-toggle="modal" data-bs-target="#status' . $data->kode_peminjaman . '"id="#status' . $data->kode_peminjaman . '"> ' . $b->status . ' </div>'; ?>
                                                                @elseif($a->status_id == $b->id && $b->id == 5)
                                                                    <?php $belumada_status = '<div class="badge bg-secondary btn-sm dropdown-toggle ' . $data->kode_peminjaman . '" data-bs-toggle="modal" data-bs-target="#status' . $data->kode_peminjaman . '"id="#status' . $data->kode_peminjamans . '"> ' . $b->status . ' </div>'; ?>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <?= $belumada_status ?>


                                                    {{-- Modal Status --}}
                                                    <div class="modal fade" id="status{{ $data->kode_peminjaman }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="staticBackdropLiveLabel">
                                                                        {{-- Status Pengajuan --}}
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <div class="col-md-12">


                                                                            <div class="card">
                                                                                <div class="card-body">

                                                                                    <h5 class="card-title">
                                                                                        Status peminjaman
                                                                                        <span>|
                                                                                            {{ Auth::user()->name }}</span>
                                                                                    </h5>
                                                                                    <div
                                                                                        class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                                                                                        <ul
                                                                                            class="list-inline p-0 m-0">
                                                                                            @foreach ($trxstatus as $a)
                                                                                                @if ($data->kode_peminjaman == $a->kode_peminjaman)
                                                                                                    <li>
                                                                                                        <div
                                                                                                            class="timeline-dots timeline-dot1 border-success text-primary">
                                                                                                        </div>
                                                                                                        @foreach ($status as $item)
                                                                                                            @if ($a->status_id == $item->id)
                                                                                                                <h6 style="color:#012970;"
                                                                                                                    class="d-inline-block w-100">
                                                                                                                    <b>
                                                                                                                        {{ $item->status }}

                                                                                                                    </b>
                                                                                                                </h6>
                                                                                                            @endif
                                                                                                        @endforeach

                                                                                                        <?php
                                                                                                            foreach($akun as $p){
                                                                                                                if($a->users_id == $p->id){?>
                                                                                                        <div
                                                                                                            class="d-inline-block w-100">
                                                                                                            <p>
                                                                                                                Diverifikasi
                                                                                                                oleh
                                                                                                                :
                                                                                                                {{ $p->name }}<br>
                                                                                                                Pada
                                                                                                                Tanggal
                                                                                                                :
                                                                                                                <?php echo date('d F Y', strtotime($a->created_at)); ?>
                                                                                                                <br>
                                                                                                                @if ($a->ket)
                                                                                                                    ket
                                                                                                                    :
                                                                                                                    {{ $a->ket }}
                                                                                                                @else
                                                                                                                    ket
                                                                                                                    :
                                                                                                                    silakan
                                                                                                                    menemui
                                                                                                                    admin
                                                                                                                    untuk
                                                                                                                    mengambil
                                                                                                                    barang
                                                                                                                @endif
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <?php }
  }
                                                                                                                        ?>

                                                                                                    </li>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="activity">
                                                                                        @foreach ($trxstatus as $a)
                                                                                            @if ($data->id == $a->pinjams_id)
                                                                                                <div
                                                                                                    class="activity-item d-flex">
                                                                                                    <i
                                                                                                        class='bi bi-circle-fill activity-badge text-success align-self-start'>
                                                                                                    </i>
                                                                                                    <div @foreach ($status as $item) @if ($a->status_id == $item->id)
                                                                                                                <div
                                                                                                                    class="activity-content">
                                                                                                                    {{ $item->status }}
                                                                                                                </div> @endif
                                                                                                        @endforeach

                                                                                                        <?php
                                                                                                            foreach($akun as $p){
                                                                                                                if($a->users_id == $p->id){?>
                                                                                                        <div
                                                                                                            class="activity-content">
                                                                                                            <p><br>
                                                                                                                Diverifikasi
                                                                                                                oleh :
                                                                                                                {{ $p->name }}<br>

                                                                                                                Tanggal
                                                                                                                :

                                                                                                                {{ $a->created_at }}
                                                                                                            </p>
                                                                                                        </div>
                                                                                                        <?php }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                    </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>

                                                                                </div> --}}
                                                                <!-- End activity item-->

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- End Recent Activity -->

                    </div>
                </div>
            </div>

            </td>

            <td>
                <!--STATUS DISETUJUI-->
                @php
                    $statuss = App\Models\Trxstatus::where('kode_peminjaman', $data->kode_peminjaman)
                        ->orderBy('id', 'desc') //status dimana id nya terakhir dnegan kdoe tersebut
                        ->first();
                @endphp

                @if ($statuss->status_id == 5)
                    <form action="/menyetujui/{{ $data->id }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="kode_peminjaman" value={{ $data->kode_peminjaman }} hidden>
                        <input type="text" name="users_id" value={{ Auth::user()->id }} hidden>

                        <button name="status_id" value="1" class="btn btn-success btn-sm"> <i
                                class="bi bi-check-lg"></i></button>
                    </form>
                    <!--STATUS DI TOLAK -->

                    <!-- Basic Modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#statustolak{{ $data->kode_peminjaman }}">
                        <i class="bi bi-x"></i>
                    </button>

                    <div class="modal fade" id="statustolak{{ $data->kode_peminjaman }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/insertstatus" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="kode_peminjaman"
                                            value={{ $data->kode_peminjaman }}>
                                        <input type="hidden" name="users_id" value={{ Auth::user()->id }}>
                                        <input type="hidden" name="status_id" value="2">
                                        <div class="row mb-3">
                                            <center>
                                                <h5 style="align-content: center" class="card-title">Keterangan
                                                    Penolakan

                                                </h5>
                                                <center>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="validationTooltip03" name="ket"
                                                            class="form-control" placeholder="Isikan keterangan">
                                                        <div class="invalid-feedback">
                                                            Harus di isi
                                                        </div>
                                                    </div><br>


                                                    <button type="submit" value="" class="btn btn btn-sm"
                                                        style=" float :right; background-color:   #012970; color:#FFFFFF">submit</button>

                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div><!-- End Basic Modal-->
                @else
                    <span class="badge border-dark border-1 text-dark small fst-italic" style="color:#012970;"> sudah
                        diverifikasi</span>
                @endif


            </td>

            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        </div>
        </div>
        </div> <!-- End Table with stripped rows -->

        </div>
        </div>



    @endsection
