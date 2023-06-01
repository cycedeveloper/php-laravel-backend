@extends('dexauth::auth.layouts.app')

@section('title', 'Login')

@section('content')

<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="{{ route("home") }}" class="">
                                    <img src="{{asset('assets/images/youdex.svg')}}" alt="" height="50" class="auth-logo logo-dark mx-auto">
                                    <img src="{{asset('assets/images/youdex.svg')}}" alt="" height="50" class="auth-logo logo-light mx-auto">
                                </a>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-size-18 text-muted mt-2 text-center">Reset your password!</h4>
                            @if (session('status'))
                                <p class="text-muted text-center mb-4"> {{ session('status') }}</p>
                            @endif
                            

                            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="email">E-mail Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary w-100 waves-effect waves-light"
                                            type="submit">Reset password</button>
                                    </div>
                                </div>
                                <!-- end row -->
                          
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
                <div class="mt-5 text-center">
                    <p>I'dont need. back to<a href="{{route('login')}}" class="fw-bold text-primary"> Login</a></p>
                    <p>©
                        <script>document.write(new Date().getFullYear())</script> All copyrights reserved by Youdex.
                    </p>
                </div>

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>

@endsection