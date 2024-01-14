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
    </style>
</head>

<body>
    <header>
        <table  style="width:90%;">
            <tbody>
                <tr>
                    <td> <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo Sawitri" height="100">
                    </td>
                    <td class="text-center text_header">
                        <h1 class="pemerintahan">PEMERINTAH KABUPATEN BOGOR</h1>
                        <h1 class="kecamatan">KECAMATAN CITEREUP</h1>
                        <h1 class="desa">DESA TARIKOLOT</h1>
                        <p class="alamat">Alamat: Jl. Industri No.65 Desa Tarikolot Citereup Bogor 16810 Telp. (021)
                            87943708
                            <br>
                            Website: <a
                                href="http://www.tarikolot-citereup.desa.id">http://www.tarikolot-citereup.desa.id</a>
                            <br>
                            Email: <a href="mailto:desatarikolotsawitri@gmail.com">desatarikolotsawitri@gmail.com</a>
                        </p>
                    </td>
                </tr>
            <tbody>
        </table>
    </header>
    <hr style="height:4px;border-width:0;color:black;background-color:black" class="my-2">
    <hr style="height:2px;border-width:0;color:black;background-color:black" class="my-2">
    <main class="flex-grow-1">
        <h5 class="text-center mt-3 mb-3">Barang dan Jasa Belanja</h5>
        <table class="table table-bordered text-center vw-100 mw-100">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Volume QTY</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->volume_qty }}</td>
                        <td>{{ $row->satuan }}</td>
                        <td>{{ $row->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
        <p>1. KEPADA</p>
        <p>2. DARI</p>
        <p>3. TANGGAL</p>
        <p>4. PERIHAL</p>
        <p>5. Sehubungan telah cairnya <<Dana Desa (DD)>> dan telah siapnya Tim Pelaksana Kegiatan, dengan ini Kami sampaikan Permohonan Pencairan <<Dana Desa (DD)>> untuk kegiatan sebagai berikut:</p>
        <p>6. JABATAN, TTD, NAMA</p>
    </div>

    <!-- Lembar Disposisi -->
    <div>
        <p>LEMBAR DISPOSISI</p>
        <p>1. INPUT MANUAL</p>
    </div>

    <!-- Surat Kesanggupan Menyelesaikan Pekerjaan -->
    <div>
        <p>1. NAMA</p>
        <p>2. JABATAN</p>
        <p>3. ALAMAT</p>
        <p>4. Dengan ini menyatakan bahwa saya sebagai Pelaksana Pengelola Keuangan Desa (PPKD), akan melaksanakan kegiatan <<Peningkatan Kapasitas Badan Permusyawaratan Desa (BPD)>> yang bersumber dari <<Dana Desa (DD)>> sesuai dengan RAB dan pelaksanaannya akan mematuhi peraturan perundang–undangan yang berlaku, serta saya akan bertanggung jawab terhadap penggunaan anggaran keuangan dimaksud.</p>
        <p>5. TGL, TTD, NAMA</p>
    </div>

    <!-- Pesanan Barang -->
    <div>
        <p>Tarikolot, 04 Januari 2023</p>
        <p>Nomor: 001 / XI / 2023- SP TPK</p>
        <p>Lampiran: -</p>
        <p>Perihal: Pesanan Barang</p>
        <p>Yth. CV. SINDORO</p>
        <p>Di ___Tempat___</p>
        <p>Untuk kebutuhan Pelaksanaan Kegiatan <<Belanja Perjalanan Dinas>> yang bersumber dari <<Dana Desa (DD)>> di wilayah Desa Tarikolot Kecamatan Citeureup Kabupaten Bogor, dengan ini Kami sebagai Pelaksana Kegiatan memesan Barang dengan rincian sebagai berikut:</p>
        <!-- Tambahkan rincian pesanan barang sesuai dengan format -->
    </div>

    <!-- Berita Acara Pemeriksaan Barang -->
    <div>
        <p>Nomor: 001 / BAPB / 2023</p>
        <!-- Tambahkan rincian Berita Acara Pemeriksaan Barang sesuai dengan format -->
    </div>

    <!-- Berita Acara Serah Terima Barang -->
    <div>
        <p>Nomor: 001 / BASTB / 2023</p>
        <!-- Tambahkan rincian Berita Acara Serah Terima Barang sesuai dengan format -->
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
