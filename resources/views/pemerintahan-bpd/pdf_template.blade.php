<!-- resources/views/pdf/pdf_template.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemerintahan BPD as PDF</title>
    <!-- Add any additional CSS styling if needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <!-- Customize the PDF layout as needed -->
    <header style="text-align: center; margin-bottom: 20px;">
        <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo Sawitri" height="50">
        <h5>PEMERINTAH KABUPATEN BOGOR</h5>
        <p>Alamat: Jl. Industri No.65 Desa Tarikolot Citereup Bogor 16810 Telp. (021) 87943708</p>
        <p>Website: <a href="http://www.tarikolot-citereup.desa.id">http://www.tarikolot-citereup.desa.id</a></p>
        <p>Email: <a href="mailto:desatarikolotsawitri@gmail.com">desatarikolotsawitri@gmail.com</a></p>
        <hr style="height:2px; border-width:0; color:black; background-color:black">

    </header>
    

    <table class="table table-bordered text-center vw-100">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Telepon</th>
                <th scope="col">No SK</th>
                <th scope="col">Tanggal SK</th>





                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->jabatan }}</td>
                    <td>{{ $row->tmpt_lahir }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>{{ $row->no_telepon }}</td>
                    <td>{{ $row->no_sk }}</td>
                    <td>{{ $row->tgl_sk }}</td>






                    <!-- Add other columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer style="text-align: center; margin-top: 20px;">
        <hr style="height:2px; border-width:0; color:black; background-color:black">
        <p>&copy; <?php echo date("Y");?> Your Company Name</p>
    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
