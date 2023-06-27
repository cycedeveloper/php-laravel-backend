@extends('layouts.app')

@section('title', 'Withdraw Confirm')

@section('content')

<div class="row">
    
    <div class="col-xl-12 col-lg-12 col-sm-12 mb-5">
        

        <form method="POST" action="{{ route('withdrawalFiat.store') }}">
            @csrf
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h5 class="card-title mb-0">Confirm Withdraw {{$withdraw->token->token_code}} <i class="youdex-font-{{$withdraw->token->token_code}}"> </i> details</h5>
                </div>
                <div class="card-body">
                    <p>Confirm your withdrawalFiat request, details:</p>
                    <hr>

                    <ul>
                        
                        <li>Token: {{$withdraw->token->token_code}}</li>
                        <li>Recived walelt: {{$withdraw->wallet->wallet}}</li>
                        <li>Amount: {{$withdraw->amount}}</li>
                        @if ($withdraw->has_fee)
                         <li>Fee amount: {{$withdraw->fee['amount_fee']}} <small> ({{$withdraw->token->token_code}})</small></li>
                         <li>Total: {{$withdraw->fee['total']}} <small> ({{$withdraw->token->token_code}})</small></li>
                        @endif
                        
                    </ul>

                    
                    <input type="hidden" name="token_id" value="{{$withdraw->token->id}}">
                    <input type="hidden" name="user_wallet_id" value="{{$withdraw->wallet_id}}">
                    <input type="hidden" name="amount" value="{{$withdraw->amount}}">

                    
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-danger mr-2">Go back </button>
                    <button type="submit" class="btn btn-success ml-2">Confirm </button>
                    
                </div>
            </div>
        </form>


    </div>
</div>


@endsection

