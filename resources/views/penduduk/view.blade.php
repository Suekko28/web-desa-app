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
                                        <input type="date" class="form-control" id="tgl_lapor" name="tgl_lapor"
                                            value="{{ $data->tgl_lapor }}">
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

                                    <div class="col-sm-6">
                                        <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" disabled>
                                            <option value="0">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->jenis_kelamin == 'laki-laki') selected @endif>Laki-Laki</option>
                                            <option value="2" @if ($data->jenis_kelamin == 'perempuan') selected @endif>Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="agama" class="col-form-label">Agama</label>
                                        <select class="form-control" name="agama" id="agama" disabled>
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->agama == 'islam') selected @endif>Islam</option>
                                            <option value="2" @if ($data->agama == 'kristen protestan') selected @endif>Kristen Protestan</option>
                                            <option value="3" @if ($data->agama == 'kristen katholik') selected @endif>Kristen Katholik</option>
                                            <option value="4" @if ($data->agama == 'hindu') selected @endif>Hindu</option>
                                            <option value="5" @if ($data->agama == 'buddha') selected @endif>Buddha</option>
                                            <option value="6" @if ($data->agama == 'khonghucu') selected @endif>Khonghucu</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="warga_negara" class="col-form-label">Warga Negara</label>
                                        <select class="form-control" name="kewarganegaraan" id="warga_negara" disabled>
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->kewarganegaraan == 'WNI') selected @endif>WNI</option>
                                            <option value="2" @if ($data->kewarganegaraan == 'WNA') selected @endif>WNA</option>
                                            <option value="3" @if ($data->kewarganegaraan == 'Kedua Kewarganegaraan') selected @endif>Kedua Kewarganegaraan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="status_nikah" class="col-form-label">Status
                                            Pernikahan</label>
                                        <select class="form-control" name="status_pernikahan" id="status_nikah" disabled>
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->status_pernikahan == 'belum kawin') selected @endif>Belum Kawin</option>
                                            <option value="2" @if ($data->status_pernikahan == 'kawin') selected @endif>Kawin</option>
                                            <option value="3" @if ($data->status_pernikahan == 'cerai hidup') selected @endif>Cerai Hidup</option>
                                            <option value="4" @if ($data->status_pernikahan == 'cerai mati') selected @endif>Cerai Mati</option>
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
                                        <select class="form-control" name="dusun" id="dusun" disabled>
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->dusun == '1') selected @endif>Dusun 1</option>
                                            <option value="2" @if ($data->dusun == '2') selected @endif>Dusun 2</option>
                                            <option value="3" @if ($data->dusun == '3') selected @endif>Dusun 3</option>
                                        </select>
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
                                        <select class="form-control" name="pendidikan" id="pendidikan" disabled>
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->pendidikan == 'tidak sekolah') selected @endif >Tidak/Belum Sekolah</option>
                                            <option value="2" @if ($data->pendidikan == 'SD') selected @endif>SD Sederajat</option>
                                            <option value="3" @if ($data->pendidikan == 'SLTP Sederajat') selected @endif>SLTP Sederajat</option>
                                            <option value="4" @if ($data->pendidikan == 'SLTA Sederajat') selected @endif>SLTA Sederajat</option>
                                            <option value="5" @if ($data->pendidikan == 'Diploma 1') selected @endif>Diploma I</option>
                                            <option value="6" @if ($data->pendidikan == 'Diploma 2') selected @endif>Diploma II</option>
                                            <option value="7" @if ($data->pendidikan == 'Diploma 3') selected @endif>Diploma III</option>
                                            <option value="8" @if ($data->pendidikan == 'Diploma 4') selected @endif>Diploma IV</option>
                                            <option value="9" @if ($data->pendidikan == 'Stara 1') selected @endif>Stara I</option>
                                            <option value="10" @if ($data->pendidikan == 'Stara 2') selected @endif>Stara II</option>
                                            <option value="11" @if ($data->pendidikan == 'Stara 3') selected @endif>Stara III</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="pekerjaan" class="col-form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Jenis Usaha" value="{{$data->pekerjaan}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="bpjs" class="col-form-label">
                                            Kepemilikan BPJS</label>
                                        <select class="form-control" class="bpjs" name="kepemilikan_bpjs" id="bpjs" disabled>
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->kepemilikan_bpjs == 'PBI') selected @endif>PPU</option>
                                            <option value="2" @if ($data->kepemilikan_bpjs == 'PBPU') selected @endif>PBPU</option>
                                            <option value="3" @if ($data->kepemilikan_bpjs == 'PD Pemda') selected @endif>PD Pemda</option>
                                            <option value="4" @if ($data->kepemilikan_bpjs == 'Bukan pekerja') selected @endif>Bukan Pekerja</option>
                                            <option value="5" @if ($data->kepemilikan_bpjs == 'PBI JK') selected @endif>PBI JK</option>
                                            <option value="6" @if ($data->kepemilikan_bpjs == 'Tidak ada') selected @endif>Tidak Ada</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="e_ktp" class="col-form-label">
                                            Kepemilikan E-KTP</label>
                                        <select class="form-control" class="e_ktp" name="kepemilikan_e_ktp" id="e_ktp" disabled>
                                            <option value="">--Pilih Salah Satu--</option>
                                            <option value="1" @if ($data->kepemilikan_e_ktp == 'ada') selected @endif >Ada</option>
                                            <option value="2" @if ($data->kepemilikan_e_ktp == 'tidak ada') selected @endif >Tidak Ada</option>
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
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="{{ route('penduduk.index') }}" class="btn btn-danger" disabled>Batal</a>
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

@endsection
