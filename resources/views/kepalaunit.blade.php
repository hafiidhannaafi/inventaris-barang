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
                                            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                                        }, {
                                            name: 'Aset Tidak Bergerak',
                                            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                                        }, {
                                            name: 'Aset Peralatan',
                                            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                                        },
                                        {
                                            name: 'Aset Perlengkapan',
                                            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
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
                                            text: '$ (thousands)'
                                        }
                                    },
                                    fill: {
                                        opacity: 1
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(val) {
                                                return "$ " + val + " thousands"
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
                                            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                                        }, {
                                            name: 'Disetujui',
                                            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                                        }, {
                                            name: 'Ditolak',
                                            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                                        },
                                        {
                                            name: 'Barang diambil',
                                            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                                        },
                                        {
                                            name: 'Dikembalikan',
                                            data: [35, 41, 36, 26, 45, 48, 52, 53]
                                        },
                                        {
                                            name: 'Terlambat kembali',
                                            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
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
                                            text: '$ (thousands)'
                                        }
                                    },
                                    fill: {
                                        opacity: 1
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(val) {
                                                return "$ " + val + " thousands"
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
