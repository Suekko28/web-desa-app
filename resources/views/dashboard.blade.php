@extends('layouts.app')

@section('navbar-admin')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <h4 class="col-6 mb-4">Jumlah Penduduk</h4>
                                <div class="d-flex">
                                <p class=" col-6 fs-30 mb-2">4006</p>
                                <img src="/images/dashboard/people.png" alt="" width="100px" height="100px" class="col-6">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                            <h4 class="col-6 mb-4">Jumlah Laki-Laki</h4>
                            <div class="d-flex">
                            <p class=" col-6 fs-30 mb-2">4006</p>
                            <img src="/images/dashboard/people.png" alt="" width="100px" height="100px" class="col-6">
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <h4 class="col-6 mb-4">Jumlah Perempuan</h4>
                                <div class="d-flex">
                                <p class=" col-6 fs-30 mb-2">4006</p>
                                <img src="/images/dashboard/people.png" alt="" width="100px" height="100px" class="col-6">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <h4 class="col-6 mb-4">Jumlah Meninggal</h4>
                                <div class="d-flex">
                                <p class=" col-6 fs-30 mb-2">4006</p>
                                <img src="/images/dashboard/people.png" alt="" width="100px" height="100px" class="col-6">
                            </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <h4 class="col-6 mb-4">Jumlah Kelahiran</h4>
                                <div class="d-flex">
                                <p class=" col-6 fs-30 mb-2">4006</p>
                                <img src="/images/dashboard/people.png" alt="" width="100px" height="100px" class="col-6">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <h4 class="col-6 mb-4">Jumlah Pindah Keluar/Masuk</h4>
                                <div class="d-flex">
                                <p class=" col-6 fs-30 mb-2">4006</p>
                                <img src="/images/dashboard/people.png" alt="" width="100px" height="100px" class="col-6">
                            </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 grid-margin stretch-card mt-4">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Usia</h4>
                            <canvas id="barChart"></canvas>
                          </div>
                        </div>
                      </div>
            
                      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card mt-4">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Pie chart</h4>
                              <canvas id="pieChart"></canvas>
                            </div>
                          </div>
                        </div> 

                        <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card mt-4">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">Pie chart</h4>
                                <canvas id="pieChart"></canvas>
                              </div>
                            </div>
                          </div> 

                          <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card mt-4">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">Pie chart</h4>
                                <canvas id="pieChart"></canvas>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card mt-4">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">Pie chart</h4>
                                <canvas id="pieChart"></canvas>
                              </div>
                            </div>
                          </div>

                          
                </div>

            </div>
            
        </div>
      
    </div>
    
@endsection