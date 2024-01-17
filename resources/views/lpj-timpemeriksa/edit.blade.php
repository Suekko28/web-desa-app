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

                <form action="{{ route('lpj-timpemeriksa.update', $data_ketua->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center data_diri mb-3">Tim Pemeriksa</h5>
                            <div class="form-group">
                                <div class="row">
                                    <!-- Tampilin Semua Field Di Table Jos !-->
                                    <div class="col-sm-4">
                                        <label for="nip" class="col-form-label">NIP</label>
                                        <input type="text" class="form-control" id="NIP" name="NIP"
                                            placeholder="Nomor Identitas Pemeriksa" value="{{ $data_ketua->NIP }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nama" class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama_ketua" name="nama_ketua"
                                            placeholder="Nama Lengkap" value="{{ $data_ketua->nama }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="jabatan" class="col-form-label">Jabatan</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="jabatan_ketua" name="jabatan_ketua"
                                                placeholder="Jabatan" value="{{ $data_ketua->jabatan }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_pemeriksa" class="col-form-label">Tanggal Pemeriksa</label>
                                        <input type="date" class="form-control" id="tgl_pemeriksa" name="tgl_pemeriksa"
                                            placeholder="" value="{{ $data_ketua->tgl_pemeriksa }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nomor" class="col-form-label">Nomor</label>
                                        <input type="number" class="form-control" id="nomor" name="nomor"
                                            placeholder="Nomor" value="{{ $data_ketua->nomor }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tahun" class="col-form-label">Tahun</label>
                                        <input type="number" class="form-control" id="tahun" name="tahun"
                                            placeholder="Tahun" value="{{ $data_ketua->tahun }}">
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5"
                                            placeholder="Masukkan Alamat">{{ $data_ketua->alamat }}</textarea>
                                    </div>

                                    @foreach ($data_anggota as $anggota)
                                        <div class="col-sm-6">
                                            <label for="nama_{{ $anggota->id }}" class="col-form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama_{{ $anggota->id }}"
                                                name="nama[]" value="{{ $anggota->nama }}" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="jabatan_{{ $anggota->id }}"
                                                class="col-form-label">Jabatan</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    id="jabatan_{{ $anggota->id }}" name="jabatan[]"
                                                    value="{{ $anggota->jabatan }}" placeholder="Jabatan">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger rounded ml-2 remove-data-btn"
                                                        type="button" data-counter="{{ $anggota->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button class="btn btn-primary mt-3" type="button" id="addDataBtn">Tambah Data</button>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="" class="btn btn-danger">Batal</a>
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


    <script>
        $(document).ready(function() {
            // Counter to keep track of the number of added data fields
            let counter = 1;

            // Function to dynamically add new input fields for Nama and Jabatan
            function addDataField() {
                let html = `
                <div class="row added-data-row">
                    <div class="col-sm-6">
                        <label for="nama_${counter}" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_${counter}" name="nama[]" placeholder="Nama Lengkap">
                    </div>

                    <div class="col-sm-6">
                      <label for="jabatan_${counter}" class="col-form-label">Jabatan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="jabatan${counter}" name="jabatan[]" placeholder="Jabatan">
                        <div class="input-group-append">
                         <button class="btn btn-danger rounded ml-2 remove-data-btn" type="button" data-counter="${counter}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
        </div>
    </div>
</div>

            `;

                // Append the new data fields to the form
                $('.form-group').append(html);

                // Increment the counter for the next set of data fields
                counter++;
            }

            // Event listener for the "Tambah Data" button
            $('#addDataBtn').on('click', function() {
                addDataField();
            });

            // Event listener for dynamically added remove buttons
            $('.form-group').on('click', '.remove-data-btn', function() {
                // Get the counter value from the data attribute
                let counterToRemove = $(this).data('counter');

                // Remove the corresponding set of data fields
                $(`.added-data-row:has([data-counter=${counterToRemove}])`).remove();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Event listener untuk tombol remove-data-btn
            $('.remove-data-btn').on('click', function() {
                // Dapatkan counter dari data-counter atribut tombol yang ditekan
                var counter = $(this).data('counter');

                // Tampilkan konfirmasi alert
                var confirmation = confirm("Apakah Anda yakin ingin menghapus data?");

                // Hapus elemen jika konfirmasi positif
                if (confirmation) {
                    $('#nama_' + counter).closest('.col-sm-6').remove();
                    $('#jabatan_' + counter).closest('.col-sm-6').remove();
                }
            });
        });
    </script>
@endsection
