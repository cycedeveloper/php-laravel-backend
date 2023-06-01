@extends('dexauth::auth.layouts.app')

@section('title', 'Register')

@section('content')
@php $token = md5(now()); @endphp

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
                            <p class="text-muted text-center mb-4">Sign up to join to Youdex.</p>

                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                @csrf




                                <div class="mb-3">
                                    <label class="form-label" for="first_name">First name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="First name">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="last_name">Last name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last name">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="email">E-mail Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address.">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="mobile_number">Mobile no</label>
                                    <input type="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" value="{{ old('email') }}" required autocomplete="mobile_number" placeholder="Mobile no">
                                    @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-confirm">Confirm password</label>
                                    <input type="password" class="form-control @error('password-confirm') is-invalid @enderror" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                    @error('password-confirm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="referral_code">Referral Code</label>
                                    <input type="text" value="{{ session()->get('refferal_code') }}" class="form-control @error('referral_code') is-invalid @enderror" id="referral_code" name="referral_code" required autocomplete="referral_code" placeholder="Referral Code">
                                    @error('referral_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                

                                <div class="mb-3 row mt-4">
                                    <div class="col-sm-12">
                                        <div class="form-checkbox">
                                            <input type="checkbox" class="form-check-input me-1" value="remember-me" name="remember"  {{ old('remember') ? 'checked' : '' }} id="customCheck1" required>
                                            <label class="form-label" class="form-check-label" for="customCheck1">I have read and accept the   <b >user membership agreement.<b></label>
                                        </div>
                                    </div>

                                    
                                </div>
                                <!-- end row -->

                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register now</button>
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
                    <p>have an account ?<a href="{{route('login')}}" class="fw-bold text-primary"> Login Now </a></p>
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

@include('dexauth::modals.terms')


@endsection