{{-- Message --}}
@if (Session::has('status') && Session::get('status') == 'success')
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Success !</strong> {{ session('message') }}
    </div>
@endif

@if (Session::has('status')  && Session::get('status') == 'error')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Error !</strong> {{ session('message') }}
    </div>
@endif