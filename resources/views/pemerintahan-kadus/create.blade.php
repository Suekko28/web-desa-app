@extends('layouts.app')
@section('master-title', 'Kadus/')
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

    <main>
        <section class="content">
            <div class="container-fluid">
                @include('layouts.message')

                <!-- Small boxes (Stat box) -->

                <form action="{{ route('pemerintahan-kadus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center data_diri">Data Diri</h5>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="profile" class="col-form-label">Profile</label>
                                        <input type="file" class="form-control" id="profile" name="profile"
                                            placeholder="" accept=".png, .jpeg, .jpg">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="name" class="col-form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Sesuai KTP" value="{{ old('nama') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="jabatan" class="col-form-label">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                                            placeholder="Jabatan" value="{{ old('jabatan') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tmpt_lahir" class="col-form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir"
                                            placeholder="Tempat Lahir" value="{{ old('tmpt_lahir') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_lahir" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                            placeholder="" value="{{ old('tgl_lahir') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                            <option value="" {{ old('jenis_kelamin') === '' ? 'selected' : '' }}>
                                                --Pilih Salah Satu--</option>
                                            <option value="1" {{ old('jenis_kelamin') == '1' ? 'selected' : '' }}>
                                                Laki-Laki</option>
                                            <option value="2" {{ old('jenis_kelamin') == '2' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="no_telepon" class="col-form-label">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="no_telepon" name="no_telepon"
                                            placeholder="Nomor Telepon" value="{{ old('no_telepon') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="no_sk" class="col-form-label">Nomor SK</label>
                                        <input type="text" class="form-control" id="no_sk" name="no_sk"
                                            placeholder="Nomor SK" value="{{ old('no_sk') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_sk" class="col-form-label">Tanggal SK</label>
                                        <input type="date" class="form-control" id="tgl_sk" name="tgl_sk"
                                            placeholder="" value="{{ old('tgl_sk') }}">
                                    </div>



                                    <div class="col">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea rows="5" type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Alamat Lengkap (Jl / Kampung  No.Rumah)">{{ old('alamat') }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="{{ route('pemerintahan-kadus.index') }}" class="btn btn-danger">Batal</a>
                            </div>


                            <!-- /.card-body -->
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

@endsection
