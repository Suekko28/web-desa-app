<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">

            <div class="mt-3">

                <span class="logo-lg">
                    <img src="/assets/images/logo.png" alt="Logo Sawitri" height="50">
                    <h6 class="mt-3">SAWITRI APPS</h6>
                </span>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('index') }}" class=" waves-effect">
                        <i class=" fas fa-light fa-gauge"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-solid fa-book"></i>
                        <span>Data Desa Tarikolot</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect mb-2">
                                <i class="fas fa-solid fa-building"></i>
                                <span>Data Lembaga Pemerintahan</span>
                            </a>
                            <ul class="sub-menu mb-2" aria-expanded="false">
                                <li><a href="{{ route('pemerintahan-desa.index') }}">Pemerintahan Desa</a></li>
                                <li><a href="{{ route('pemerintahan-BPD.index') }}">Badan Permusyawaratan Desa</a></li>
                                <li><a href="{{ route('pemerintahan-lpm.index') }}">Lembaga Pemberdayaan Masyarakat</a>
                                </li>
                                <li><a href="{{ route('pemerintahan-mui.index') }}">MUI (Majelis Ulama Indonesia)</a>
                                </li>
                                <li><a href="{{ route('pemerintahan-pkk.index') }}">PKK (Pemberdayaan Kesejahteraan
                                        Keluarga)</a></li>
                                <li><a href="{{ route('pemerintahan-sahbandar.index') }}">Sahbandar</a></li>
                                <li><a href="{{ route('pemerintahan-karang-taruna.index') }}">Karang Taruna</a></li>
                                <li><a href="{{ route('pemerintahan-posyandu.index') }}">Posyandu</a></li>
                                <li><a href="{{ route('pemerintahan-rt.index') }}">RT</a></li>
                                <li><a href="{{ route('pemerintahan-rw.index') }}">RW</a></li>
                                <li><a href="{{route('pemerintahan-kadus.index')}}">Kadus</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('penduduk.index') }}">Data Penduduk</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-solid fa-building"></i>
                        <span>Data Sirkulasi Desa</span>
                    </a>
                    <ul class="sub-menu mb-2" aria-expanded="false">
                        <li><a href="">Data Melahirkan</a></li>
                        <li><a href="">Data Meninggal</a></li>
                        <li><a href="">Data Pendatang</a>
                        </li>
                        <li><a href="">Data Pindah</a>
                        </li>
                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-solid fa-book-medical"></i>
                        <span>Data Sirkulasi Desa</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Data Melahirkan</a></li>
                        <li><a href="#">Data Meninggal</a></li>
                        <li><a href="#">Data Pendatang</a></li>
                        <li><a href="#">Data Pindah</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-solid fa-journal-whills"></i>
                        <span>LPJ Kegiatan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('lpj-barangjasa.index') }}">Barang dan Jasa</a></li>
                    </ul>
                </li>

                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-solid fa-envelope-open-text"></i>
                        <span>Surat Menyurat</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Surat Kependudukan</a></li>
                        <li><a href="form-validation.html">Surat Keluar</a></li>
                    </ul>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        <button type="submit" class="btn btn-l dropdown-item text-danger">
                            @csrf
                            <i class="fas fa-solid fa-right-from-bracket"></i> Logout
                    </form>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
