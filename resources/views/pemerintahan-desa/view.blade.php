@extends('layouts.app')
@section('master-title', 'Pemerintahan Desa/')
@section('page-title', 'View')
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

                <form action="{{ route('pemerintahan-desa.update', $data->id) }}" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">


                            <h5 class="text-center data_diri">Data Diri</h5>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="d-flex flex-column">
                                            <label for="profile" class="col-form-label">Profile</label>
                                            <img class="img-fluid rounded-circle"
                                                src="{{ asset('storage/desa/' . $data->profile) }}" alt="Foto Profile"
                                                width="230" height="230">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="name" class="col-form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $data->nama }}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="jabatan" class="col-form-label">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                                            value="{{ $data->jabatan }}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tmpt_lahir" class="col-form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir"
                                            value="{{ $data->tmpt_lahir }}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_lahir" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                            value="{{ $data->tgl_lahir }}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_lahir" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                            value="{{ $data->tgl_lahir }}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="no_telepon" class="col-form-label">Nomor Telepon</label>
                                        <input type="number" class="form-control" id="no_telepon" name="no_telepon"
                                            placeholder="Nomor Telepon" value="{{ $data->no_telepon }}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="no_sk" class="col-form-label">Nomor SK</label>
                                        <input type="text" class="form-control" id="no_sk" name="no_sk"
                                            placeholder="Nomor SK" value="{{ $data->no_sk }}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_sk" class="col-form-label">Tanggal SK</label>
                                        <input type="date" class="form-control" id="tgl_sk" name="tgl_sk"
                                            placeholder="" value="{{ $data->tgl_sk }}" disabled>
                                    </div>

                                    <div class="col">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea rows="5" type="text" class="form-control" id="alamat" name="alamat" disabled>{{ $data->alamat }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <a href="{{ route('pemerintahan-desa.index') }}" class="btn btn-danger">Kembali</a>
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
