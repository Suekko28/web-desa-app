@extends('layouts.app')
@section('master-title', 'Data Meninggal/')
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

                <form action="{{ route('sirkulasi-meninggal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center data_diri mb-3">Data Meninggal</h5>
                            <div class="form-group">
                                <div class="row">
                                    <!-- Tampilin Semua Field Di Table Jos !-->
                                    <div class="col-sm-4">
                                        <label for="penduduk" class="col-form-label">Penduduk</label>
                                        <div class="dropdown">
                                            <button class="form-control dropdown-toggle text-left" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="penduduk">
                                                --Pilih Penduduk--
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="pendudukDropdown">
                                                <input type="text" id="pendudukSearchInput" name="NIK_penduduk" class="form-control" placeholder="Cari Penduduk...">
                                                @foreach ( $data as $i )
                                                    <li><a class="dropdown-item penduduk-option" href="#" value="{{ $i->NIK }}">{{ $i->NIK . " - " . $i->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_meninggal" class="col-form-label">Tanggal Meninggal</label>
                                        <input type="date" class="form-control" id="tgl_meninggal" name="tgl_meninggal"
                                            placeholder="">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="sebab" class="col-form-label">Sebab</label>
                                        <input type="text" class="form-control" id="sebab" name="sebab"
                                            placeholder="Sebab Meninggal">
                                    </div>


                                </div>
                            </div>
    
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="{{ route('sirkulasi-meninggal.index') }}" class="btn btn-danger">Batal</a>
                            </div>
    
    
                            <!-- /.card-body -->
                            </form>
                            <!-- /.row (main row) -->
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
    function searchPenduduk() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("pendudukSearchInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("pendudukDropdown");
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

    // Adding event listener for input search
    var searchInput = document.getElementById("pendudukSearchInput");
    searchInput.addEventListener("input", searchPenduduk);

    // Adding event listener for each option in the dropdown
    var pendudukOptions = document.querySelectorAll("#pendudukDropdown .penduduk-option");
    pendudukOptions.forEach(function(option) {
        option.addEventListener("click", function() {
            selectPenduduk(option.getAttribute("value"), option.textContent);
        });
    });

    // Handling selection in the dropdown
    function selectPenduduk(value, label) {
        var dropdownButton = document.querySelector(".dropdown button[name='penduduk']");
        dropdownButton.innerHTML = label;
        var inputVal = document.querySelector("[name='NIK_penduduk']");
        inputVal.value = value;
    }
</script>

@endsection
