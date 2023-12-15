<header id="page-topbar" class="mt-2">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">
                <div class="dropdown d-inline-block">`
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="/assets/images/users/avatar-2.jpg"
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ml-1">{{ auth()->user()->nama }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <form method="POST" action="{{ route('logout') }}">
                        <button type="submit" class="dropdown-item text-danger">
                            @csrf
                            <i class="bx bx-power-off font-size-16 align-middle mr-1"></i> Logout
                        </form>
                    </div>
                </div>



            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/assets/images/logo-sm.png" alt="" height="20">
                        </span>
                        <div class="logo-lg">
                            <img src="/assets/images/logo-dark.png" alt="" height="17">
                        </div>
                    </a>

                    <div class="row">
                        <div class="col">
                            <a href="index.html" class="logo logo-light d-flex text-center">
                                <span class="logo-sm">
                                    <img src="/assets/images/logo.png" alt="" height="50">
                                    <h6 class="text-white">SAWITRI APPS</h6>
                                </span>
                                <span class="logo-lg">
                                    <img src="/assets/images/logo.png" alt="Logo Sawitri" height="50">
                                    <h6 class="text-white">SAWITRI APPS</h6>
                                </span>
                            </a>
                        </div>
                    </div>
                   
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->


            </div>

        </div>
    </div>
</header>
