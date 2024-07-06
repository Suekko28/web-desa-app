@extends('layouts.app')
@section('master-title', 'Data Penduduk/')
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

                
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="nama1" class="col-form-label">Tanggal Pindah
                                            Masuk</label>
                                        <input type="date" class="form-control" id="tgl_pindah_masuk" name="tgl_pindah_masuk"
                                            value="{{ $data->tgl_pindah_masuk }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama2" class="col-form-label">Tanggal Lapor</label>
                                        <input type="date" class="form-control " id="tgl_lapor" name="tgl_lapor"
                                            value="{{ $data->tgl_lapor }}" disabled>
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <h5 class="text-center data_diri">Data Diri</h5>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="nik" class="col-form-label">NIK</label>
                                        <input type="text" class="form-control" id="NIK" name="NIK"
                                            value="{{$data->NIK}}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nkk" class="col-form-label">NKK</label>
                                        <input type="text" class="form-control" id="NKK" name="NKK"
                                            value="{{$data->NKK}}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nama" class="col-form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Sesuai KTP" value="{{$data->nama}}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tmpt_lhr" class="col-form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="nama1" name="tempat_lahir"
                                            placeholder="Tempat Lahir" value="{{$data->tempat_lahir}}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_lhr" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lhr" name="tgl_lahir"
                                            placeholder="" value="{{$data->tgl_lahir}}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="usia" class="col-form-label">Usia</label>
                                        <input type="text" class="form-control bg-light" id="usia" name="usia" placeholder="Terisi Otomatis" disabled value="">
                                        <!-- Input tersembunyi untuk menyimpan usia awal -->
                                        <input type="hidden" id="usia_awal" name="usia_awal">
                                    </div>
                                    

                                    <div class="col-sm-6">
                                        <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                        <input type="text" class="form-control text-capitalize" id="jenis_kelamin" name="jenis_kelamin"
                                            placeholder="" value="{{$data->jenis_kelamin}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="agama" class="col-form-label">Agama</label>
                                        <input type="text" class="form-control text-capitalize" id="agama" name="agama"
                                        placeholder="" value="{{$data->agama}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="kewarganegaraan" class="col-form-label">Warga Negara</label>
                                        <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan"
                                        placeholder="" value="{{$data->kewarganegaraan}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="status_pernikahan" class="col-form-label">Status
                                            Pernikahan</label>
                                            <input type="text" class="form-control text-capitalize" id="status_pernikahan" name="status_pernikahan"
                                            placeholder="" value="{{$data->status_pernikahan}}" disabled>

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
                                        <input type="text" class="form-control" id="dusun" name="dusun"
                                            placeholder="Dusun" value="{{ $data->dusun}} " disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="rt" class="col-form-label">RT</label>
                                        <input type="text" class="form-control" id="rt" name="rt"
                                            placeholder="000" value="{{$data->rt}}" disabled>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="rw" class="col-form-label">RW</label>
                                        <input type="text" class="form-control" id="rw" name="rw"
                                            placeholder="000" value="{{$data->rw}}" disabled>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5" placeholder="Alamat Lengkap (Jl / Kampung  No.Rumah" disabled>{{$data->alamat}}</textarea>
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
                                            <input type="text" class="form-control" id="pendidikan" name="pendidikan"
                                            placeholder="Jenis Usaha" value="{{$data->pendidikan}}" disabled>

                                    </div>

                                    <div class="col-sm-6">
                                        <label for="pekerjaan" class="col-form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="" value="{{$data->pekerjaan}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="kepemilikan_bpjs" class="col-form-label">
                                            Kepemilikan BPJS</label>
                                            <input type="text" class="form-control" id="kepemilikan_bpjs" name="kepemilikan_bpjs"
                                            placeholder="" value="{{$data->kepemilikan_bpjs}}" disabled>

                                    </div>

                                    <div class="col-sm-6">
                                        <label for="kepemilikan_e_ktp" class="col-form-label">
                                            Kepemilikan E-KTP</label>
                                            <input type="text" class="form-control text-capitalize" id="kepemilikan_e_ktp" name="kepemilikan_e_ktp"
                                            placeholder="" value="{{$data->kepemilikan_e_ktp}}" disabled>

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
                                            placeholder="Nama Ibu" value="{{$data->nama_ibu}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama_ayah" class="col-form-label">Nama Ayah</label>
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                            placeholder="Nama Ayah" value="{{$data->nama_ayah}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <a href="{{ route('penduduk.index') }}" class="btn btn-danger" disabled>Kembali</a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
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
        if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
            age--;
        }

        // Set nilai usia pada input usia
        document.getElementById('usia').value = age;

        // Simpan nilai usia awal pada elemen tersembunyi
        document.getElementById('usia_awal').value = age;
    }

    // Panggil fungsi hitungUsia saat input tanggal lahir berubah
    document.getElementById('tgl_lhr').addEventListener('input', hitungUsia);

    // Panggil fungsi hitungUsia untuk menginisialisasi usia awal
    hitungUsia();
</script>



@endsection
