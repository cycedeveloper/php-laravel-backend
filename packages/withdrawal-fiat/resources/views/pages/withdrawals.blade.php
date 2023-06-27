@extends('layouts.app')

@section('title', 'Withdraw')


@section('content')
<style>        
    .table td, .table th { border-top: 1px solid #f1f3f1; }
    .table-controls>li>a i { color: #d3d3d3; }
</style>
<div class="row">
    
    <div class="col-lg-12 col-md-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            @if(count($withdrawalFiats) > 0)
            <div class="widget-content widget-content-area p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawalFiats as $withdrawalFiat)
                            <tr>
                                <td>{{$withdrawalFiat->amount}} <small>{{$withdrawalFiat->token->token_code}}</small></td>
                                <td><span class="badge badge-{{$withdrawalFiat->status_class}} shadow-none badge-pill">{{$withdrawalFiat->status_title}}</span></td>
                                <td><span class="flaticon-clock-2"></span> {{$withdrawalFiat->created_at}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else 
            <div class="widget-content text-center pt-4 pb-4 widget-content-area">
                <lottie-player class="mt-5 center-ani"  loop  autoplay src="https://assets2.lottiefiles.com/packages/lf20_rc6CDU.json"   background="transparent" speed="1"  style="width: 270px;" ></lottie-player>

                 <h4 class="mb-5">No data yet!</h4>

                 <a href="{{route('withdrawalFiat.new',['token'=>'USDT'])}}" class="mb-2 btn btn-button-4 btn-rounded  mb-4 mr-2">Send new request</a>
            </div>
            @endif
        </div>
    </div>

</div>

@endsection