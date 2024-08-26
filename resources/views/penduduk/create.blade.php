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
                                            name="tgl_pindah_masuk" placeholder="" value="{{ old('tgl_pindah_masuk') }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama2" class="col-form-label">Tanggal Lapor</label>
                                        <input type="date" class="form-control" id="tgl_lapor" name="tgl_lapor"
                                            placeholder="" value="{{ old('tgl_lapor') }}">
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
                                            placeholder="Nomor KTP" value="{{ old('NIK') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nkk" class="col-form-label">NKK</label>
                                        <input type="number" class="form-control" id="NKK" name="NKK"
                                            placeholder="Nomor KK"value="{{ old('NKK') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="nama" class="col-form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Sesuai KTP" value="{{ old('nama') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tmpt_lhr" class="col-form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="nama1" name="tempat_lahir"
                                            placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_lhr" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lhr" name="tgl_lahir"
                                            placeholder="" value="{{ old('tgl_lahir') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="disabledTextInput" class="col-form-label">Usia</label>
                                        <input type="text" class="form-control bg-light" id="usia"
                                            name="usia" placeholder="Terisi Otomatis" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="0" {{ old('jenis_kelamin') == '0' ? 'selected' : '' }}>
                                                --Pilih Salah Satu--</option>
                                            <option value="1" {{ old('jenis_kelamin') == '1' ? 'selected' : '' }}>
                                                Laki-Laki</option>
                                            <option value="2" {{ old('jenis_kelamin') == '2' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="agama" class="col-form-label">Agama</label>
                                        <select class="form-control" name="agama" id="agama">
                                            <option value="" {{ old('agama') == '' ? 'selected' : '' }}>--Pilih
                                                Salah Satu--</option>
                                            <option value="1" {{ old('agama') == '1' ? 'selected' : '' }}>Islam
                                            </option>
                                            <option value="2" {{ old('agama') == '2' ? 'selected' : '' }}>Kristen
                                                Protestan</option>
                                            <option value="3" {{ old('agama') == '3' ? 'selected' : '' }}>Kristen
                                                Katolik</option>
                                            <option value="4" {{ old('agama') == '4' ? 'selected' : '' }}>Hindu
                                            </option>
                                            <option value="5" {{ old('agama') == '5' ? 'selected' : '' }}>Buddha
                                            </option>
                                            <option value="6" {{ old('agama') == '6' ? 'selected' : '' }}>Khonghucu
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="warga_negara" class="col-form-label">Warga Negara</label>
                                        <select class="form-control" name="kewarganegaraan" id="warga_negara">
                                            <option value="" {{ old('kewarganegaraan') == '' ? 'selected' : '' }}>
                                                --Pilih Salah Satu--</option>
                                            <option value="1" {{ old('kewarganegaraan') == '1' ? 'selected' : '' }}>
                                                WNI</option>
                                            <option value="2" {{ old('kewarganegaraan') == '2' ? 'selected' : '' }}>
                                                WNA</option>
                                            <option value="3" {{ old('kewarganegaraan') == '3' ? 'selected' : '' }}>
                                                Kedua Kewarganegaraan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="status_nikah" class="col-form-label">Status Pernikahan</label>
                                        <select class="form-control" name="status_pernikahan" id="status_nikah">
                                            <option value="" {{ old('status_pernikahan') == '' ? 'selected' : '' }}>
                                                --Pilih Salah Satu--</option>
                                            <option value="1"
                                                {{ old('status_pernikahan') == '1' ? 'selected' : '' }}>Belum Kawin
                                            </option>
                                            <option value="2"
                                                {{ old('status_pernikahan') == '2' ? 'selected' : '' }}>Kawin</option>
                                            <option value="3"
                                                {{ old('status_pernikahan') == '3' ? 'selected' : '' }}>Cerai Hidup
                                            </option>
                                            <option value="4"
                                                {{ old('status_pernikahan') == '4' ? 'selected' : '' }}>Cerai Mati</option>
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
                                            placeholder="Dusun" value="{{ old('dusun') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="rt" class="col-form-label">RT</label>
                                        <input type="number" class="form-control" id="rt" name="rt"
                                            placeholder="000" value="{{ old('rt') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="rw" class="col-form-label">RW</label>
                                        <input type="number" class="form-control" id="rw" name="rw"
                                            placeholder="000" value="{{ old('rw') }}">
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5"
                                            placeholder="Alamat Lengkap (Jl / Kampung  No.Rumah)">{{ old('alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-center pendidikan_kerja">Pendidikan & Pekerjaan</h5>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="pendidikan" class="col-form-label">Pendidikan</label>
                                        <select class="form-control" name="pendidikan" id="pendidikan">
                                            <option value="" {{ old('pendidikan') == '' ? 'selected' : '' }}>--Pilih
                                                Salah Satu--</option>
                                            <option value="1" {{ old('pendidikan') == '1' ? 'selected' : '' }}>Belum
                                                Sekolah</option>
                                            <option value="2" {{ old('pendidikan') == '2' ? 'selected' : '' }}>Tamat
                                                SD</option>
                                            <option value="3" {{ old('pendidikan') == '3' ? 'selected' : '' }}>Belum
                                                Tamat SD</option>
                                            <option value="4" {{ old('pendidikan') == '4' ? 'selected' : '' }}>
                                                Akademi</option>
                                            <option value="5" {{ old('pendidikan') == '6' ? 'selected' : '' }}>SLTP
                                                </option>
                                            <option value="6" {{ old('pendidikan') == '7' ? 'selected' : '' }}>SLTA
                                                </option>
                                            <option value="7" {{ old('pendidikan') == '8' ? 'selected' : '' }}>
                                                Diploma I</option>
                                            <option value="8" {{ old('pendidikan') == '9' ? 'selected' : '' }}>
                                                Diploma II</option>
                                            <option value="9" {{ old('pendidikan') == '10' ? 'selected' : '' }}>
                                                Diploma III</option>
                                            <option value="10" {{ old('pendidikan') == '11' ? 'selected' : '' }}>
                                                Diploma IV</option>
                                            <option value="11" {{ old('pendidikan') == '12' ? 'selected' : '' }}>Stara
                                                I</option>
                                            <option value="12" {{ old('pendidikan') == '13' ? 'selected' : '' }}>Stara
                                                II</option>
                                            <option value="13" {{ old('pendidikan') == '14' ? 'selected' : '' }}>Stara
                                                III</option>
                                        </select>
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="pekerjaan" class="col-form-label">Pekerjaan</label>
                                        <select class="form-control" name="pekerjaan" id="pekerjaan">
                                            <option value="" {{ old('pekerjaan') == '' ? 'selected' : '' }}>--Pilih
                                                Salah Satu--</option>
                                            <option value="1" {{ old('pekerjaan') == '1' ? 'selected' : '' }}>Buruh
                                                Harian Lepas</option>
                                            <option value="2" {{ old('pekerjaan') == '2' ? 'selected' : '' }}>Belum
                                                Bekerja</option>
                                            <option value="3" {{ old('pekerjaan') == '3' ? 'selected' : '' }}>
                                                Pengrajin Logam</option>
                                            <option value="4" {{ old('pekerjaan') == '4' ? 'selected' : '' }}>
                                                Wiraswasta</option>
                                            <option value="5" {{ old('pekerjaan') == '5' ? 'selected' : '' }}>Guru
                                            </option>
                                            <option value="6" {{ old('pekerjaan') == '6' ? 'selected' : '' }}>
                                                Mengurus Rumah Tangga</option>
                                            <option value="7" {{ old('pekerjaan') == '7' ? 'selected' : '' }}>Pegawai
                                                Negri Sipil</option>
                                            <option value="8" {{ old('pekerjaan') == '8' ? 'selected' : '' }}>Tentara
                                                Nasional Indonesia</option>
                                            <option value="9" {{ old('pekerjaan') == '9' ? 'selected' : '' }}>Guru
                                                Ngaji</option>
                                            <option value="10" {{ old('pekerjaan') == '10' ? 'selected' : '' }}>
                                                Wirausaha</option>
                                            <option value="11" {{ old('pekerjaan') == '11' ? 'selected' : '' }}>
                                                Penjahit</option>
                                            <option value="12" {{ old('pekerjaan') == '12' ? 'selected' : '' }}>
                                                Pensiun PNS</option>
                                            <option value="13" {{ old('pekerjaan') == '13' ? 'selected' : '' }}>
                                                Pemulung</option>
                                            <option value="14" {{ old('pekerjaan') == '14' ? 'selected' : '' }}>Buruh
                                            </option>
                                            <option value="15" {{ old('pekerjaan') == '15' ? 'selected' : '' }}>Linmas
                                                wilayah</option>
                                            <option value="16" {{ old('pekerjaan') == '16' ? 'selected' : '' }}>Driver
                                            </option>
                                            <option value="17" {{ old('pekerjaan') == '17' ? 'selected' : '' }}>Petani
                                            </option>
                                            <option value="18" {{ old('pekerjaan') == '18' ? 'selected' : '' }}>Amil
                                            </option>
                                            <option value="19" {{ old('pekerjaan') == '19' ? 'selected' : '' }}>
                                                Service</option>
                                        </select>
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="bpjs" class="col-form-label">Kepemilikan BPJS</label>
                                        <select class="form-control" name="kepemilikan_bpjs" id="bpjs">
                                            <option value="" {{ old('kepemilikan_bpjs') == '' ? 'selected' : '' }}>
                                                --Pilih Salah Satu--</option>
                                            <option value="1" {{ old('kepemilikan_bpjs') == '1' ? 'selected' : '' }}>
                                                PPU</option>
                                            <option value="2" {{ old('kepemilikan_bpjs') == '2' ? 'selected' : '' }}>
                                                PBPU</option>
                                            <option value="3" {{ old('kepemilikan_bpjs') == '3' ? 'selected' : '' }}>
                                                PD Pemda</option>
                                            <option value="4" {{ old('kepemilikan_bpjs') == '4' ? 'selected' : '' }}>
                                                Bukan Pekerja</option>
                                            <option value="5" {{ old('kepemilikan_bpjs') == '5' ? 'selected' : '' }}>
                                                PBI JK</option>
                                            <option value="6" {{ old('kepemilikan_bpjs') == '6' ? 'selected' : '' }}>
                                                Tidak Ada</option>
                                        </select>
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="e_ktp" class="col-form-label">Kepemilikan E-KTP</label>
                                        <select class="form-control" name="kepemilikan_e_ktp" id="e_ktp">
                                            <option value=""
                                                {{ old('kepemilikan_e_ktp') === '' ? 'selected' : '' }}>--Pilih Salah
                                                Satu--</option>
                                            <option value="1"
                                                {{ old('kepemilikan_e_ktp') == '1' ? 'selected' : '' }}>Ada</option>
                                            <option value="2"
                                                {{ old('kepemilikan_e_ktp') == '2' ? 'selected' : '' }}>Tidak Ada</option>
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
                                            placeholder="Nama Ibu" value="{{ old('nama_ibu') }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama_ayah" class="col-form-label">Nama Ayah</label>
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                            placeholder="Nama Ayah" value="{{ old('nama_ayah') }}">
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
