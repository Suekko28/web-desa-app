@extends('layouts.app')
@section('master-title','Pemerintahan Desa/')
@section('page-title','Edit')
@section('contents')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

                <form action="{{ route('pemerintahan-desa.update',$data->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')    
                    @csrf
                    <div class="card">
                        <div class="card-body">


                            <h5 class="text-center data_diri">Data Diri</h5>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="profile" class="col-form-label">Profile</label>
                                        <input type="file" class="form-control" id="profile"
                                            name="profile" placeholder="">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="name" class="col-form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama"
                                            name="nama" value="{{ $data->nama }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="jabatan" class="col-form-label">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan"
                                            name="jabatan" value="{{ $data->jabatan }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tmpt_lahir" class="col-form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tmpt_lahir"
                                            name="tmpt_lahir" value="{{ $data->tmpt_lahir}}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tgl_lahir" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir"
                                            name="tgl_lahir" value="{{ $data->tgl_lahir }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="jns_kelamin" class="col-form-label">Jenis Kelamin</label>
                                        <select class="form-control" id="jns_kelamin" name="jns_kelamin">
                                            <option value="1" @if($data->jns_kelamin == '1') selected @endif>Laki-Laki</option>
                                            <option value="2" @if($data->jns_kelamin == '2') selected @endif>Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea rows="5" type="text" class="form-control" id="alamat" name="alamat" >{{ $data->alamat }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                <a href="{{ route('pemerintahan-desa.index') }}" class="btn btn-danger">Batal</a>
                            </div>

    
    <!-- /.card-body -->
    </form>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->

@endsection