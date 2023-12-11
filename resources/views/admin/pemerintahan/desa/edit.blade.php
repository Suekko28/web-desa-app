<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Qovex - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- jquery.vectormap css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('partials.topbar') @include('partials.sidebar')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title mb-0 font-size-18">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pemerintahan Desa</a></li>
                                        <li class="breadcrumb-item active">Input Pemerintahan Desa</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <section class="content">
                        <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->

                            <form action="{{ url('/admin/kegiatan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">


                                        <h5 class="text-center data_diri">Data Diri</h5>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="profile" class="col-form-label">Profile</label>
                                                    <input type="file" class="form-control" id="profile"
                                                        name="profile" placeholder="">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="name" class="col-form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="jabatan" class="col-form-label">Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan"
                                                        name="jabatan" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="tempat_lahir" class="col-form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tempat_lahir"
                                                        name="tempat_lahir" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tanggal_lahir"
                                                        name="tanggal_lahir" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="gender" class="col-form-label" name="gender">Jenis Kelamin</label>
                                                    <select class="form-control">
                                                        <option value="1">Laki-Laki</option>
                                                        <option value="2">Perempuan</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="alamat" class="col-form-label">Alamat</label>
                                                    <textarea rows="5" type="text" class="form-control" id="alamat" name="alamat" placeholder=""></textarea>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                            <a href="{{ url('/admin/kegiatan') }}" class="btn btn-danger">Batal</a>
                                        </div>

                
                <!-- /.card-body -->
                </form>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
            </section>

            <!-- end row -->
        </div>
        <!-- End Page-content -->

        @include('partials.footer')

    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>

    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script
        src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+') }}"
        crossorigin="anonymous"></script>

</body>

</html>
