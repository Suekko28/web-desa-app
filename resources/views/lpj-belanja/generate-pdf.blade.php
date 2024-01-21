<!-- resources/views/pdf/pdf_template.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang dan Jasa Belanja as PDF</title>
    <!-- Add any additional CSS styling if needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
        main {
            font-size: 11px;
        }

        .pemerintahan,
        .kecamatan {
            font-size: 16px;
            margin: 0;
        }

        .desa {
            font-size: 22px;
            margin: 0;
        }

        .alamat {
            font-size: 12px
        }


        .text_header {
            margin: -10px;
        }

        .page-break {
            page-break-before: always;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 10px;
            font-family: Arial, sans-serif;
        }

        p {
            margin: 0;
        }
    </style>
</head>

<body>
    <header>
        <table style="width:90%;">
            <tbody>
                <tr>
                    <td> <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo Sawitri" height="100">
                    </td>
                    <td class="text-center text_header">
                        <h1 class="pemerintahan">PEMERINTAH KABUPATEN BOGOR</h1>
                        <h1 class="kecamatan">KECAMATAN CITEREUP</h1>
                        <h1 class="desa">TIM PENGELOLA KEGIATAN (TPK)</h1>
                        <h1 class="desa">DESA TARIKOLOT</h1>
                        <p class="alamat">Alamat: Jl. Industri No.65 Desa Tarikolot Citereup Bogor 16810 Telp. (021)
                            87943708
                            <br>
                            Email: <a href="mailto:desatarikolotsawitri@gmail.com">tpkdesatarikolotsawitri@gmail.com</a>
                        </p>
                    </td>
                </tr>
            <tbody>
        </table>
    </header>
    <hr style="height:4px;border-width:0;color:black;background-color:black" class="my-2">
    <hr style="height:2px;border-width:0;color:black;background-color:black" class="my-2">
    <main class="flex-grow-1">



        <table style="width: 100%;" class="container">
            <tbody>
                <tr>
                    <td>
                        <p>Nomor : {{ $data_belanja->no_berita_acara }}</p>
                        <p>Lampiran : - </p>
                        <p>Perihal : {{ $data_belanja->perihal }}</p>
                    </td>
                    <td style="text-align:right;">
                        <p>Tarikolot , {{ $date_pesanan }}</p>
                        <p>Kepada</p>
                        <p>Yth. {{ $data_belanja->nama_toko }}</p>
                        <p>____Tempat____</p>
                    </td>
                </tr>
            </tbody>
        </table>



        <p style="margin-top: 2em; text-indent: 20px;">Untuk kebutuhan Pelaksanaan Kegiatan
            {{ $data_belanja->nama_rincian_spp }} Sumber Dana
            Rp.{{ number_format($data_belanja->dana_desa, 0, ',', '.') }} di wilayah Desa
            Tarikolot Kecamatan
            Citeureup Kabupaten Bogor, dengan ini Kami
            sebagai Pelaksana Kegiatan memesan Barang dengan rincian sebagai berikut:
        </p>

        <table class="table table-bordered text-center vw-100 mw-100 mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Banyaknya</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($data_barang as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->volume_qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="text-indent: 20px;">Demikian untuk menjadi Perhatiannya dan atas kerjasamanya yang baik, Kami ucapkan
            Terimakasih.</p>

        <table style="width: 100%;" class="text-center mt-3">
            <tbody>
                <tr>
                    <td style="width:50%;">
                    </td>
                    <td style="width:50%;">
                        <p class="mb-5">PELAKSANA KEGIATAN</p>
                        <br>
                        <p class="mt-5"> {{ $data_belanja->nama_pelaksana_kegiatan }}
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        </p>

        <div class="page-break"></div>
        <h5 class="text-center mt-3 mb-3 berita_acara"><u>BERITA ACARA PEMERIKSAAN BARANG</u></h5>
        <p class="alamat text-center" style="margin-top: -10px">Alamat: Jl. Industri No.65 Desa Tarikolot Citereup Bogor
            16810 Telp. (021)
            87943708></p>
        <p class="text-wrap" style="margin-top: 2em; text-indent: 20px;">Pada hari ini, {{ $tanggal_hari_ini }}, Kami
            yang
            bertandatangan dibawah ini:</p>

        <div class="container">
            <table style="width: 100%;" class="">
                <tbody>
                    <tr>
                        <td>
                            <ol>
                                <li>Nama : {{ $data_pemeriksa->nama }}</li>
                                @foreach ($data_anggota_pemeriksa as $i)
                                    <li>Nama : {{ $i->nama }}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td>
                            <ul style="list-style: none;">
                                <li>Jabatan : {{ $data_pemeriksa->jabatan }}</li>
                                @foreach ($data_anggota_pemeriksa as $i)
                                    <li>Jabatan : {{ $i->jabatan }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <p style="text-indent: 20px;">Berdasarkan Surat Keputusan Kepala Desa Tarikolot Nomor
            {{ $data_pemeriksa->nomor }} Tahun 2024 tanggal {{ $date_pemeriksa }}
            tentang Penetapan Tim Pemeriksa Pekerjaan/Penerima Barang/Jasa Desa Tarikolot Tahun 2024, Kami selaku Tim
            Pemeriksa Pekerjaan/Penerima Barang/Jasa telah melaksanakan Pemeriksaan Barang yang diserahkan oleh:
            {{ $data->first()->nama_toko }}</p>
        <br>
        <p style="text-indent: 20px;">Berdasarkan Surat Pesanan Nomor {{ $data_belanja->no_pesanan_brg }} tanggal
            {{ $date_pesanan }},
            hasil pemeriksaan tersebut Kami simpulkan terhadap barang yang kondisinya Baik Kami beri kalimat Ya,
            sedangkan
            barang yang kondisinya Tidak Baik/Rusak/Tidak Sesuai Dengan Pesanan kami beri kalimat Tidak.</p>
        <table class="table table-bordered text-center vw-100 mw-100 mt-3">
            <thead>
                <tr>
                    <th scope="col" rowspan="2" class="text-center">No</th>
                    <th scope="col" rowspan="2" class="text-center">Nama Barang</th>
                    <th scope="col" rowspan="2" class="text-center">Banyaknya</th>
                    <th scope="col" colspan="2" class="text-center">Kondisi</th>

                </tr>


            </thead>
            <tbody>
                <tr>
                    <th>Baik</th>
                    <th>Tidak Baik</th>
                </tr>
                @php $i=1 @endphp
                @foreach ($data_barang as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->volume_qty }}</td>
                        <td><span>Ya</span></td>
                        <!-- Simbol ceklis (√) -->
                        <td><span>Tidak</span></td> <!-- Simbol silang (✗) -->
                        <!-- Tambahkan kolom "Baik" dan "Tidak Baik" sesuai dengan kebutuhan -->
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="text-indent: 20px;">Demikan Berita Acara Pemeriksaan Barang ini Kami buat pada hari dan tanggal
            tersebut diatas.</p>

        <div class="mt-3">
            <table style="width: 100%;" class="text-center">
                <tbody>
                    <tr>
                        <td style="width:50%;">
                            <p>REKANAN</p>
                            <p>{{ $data_belanja->nama_toko }}</p>
                            <br>
                            <p style="margin-top: 5em">{{ $data_belanja->pemilik_toko }}</p>
                        </td>
                        <td style="width:50%;">
                            <p class="">PANITIA PEMERIKSA BARANG</p>
                            <p></p>
                            <ol class="mt-3">
                                <<li>Nama : {{ $data_pemeriksa->nama }} (................)</li>
                                    @foreach ($data_anggota_pemeriksa as $i)
                                        <li>Nama : {{ $i->nama }} (................)</li>
                                    @endforeach
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>
        <h5 class="text-center mt-3 mb-3 berita_acara"><u>BERITA ACARA SERAH TERIMA BARANG</u></h5>
        <p class="alamat text-center" style="margin-top: -10px">Alamat: Jl. Industri No.65 Desa Tarikolot Citereup Bogor
            16810 Telp. (021)
            87943708></p>

        <p style="text-indent: 20px; margin-top:2em;">Pada hari ini, {{ $tanggal_hari_ini }}, Kami yang
            bertandatangan dibawah ini:</p>

        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <ol type="i">
                            <li>Nama : {{ $data_belanja->pemilik_toko }} </li>
                            <p>Jabatan : Perwakilan {{ $data_belanja->nama_toko }} </p>
                            <p>Alamat : {{ $data_belanja->alamat }} </p>
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="text-indent: 20px;">Dalam hal ini bertindak untuk dan atas nama {{ $data->first()->nama_toko }}
            selaku
            Penjual/Penyedia barang yang selanjutnya
            disebut sebagai PIHAK PERTAMA.</p>

        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <ol type="i" start="2">
                            <li>Nama : {{ $data_pemeriksa->nama }} </li>
                            <p>Jabatan : {{ $data_pemeriksa->jabatan }} </p>
                            <p>Alamat : {{ $data_pemeriksa->alamat }}</p>
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="text-indent: 20px;">Dalam hal ini bertindak untuk dan atas nama Tim Pemeriksa Pekerjaan/Penerima
            Barang/Jasa Kegiatan Penyuluhan
            dan Pelatihan Pendidikan Bagi Masyarakat Sumber Dana
            Rp.{{ number_format($data_belanja->dana_desa, 0, ',', '.') }} Desa Tarikolot selaku Pemesan/Pembeli/
            Pengguna Barang yang selanjutnya disebut sebagai PIHAK KEDUA.</p>
        <br>

        <p style="text-indent: 20px;">Dengan ini PIHAK PERTAMA menyerahkan Bahan Baku/Material/Barang untuk Kegiatan
            Penyuluhan dan Pelatihan
            Pendidikan Bagi Masyarakat Sumber Dana Rp.{{ number_format($data_belanja->dana_desa, 0, ',', '.') }} Desa
            Tarikolot kepada PIHAK KEDUA dan PIHAK KEDUA menerima
            sebagai berikut:</p>

        <table class="table table-bordered text-center vw-100 mw-100 mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Banyaknya</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($data_barang as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->volume_qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p style="text-indent: 20px;">Demikan Berita Acara Serah Terima Barang ini dibuat sebagai Bukti yang Sah dan
            mempuyai kekuatan hukum yang
            sama bagi PIHAK PERTAMA dan PIHAK KEDUA.</p>
        <div class="mt-3">
            <table class="text-center">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <p>PIHAK KEDUA</p>
                            <p>Yang menerima</p>
                            <p>KETUA TIM PEMERIKSA PEKERJAAN/PENERIMAAN BARANG/JASA</p>
                            <p style="margin-top: 5em">{{ $data_pemeriksa->nama }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p>PIHAK PERTAMA</p>
                            <p>Yang menyerahkan</p>
                            <p>{{ $data_belanja->nama_toko }}</p>
                            <p style="margin-top: 8em">{{ $data_belanja->pemilik_toko }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Include Bootstrap JS (optional) -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>


</body>

</html>
