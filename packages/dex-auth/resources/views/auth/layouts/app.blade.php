<!DOCTYPE html>
<html lang="en">

{{-- Head Before AUTH--}}
@include('dexauth::auth.includes.head')

<body>

    @yield('content')

    {{-- Scripts Before AUTH --}}
    @include('dexauth::auth.includes.scripts')

</body>

</html>