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
    <div class="row">
        <div class="col">
            <div class="d-flex flex-row">
                {{-- <img src="{{ asset('/assets/images/logo.png') }}" alt="">                  <h3>fefwef</h3> --}}
            </div>
        </div>
    </div>

    <hr style="height:2px;border-width:0;color:black;background-color:black">
    <table class="table table-bordered text-center vw-100">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col" >Jabatan</th>
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

    <p>Custom PDF Footer</p>
</body>

</html>
