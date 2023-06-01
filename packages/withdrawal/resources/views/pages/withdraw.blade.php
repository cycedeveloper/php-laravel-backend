@extends('layouts.app')

@section('title', 'Assets')
 
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Youdex</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Assets</a></li>
                    <li class="breadcrumb-item active">List all assets</li>
                </ol>
            </div>

        </div>
    </div>
</div>


<div class="row">


    <div class="col-xl-8">


        @include('dex::alerts.status-alert')
        
        <form method="POST" action="{{ route('withdrawal.confirm') }}">
            @csrf
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h5 class="card-title mb-0">Withdraw {{$token->token_code}} <i class="youdex-font-{{ $token->token_code}}"> </i></h5>
                </div>
                <div class="card-body">
                    <p>Fill in the form below to submit a withdrawal request, Minimum withdrawal amount: ${{$min}}</p>
                    <hr>
                    @include('dex::inputs.input-with-max',['name'=>'amount','value'=>$balance->balance,'label'=>'Amount'])
 
                    <label for="user_wallet_id">Select wallet</label>    
                    <div class="input-group mb-3">
                       <select name="user_wallet_id" id="user_wallet_id" required class="form-control @error('wallet') is-invalid @enderror">
                        @foreach($userWallets as $wallet)
                            <option value="{{$wallet->id}}">{{$wallet->label}} - {{$wallet->wallet}}</option>
                        @endforeach
                       </select>

                       <button id="set-max" class="btn" data-bs-toggle="modal" data-bs-target="#walletsModal" type="button">
                        Add new wallet
                      </button>
                    </div>
                    @error('wallet')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="hidden" name="token_id" value="{{$token->id}}">

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">Withdraw</button>
                </div>
            </div>
        </form>

    </div>

    <div class="col-xl-4">

        <div class="card">
            <div class="card-body assets">
   
                
             
            </div>
        </div>


    </div>

    <!-- end col -->
</div>

@include('dex-withdrawal::modals.add-new-wallet', ['token' => $token])

@endsection