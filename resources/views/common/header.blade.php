<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{url('')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/youdex.svg')}}" />
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/youdex.svg')}}" />
                        </span>
                    </a>

                    <a href="{{url('')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/youdex.svg')}}" />
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/images/youdex-l.svg')}}" height="45px" />
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="top-icon">
                            <i class="ri-search-line"></i>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                        {{-- <form class="p-3">
                            <div class="m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ...">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>

                <!-- full screen -->
                <div class="dropdown d-none d-lg-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <div class="top-icon">
                            <i class="mdi mdi-fullscreen"></i>
                        </div>
                    </button>
                </div>

                <!-- Notification -->
                {{--<div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="top-icon">
                            <i class="mdi mdi-bell"></i>
                        </div>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </button>
                     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small">View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-shopping-cart-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mt-0 mb-1">Your order is placed</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs"
                                        alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mt-0 mb-1">James Lemire</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">It will seem like simplified English.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="ri-checkbox-circle-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-xs"
                                        alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="dropdown d-inline-block user-dropdown">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-7.jpg')}}"
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1">Hello, {{auth()->user()->first_name}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('profile.detail') }}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                        {{-- <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a> --}}
                        {{-- <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock screen</a> --}}
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item text-danger" data-toggle="modal" data-target="#logoutModal"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</button>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <div class="top-icon">
                            <i class="mdi mdi-cog-outline mdi-spin"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->

    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">
                                <i class="ri-dashboard-line me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <i class="ri-apps-2-line me-2"></i> Exchange
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <i class="ri-stack-line me-2"></i> Stake
                            </a>
                        </li>
                        <!-- end li -->

                    </ul>
                    <!-- end ul -->
                </div>
            </nav>
            <!-- end nav -->
        </div>
    </div>
    <!-- end topnav -->











{{-- 
<header class="tabMobileView header navbar fixed-top d-lg-none">
    <ul class="navbar-nav flex-row ml-lg-auto w-100">
        <li class="nav-item dropdown user-profile-dropdown w-100">
            <div class="nav-toggle d-inline-block float-left mt-2">
                <a href="javascript:void(0);" class="nav-link sidebarCollapse d-inline-block" data-placement="bottom">
                    <i class="flaticon-menu-line-2"></i>
                </a>
                <a href="{{route('home')}}" class="ml-3"> <img src="{{asset('assets/logo/youdex.svg')}}" class="img-fluid" alt="logo"></a>
            </div>
            <a href="javascript:void(0);" class="nav-link dropdown-toggle user d-inline-block float-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_34RWGs.json"  background="transparent" speed="1" class="img-fluid mr-2"  style="width: 50px;"  loop  autoplay></lottie-player>
                    <div class="media-body align-self-center">
                        <h6 class="mb-1">Hello, {{auth()->user()->first_name}}</h6>
                        <p class="mb-0">User</p>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu p-0 mt-5" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item d-flex mt-5" href="{{ route('profile.detail') }}">
                    <i class="mr-3 flaticon-user-11"></i> <span class="align-self-center">Profile</span>
                </a>
                <a data-toggle="modal" data-target="#logoutModal" class="dropdown-item dropdown-item-btn">
                    <i class="mr-2 flaticon-power-off"></i> <span class="align-self-center">Logout</span>
                </a>
            </div>
        </li>
    </ul>
</header>



<header class="desktop-nav header navbar fixed-top">
    <div class="nav-logo mr-5 ml-4 d-lg-inline-block d-none">
        <a href="{{route('home')}}" class=""> <img src="{{asset('assets/logo/youdex.svg')}}" class="img-fluid" alt="logo"></a>
    </div>
    <ul class="navbar-nav flex-row mr-auto">
        <li class="nav-item ml-4 d-lg-none">
            <form class="form-inline search-full form-inline search animated-search" role="search">
                <i class="flaticon-search-1 d-lg-none d-block"></i>
                <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
            </form>
        </li>
    </ul>

    <ul class="navbar-nav flex-row ml-lg-auto">
        <li class="nav-item mr-5 d-lg-block d-none">
            <form class="form-inline form-inline search animated-search" role="search">
                <i class="flaticon-search-1 d-lg-none d-block"></i>
                <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
            </form>
        </li>

        <li class="nav-item dropdown user-profile-dropdown mr-5  d-lg-inline-block d-none">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_34RWGs.json"  background="transparent" speed="1" class="img-fluid mr-2"  style="width: 50px;"  loop  autoplay></lottie-player>
                    <div class="media-body align-self-center">
                        <h6 class="mb-1">Hello, {{auth()->user()->first_name}}</h6>
                        <p class="mb-0">User</p>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu  position-absolute p-0" aria-labelledby="user-profile-dropdown">
                <a class="dropdown-item mt-2 d-flex" href="{{ route('profile.detail') }}">
                    <i class="mr-3 flaticon-user-11"></i> <span class="align-self-center">Settings</span>
                </a>
                <div class="dropdown-item dropdown-item-btn d-flex justify-content-around">
                    <a class="" data-toggle="modal" data-target="#logoutModal">
                        <i class="mr-2 flaticon-power-off"></i> <span class="align-self-center">Logout</span>
                    </a>
                </div>
            </div>
        </li>


        <li class="nav-item dropdown cs-toggle ml-3 mr-lg-4"> 
            <a href="#" class="nav-link toggle-control-sidebar suffle">
                <span class="icon flaticon-log-3"></span>
            </a>
        </li>
    </ul>
</header> --}}
