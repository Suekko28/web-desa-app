@extends('layouts.app')
@section('master-title', 'Tim Pemeriksa/')
@section('page-title', 'Create')
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <main>
        <section class="content">
            <div class="container-fluid">
                @include('layouts.message')

                <!-- Small boxes (Stat box) -->
                <form action="{{ route('lpj-timpemeriksa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center data_diri mb-3">Tim Pemeriksa</h5>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="nip" class="col-form-label">NIP</label>
                                        <input type="text" class="form-control" id="NIP" name="NIP"
                                            placeholder="Nomor Identitas Pemeriksa" value="{{ old('NIP') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nama" class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama_ketua"
                                            placeholder="Nama Lengkap" value="{{ old('nama_ketua') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="jabatan" class="col-form-label">Jabatan</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="jabatan" name="jabatan_ketua"
                                                placeholder="Jabatan" value="{{ old('jabatan_ketua') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_pemeriksa" class="col-form-label">Tanggal Pemeriksa</label>
                                        <input type="date" class="form-control" id="tgl_pemeriksa" name="tgl_pemeriksa"
                                            placeholder="" value="{{ old('tgl_pemeriksa') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nomor" class="col-form-label">Nomor</label>
                                        <input type="number" class="form-control" id="nomor" name="nomor"
                                            placeholder="Nomor" value="{{ old('nomor') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tahun" class="col-form-label">Tahun</label>
                                        <input type="number" class="form-control" id="tahun" name="tahun"
                                            placeholder="Tahun" value="{{ old('tahun') }}">
                                    </div>

                                    <div class="col-sm-12">
                                        <label for=" alamat" class="col-form-label">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5"
                                            placeholder="Alamat Lengkap (Jl / Kampung  No.Rumah)">{{ old('alamat') }}</textarea>
                                    </div>
                                </div>

                                <button class="btn btn-primary mt-3" type="button" id="addDataBtn">Tambah
                                    Anggota</button>
                            </div>

                            <div class="form-group" id="anggotaContainer"></div>

                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="{{ route('lpj-timpemeriksa.index') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </main>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <!-- Chart -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#addDataBtn').click(function() {
                $('#anggotaContainer').append(`
                <div class="form-group anggota-row">
    <div class="row">
        <div class="col-sm-5">
            <label for="nama" class="col-form-label">Nama</label>
            <input type="text" class="form-control" name="nama[]" placeholder="Nama Anggota">
        </div>
        <div class="col-sm-5">
            <label for="jabatan" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" name="jabatan[]" placeholder="Jabatan">
        </div>
        <div class="col-sm-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger remove-anggota-btn">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </div>
</div>

                `);
            });

            $(document).on('click', '.remove-anggota-btn', function() {
                $(this).closest('.anggota-row').remove();
            });
        });
    </script>
@endsection
