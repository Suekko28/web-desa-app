@extends('layouts.app')
@section('master-title', 'Dashboard/')
@section('page-title', 'Data Penduduk')
@section('contents')

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <main>
        <form action="{{ route('penduduk.index') }}" method="GET" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-info fw-bold">Filter</h3>
                    <div class="form-group">
                        <div class="row">

                            <div class="col-sm-3">
                                <label for="pendidikan" class="col-form-label">
                                    Pendidikan</label>
                                <select class="form-control" name="pendidikan" id="pendidikan">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="1">Tidak/Belum Sekolah</option>
                                    <option value="2">SD Sederajat</option>
                                    <option value="3">SLTP Sederajat</option>
                                    <option value="4">SLTA Sederajat</option>
                                    <option value="5">Diploma I</option>
                                    <option value="6">Diploma II</option>
                                    <option value="7">Diploma III</option>
                                    <option value="8">Diploma IV</option>
                                    <option value="9">Stara I</option>
                                    <option value="10">Stara II</option>
                                    <option value="11">Stara III</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="pekerjaan" class="col-form-label">
                                    Pekerjaan</label>
                                <select class="form-control" class="pekerjaan" name="pekerjaan" id="pekerjaan">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="1">Karyawan Swasta</option>
                                    <option value="2">Pengrajin</option>
                                    <option value="3">Wirausaha</option>
                                    <option value="4">Guru</option>
                                    <option value="5">Petani</option>

                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="bpjs" class="col-form-label">
                                    Kepemilikan BPJS</label>
                                <select class="form-control" class="bpjs" name="kepemilikan_bpjs" id="bpjs">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="1">PPU</option>
                                    <option value="2">PBPU</option>
                                    <option value="3">PD Pemda</option>
                                    <option value="4">Bukan Pekerja</option>
                                    <option value="5">PBI JK</option>
                                    <option value="6">Tidak Ada</option>

                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="e_ktp" class="col-form-label">
                                    Kepemilikan E-KTP</label>
                                <select class="form-control" class="e_ktp" name="kepemilikan_e_ktp" id="e_ktp">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="1">Ada</option>
                                    <option value="2">Tidak Ada</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row">

                            <div class="col-sm-3">
                                <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="status_nikah" class="col-form-label">Status
                                    Pernikahan</label>
                                <select class="form-control" name="status_pernikahan" id="status_nikah">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="1">Belum Kawin</option>
                                    <option value="2">Kawin</option>
                                    <option value="3">Cerai Hidup</option>
                                    <option value="4">Cerai Mati</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="agama" class="col-form-label">Agama</label>
                                <select class="form-control" name="agama" id="agama">
                                    <option value="">--Pilih Salah Satu--</option>
                                    <option value="1">Islam</option>
                                    <option value="2">Kristen Protestan</option>
                                    <option value="3">Kristen Katolik</option>
                                    <option value="4">Hindu</option>
                                    <option value="5">Buddha</option>
                                    <option value="6">Khonghucu</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="rt" class="col-form-label">RT</label>
                                <input type="number" class="form-control" id="rt" name="rt"
                                    placeholder="000">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="rw" class="col-form-label">RW</label>
                                <input type="number" class="form-control" id="rw" name="rw"
                                    placeholder="000">
                            </div>
                            <div class="col-sm-3">
                                <label for="usia_mn" class="col-form-label">Usia Minimal</label>
                                <input type="number" class="form-control" id="usia_mn" name="usia_mn"
                                    placeholder="Usia Minimal">
                            </div>
                            <div class="col-sm-3">
                                <label for="usia_mx" class="col-form-label">Usia Maksimal</label>
                                <input type="number" class="form-control" id="usia_mx" name="usia_mx"
                                    placeholder="Usia Maksimal">
                            </div>


                        </div>
                    </div>

                    <div class="d-flex flex-row mt-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <hr>
                </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="table-default" class="table-responsive">
                            {{ $dataTable->table() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js"
        integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>


@endsection


@push('scripts')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    
@endpush
