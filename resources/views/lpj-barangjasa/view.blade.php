@extends('layouts.app')
@section('master-title', 'Barang dan Jasa/')
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
                <form action="{{ route('lpj-barangjasa.update', [$data->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center data_diri">Data Barang Jasa</h5>
                            <div class="form-group">
                                <div class="row">
                                    <!--Field yang ditampilin di table
                                            1. No
                                            2. Nomor Pesanan
                                            3. TPK (Nama TPK)
                                            4. Tanggal Pesanan
                                            5. Nama Toko !-->

                                    <div class="col-sm-6">
                                        <label for="lampiran" class="col-form-label">Lampiran</label>
                                        <input type="text" class="form-control" id="lampiran" name="lampiran"
                                            placeholder="Masukkan Lampiran" value="{{ $data->lampiran }}" disabled >
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="perihal" class="col-form-label">Perihal</label>
                                        <input type="text" class="form-control" id="perihal" name="perihal"
                                            placeholder="Masukkan Perihal" value="{{ $data->perihal }}" disabled>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <label for="dana_desa" class="col-form-label"> Sumber Dana Desa</label>
                                        <input type="text" class="form-control" id="dana_desa" name="dana_desa"
                                            placeholder="Masukkan Sumber Dana Desa" value="{{$data->dana_desa}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="no_pesanan_brg" class="col-form-label">No. Pesanan Barang</label>
                                        <input type="text" class="form-control" id="no_pesanan_brg" name="no_pesanan_brg"
                                            placeholder="001/PSB/PTPKD/15.2005/IV/2023"
                                            value="{{ $data->no_pesanan_brg }}" disabled> 
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="no_berita_acara" class="col-form-label">No. Berita Acara Serah Terima Barang
                                            (BASTB)</label>
                                        <input type="text" class="form-control" id="no_berita_acara"
                                            name="no_berita_acara" placeholder="001/BAST/PTPKD/15.2005/IV/2023"
                                            value="{{ $data->no_berita_acara }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="no_berita_acara_pemeriksaan" class="col-form-label">No. Berita Acara
                                            Pemeriksaan Barang (BAPB)</label>
                                        <input type="text" class="form-control" id="no_berita_acara_pemeriksaan"
                                            name="no_berita_acara_pemeriksaan" placeholder="001/BAPB/PTPKD/15.2005/IV/2023" value="{{$data->no_berita_acara_pemeriksaan}}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama_pelaksana_kegiatan" class="col-form-label">Nama Pelaksana
                                            Kegiatan/Pemesan (TPK)</label>
                                        <input type="text" class="form-control" id="nama_pelaksana_kegiatan"
                                            name="nama_pelaksana_kegiatan" placeholder="Masukkan Nama TPK"
                                            value="{{ $data->nama_pelaksana_kegiatan }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="sk_tpk" class="col-form-label">SK TPK</label>
                                        <input type="text" class="form-control" id="sk_tpk" name="sk_tpk"
                                            placeholder="Masukkan SK TPK" value="{{ $data->sk_tpk }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama_rincian_spp" class="col-form-label">Nama Rincian SPP</label>
                                        <input type="text" class="form-control" id="nama_rincian_spp"
                                            name="nama_rincian_spp" placeholder="Belanja Alat Tulis Kantor dan Benda Pos"
                                            value="{{ $data->nama_rincian_spp }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="uraian_kwitansi" class="col-form-label">Uraian Kwitansi Sesuai
                                            SISKEUDES</label>
                                        <input type="text" class="form-control" id="uraian_kwitansi"
                                            name="uraian_kwitansi" placeholder="Belanja Alat Tulis Kantor dan Benda Pos"
                                            value="{{ $data->uraian_kwitansi }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="tgl_pesanan" class="col-form-label">Tanggal Pesanan</label>
                                        <input type="date" class="form-control" id="tgl_pesanan" name="tgl_pesanan"
                                            placeholder="" value="{{ $data->tgl_pesanan }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="jatuh_tempo" class="col-form-label">Jatuh Tempo</label>
                                        <input type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo"
                                            placeholder="" value="{{ $data->jatuh_tempo }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="tgl_bast" class="col-form-label">Tanggal Bast</label>
                                        <input type="date" class="form-control" id="tgl_bast" name="tgl_bast"
                                            placeholder="" value="{{ $data->tgl_bast }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="jatuh_pemeriksaan" class="col-form-label">Jatuh Pemeriksaan</label>
                                        <input type="date" class="form-control" id="jatuh_pemeriksaan"
                                            name="jatuh_pemeriksaan" placeholder=""
                                            value="{{ $data->jatuh_pemeriksaan }}" disabled>
                                    </div>


                                    <div class="col-sm-12">
                                        <label for="keterangan" class="col-form-label">Keterangan</label>
                                        <textarea type="text" class="form-control" id="keterangan" name="keterangan" rows="5"
                                            placeholder="Barang-barang tersebut telah kami terima dengan baik" disabled>{{ $data->keterangan }}</textarea>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nama_toko" class="col-form-label">Nama Toko</label>
                                        <input type="text" class="form-control" id="nama_toko" name="nama_toko"
                                            placeholder="" value="{{ $data->nama_toko }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="pemilik_toko" class="col-form-label">Pemilik Toko</label>
                                        <input type="text" class="form-control" id="pemilik_toko" name="pemilik_toko"
                                            placeholder="" value="{{ $data->pemilik_toko }}" disabled>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="tim_pemeriksa" class="col-form-label">Tim Pemeriksa</label>
                                        <div class="dropdown">
                                            <button class="form-control dropdown-toggle text-left" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                name="tim_pemeriksa_show" disabled>
                                                {{ $data_pemeriksa->NIP }} - {{ $data_pemeriksa->nama }}
                                            </button>
                                            <!-- Data diambil dari TIM PEMERIKSA !-->
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                id="timPemeriksaDropdown">
                                                <input type="text" id="timPemeriksaSearchInput" class="form-control"
                                                    placeholder="Cari Tim Pemeriksa..." oninput="searchTimPemeriksa()"
                                                    name="tim_pemeriksa" value="{{ $data->tim_pemeriksa }}" >
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5"
                                            placeholder="Masukkan Alamat Toko" disabled>{{ $data->alamat }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <a href="{{ route('lpj-barangjasa.index') }}" class="btn btn-danger">Kembali</a>
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
            var dropdownButton = document.querySelector(".dropdown button[name='tim_pemeriksa_show']");
            dropdownButton.innerHTML = label;
            var inputVal = document.querySelector("[name='tim_pemeriksa']");
            inputVal.value = value;
        }
    </script>


@endsection
