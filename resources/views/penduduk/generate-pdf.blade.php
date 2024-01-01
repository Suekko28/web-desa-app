<!-- resources/views/pdf/pdf_template.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemerintahan Melahirkan as PDF</title>
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
        <h5 class="text-center mt-3 mb-3">Data Melahirkan</h5>
        <table class="table table-bordered text-center vw-100 mw-100">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Tanggal Pindah Masuk</th>
                    <th scope="col">Tanggal Lapor</th>
                    <th scope="col">NIK</th>
                    <th scope="col">NKK</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Usia</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Agama</th>
                    <th scope="col">Warga Negara</th>
                    <th scope="col">Status Pernikahan</th>
                    <th scope="col">Dusun</th>
                    <th scope="col">RT</th>
                    <th scope="col">RW</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Pendidikan</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Kepemilikan BPJS</th>
                    <th scope="col">Kepemilikan E-KTP</th>
                    <th scope="col">Nama Ibu</th>
                    <th scope="col">Nama Ayah</th>




                    
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->tgl_pindah_masuk }}</td>
                        <td>{{ $row->tgl_lapor }}</td>
                        <td>{{ $row->NIK }}</td>
                        <td>{{ $row->NKK }}</td>
                        <td>{{ $row->tgl_lahir }}</td>
                        <td>{{ $row->usia }}</td>
                        <td>{{ $row->tempat_lahir }}</td>
                        <td>{{ $row->jenis_kelamin }}</td>
                        <td>{{ $row->agama }}</td>
                        <td>{{ $row->kewarganegaraan }}</td>
                        <td>{{ $row->status_pernikahan }}</td>
                        <td>{{ $row->dusun }}</td>
                        <td>{{ $row->RT }}</td>
                        <td>{{ $row->RW }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>{{ $row->kepemilikan_bpjs }}</td>
                        <td>{{ $row->kepemilikan_e_ktp }}</td>
                        <td>{{ $row->nama_ibu }}</td>
                        <td>{{ $row->nama_ayah }}</td>



                    </tr>
                @endforeach
            </tbody>
        </table>
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
