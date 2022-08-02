@extends('layouts.master')
@section('content')
    {{-- @section('title', 'barangkeluar')
@section('barangkeluar', 'active')
@section('charts-nav', 'show') --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />

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
            <div class="row">
                <div class="col-lg-12">

                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Data Aset Peralatan</h5>

                            <form action="/filterasetperalatan" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Dari </label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tglawal" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Ke</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tglakhir" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button style=" float :right; background-color:   #012970; color:#FFFFFF"
                                            type="submit" class="btn btn-sm">Search</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div><!-- End Default Card -->

                    @isset($data)
                        <div class=" ">
                            <div class="card-body">
                                <h5 class="card-title">Laporan Data Aset Peralatan</h5>
                                <a href="/laporanasetperalatan/{{ $startDate }}/{{ $endDate }}"
                                    class="btn btn-secondary btn-sm float-right mr-4"><i class="bi bi-print"></i> C Cetak
                                    PDF </a> <br>
                                <br>


                                <!-- Table with stripped rows -->
                                <table id="example" class="table-border display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama
                                                Tipe/ Spesifik</th>
                                            <th scope="col">Kegunaan</th>
                                            <th scope="col">Tgl Perolehan</th>
                                            <th scope="col">Asal Perolehan</th>
                                            <th scope="col"> Nilai Perolehan</th>
                                            <th scope="col">Beban Penyusutan</th>
                                            <th scope="col"> Nilai Buku</th>
                                            <th scope="col">Lokasi</th>
                                            <th scope="col">penanggung jawab</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">kondisi</th>
                                            <th scope="col">ket</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        ?>
                                        @foreach ($data as $data)
                                            @if ($data->jenis_asets_id == 3)
                                                <tr>
                                                    <th> {{ $nomor++ }}</th>
                                                    <td> {{ $data->kode }}</td>
                                                    <td> {{ $data->jenis_barangs->jenis_barang }} {{ $data->spesifikasi }}</td>
                                                    <td> {{ $data->kegunaan }} </td>
                                                    <td> {{ $data->tanggal_perolehan }}
                                                    <td> {{ $data->asal_perolehans->nama_asalperolehan }} </td>
                                                    <td> {{ $data->nilai_perolehan }}</td>
                                                    <td> {{ $data->beban_penyusutan }}
                                                    <td> {{ $data->nilai_buku }}</td>
                                                    <td> {{ $data->lokasi }}</td>
                                                    <td> {{ $data->penanggung_jawab }}</td>
                                                    <td> {{ $data->jumlah }} {{ $data->satuans->nama_satuan }}</td>
                                                    <td> {{ $data->kondisi }}</td>
                                                    <td> {{ $data->ket }}</td>
                                            @endif
                                        @endforeach

                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>
                    @endisset
                </div>
            </div>


            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                             'copy', 'excel', 'print'
                        ]
                    });
                });
            </script>
        </section>
    @endsection
