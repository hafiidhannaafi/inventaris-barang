@extends('layouts.master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        console.log('sdhjfdskfsdfjsdjfksd');
        $("#tgl_pinjam").change(function() {
            console.log('sdfkjndipjgodkgdfgjdfgsdhjfdskfsdfjsdjfksd');
        });
    </script>




    <style>
        input[type="date"] {
            position: relative;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: auto;
            height: auto;
            color: transparent;
            background: transparent;
        }
    </style>

    <main id="main" class="main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center pb-0 fs-5">Formulir Peminjaman Barang</h5></br>

                <!-- validation Form Elements -->

                <form action="{{ route('inputpinjam') }}" method="POST" enctype="multipart/form-data"
                    class=" needs-validation" novalidate>
                    @csrf

                    <div class="row mb-3">
                        {{-- <label for="validationCustom01" class="col-sm-2 col-form-label">Nama login</label> --}}
                        <div class="col-sm-10">


                            <input type="hidden" id="validationCustom01" name="users_id" value=" {{ auth()->user()->id }}"
                                class="form-control" required readonly>


                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="validationCustom01" class="col-sm-2 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-10">
                            <input type="text" id="validationCustom01" name="nama_peminjam"
                                value=" {{ auth()->user()->name }}" readonly class="form-control" required
                                placeholder=" nama peminjam">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>




                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Peminjaman</legend>
                        <div class="col-sm-10">

                            <input class="form-check-input" type="radio" name="jenis_peminjaman" name="gridRadios"
                                id="gridRadios1" value="Pribadi" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Pribadi
                            </label>
                            <input class="form-check-input" type="radio" name="jenis_peminjaman" name="gridRadios"
                                id="gridRadios2" value="Keperluan Projek">
                            <label class="form-check-label" for="gridRadios2">
                                Keperluan Projek
                            </label>
                        </div>
                    </fieldset>


                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Tujuan Pinjam </label>
                        <div class="col-sm-10">
                            <input type="text" id="validationTooltip02" name="tujuan" class="form-control" required
                                placeholder=" ex. untuk keperluan proyek A, untuk mengantar keluarga">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Pengajuan</label>
                        <div class="col-sm-10">
                            <input type="date" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date('Y-m-d'); ?>"
                                readonly class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Peminjaman</label>
                        <div class="col-sm-10">
                            <input type="date" id="datefield" name="tgl_pinjam" class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="date"  id="datefield2" name="tgl_kembali" class="form-control"
                                required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="validationTooltip03" class="col-sm-2 col-form-label">Surat Pengantar</label>
                        <div class="col-sm-10">
                            <input type="file" id="validationTooltip03" name="surat_pinjam" class="form-control"required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" id=" " name="ket" class="form-control" required
                                placeholder=" isi keterangan">

                        </div>
                    </div>
                    <div class="row mb-3">
                        {{-- <label for="validationTooltip04" class="col-sm-2 col-form-label">Status Konfirmasi</label> --}}
                        <div class="col-sm-10">
                            <input type="hidden" id="validationTooltip04" value="4" name="status_konfirmasis_id"
                                class="form-control"required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>



                    <div class="row g-3 mt-3 border-top pt-2">
                        <div class="row targetDiv" id="div0">
                            <div id="group1" class="fvrduplicate">
                                <center> <label for="validationTooltip06" style="float: center; " col-sm-6
                                        col-form-label>Peminjaman
                                        Barang</label>
                                    <center><br>



                                        <div class="row mb-3">

                                            <div class="col-sm-10">

                                                <input type="hidden" id="datefield2" value=" {{ $inputbarang->id }}"
                                                    name="barangs_id" class="form-control" required readonly>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="validationTooltip05" class="col-sm-2 col-form-label"> Barang
                                                Pinjam</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="datefield2"
                                                    value="{{ $inputbarang->kode }} {{ $inputbarang->jenis_barangs->jenis_barang }} {{ $inputbarang->spesifikasi }}"
                                                    name=" " class="form-control" required readonly>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="validationTooltip05" class="col-sm-2 col-form-label">Sisa Jumlah
                                                Barang</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="datefield2"
                                                    value="{{ $inputbarang->jumlah }} {{ $inputbarang->satuans->nama_satuan }}"
                                                    name="jumlah" class="form-control" required readonly>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="validationTooltip03" class="col-sm-2 col-form-label">jumlah
                                                pinjam</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="validationTooltip03" name="jumlah_pinjam"
                                                    class="form-control"required
                                                    placeholder="isikan jumlah item yang akan di pinjam">
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>
                                            </div>
                                        </div>
                                        {{-- @foreach ($pinjam as $data)
                                            <form action="/insertstatus" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pinjams_id" value={{ $data->id }}>
                                                <input type="hidden" name="users_id" value={{ Auth::user()->id }}>
                                                <input type="hidden" name="status_id" value="1">
                                            </form>
                                        @endforeach --}}

                                        <div class="card-footer">
                                            <button style=" float :right; background-color:   #012970; color:#FFFFFF"
                                                type="submit" class="btn btn btn-sm">Submit</button>
                                        </div>

                </form><!-- End General Form Elements -->
            </div>


        </div>
        <script>
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("datefield").setAttribute("min", today);
            document.getElementById("datefield2").setAttribute("min", today);
        </script>
    @endsection
