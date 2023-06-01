<!DOCTYPE html>
<html lang="en">
@include('common.head')
<body class="default-sidebar"  data-topbar="dark" data-layout="horizontal">


    @include('common.header')

    {{-- <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

     

        <div id="content" class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div class="page-title">
                                <h3>@yield('title')</h3>
                            </div>
                        </div>
                    </div>
                </div>


    
                @yield('content')
        
            </div>
        </div>

    </div> --}}

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    
    

    @include('common.footer')

    @include('dexauth::modals.logout-modal')

    @include('common.footer-scripts')
</body>
</html>