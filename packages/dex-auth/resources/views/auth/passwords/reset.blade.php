@extends('dexauth::auth.layouts.app')

@section('title', 'Forgot Password')

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
                            <h4 class="font-size-18 text-muted mt-2 text-center">Welcome!</h4>
                            <p class="text-muted text-center mb-4">Reset Password!</p>

                            @if (session('error'))
                                <span class="text-danger"> {{ session('error') }}</span>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                
                                <div class="mb-3">
                                    <label class="form-label" for="username">E-mail Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-1"><strong>Password</strong></label>
                                    <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
        
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter password">
                                </div>

                                <div class="mb-3 row mt-4">
                                    <div class="col-sm-6">
                                        <div class="form-checkbox">
                                            <input type="checkbox" class="form-check-input me-1" value="remember-me" name="remember"  {{ old('remember') ? 'checked' : '' }}
                                                id="customControlInline">
                                            <label class="form-label" class="form-check-label"
                                                for="customControlInline">Remember me</label>
                                        </div>
                                    </div>

                                    <!-- end col -->
                                    <div class="col-sm-6 text-end">
                                        <a href="{{route('password.request')}}" class="text-muted"><i
                                                class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary w-100 waves-effect waves-light"
                                            type="submit">Log In</button>
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
                    <p>Don't have an account ?<a href="{{route('register')}}" class="fw-bold text-primary"> Signup
                            Now </a></p>
                    <p>©
                        <script>document.write(new Date().getFullYear())</script> all copyrights reserved by Youdex.
                    </p>
                </div>

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>












<div class="col-md-6">
    <div class="authincation-content">
        <div class="row no-gutters">
            <div class="col-xl-12">
                <div class="auth-form">

                
                    <img src="{{ config('dex-auth-referral.logo') }}" class="logo-auth mb-3" >

                    <h4 class="text-center mb-4">Reset Password!</h4>

                    @if (session('error'))
                     <span class="text-danger"> {{ session('error') }}</span>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">


                        <div class="form-group">
                            <label class="mb-1"><strong>Email</strong></label>
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Password</strong></label>
                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
                        </div>

                        <div class="new-account mt-3">
                            <p>Already know your passwrd? <a class="text-primary" href="{{route('login')}}"> Login Here</a></p>
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
