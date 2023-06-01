@extends('dexauth::auth.layouts.app')

@section('title', 'Login')

@section('content')
 <style>
.center-ani {
    display: block;
    margin: auto
}
</style>
<div class="form-login" >
    
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player class="center-ani" src="https://assets3.lottiefiles.com/packages/lf20_youawcuj.json"  background="transparent"  speed="1"  style="width: 250px; height: 250px;"  loop autoplay></lottie-player>

    <h4 class="text-center">Verify your E-mail</h4>
    <p> {{ __('Before proceeding, please check your email for a verification link.') }}</p>
    <p> {{ __('If you did not receive the email') }},</p>
    <form  method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button class="btn btn-lg btn-gradient-danger btn-block btn-rounded mb-2 mt-4" type="submit">{{ __('click here to request another') }}</button>
    </form>

    <hr>
    <p class="text-center"> <small>OR</small> </p>
    <a href="{{route('logout.app')}}" class="btn btn-lg btn-outline-dark btn-block btn-rounded mb-3">Logout</a>

</div>


@endsection