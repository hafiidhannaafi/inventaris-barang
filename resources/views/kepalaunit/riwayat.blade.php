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
                            <h5 style="align-content: center" class="card-title">Riwayat Peminjaman
                                {{ auth()->user()->name }}
                            </h5>
                            <center>


                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col sm">No</th>
                                            <th scope="col">Kode </th>
                                            <th scope="col">Nama </th>
                                            <th scope="col">Jenis peminjaman </th>
                                            <th scope="col">Tujuan </th>
                                            <th scope="col">Tgl Pengajuan</th>
                                            <th scope="col">Tgl Peminjaman</th>
                                            <th scope="col">Tgl Pengembalian</th>
                                            {{-- <th scope="col">Tujuan</th>
                                            <th scope="col">barang pinjam</th>
                                            <th scope="col">jumlah pinjam </th> --}}
                                            <th scope="col">Detail</th>
                                            {{-- <th scope="col">status</th> --}}



                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        ?>
                                        @foreach ($trxstatus as $data)
                                            @if ($data->status_id == 4)
                                                <tr role="row">
                                                    <td>{{ $nomor++ }}</td>
                                                    <td> {{ $data->pinjams->kode_peminjaman }}</td>
                                                    <td> {{ $data->pinjams->nama_peminjam }}</td>
                                                    <td> {{ $data->pinjams->jenis_peminjaman }}</td>
                                                    <td> {{ $data->pinjams->tujuan }}</td>
                                                    <td> <?php echo date('d F Y', strtotime($data->pinjams->tgl_pengajuan)); ?> </td>
                                                    <td> <?php echo date('d F Y', strtotime($data->pinjams->tgl_pinjam)); ?> </td>
                                                    <td> <?php echo date('d F Y', strtotime($data->pinjams->tgl_kembali)); ?></td>
                                                    <td>

                                                        <!-- Detail Peminjaman -->
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
                                                                                        <h5
                                                                                            class="card-title text-center">
                                                                                            Detail Data Peminjaman</h5>

                                                                                        <p class="card-text">
                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label ">
                                                                                                Kode peminjaman </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :{{ $data->pinjams->kode_peminjaman }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                Peminjam </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :{{ $data->pinjams->nama_peminjam }}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                jenis peminjaman </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :{{ $data->pinjams->jenis_peminjaman }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                Tujuan </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :{{ $data->pinjams->tujuan }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                Tanggal ajuan </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :{{ $data->pinjams->tgl_pengajuan }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                Tanggal pinjam </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :{{ $data->pinjams->tgl_pinjam }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                Tanggal kembali :</div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :{{ $data->pinjams->tgl_kembali }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                Barang Pinjam </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :
                                                                                                {{ $data->pinjams->barangs->kode }}
                                                                                                {{ $data->pinjams->barangs->jenis_barangs->jenis_barang }}
                                                                                                {{ $data->pinjams->barangs->spesifikasi }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-lg-5 col-md-4 label">
                                                                                                Jumlah Pinjam </div>
                                                                                            <div
                                                                                                class="col-lg-7 col-md-8">
                                                                                                :
                                                                                                {{ $data->pinjams->jumlah_pinjam }}
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
                                                    </td>
                                                    {{-- <td>{{ $data->tujuan }} </td>
                                                <td>{{ $data->barangs->kode }}
                                                    {{ $data->barangs->jenis_barangs->jenis_barang }}
                                                    {{ $data->barangs->spesifikasi }}
                                                </td>
                                                <td>{{ $data->jumlah_pinjam }} </td> --}}



                                                </tr>
                                            @endif
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
