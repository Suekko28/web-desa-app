@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('contents')

<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

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
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card bg-primary text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Penduduk</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">{{ $penduduk->count() }}</h1>
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
                            <h1 class="text-white">{{ $jumlah_laki_laki->count() }}</h1>
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
                            <h1 class="text-white">{{ $jumlah_perempuan->count() }}</h1>
                            <iconify-icon icon="mdi:face-female" width="50" height="50"
                                style="color:white;"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Meninggal</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">{{$meninggal}}</h1>
                            <i class="fas fa-book-dead fa-3x" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card bg-danger text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Kelahiran</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">{{$kelahiran}}</h1>
                            <i class="fas fa-solid fa-baby fa-3x" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-info text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Pindah Masuk</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">{{$pindah_masuk}}</h1>
                            <i class="fas fa-user-plus fa-3x" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card bg-warning text-white-50">
                    <div class="card-body">
                        <h5 class="mt-0 mb-4 text-white">Jumlah Pindah Keluar</h5>
                        <div class="d-flex justify-content-between">
                            <h1 class="text-white">{{$pindah_keluar}}</h1>
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
                            <h5 class="">{{ $penduduk_all->count() }}</h5>
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
                            <div class="col-6">
                                <h5 class="mb-0">{{ $jumlah_kepemilikan_e_ktp_ada->count() }}</h5>
                                <p class="text-muted text-truncate">Ada</p>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-0">{{ $jumlah_kepemilikan_e_ktp_tidak_ada->count() }}</h5>
                                <p class="text-muted text-truncate">Tidak Ada</p>
                            </div>
                        </div>

                        <div id="donut_chart_e_ktp"></div>
                    </div>

                </div>
            </div>




            <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Status Pernikahan</h4>

                        <div class="row text-center">
                            <div class="col-3">
                                <h5 class="mb-0">{{ $sts_nikah_belum_kawin->count() }}</h5>
                                <p class="text-muted text-truncate">Belum Kawin</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $sts_nikah_kawin->count() }}</h5>
                                <p class="text-muted text-truncate">Kawin</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $sts_nikah_cerai_hidup->count() }}</h5>
                                <p class="text-muted text-truncate">Cerai Hidup</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $sts_nikah_cerai_mati->count() }}</h5>
                                <p class="text-muted text-truncate">Cerai Mati</p>
                            </div>

                        </div>

                        <div id="pie_chart_pernikahan"></div>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Kewarganegaraan</h4>

                        <div class="row text-center">
                            <div class="col-4">
                                <h5 class="mb-0">{{ $wni->count() }}</h5>
                                <p class="text-muted text-truncate">WNI</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">{{ $wna->count() }}</h5>
                                <p class="text-muted text-truncate">WNA</p>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">{{ $wni_wna->count() }}</h5>
                                <p class="text-muted text-truncate">Kedua Warganegara</p>
                            </div>
                        </div>

                        <div id="donut_chart_kewarganegaraan"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Agama</h4>

                        <div class="row text-center">
                            <div class="col-3">
                                <h5 class="mb-0">{{ $agama_islam->count() }}</h5>
                                <p class="text-muted text-truncate">Islam</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $agama_kristen_protestan->count() }}</h5>
                                <p class="text-muted text-truncate">Kristen Protestan</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $agama_kristen_katolik->count() }}</h5>
                                <p class="text-muted text-truncate">Kristen Katolik</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $agama_hindu->count() }}</h5>
                                <p class="text-muted text-truncate">Hindu</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $agama_buddha->count() }}</h5>
                                <p class="text-muted text-truncate">Buddha</p>
                            </div>

                            <div class="col-3">
                                <h5 class="mb-0">{{ $agama_khonghucu->count() }}</h5>
                                <p class="text-muted text-truncate">Khonghucu</p>
                            </div>

                        </div>

                        <div id="pie_chart_agama"></div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pendidikan</h4>

                        <div class="row text-center">
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_belum_sekolah->count() }}</h5>
                                <p class="text-muted text-truncate">Belum Sekolah</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_sd->count() }}</h5>
                                <p class="text-muted text-truncate">SD</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_sltp->count() }}</h5>
                                <p class="text-muted text-truncate">SLTP</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_slta->count() }}</h5>
                                <p class="text-muted text-truncate">SLTA</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_diploma_i->count() }}</h5>
                                <p class="text-muted text-truncate">Diploma I</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_diploma_ii->count() }}</h5>
                                <p class="text-muted text-truncate">Diploma II</p>
                            </div>

                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_diploma_iii->count() }}</h5>
                                <p class="text-muted text-truncate">Diploma III</p>
                            </div>

                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_diploma_iv->count() }}</h5>
                                <p class="text-muted text-truncate">Diploma IV</p>
                            </div>

                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_sastra_i->count() }}</h5>
                                <p class="text-muted text-truncate">Sastra I</p>
                            </div>

                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_sastra_ii->count() }}</h5>
                                <p class="text-muted text-truncate">Sastra II</p>
                            </div>

                            <div class="col-3">
                                <h5 class="mb-0">{{ $pendidikan_sastra_iii->count() }}</h5>
                                <p class="text-muted text-truncate">Sastra III</p>
                            </div>

                        </div>

                        <div id="donut_chart_pendidikan"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Kepemilikan BPJS</h4>

                        <div class="row text-center">
                            <div class="col-3">
                                <h5 class="mb-0">{{ $bpjs_ppu->count() }}</h5>
                                <p class="text-muted text-truncate">PPU</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $bpjs_pbpu->count() }}</h5>
                                <p class="text-muted text-truncate">PBPU</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $bpjs_pd_pemda->count() }}</h5>
                                <p class="text-muted text-truncate">PD Pemdak</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $bpjs_bukan_pekerja->count() }}</h5>
                                <p class="text-muted text-truncate">Bukan Pekerja</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $bpjs_pbi_jk->count() }}</h5>
                                <p class="text-muted text-truncate">PBI JK</p>
                            </div>

                            <div class="col-3">
                                <h5 class="mb-0">{{ $bpjs_tidak_ada->count() }}</h5>
                                <p class="text-muted text-truncate">Tidak Ada</p>
                            </div>

                        </div>

                        <div id="pie_chart_bpjs"></div>
                    </div>
                </div>
            </div>

        </div>

        <?php
        $ages = $usia->pluck('usia')->toArray();
        
        // Define age groups
        $ageGroups = ['0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44', '45-49', '50-54', '55-59', '60-64', '65+'];
        
        // Initialize counts for each age group
        $jobCounts = array_fill_keys($ageGroups, 0);
        
        // Assign each age to the appropriate group
        foreach ($ages as $age) {
            foreach ($ageGroups as $group) {
                if ($group == '65+') {
                    if ($age >= 65) {
                        $jobCounts[$group]++;
                    }
                } else {
                    [$start, $end] = explode('-', $group);
                    if ($age >= $start && $age <= $end) {
                        $jobCounts[$group]++;
                        break;
                    }
                }
            }
        }
        
        // Convert counts to an indexed array
        $jobCountsIndexed = array_values($jobCounts);
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Usia</h4>
                        <div id="donut_chart_usia"></div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pekerjaan</h4>

                        <div class="row text-center">
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pekerjaan_swasta->count() }}</h5>
                                <p class="text-muted text-truncate">Karyawan Swasta</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pekerjaan_pengrajin->count() }}</h5>
                                <p class="text-muted text-truncate">Pengrajin</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pekerjaan_wirausaha->count() }}</h5>
                                <p class="text-muted text-truncate">Wirausaha</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pekerjaan_guru->count() }}</h5>
                                <p class="text-muted text-truncate">Guru</p>
                            </div>
                            <div class="col-3">
                                <h5 class="mb-0">{{ $pekerjaan_petani->count() }}</h5>
                                <p class="text-muted text-truncate">Petani</p>
                            </div>

                        </div>

                        <div id="pie_chart_pekerjaan"></div>
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
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="{{ asset('assets/libs/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>


    <!-- App js -->

    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- apexcharts init -->
    <script src="{{ asset('assets/js/pages/apexcharts.init.js') }}"></script>

    <script src="{{ asset('../../vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('../../vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('../../js/off-canvas.js') }}"></script>
    <script src="{{ asset('../../js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('../../js/template.js') }}"></script>
    <script src="{{ asset('../../js/settings.js') }}"></script>
    <script src="{{ asset('../../js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('../../js/chart.js') }}"></script>



    <!-- Chart Dashboard !-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'donut',
                },
                series: [
                    {{ $jumlah_kepemilikan_e_ktp_ada->count() }},
                    {{ $jumlah_kepemilikan_e_ktp_tidak_ada->count() }},
                ],
                labels: ['Ada', 'Tidak Ada'],
                colors: ['#FF6384', '#36A2EB'],
            };

            var chart = new ApexCharts(document.querySelector("#donut_chart_e_ktp"), options);

            chart.render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'pie',
                },
                series: [
                    {{ $sts_nikah_belum_kawin->count() }},
                    {{ $sts_nikah_kawin->count() }},
                    {{ $sts_nikah_cerai_hidup->count() }},
                    {{ $sts_nikah_cerai_mati->count() }},
                ],
                labels: ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati'],
                colors: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50'],
            };

            var chart = new ApexCharts(document.querySelector("#pie_chart_pernikahan"), options);

            chart.render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'pie',
                },
                series: [
                    {{ $agama_islam->count() }},
                    {{ $agama_kristen_protestan->count() }},
                    {{ $agama_kristen_katolik->count() }},
                    {{ $agama_hindu->count() }},
                    {{ $agama_buddha->count() }},
                    {{ $agama_khonghucu->count() }},
                ],
                labels: ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Khonghucu'],
                colors: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800', '#9C27B0'],
            };

            var chart = new ApexCharts(document.querySelector("#pie_chart_agama"), options);

            chart.render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'donut',
                },
                series: [
                    {{ $pendidikan_belum_sekolah->count() }},
                    {{ $pendidikan_sd->count() }},
                    {{ $pendidikan_sltp->count() }},
                    {{ $pendidikan_slta->count() }},
                    {{ $pendidikan_diploma_i->count() }},
                    {{ $pendidikan_diploma_ii->count() }},
                    {{ $pendidikan_diploma_iii->count() }},
                    {{ $pendidikan_diploma_iv->count() }},
                    {{ $pendidikan_sastra_i->count() }},
                    {{ $pendidikan_sastra_ii->count() }},
                    {{ $pendidikan_sastra_iii->count() }},
                ],
                labels: ['Belum Sekolah', 'SD', 'SLTP', 'SLTA', 'Diploma I', 'Diploma II', 'Diploma III',
                    'Diploma IV', 'Sastra I', 'Sastra II', 'Sastra III'
                ],
                colors: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800', '#9C27B0', '#795548', '#607D8B',
                    '#9E9E9E', '#3F51B5', '#FF5722'
                ],
            };

            var chart = new ApexCharts(document.querySelector("#donut_chart_pendidikan"), options);

            chart.render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'pie',
                },
                series: [
                    {{ $bpjs_ppu->count() }},
                    {{ $bpjs_pbpu->count() }},
                    {{ $bpjs_pd_pemda->count() }},
                    {{ $bpjs_bukan_pekerja->count() }},
                    {{ $bpjs_pbi_jk->count() }},
                    {{ $bpjs_tidak_ada->count() }},
                ],
                labels: ['PPU', 'PBPU', 'PD Pemda', 'Bukan Pekerja', 'PBI JK', 'Tidak Ada'],
                colors: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800', '#9C27B0'],
            };

            var chart = new ApexCharts(document.querySelector("#pie_chart_bpjs"), options);

            chart.render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'donut',
                },
                series: [
                    {{ $wni->count() }},
                    {{ $wna->count() }},
                    {{ $wni_wna->count() }},


                ],
                labels: ['WNI', 'WNA', 'Kedua Warganegara', ],
                colors: ['#FF6384', '#36A2EB', '#FFCE56', ],
            };

            var chart = new ApexCharts(document.querySelector("#donut_chart_kewarganegaraan"), options);

            chart.render();
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var jobCounts = <?php echo json_encode($jobCountsIndexed); ?>; // Updated with the calculated counts
            var jobNames = <?php echo json_encode(array_keys($jobCounts)); ?>;

            var options = {
                chart: {
                    type: 'donut',
                },
                series: jobCounts,
                labels: jobNames,
                colors: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800', '#9C27B0', '#795548', '#607D8B',
                    '#9E9E9E', '#3F51B5', '#FF5722'
                ],
            };

            var chart = new ApexCharts(document.querySelector("#donut_chart_usia"), options);
            chart.render();
        });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = {
            chart: {
                type: 'pie',
            },
            series: [
                {{ $pekerjaan_swasta->count() }},
                {{ $pekerjaan_pengrajin->count() }},
                {{ $pekerjaan_wirausaha->count() }},
                {{ $pekerjaan_guru->count() }},
                {{ $pekerjaan_petani->count() }},
            ],
            labels: ['Buruh Harian Lepas', 'Belum Bekerja', 'Pengrajin Logam', 'Wiraswasta', 'Guru', 'Mengurus Rumah Tangga', 'Pegawai Negri Sipil', 'Tentara Nasional Indonesia', 'Guru ngaji', 'Wirausaha', 'Penjahit', 'Pensiun PNS', 'Pemulung', 'Buruh', 'Linmas wilayah', 'Driver', 'Petani', 'Amil', 'Service'],
            colors: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800', '#FFD700', '#00FF00', '#FF1493', '#8A2BE2', '#FF4500', '#1E90FF', '#008B8B', '#FF69B4', '#228B22', '#9370DB', '#FF6347', '#00CED1', '#8B4513', '#4682B4', '#FF8C00'],
        };

        var chart = new ApexCharts(document.querySelector("#pie_chart_pekerjaan"), options);

        chart.render();
    });
</script>




@endsection
