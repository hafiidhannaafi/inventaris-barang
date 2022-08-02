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
                                            <th scope="col">Detail</th>
                                            <th scope="col">Status </th>
                                            <th scope="col">Aksi</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        ?>
                                        @foreach ($peminjaman as $data)
                                            @php
                                                $status = App\Models\DetailPeminjaman::where('kode_peminjaman', $data->kode_peminjaman)->first();
                                            @endphp
                                            @if ($status->status_konfirmasis_id == 1 ||
                                                ($status->status_konfirmasis_id == 2 && $status->status_peminjamans_id == 1) ||
                                                ($status->status_konfirmasis_id == 2 && $status->status_peminjamans_id == 2))

                                                {{-- @if ($data->status_konfirmasis_id == 1 || ($data->status_konfirmasis_id == 2 && $data->status_peminjamans_id == 1) || $data->status_peminjamans_id == 2) --}}
                                                <th>{{ $nomor++ }}</th>
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

                                                <td>
                                                    <a href="/detailbarang/{{ $data->kode_peminjaman }}"
                                                        style=" float :right; background-color:   #012970; color:#FFFFFF"
                                                        button type="button" class="btn btn-sm"><i
                                                            class="bi bi-eye"></i></a>
                                                </td>


                                                @php
                                                    $status = App\Models\DetailPeminjaman::where('kode_peminjaman', $data->kode_peminjaman)->first();
                                                @endphp
                                                <td>
                                                    @if ($status->status_konfirmasis_id == 1)
                                                        <span class="badge bg-secondary">
                                                            {{ $status->status_konfirmasis->status_konfirmasi }}</span>
                                                    @elseif($status->status_konfirmasis_id == 2)
                                                        <span class="badge bg-success">
                                                            {{ $status->status_konfirmasis->status_konfirmasi }}</span>
                                                    @elseif($status->status_konfirmasis_id == 3)
                                                        <span class="badge bg-danger">
                                                            {{ $status->status_konfirmasis->status_konfirmasi }}</span>
                                                    @elseif($status->status_konfirmasis_id == 4)
                                                        <span class="badge bg-secondary">
                                                            {{ $status->status_konfirmasis->status_konfirmasi }}</span>
                                                    @elseif($status->status_konfirmasis_id == 5)
                                                        <span
                                                            class="badge bg-danger">{{ $status->status_konfirmasis->status_konfirmasi }}</span>
                                                    @endif

                                                    @if ($status->status_konfirmasis_id == 2)
                                                        @if ($status->status_peminjamans_id == 1)
                                                <td><span class="badge bg-secondary">
                                                        {{ $status->status_peminjamans->status_peminjamans }}</span>
                                                </td>
                                            @elseif($status->status_peminjamans_id == 2)
                                                <td><span class="badge bg"
                                                        style="background-color: #FFA500; color:#FFFFFF">
                                                        {{ $status->status_peminjamans->status_peminjamans }}</span>
                                                </td>
                                            @elseif($status->status_peminjamans_id == 3)
                                                <td>

                                                    <?php
                                                    $d = Carbon\Carbon::parse($data->tgl_kembali);
                                                    $e = Carbon\Carbon::parse($data->tgl_konfirmasikembali);
                                                    if ($d >= $e) {
                                                        $waktu = $d->diffInDays($e) + 1;
                                                    } else {
                                                        $waktu = -$d->diffInDays($e);
                                                    } ?>


                                                    @if ($waktu < 0)
                                                        <span
                                                            class="badge bg-danger">{{ $status->status_peminjamans->status_peminjamans }}</span>
                                                    @elseif($waktu >= 0)
                                                        <span
                                                            class="badge bg-info">{{ $status->status_peminjamans->status_peminjamans }}</span>
                                                    @endif


                                                    {{-- <span
                                                            class="badge bg-info">{{ $status->status_peminjamans->status_peminjamans }}</span> --}}


                                                </td>
                                            @endif
                                        @endif
                                        </td>
                                        </td>

                                        <td>
                                            @if ($status->status_konfirmasis_id == 1)
                                                <a href="/status_batal/{{ $data->kode_peminjaman }}" type="button"
                                                    class="btn btn-danger btn-sm">
                                                    Batalkan</a>
                                            @elseif ($status->status_konfirmasis_id == 2 || $status->status_konfirmasis_id == 5)
                                            @endif

                                        </td>

                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>

                                </table>

                                <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
