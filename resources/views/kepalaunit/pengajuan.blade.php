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
                                                <td> <?php echo date('d F Y', strtotime($data->tgl_kembali)); ?></td>
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
                                                                                            Barang Pinjam </div>
                                                                                        <div class="col-lg-7 col-md-8">
                                                                                            :
                                                                                            {{-- {{ $data->barangs->kode }}
                                                                                            {{ $data->barangs->jenis_barangs->jenis_barang }}
                                                                                            {{ $data->barangs->spesifikasi }} --}}
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
                                                        @if ($data->id == $a->pinjams_id)
                                                            @foreach ($status as $b)
                                                                @if ($a->status_id == $b->id)
                                                                    <?php $belumada_status = '<div class="badge bg-info btn-sm dropdown-toggle ' . $data->id . '" data-bs-toggle="modal" data-bs-target="#status' . $data->id . '"id="#status' . $data->id . '"> ' . $b->status . ' </div>'; ?>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <?= $belumada_status ?>


                                                    {{-- Modal Status --}}
                                                    <div class="modal fade" id="status{{ $data->id }}"
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
                                                                                        <ul class="list-inline p-0 m-0">
                                                                                            @foreach ($trxstatus as $a)
                                                                                                @if ($data->id == $a->pinjams_id)
                                                                                                    <li>
                                                                                                        <div
                                                                                                            class="timeline-dots timeline-dot1 border-success text-primary">
                                                                                                        </div>
                                                                                                        @foreach ($status as $item)
                                                                                                            @if ($a->status_id == $item->id)
                                                                                                                <h6
                                                                                                                    class="float-left mb-1">
                                                                                                                    {{ $item->status }}
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
                                                                                                                oleh :
                                                                                                                {{ $p->name }}<br>
                                                                                                                Pada
                                                                                                                Tanggal
                                                                                                                :
                                                                                                                <?php echo date('d F Y', strtotime($a->created_at)); ?>
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
                    $status = App\Models\trxstatus::where('id', $data->id)->first();
                @endphp
                <form action="/insertstatus" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pinjams_id" value={{ $data->id }}>
                    <input type="hidden" name="users_id" value={{ Auth::user()->id }}>
                    <button name="status_id" value="1" class="btn btn-success btn-sm"> <i
                            class="bi bi-check-lg"></i></button>
                </form>
                <!--STATUS DI TOLAK -->
                <form action="/insertstatus" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pinjams_id" value={{ $data->id }}>
                    <input type="hidden" name="users_id" value={{ Auth::user()->id }}>
                    <button name="status_id" value="2" class="btn btn-danger btn-sm"><i
                            class="bi bi-check-x"></i></button>
                </form>
                 @else
                    <span class="badge border-dark border-1 text-dark small fst-italic" style="color:#012970;"> sudah diverfi</span>
                @endif

                {{-- <a href="/status_setuju/{{ $data->kode_peminjaman }}" type="button"
                                                        class="btn btn-success btn-sm"><i
                                                            class="bi bi-check-lg"></i></a> --}}
                <!--STATUS DI TOLAK -->
                {{-- <a href="/status_ditolak/{{ $data->kode_peminjaman }}"
                                                        type="button" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-x"></i></a> --}}

                {{-- <span class="badge border-dark border-1 text-dark small fst-italic"
                                                        style="color:#012970;">sudah
                                                        diverifikasi</span> --}}
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
