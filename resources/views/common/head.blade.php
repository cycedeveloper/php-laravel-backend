<head>

	<meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="{{asset('assets/logo/youdex-icon.png')}}">

    <!-- jquery.vectormap css -->
    <link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/custom.css')}}" id="app-style" rel="stylesheet" type="text/css" />


    <link href="{{asset('assets/css/num.css')}}" id="app-style" rel="stylesheet" type="text/css" />


    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
	<script> 
		var siteurl = "{{url('')}}"
		function getSiteurl() { return "{{url('/')}}" }
        
	</script>

</head>