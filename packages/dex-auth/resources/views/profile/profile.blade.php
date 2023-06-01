@extends('layouts.app')

@section('title', 'Profile')

@section('content')
   
<div class="row"> 

    <div class="col-xl-4 col-lg-12 col-sm-12">
        <div class="card overflow-hidden">
            <div class="text-center p-3 overlay-box " style="background-image: url({{asset('assets/images/big/img1.jpg')}});">
                <div class=" style="width:100%">
                    <svg version="1.1" style="width: 100px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
	<g>
		<path style="fill: #d56cf5" d="M437.02,74.981C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.981C26.629,123.333,0,187.62,0,256
			s26.629,132.667,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.981
			C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.981z M256,482c-60.844,0-116.142-24.177-156.812-63.419
			C121.212,351.287,184.487,305,256,305s134.788,46.287,156.813,113.582C372.142,457.823,316.844,482,256,482z M181,200
			c0-41.355,33.645-75,75-75c41.355,0,75,33.645,75,75s-33.645,75-75,75C214.645,275,181,241.355,181,200z M435.34,393.354
			c-22.07-51.635-65.404-90.869-117.777-108.35C343.863,265.904,361,234.918,361,200c0-57.897-47.103-105-105-105
			c-57.897,0-105,47.103-105,105c0,34.918,17.137,65.904,43.438,85.004c-52.374,17.481-95.708,56.715-117.778,108.35
			C47.414,355.259,30,307.628,30,256C30,131.383,131.383,30,256,30s226,101.383,226,226C482,307.628,464.586,355.259,435.34,393.354
			z"/>
	</g>
</g>
</svg>
                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_34RWGs.json"  background="transparent" speed="1" class="img-flui profile-photo"  style="width: 100px;"  loop  autoplay></lottie-player>
                </div>
                <h3 class="mt-3 h5 mb-1">{{$user->full_name}}</h3>
                <p class="mb-0">User</p>
            </div>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Registration date </span> {{auth()->user()->created_at}}	</li>
            </ul>
        </div>
    </div>

    <div class="col-xl-8 col-lg-12 col-sm-12">


        <div class="card">
            <div class="card-header">
                <h4 class="card-title h5  mb-0 ">Profile Details</h4>
            </div>
            <div class="card-body">
                <div class="basic-form mb-5">
                    

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="labels">First name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" placeholder="First name"
                                    value="{{ old('first_name') ? old('first_name') : auth()->user()->first_name }}">
    
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Last name</label>
                                <input type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name') ? old('last_name') : auth()->user()->last_name }}"
                                    placeholder="Soyad">
    
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Mobile number</label>
                                <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number"
                                    value="{{ old('mobile_number') ? old('mobile_number') : $user->mobile_number }}"
                                    placeholder="Mobile Number">
                                @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-primary profile-button" type="submit">Update</button>
                        </div>
                    </form>


                </div>

                <hr class="mb-2">

                <div class="basic-form mt-5">

                    <form action="{{ route('profile.change-password') }}" method="POST">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="labels">Change login password</label>
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Your password" required>
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="labels">New password</label>
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required placeholder="New password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Password Confirm</label>
                                <input type="password" name="new_confirm_password" class="form-control @error('new_confirm_password') is-invalid @enderror" required placeholder="Password Confirm">
                                @error('new_confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-success profile-button" type="submit">Change Password</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
        

    </div>

</div>



@endsection
