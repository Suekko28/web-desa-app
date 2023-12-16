@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('contents')
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
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />



    <main>
        <div class="row">

            <div class="col-lg-4">
                <div class="card bg-primary text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Penduduk</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">1</h1>
                            <i class="fas fa-solid fa-users fa-3x" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card bg-success text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Laki-Laki</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">1</h1>
                            <iconify-icon icon="mdi:face-man" width="50" height="50"
                                style="color:white;"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card bg-info text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Perempuan</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">1</h1>
                            <iconify-icon icon="mdi:face-female" width="50" height="50"
                                style="color:white;"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Meninggal</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">1</h1>
                            <i class="fas fa-book-dead fa-3x" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card bg-danger text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Kelahiran</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">1</h1>
                            <i class="fas fa-solid fa-baby fa-3x" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card bg-warning text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Pindah Masuk/Keluar</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">1</h1>
                            <i class="fas fa-user-xmark fa-3x" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card p-3">
                    <div class="d-flex">
                        <i class="fas fa-solid fa-user fa-2x mr-3 p-3 bg-primary rounded" style="color:white;"></i>
                        <div class="d-flex flex-column">
                            <h5 class="">Total Penduduk</h5>
                            <h5>1</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Kepemilikan E-KTP</h4>

                        <div class="row text-center">
                            <div class="col-4">
                                <h5 class="mb-0">2536</h5>
                                <p class="text-muted text-truncate">Activated</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">69421</h5>
                                <p class="text-muted text-truncate">Pending</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">89854</h5>
                                <p class="text-muted text-truncate">Deactivated</p>
                            </div>
                        </div>

                        <canvas id="pie" height="260"></canvas>

                    </div>
                </div>
            </div>
            
            <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Status Pernikahan</h4>

                        <div class="row text-center">
                            <div class="col-4">
                                <h5 class="mb-0">9595</h5>
                                <p class="text-muted text-truncate">Activated</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">36524</h5>
                                <p class="text-muted text-truncate">Pending</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">62541</h5>
                                <p class="text-muted text-truncate">Deactivated</p>
                            </div>
                        </div>

                        <canvas id="doughnut" height="260"></canvas>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Agama</h4>

                        <div id="pie_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pendidikan</h4>

                        <div id="donut_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pekerjaan</h4>

                        <div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Kepemilikan BPJS</h4>

                        <div id="bar_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Warga Negara</h4>

                        <div class="row text-center">
                            <div class="col-4">
                                <h5 class="mb-0">86541</h5>
                                <p class="text-muted text-truncate">Activated</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">2541</h5>
                                <p class="text-muted text-truncate">Pending</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">102030</h5>
                                <p class="text-muted text-truncate">Deactivated</p>
                            </div>
                        </div>

                        <canvas id="lineChart" height="300"></canvas>

                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Usia</h4>

                        <div class="row text-center">
                            <div class="col-4">
                                <h5 class="mb-0">2541</h5>
                                <p class="text-muted text-truncate">Activated</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">84845</h5>
                                <p class="text-muted text-truncate">Pending</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">12001</h5>
                                <p class="text-muted text-truncate">Deactivated</p>
                            </div>
                        </div>

                        <canvas id="bar" height="300"></canvas>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>


        <!-- end col -->



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
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="{{ asset('assets/libs/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>


    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- apexcharts init -->
    <script src="assets/js/pages/apexcharts.init.js"></script>






@endsection
