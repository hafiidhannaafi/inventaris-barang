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
                            <h5 style="align-content: center" class="card-title">Proses Peminjaman
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
                                            <th scope="col">Tgl Pengajuan</th>
                                            <th scope="col">Tgl Peminjaman</th>
                                            <th scope="col">Tgl Pengembalian</th>
                                            {{-- <th scope="col">Tujuan</th>
                                            <th scope="col">barang pinjam</th>
                                            <th scope="col">jumlah pinjam </th> --}}
                                            {{-- <th scope="col">detail</th>
                                            <th scope="col">status</th> --}}



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
                                                    {{-- <td> {{ $data->jenis_peminjaman }}</td> --}}
                                                    <td> <?php echo date('d F Y', strtotime($data->tgl_pengajuan)); ?> </td>
                                                    <td> <?php echo date('d F Y', strtotime($data->tgl_pinjam)); ?> </td>
                                                    <td> <?php echo date('d F Y', strtotime($data->tgl_kembali)); ?></td>
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
