<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="/assets/images/users/avatar-2.jpg" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">{{ auth()->user()->nama }}</a>
                <p class="text-body mt-1 mb-0 font-size-13">{{ auth()->user()->jabatan }}</p>

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
                                <li><a href="{{ route('pemerintahan-lpm.index') }}">Lembaga Pemberdayaan Masyarakat</a></li>
                                <li><a href="{{ route('pemerintahan-mui.index') }}">MUI (Majelis Ulama Indonesia)</a></li>
                                <li><a href="{{ route('pemerintahan-pkk.index') }}">PKK (Pemberdayaan Kesejahteraan Keluarga)</a></li>
                                <li><a href="{{ route('pemerintahan-sahbandar.index') }}">Sahbandar</a></li>
                                <li><a href="{{ route('pemerintahan-karang-taruna.index') }}">Karang Taruna</a></li>
                                <li><a href="{{ route('pemerintahan-posyandu.index') }}">Posyandu</a></li>
                            </ul>
                        </li>

                    <li><a href="{{ route('penduduk.index') }}">Data Penduduk</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-solid fa-envelope-open-text"></i>
                        <span>Surat Menyurat</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.html">Surat Kependudukan</a></li>
                        <li><a href="form-validation.html">Surat Keluar</a></li>
                    </ul>
                </li> 

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->