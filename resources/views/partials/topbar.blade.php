<header id="page-topbar" class="mt-2 ">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">
                <div class="dropdown d-inline-block">`
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
          
                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->


            </div>

        </div>
    </div>
</header>
