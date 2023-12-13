@extends('layouts.app')
@section('master-title','Dashboard / ')
@section('page-title',' Lembaga Pemberdayaan Masyarakat')
@section('contents')
                    <section class="content">
                        <div class="container-fluid">
                            <!-- Small boxes (Stat box) -->

                            <form action="{{ route('pemerintahan-desa.store') }}" method="POST" enctype="multipart/form-data">
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
                                                        name="nama" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="jabatan" class="col-form-label">Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan"
                                                        name="jabatan" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="tmpt_lahir" class="col-form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tmpt_lahir"
                                                        name="tmpt_lahir" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="tgl_lahir" class="col-form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tgl_lahir"
                                                        name="tgl_lahir" placeholder="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="jns_kelamin" class="col-form-label">Jenis Kelamin</label>
                                                    <select id="jns_kelamin" name="jns_kelamin" class="form-control" required>
                                                        <option value="1" selected>Laki-Laki</option>
                                                        <option value="2">Perempuan</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="alamat" class="col-form-label">Alamat</label>
                                                    <textarea rows="5" type="text" class="form-control" id="alamat" name="alamat" placeholder=""></textarea>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                                            <a href="{{ url('/admin/kegiatan') }}" class="btn btn-danger">Batal</a>
                                        </div>

                
                <!-- /.card-body -->
                </form>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
            </section>
@endsection