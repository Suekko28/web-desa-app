@extends('layouts.app')
@section('master-title', 'Data Penduduk/')
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

                <form action="{{ route('penduduk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="nama1" class="col-form-label">Tanggal Pindah
                                            Masuk</label>
                                        <input type="date" class="form-control" id="tgl_pindah_masuk"
                                            name="tgl_pindah_masuk" placeholder="">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama2" class="col-form-label">Tanggal Lapor</label>
                                        <input type="date" class="form-control" id="tgl_lapor" name="tgl_lapor"
                                            placeholder="">
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <h5 class="text-center data_diri">Data Diri</h5>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="nik" class="col-form-label">NIK</label>
                                        <input type="number" class="form-control" id="NIK" name="NIK"
                                            placeholder="Nomor KTP">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nkk" class="col-form-label">NKK</label>
                                        <input type="number" class="form-control" id="NKK" name="NKK"
                                            placeholder="Nomor KK">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nama" class="col-form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Sesuai KTP">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tmpt_lhr" class="col-form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="nama1" name="tempat_lahir"
                                            placeholder="Tempat Lahir">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_lhr" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lhr" name="tgl_lahir"
                                            placeholder="">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="disabledTextInput" class="col-form-label">Usia</label>
                                        <input type="text" class="form-control bg-light" id="usia"
                                            name="usia" placeholder="Terisi Otomatis" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="0">--Pilih Salah Satu--</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
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

                                    <div class="col-sm-6">
                                        <label for="warga_negara" class="col-form-label">Warga Negara</label>
                                        <select class="form-control" name="kewarganegaraan" id="warga_negara">
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1">WNI</option>
                                            <option value="2">WNA</option>
                                            <option value="3">Kedua Kewarganegaraan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
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
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-center alamat_pribadi">Alamat Pribadi</h5>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="dusun" class="col-form-label">
                                            Dusun</label>
                                        <input type="text" class="form-control" id="nama1" name="dusun"
                                            placeholder="Dusun">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="rt" class="col-form-label">RT</label>
                                        <input type="number" class="form-control" id="rt" name="rt"
                                            placeholder="000">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="rw" class="col-form-label">RW</label>
                                        <input type="number" class="form-control" id="rw" name="rw"
                                            placeholder="000">
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5"
                                            placeholder="Alamat Lengkap (Jl / Kampung  No.Rumah)"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-center pendidikan_kerja">Pendidikan & Pekerjaan</h5>


                            <div class="form-group">
                                <div class="row">


                                    <div class="col-sm-6">
                                        <label for="pendidikan" class="col-form-label">
                                            Pendidikan</label>
                                        <select class="form-control" name="pendidikan" id="pendidikan">
                                            <option value="" selected>--Pilih Salah Satu--</option>
                                            <option value="1">Belum Sekolah</option>
                                            <option value="2">Tamat SD</option>
                                            <option value="3">Belum Tamat SD</option>
                                            <option value="4">Akademi</option>
                                            <option value="5">SD Sederajat</option>
                                            <option value="6">SLTP Sederajat</option>
                                            <option value="7">SLTA Sederajat</option>
                                            <option value="8">Diploma I</option>
                                            <option value="9">Diploma II</option>
                                            <option value="10">Diploma III</option>
                                            <option value="11">Diploma IV</option>
                                            <option value="12">Stara I</option>
                                            <option value="13">Stara II</option>
                                            <option value="14">Stara III</option>
                                        </select>

                                    </div>

                                    <div class="col-sm-6">
                                        <label for="pekerjaan" class="col-form-label">
                                            Pekerjaan</label>
                                        <select class="form-control" class="pekerjaan" name="pekerjaan" id="pekerjaan">
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1">Buruh Harian Lepas</option>
                                            <option value="2">Belum Bekerja</option>
                                            <option value="3">Pengrajin Logam</option>
                                            <option value="4">Wiraswasta</option>
                                            <option value="5">Guru</option>
                                            <option value="6">Mengurus Rumah Tangga</option>
                                            <option value="7">Pegawai Negri Sipil</option>
                                            <option value="8">Tentara Nasional Indonesia</option>
                                            <option value="9">Guru ngaji</option>
                                            <option value="10">Wirausaha</option>
                                            <option value="11">Penjahit</option>
                                            <option value="12">Pensiun PNS</option>
                                            <option value="13">Pemulung</option>
                                            <option value="14">Buruh</option>
                                            <option value="15">Linmas wilayah</option>
                                            <option value="16">Driver</option>
                                            <option value="17">Petani</option>
                                            <option value="18">Amil</option>
                                            <option value="19">Service</option>
                                        </select>

                                    </div>

                                    <div class="col-sm-6">
                                        <label for="bpjs" class="col-form-label">
                                            Kepemilikan BPJS</label>
                                        <select class="form-control" class="bpjs" name="kepemilikan_bpjs"
                                            id="bpjs">
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1">PPU</option>
                                            <option value="2">PBPU</option>
                                            <option value="3">PD Pemda</option>
                                            <option value="4">Bukan Pekerja</option>
                                            <option value="5">PBI JK</option>
                                            <option value="6">Tidak Ada</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="e_ktp" class="col-form-label">
                                            Kepemilikan E-KTP</label>
                                        <select class="form-control" class="e_ktp" name="kepemilikan_e_ktp"
                                            id="e_ktp">
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1">Ada</option>
                                            <option value="2">Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-center data_ortu">Data Orang Tua</h5>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <label for="nama_ibu" class="col-form-label">Nama Ibu</label>
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                            placeholder="Nama Ibu">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama_ayah" class="col-form-label">Nama Ayah</label>
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                            placeholder="Nama Ayah">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="{{ route('penduduk.index') }}" class="btn btn-danger">Batal</a>
                            </div>

                        </div>
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
        // Fungsi untuk menghitung usia berdasarkan tanggal lahir
        function hitungUsia() {
            // Ambil nilai dari input tanggal lahir
            var tanggalLahir = document.getElementById('tgl_lhr').value;

            // Konversi string tanggal lahir menjadi objek Date
            var dob = new Date(tanggalLahir);

            // Dapatkan tanggal hari ini
            var today = new Date();

            // Hitung selisih tahun antara tanggal lahir dan hari ini
            var age = today.getFullYear() - dob.getFullYear();

            // Periksa apakah ulang tahun sudah terjadi atau belum
            if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob
                    .getDate())) {
                age--;
            }

            // Set nilai usia pada input usia
            document.getElementById('usia').value = age;
        }

        // Panggil fungsi hitungUsia saat input tanggal lahir berubah
        document.getElementById('tgl_lhr').addEventListener('input', hitungUsia);
    </script>


@endsection
