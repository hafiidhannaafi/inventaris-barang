@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <!-- Default Card -->
        <div class="card">
            <div class="card-body"><br>
                <center> <img src="admin/logo-lptp.png" class="card-img-bottom" style="width: 90px;" alt="...">
                    <center>
                        <h5 class="card-title text-center pb-0 fs-4">Selamat Datang Admin {{ auth()->user()->name }}
                        </h5>
                        <h5 class="card-title">Sistem Informasi Inventaris Barang Lembaga Pengembangan Pedesaan
                            (LPTP) Surakarta</h5>
                        {{-- <h5 class="card-title"> Lembaga Pengembangan Pedesaan (LPTP) Surakarta</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
            </div>

        </div><!-- End Card with an image on bottom -->


        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">



                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Total Jumlah jenis Barang<span></span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                {{ $jumlah }}
                                            </h6>
                                            <span class="text-success small pt-1 fw-bold">{{ $asetbergerak }}</span> <span
                                                class="text-muted small pt-2 ps-1">Aset bergerak</span><br>
                                            <span class="text-success small pt-1 fw-bold">{{ $asettidakbergerak }}</span>
                                            <span class="text-muted small pt-2 ps-1">Aset tidak bergerak</span><br>
                                            <span class="text-success small pt-1 fw-bold">{{ $asetperalatan }}</span> <span
                                                class="text-muted small pt-2 ps-1">Aset Peralatan</span><br>
                                            <span class="text-success small pt-1 fw-bold">{{ $asetperlengkapan }}</span>
                                            <span class="text-muted small pt-2 ps-1">Aset Perlengakapan</span>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Total Jumlah Barang<span> </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> @php
                                                $varjumlah = 0;
                                                foreach ($inputbarang as $ib) {
                                                    $varjumlah += $ib->jumlah;
                                                }
                                                echo $varjumlah;
                                            @endphp </h6>
                                            <span class="text-success small pt-1 fw-bold"><?php
                                            $varjumlah = 0;
                                            foreach ($inputbarang as $ib) {
                                                if ($ib->jenis_asets_id == 1) {
                                                    $varjumlah += $ib->jumlah;
                                                }
                                            }
                                            echo $varjumlah;
                                            ?></span> <span
                                                class="text-muted small pt-2 ps-1">Aset bergerak</span><br>
                                            <span class="text-success small pt-1 fw-bold"><?php
                                            $varjumlah = 0;
                                            foreach ($inputbarang as $ib) {
                                                if ($ib->jenis_asets_id == 2) {
                                                    $varjumlah += $ib->jumlah;
                                                }
                                            }
                                            echo $varjumlah;
                                            ?></span> <span
                                                class="text-muted small pt-2 ps-1">Aset tidak bergerak</span><br>
                                            <span class="text-success small pt-1 fw-bold"><?php
                                            $varjumlah = 0;
                                            foreach ($inputbarang as $ib) {
                                                if ($ib->jenis_asets_id == 3) {
                                                    $varjumlah += $ib->jumlah;
                                                }
                                            }
                                            echo $varjumlah;
                                            ?></span> <span
                                                class="text-muted small pt-2 ps-1">Aset Peralatan</span><br>
                                            <span class="text-success small pt-1 fw-bold"><?php
                                            $varjumlah = 0;
                                            foreach ($inputbarang as $ib) {
                                                if ($ib->jenis_asets_id == 4) {
                                                    $varjumlah += $ib->jumlah;
                                                }
                                            }
                                            echo $varjumlah;
                                            ?></span> <span
                                                class="text-muted small pt-2 ps-1">Aset Perlengakapan</span>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Total Pengajuan Pinjam</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-file-arrow-up-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ $pinjam }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->



                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">



                                <div class="card-body">
                                    <h5 class="card-title">Grafik Peminjaman <span> </span></h5>

                                    <!-- Bar Chart -->
                                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new Chart(document.querySelector('#barChart'), {
                                                type: 'bar',
                                                data: {
                                                    labels: ["Juli", "Agustus", "September", "Oktober", "November", "Desember", "Januari",
                                                        "Februari", "Maret", "April", "Mei", "Juni",
                                                    ],
                                                    datasets: [{
                                                        label: 'Jumlah Pengajuan Peminjaman',
                                                        data: [{!! json_encode($total_juli) !!}, {!! json_encode($total_agus) !!},
                                                            {!! json_encode($total_sept) !!}, {!! json_encode($total_okto) !!},
                                                            {!! json_encode($total_nove) !!}, {!! json_encode($total_dese) !!},
                                                            {!! json_encode($total_jan) !!}, {!! json_encode($total_feb) !!},
                                                            {!! json_encode($total_mar) !!}, {!! json_encode($total_apr) !!},
                                                            {!! json_encode($total_mei) !!}, {!! json_encode($total_jun) !!}
                                                        ],
                                                        backgroundColor: [
                                                            'rgba(255, 99, 132, 0.2)',
                                                            'rgba(255, 159, 64, 0.2)',
                                                            'rgba(255, 205, 86, 0.2)',
                                                            'rgba(75, 192, 192, 0.2)',
                                                            'rgba(54, 162, 235, 0.2)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(201, 203, 207, 0.2)'
                                                        ],
                                                        borderColor: [
                                                            'rgb(255, 99, 132)',
                                                            'rgb(255, 159, 64)',
                                                            'rgb(255, 205, 86)',
                                                            'rgb(75, 192, 192)',
                                                            'rgb(54, 162, 235)',
                                                            'rgb(153, 102, 255)',
                                                            'rgb(201, 203, 207)'
                                                        ],
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                    <!-- End Bar CHart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->


                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title"> Peraturan Admin<span></span></h5>

                            <div class="activity">

                                <div class="activity-item d-flex">
                                    <div class="activite-label">1. </div>

                                    <div class="activity-content">
                                        Admin dapat menambahkan akun admin baru dan kepala unit
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">2. </div>

                                    <div class="activity-content">
                                        Menginput barang sesuai jenis aset barang tersebut
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">3. </div>

                                    <div class="activity-content">
                                        Menginput pencatatan barang keluar karena hilang atau rusak setelah ada pelaporan
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">4. </div>

                                    <div class="activity-content">
                                        Menverifikasi status apabila peminjam telah datang untuk
                                        pengambilan
                                        barang serta pengembalikan barang
                                    </div>
                                </div><!-- End activity item-->

                                <div class="activity-item d-flex">
                                    <div class="activite-label">5. </div>

                                    <div class="activity-content">
                                        Melakukan cetak laporan sesuai tanggal yang diinput
                                    </div>
                                </div><!-- End activity item-->



                            </div>

                        </div>
                    </div><!-- End Recent Activity -->





                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
