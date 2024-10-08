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
            margin-right: 6%;
            margin-left: 64px;
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

        .signature-list {
            display: flex;
            flex-direction: column;
            list-style-type: none;
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



        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: left; width:50%">
                        <p>Nomor<span style="margin-left: 30px"> :<span> {{ $data_belanja->no_berita_acara }}</p>
                        <p style="margin: 0;">Lampiran <span style="margin-left: 15px"> :<span>
                                    {{ $data_belanja->lampiran }} </p>
                        <p>Perihal<span style="margin-left: 30px"> :<span> {{ $data_belanja->perihal }}</p>
                    </td>

                    <td style="width:50%;">
                        <p style="margin-left: 10em;">Tarikolot , {{ $date_pesanan }}</p>
                        <p style="margin-left: 10em;">Kepada</p>
                        <p style="margin-left: 8em;">Yth. {{ $data_belanja->nama_toko }}</p>
                        <p style="margin-left: 10em;">Di</p>
                        <p style="margin-left: 10em;">____Tempat____</p>
                    </td>
                </tr>
            </tbody>
        </table>



        <p class="text-justify" style="margin-top: 2em; text-indent: 20px; margin-left:7em;  text-align:justify;">Untuk
            kebutuhan Pelaksanaan Kegiatan
            {{ $data_belanja->nama_rincian_spp }} Sumber Dana
            {{ $data_belanja->dana_desa }} di wilayah Desa
            Tarikolot Kecamatan
            Citeureup Kabupaten Bogor, dengan ini Kami
            sebagai Pelaksana Kegiatan memesan Barang dengan rincian sebagai berikut:
        </p>

        <table class="table table-bordered text-center mt-3" style="margin-left:7em; width:87%;">
            <thead>
                <tr>
                    <th scope="col" style="width: 10%;">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Banyaknya</th>
                    <th scope="col">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($data_barang as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->volume_qty }}</td>
                        <td>{{ number_format($row->harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="text-indent: 20px; margin-left:7em;  text-align:justify;">Demikian untuk menjadi Perhatiannya dan atas
            kerjasamanya yang baik, Kami ucapkan
            Terimakasih.</p>

        <table style="width: 100%; margin-left:7em;" class="text-center mt-3">
            <tbody>
                <tr>
                    <td style="width:50%;">
                    </td>
                    <td style="width:50%; margin-top:20em;">
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
        <p class="alamat text-center" style="margin-top: -10px">{{ $data_belanja->no_berita_acara_pemeriksaan }}</p>
        <p class="text-wrap" style="margin-top: 2em; text-indent: 20px;">Pada hari ini,
            {{ $date_pemeriksa_hari }} Tanggal {{ $date_pemeriksa_text_day }} Bulan {{ $date_pemeriksa_text_month }}
            Tahun {{ $date_pemeriksa_text_year }} , Kami
            yang
            bertandatangan dibawah ini:</p>

        <div class="">
            <table style="width: 100%;" class="">
                <tbody>
                    <tr>
                        <td style="width: 50%">
                            <ol>
                                <li>Nama : {{ $data_pemeriksa->nama }}</li>
                                @foreach ($data_anggota_pemeriksa as $i)
                                    <li>Nama : {{ $i->nama }}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td style="width: 50%">
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
        <p style="text-indent: 20px; text-align:justify;">Berdasarkan Surat Keputusan Kepala Desa
            Tarikolot Nomor
            {{ $data_pemeriksa->nomor }} Tahun 2024 tanggal {{ $date_pemeriksa }}
            tentang Penetapan Tim Pemeriksa Pekerjaan/Penerima Barang/Jasa Desa Tarikolot Tahun 2024, Kami selaku Tim
            Pemeriksa Pekerjaan/Penerima Barang/Jasa telah melaksanakan Pemeriksaan Barang yang diserahkan oleh:
            {{ $data->first()->nama_toko }}</p>
        <br>
        <p style="text-indent: 20px; text-align:justify;">Berdasarkan Surat Pesanan Nomor
            {{ $data_belanja->no_pesanan_brg }} tanggal
            {{ $date_pesanan }},
            hasil pemeriksaan tersebut Kami simpulkan terhadap barang yang kondisinya Baik Kami beri kalimat Ya,
            sedangkan
            barang yang kondisinya Tidak Baik/Rusak/Tidak Sesuai Dengan Pesanan kami beri kalimat Tidak.</p>

        <table class="table table-bordered text-center vw-100 mw-100 mt-3">
            <thead>
                <tr class="">
                    <th style="padding:-10em;" scope="col" rowspan="2" class="text-center">No</th>
                    <th style="padding:-10em;" scope="col" rowspan="2" class="text-center">Nama Barang</th>
                    <th style="padding:-10em;" scope="col" rowspan="2" class="text-center">Banyaknya</th>
                    <th style="" scope="col" colspan="2" class="text-center">Kondisi</th>
                </tr>

                <tr class="">
                    <th>Baik</th>
                    <th>Tidak Baik</th>
                </tr>
            </thead>
            <tbody>
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

        <p style="text-indent: 20px; text-align:justify;">Demikan Berita Acara Pemeriksaan Barang ini
            Kami buat pada hari dan tanggal
            tersebut diatas.</p>

        <div class="mt-3" style="width: 100%;" class="text-center">
            <table>
                <tbody>
                    <tr>
                        <td style="width: 50%" class="text-center">
                            <p>REKANAN</p>
                        </td>
                        <td style="width: 50%" class="text-center">
                            <p>PANITIA PEMERIKSA BARANG</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%; margin-top:-2em;" class="text-center">
                <tbody>
                    <tr>
                        <td style="width:50%;" class="text-center">
                            <p>{{ $data_belanja->nama_toko }}</p>
                            <br>
                            <p style="margin-top: 5em">{{ $data_belanja->pemilik_toko }}</p>
                        </td>
                        <td style="width:40%;">
                            <ol class="mt-3 text-left signature-list">
                                <li>
                                    <span>Nama : {{ $data_pemeriksa->nama }}</span>
                                </li>
                                @foreach ($data_anggota_pemeriksa as $i)
                                    <li>
                                        <span>Nama : {{ $i->nama }}</span>
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                        <td style="width:10%; margin-right: 10em;">
                            <br>
                            @for ($i = 0; $i <= count($data_anggota_pemeriksa); $i++)
                                <span>(................)</span>
                            @endfor
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>
        <h5 class="text-center mt-3 mb-3 berita_acara"><u>BERITA ACARA SERAH TERIMA BARANG</u></h5>
        <p class="alamat text-center" style="margin-top: -10px">{{ $data_belanja->no_berita_acara }}</p>

        <p style="text-indent: 20px; margin-top:2em;">Pada hari ini,
            {{ $date_pemeriksa_hari }} Tanggal {{ $date_pemeriksa_text_day }} Bulan {{ $date_pemeriksa_text_month }}
            Tahun {{ $date_pemeriksa_text_year }} , Kami
            yang
            bertandatangan dibawah ini:</p>


        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <ol type="i">
                            <li>Nama <span style="margin-left: 34px"> :<span> {{ $data_belanja->pemilik_toko }} </li>
                            <p>Jabatan <span style="margin-left: 25px"> :<span> Perwakilan
                                        {{ $data_belanja->nama_toko }} </p>
                            <p>Alamat <span style="margin-left: 30px"> :<span> {{ $data_belanja->alamat }} </p>
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
                            <li>Nama <span style="margin-left: 34px"> :<span> {{ $data_pemeriksa->nama }} </li>
                            <p>Jabatan <span style="margin-left: 25px"> :<span> {{ $data_pemeriksa->jabatan }} Tim
                                        Pemeriksa Pekerjaan/Penerima Barang/Jasa </p>
                            <p>Alamat <span style="margin-left: 30px"> :<span> {{ $data_pemeriksa->alamat }}</p>
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="text-indent: 20px; text-align:justify;">Dalam hal ini bertindak untuk dan atas nama Tim Pemeriksa
            Pekerjaan/Penerima
            Barang/Jasa Kegiatan Penyuluhan
            dan Pelatihan Pendidikan Bagi Masyarakat Sumber Dana
            {{ $data_belanja->dana_desa }} Desa Tarikolot selaku Pemesan/Pembeli/
            Pengguna Barang yang selanjutnya disebut sebagai PIHAK KEDUA.</p>
        <br>

        <p style="text-indent: 20px; text-align:justify;">Dengan ini PIHAK PERTAMA menyerahkan Bahan
            Baku/Material/Barang untuk Kegiatan
            Penyuluhan dan Pelatihan
            Pendidikan Bagi Masyarakat Sumber Dana {{ $data_belanja->dana_desa }} Desa
            Tarikolot kepada PIHAK KEDUA dan PIHAK KEDUA menerima
            sebagai berikut:</p>

        <table class="table table-bordered text-center vw-100 mw-100 mt-3">
            <thead>
                <tr>
                    <th scope="col" style="width: 10%;">No</th>
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
        <p style="text-indent: 20px; text-align:justify;">Demikan Berita Acara Serah Terima Barang ini dibuat sebagai
            Bukti yang Sah dan
            mempuyai kekuatan hukum yang
            sama bagi PIHAK PERTAMA dan PIHAK KEDUA.</p>
        <div class="mt-3">
            <table class="text-center">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <p>PIHAK KEDUA</p>
                            <p>Yang menerima</p>
                            <p class="text-uppercase">Tim Pemeriksa Pekerjaan/Penerima Barang/Jasa </p>
                            <p class="text-uppercase">{{ $data_pemeriksa->jabatan }}</p>
                            <p style="margin-top: 8em;">{{ $data_pemeriksa->nama }}</p>
                        </td>
                        <td style="width: 50%;">
                            <p>PIHAK PERTAMA</p>
                            <p>Yang menyerahkan</p>
                            <p>{{ $data_belanja->nama_toko }}</p>
                            <p style="margin-top: 11em;">{{ $data_belanja->pemilik_toko }}</p>
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
