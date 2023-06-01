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

        <div class="card">
            <div class="card-body">
                <h2 class="mb-4"><i class="ri-wallet-line" style="color: #7578f9"></i> Assets</h2>
                <div class="table-responsive">
                    <table class="table table-centered border table-nowrap mb-0"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>Token</th>
                                <th>Balance</th>
                                <th>Total Deposited</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <!-- end tr -->
                        </thead>
                        <!-- end thead -->
                        <tbody>


                            @foreach ($assets as $i => $asset)
                            <tr>

                                <td>
                                    <div class="d-flex">
                                        <div class="me-3">
                           
                                                <i class="youdex-font-{{strtolower($asset->token->token_name)}}  h-auto rounded-circle asset-icon"></i>

                                        </div>
                                        <div>
                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                    class="text-white">{{$asset->token->token_name}}</a>
                                            </h5>
                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                {{$asset->token->blockchain}}</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <h6 class="mb-1 font-size-13">{!! num_view_html($asset->balance) !!}</h6>
                                    <p class="text-success text-uppercase  mb-0 font-size-11">≈  {{ $asset->convertBalance() }}$</p>
                                </td>

                                <td>
                                    <h6 class="mb-1 font-size-13">{!! num_view_html(Accounting::of('DEPOSIT',$asset->token->id,$user_id)->get())  !!}</h6>
                                </td>

                                <td style="width: 134px">
                                    <a href="{{route('withdrawal.new',['token'=>$asset->token->token_code])}}" class="btn btn-soft-success @if(!$asset->token->withdrawable) disabled @endif btn-sm">
                                          <i class="ri-logout-box-r-line"></i> Withdraw
                                    </a>

                                    <a  class="btn btn-soft-success @if(!$asset->token->withdrawable) disabled @endif  btn-sm">
                                        <i class=" ri-wallet-2-line"></i> Deposit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                        <!-- end tbody -->
                    </table>
                    <!-- end table -->
                </div>
                <!-- end tableresponsive -->
            </div>
        </div>

    </div>

    <div class="col-xl-4">

        <div class="card">
            <div class="card-body assets">
   
                
             
            </div>
        </div>


    </div>

    <!-- end col -->
</div>

@endsection