@extends('layouts.app')
@section('master-title', 'Data Perbelanjaan/')
@section('page-title', 'Edit')
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

                <form action="{{ route('lpj-belanja.update', ['id' => $id, 'id_barang_jasa' => $id_barang_jasa]) }}"
                    method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center data_diri mb-3">Data Belanja</h5>
                            <div class="form-group">
                                <div class="row">
                                    <!-- Tampilin Semua Field Di Table Jos !-->

                                    <div class="col-sm-4">
                                        <label for="nama_barang" class="col-form-label">Nama Barang / Jasa</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                            placeholder="Buku/Pena/dll" value="{{ $data->nama_barang }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="dana_desa" class="col-form-label">Dana Desa</label>
                                        <input type="number" class="form-control" id="dana_desa" name="dana_desa"
                                            placeholder="Dana Desa" value="">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="volume_qty" class="col-form-label">Volume / QTY</label>
                                        <input type="number" class="form-control" id="volume_qty" name="volume_qty"
                                            placeholder="50" value="{{ $data->volume_qty }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="satuan" class="col-form-label">Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan"
                                            placeholder="Masukkan Nama Satuan" value="{{ $data->satuan }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="harga" class="col-form-label">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            placeholder="Masukkan Harga" value="{{ $data->harga }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tim_pemeriksa" class="col-form-label">Tim Pemeriksa</label>
                                        <div class="dropdown">
                                            <button class="form-control dropdown-toggle text-left" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false" name="tim_pemeriksa">
                                                --Pilih Tim Pemeriksa--
                                            </button>
                                            <!-- Data diambil dari TIM PEMERIKSA !-->
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                id="timPemeriksaDropdown">
                                                <input type="text" id="timPemeriksaSearchInput" class="form-control"
                                                    placeholder="Cari Tim Pemeriksa..." oninput="searchTimPemeriksa()">
                                                {{-- @foreach ($data as $i)
                                                    <li><a class="dropdown-item penduduk-option" href="#" value="{{ $i->NIK }}">{{ $i->NIK . " - " . $i->nama }}</a></li>
                                                @endforeach --}}
                                                <!-- Tambahkan opsi ketua, sekretaris, dan anggota -->
                                                <li><a class="dropdown-item penduduk-option" href="#"
                                                        value="ketua">Ketua</a></li>
                                                <li><a class="dropdown-item penduduk-option" href="#"
                                                        value="sekretaris">Sekretaris</a></li>
                                                <li><a class="dropdown-item penduduk-option" href="#"
                                                        value="anggota">Anggota</a></li>
                                            </ul>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="{{ route('lpj-belanja.show', ['lpj_belanja' => $id]) }}"
                                    class="btn btn-danger">Batal</a>
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
        function searchTimPemeriksa() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("timPemeriksaSearchInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("timPemeriksaDropdown");
            li = ul.getElementsByClassName("penduduk-option");

            for (i = 0; i < li.length; i++) {
                a = li[i];
                txtValue = a.textContent || a.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }

        // Adding event listener for each option in the dropdown
        var timPemeriksaOptions = document.querySelectorAll("#timPemeriksaDropdown .penduduk-option");
        timPemeriksaOptions.forEach(function(option) {
            option.addEventListener("click", function() {
                selectTimPemeriksa(option.getAttribute("value"), option.textContent);
            });
        });

        // Handling selection in the dropdown
        function selectTimPemeriksa(value, label) {
            var dropdownButton = document.querySelector(".dropdown button[name='tim_pemeriksa']");
            dropdownButton.innerHTML = label;
            var inputVal = document.querySelector("[name='tim_pemeriksa']");
            inputVal.value = value;
        }
    </script>



@endsection
