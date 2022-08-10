@extends('layouts.master')
@section('content')
    {{-- @section('title', 'pengajuan')
@section('pengajuan', 'active')
@section('iconss-nav', 'show') --}}

    <main id="main" class="main">

        <div class="pagetitle">

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-14">

                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body"><br>
                            <center> <img src="admin/logo-lptp.png" class="card-img-bottom" style="width: 90px;"
                                    alt="...">
                                <center>
                                    <h5 class="card-title text-center pb-0 fs-4">Selamat Datang Kepala Unit
                                        {{ auth()->user()->name }}
                                    </h5>
                                    <h5 class="card-title">Sistem Informasi Inventaris Barang Lembaga Pengembangan Pedesaan
                                        (LPTP) Surakarta</h5>

                        </div>

                    </div><!-- End Card with an image on bottom -->

                </div>
            </div>
            {{-- <div class="row"> --}}
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Jumlah Jenis Aset</h5>
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">2020</a></li>
                                <li><a class="dropdown-item" href="#">2021</a></li>
                                <li><a class="dropdown-item" href="#">2022</a></li>
                            </ul>
                        </div>
                        <!-- Column Chart -->
                        <div id="columnChart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#columnChart"), {
                                    series: [{
                                            name: 'Aset Bergerak',
                                            data: [{!! json_encode($bergerak_jan) !!}, {!! json_encode($bergerak_feb) !!},
                                                {!! json_encode($bergerak_mar) !!}, {!! json_encode($bergerak_apr) !!},
                                                {!! json_encode($bergerak_mei) !!}, {!! json_encode($bergerak_jun) !!},
                                                {!! json_encode($bergerak_juli) !!}, {!! json_encode($bergerak_agus) !!},
                                                {!! json_encode($bergerak_sept) !!}, {!! json_encode($bergerak_okto) !!},
                                                {!! json_encode($bergerak_nove) !!}, {!! json_encode($bergerak_dese) !!}
                                            ]
                                        }, {
                                            name: 'Aset Tidak Bergerak',
                                            data: [{!! json_encode($bergerak_jan) !!}, {!! json_encode($tdkbergerak_feb) !!},
                                                {!! json_encode($tdkbergerak_mar) !!}, {!! json_encode($tdkbergerak_apr) !!},
                                                {!! json_encode($tdkbergerak_mei) !!}, {!! json_encode($tdkbergerak_jun) !!},
                                                {!! json_encode($tdkbergerak_juli) !!}, {!! json_encode($tdkbergerak_agus) !!},
                                                {!! json_encode($tdkbergerak_sept) !!}, {!! json_encode($tdkbergerak_okto) !!},
                                                {!! json_encode($tdkbergerak_nove) !!}, {!! json_encode($tdkbergerak_dese) !!}
                                            ]
                                        }, {
                                            name: 'Aset Peralatan',
                                            data: [{!! json_encode($peralatan_jan) !!}, {!! json_encode($peralatan_feb) !!},
                                                {!! json_encode($peralatan_mar) !!}, {!! json_encode($peralatan_apr) !!},
                                                {!! json_encode($peralatan_mei) !!}, {!! json_encode($peralatan_jun) !!},
                                                {!! json_encode($peralatan_juli) !!}, {!! json_encode($peralatan_agus) !!},
                                                {!! json_encode($peralatan_sept) !!}, {!! json_encode($peralatan_okto) !!},
                                                {!! json_encode($peralatan_nove) !!}, {!! json_encode($peralatan_dese) !!}
                                            ]
                                        },
                                        {
                                            name: 'Aset Perlengkapan',
                                            data: [{!! json_encode($perlengkapan_jan) !!}, {!! json_encode($perlengkapan_feb) !!},
                                                {!! json_encode($perlengkapan_mar) !!}, {!! json_encode($perlengkapan_apr) !!},
                                                {!! json_encode($perlengkapan_mei) !!}, {!! json_encode($perlengkapan_jun) !!},
                                                {!! json_encode($perlengkapan_juli) !!}, {!! json_encode($perlengkapan_agus) !!},
                                                {!! json_encode($perlengkapan_sept) !!}, {!! json_encode($perlengkapan_okto) !!},
                                                {!! json_encode($perlengkapan_nove) !!}, {!! json_encode($perlengkapan_dese) !!}
                                            ]
                                        }
                                    ],
                                    chart: {
                                        type: 'bar',
                                        height: 350
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: false,
                                            columnWidth: '55%',
                                            endingShape: 'rounded'
                                        },
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        show: true,
                                        width: 2,
                                        colors: ['transparent']
                                    },
                                    xaxis: {
                                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                                            'Nov', 'Des'
                                        ],
                                    },
                                    yaxis: {
                                        title: {
                                            text: ' buah'
                                        }
                                    },
                                    fill: {
                                        opacity: 1
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(val) {
                                                return " " + val + " buah"
                                            }
                                        }
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Column Chart -->

                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peminjaman Barang</h5>
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">2020</a></li>
                                <li><a class="dropdown-item" href="#">2021</a></li>
                                <li><a class="dropdown-item" href="#">2022</a></li>
                            </ul>
                        </div>

                        <!-- Column Chart -->
                        <div id="columnChart2"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#columnChart2"), {
                                    series: [{
                                            name: 'Pengajuan',
                                            data: [{!! json_encode($total_jan) !!}, {!! json_encode($total_feb) !!},
                                                {!! json_encode($total_mar) !!}, {!! json_encode($total_apr) !!},
                                                {!! json_encode($total_mei) !!}, {!! json_encode($total_jun) !!},
                                                {!! json_encode($total_juli) !!}, {!! json_encode($total_agus) !!},
                                                {!! json_encode($total_sept) !!}, {!! json_encode($total_okto) !!},
                                                {!! json_encode($total_nove) !!}, {!! json_encode($total_dese) !!}
                                            ]
                                        }, {
                                            name: 'Disetujui',
                                            data: [{!! json_encode($disetujui_jan) !!}, {!! json_encode($disetujui_feb) !!},
                                                {!! json_encode($disetujui_mar) !!}, {!! json_encode($disetujui_apr) !!},
                                                {!! json_encode($disetujui_mei) !!}, {!! json_encode($disetujui_jun) !!},
                                                {!! json_encode($disetujui_juli) !!}, {!! json_encode($disetujui_agus) !!},
                                                {!! json_encode($disetujui_sept) !!}, {!! json_encode($disetujui_okto) !!},
                                                {!! json_encode($disetujui_nove) !!}, {!! json_encode($disetujui_dese) !!}
                                            ]
                                        }, {
                                            name: 'Ditolak',
                                            data: [{!! json_encode($ditolak_jan) !!}, {!! json_encode($ditolak_feb) !!},
                                                {!! json_encode($ditolak_mar) !!}, {!! json_encode($ditolak_apr) !!},
                                                {!! json_encode($ditolak_mei) !!}, {!! json_encode($ditolak_jun) !!},
                                                {!! json_encode($ditolak_juli) !!}, {!! json_encode($ditolak_agus) !!},
                                                {!! json_encode($ditolak_sept) !!}, {!! json_encode($ditolak_okto) !!},
                                                {!! json_encode($ditolak_nove) !!}, {!! json_encode($ditolak_dese) !!}
                                            ]
                                        },
                                        {
                                            name: 'Barang diambil',
                                            data: [{!! json_encode($ambilbarang_jan) !!}, {!! json_encode($ambilbarang_feb) !!},
                                                {!! json_encode($ambilbarang_mar) !!}, {!! json_encode($ambilbarang_apr) !!},
                                                {!! json_encode($ambilbarang_mei) !!}, {!! json_encode($ambilbarang_jun) !!},
                                                {!! json_encode($ambilbarang_juli) !!}, {!! json_encode($ambilbarang_agus) !!},
                                                {!! json_encode($ambilbarang_sept) !!}, {!! json_encode($ambilbarang_okto) !!},
                                                {!! json_encode($ambilbarang_nove) !!}, {!! json_encode($ambilbarang_dese) !!}
                                            ]
                                        },
                                        {
                                            name: 'Dikembalikan',
                                            data: [{!! json_encode($dikembalikan_jan) !!}, {!! json_encode($dikembalikan_feb) !!},
                                                {!! json_encode($dikembalikan_mar) !!}, {!! json_encode($dikembalikan_apr) !!},
                                                {!! json_encode($dikembalikan_mei) !!}, {!! json_encode($dikembalikan_jun) !!},
                                                {!! json_encode($dikembalikan_juli) !!}, {!! json_encode($dikembalikan_agus) !!},
                                                {!! json_encode($dikembalikan_sept) !!}, {!! json_encode($dikembalikan_okto) !!},
                                                {!! json_encode($dikembalikan_nove) !!}, {!! json_encode($dikembalikan_dese) !!}
                                            ]
                                        },
                                        {
                                            name: 'Terlambat kembali',
                                            data: [{!! json_encode($terlambat_jan) !!}, {!! json_encode($terlambat_feb) !!},
                                                {!! json_encode($terlambat_mar) !!}, {!! json_encode($terlambat_apr) !!},
                                                {!! json_encode($terlambat_mei) !!}, {!! json_encode($terlambat_jun) !!},
                                                {!! json_encode($terlambat_juli) !!}, {!! json_encode($terlambat_agus) !!},
                                                {!! json_encode($terlambat_sept) !!}, {!! json_encode($terlambat_okto) !!},
                                                {!! json_encode($terlambat_nove) !!}, {!! json_encode($terlambat_dese) !!}
                                            ]
                                        }
                                    ],
                                    chart: {
                                        type: 'bar',
                                        height: 350
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: false,
                                            columnWidth: '55%',
                                            endingShape: 'rounded'
                                        },
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        show: true,
                                        width: 1,
                                        colors: ['transparent']
                                    },
                                    xaxis: {
                                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                                            'Nov', 'Des'
                                        ],
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'peminjaman'
                                        }
                                    },
                                    fill: {
                                        opacity: 1
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(val) {
                                                return "  " + val + " peminjaman"
                                            }
                                        }
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Column Chart -->

                    </div>
                </div>
            </div>
            </div>




            </div>
            </div>
        </section>
    @endsection
