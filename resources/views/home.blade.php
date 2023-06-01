@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Youdex</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-8">
        <div class="home-slider">
            <a>
                <img src="{{asset('assets/images/banner-1.jpg')}}" />
            </a>
            <a>
                <img src="{{asset('assets/images/banner-2.jpg')}}" />
            </a>
            <a>
                <img src="{{asset('assets/images/banner-3.jpg')}}" />
            </a>
        </div>
        <div class="row carts">

            <!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <div class="d-flex">
                                <div class="flex-1">
                                    <h2><i class="ri-money-dollar-box-line"></i> Staked</h2>
                                    <h5 class="mb-3"><span class="counter_value" data-target="97450">0</span> U2 <span class="font-size-13 equal">≈ 100$</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->


            <!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <div class="d-flex">
                                <div class="flex-1">
                                    <h2><i class="ri-funds-box-line"></i> Total Profit</h2>
                                    <h5 class="mb-3"><span class="counter_value" data-target="97450">0</span> U2 <span class="font-size-13 equal">≈ 100$</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->


            <!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <div class="d-flex">
                                <div class="flex-1">
                                    <h2><i class="ri-currency-line"></i> Staked</h2>
                                    <h5 class="mb-3"><span class="counter_value" data-target="97450">0</span> U2 <span class="font-size-13 equal">≈ 100$</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div class="card">
            <div class="card-body p-0">
                <div class="p-4">
                    <div class="d-flex">
                        <div class="flex-1">
                            <h2 class="mb-4"><i class="ri-login-box-line"></i> Join with U2 stake programs</h2>
                            <div class="row">
                                <div class="col-xl-6 col-sm-6">
                                    <h5 class="mb-4">Stake amount</h5>
                                    <form>
                                        <input type="number" class="form-control" placeholder="Min (0,001)" />
                                        <h6>(max: 100$)</h6>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <input type="radio" name="months" id="months6" />
                                                <label for="months6">6 Months</label>
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="months" id="months12" />
                                                <label for="months12">6 Months</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-soft-success btn-md mt-4">Stake now</button>
                                    </form>
                                </div>
                                <div class="col-xl-6 col-sm-6">
                                    <h5 class="mb-4">Stake details</h5>
                                    <div class="row profits">
                                        <h6 class="col-xl-6 col-sm-6">Profit period: daily</h6>
                                        <h6 class="col-xl-6 col-sm-6">Duration: 6 month</h6>
                                    </div>
                                    <div class="row mt-4 profits">
                                        <div class="col-xl-6 col-sm-6">
                                            <i class="ri-calendar-event-line"></i>
                                            <h5>Daily profit</h5>
                                            <p>100 U2 <span class="font-size-13" style="opacity: .8">≈ 100$</span></p>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <i class="ri-calendar-check-line"></i>
                                            <h5>Total profit</h5>
                                            <p>100 U2 <span class="font-size-13" style="opacity: .8">≈ 100$</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end cardbody -->
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Latest Transactions</h4>
                <div class="table-responsive">
                    <table class="table table-centered border table-nowrap mb-0"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>Customer ID</th>
                                <th>Billing Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <!-- end tr -->
                        </thead>
                        <!-- end thead -->
                        <tbody>
                            <tr>
                                <td>
                                    #DD4951
                                    <p class="text-muted mb-0 font-size-11">24-03-2021</p>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <img src="assets/images/users/avatar-1.jpg"
                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                        </div>
                                        <div>
                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                    class="text-dark">Julia Fox</a>
                                            </h5>
                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                Grenada</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <h6 class="mb-1 font-size-13">$32,960</h6>
                                    <p class="text-success text-uppercase  mb-0 font-size-11"><i
                                            class="mdi mdi-circle-medium"></i>paid</p>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">Stock</h6>
                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546881</p>
                                </td>
                                <td>
                                    <ul class="d-flex list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                    </ul>
                                </td>

                                <td style="width: 134px">
                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                            class="mdi mdi-arrow-right ms-1"></i></div>
                                </td>
                            </tr>
                            <!-- end /tr -->
                            <tr>
                                <td>
                                    #DD4952
                                    <p class="text-muted mb-0 font-size-11">25-03-2021</p>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <img src="assets/images/users/avatar-2.jpg"
                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                        </div>
                                        <div>
                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                    class="text-dark">Max Jazz</a>
                                            </h5>
                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                Vatican City</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">$30,785</h6>
                                    <p class="text-success text-uppercase mb-0 font-size-11"><i
                                            class="mdi mdi-circle-medium "></i>paid</p>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">Out of Stock</h6>
                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546882</p>
                                </td>
                                <td>
                                    <ul class="d-flex list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                    </ul>
                                </td>

                                <td>
                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                            class="mdi mdi-arrow-right ms-1"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- end /tr -->
                            <tr>
                                <td>
                                    #DD4953
                                    <p class="text-muted mb-0 font-size-11">26-03-2021</p>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <img src="assets/images/users/avatar-3.jpg"
                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                        </div>
                                        <div>
                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                    class="text-dark">Jems Clarence</a>
                                            </h5>
                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                Grenada</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">$19,191</h6>
                                    <p class="text-warning text-uppercase  mb-0 font-size-11"><i
                                            class="mdi mdi-circle-medium"></i>Pending</p>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">Stock</h6>
                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546883</p>
                                </td>
                                <td>
                                    <ul class="d-flex list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                    </ul>
                                </td>
                                <td>
                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                            class="mdi mdi-arrow-right ms-1"></i>
                                    </div>
                                </td>

                            </tr>
                            <!-- end /tr -->
                            <tr>
                                <td>
                                    #DD4954
                                    <p class="text-muted mb-0 font-size-11">27-03-2021</p>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <img src="assets/images/users/avatar-4.jpg"
                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                        </div>
                                        <div>
                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                    class="text-dark">Prezy Summa</a>
                                            </h5>
                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                Maldivse</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">$34,450</h6>
                                    <p class="text-success text-uppercase mb-0 font-size-11"><i
                                            class="mdi mdi-circle-medium "></i>paid</p>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">Out of Stock</h6>
                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546884</p>
                                </td>
                                <td>
                                    <ul class="d-flex list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                    </ul>
                                </td>
                                <td>
                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                            class="mdi mdi-arrow-right ms-1"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- end /tr -->
                            <tr>
                                <td>
                                    #DD4955
                                    <p class="text-muted mb-0 font-size-11">29-03-2021</p>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <img src="assets/images/users/avatar-5.jpg"
                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                        </div>
                                        <div>
                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                    class="text-dark">Julia Fox</a>
                                            </h5>
                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                Glory
                                                Road</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">$24,450</h6>
                                    <p class="text-danger text-uppercase mb-0 font-size-11"><i
                                            class="mdi mdi-circle-medium"></i>Canceled</p>
                                </td>
                                <td>
                                    <h6 class="mb-1 font-size-13">Stock</h6>
                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546885</p>
                                </td>
                                <td>
                                    <ul class="d-flex list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                        <li class="list-inline-item">
                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                <span class="avatar-title bg-transparent text-body">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <!-- end li -->
                                    </ul>
                                </td>
                                <td>
                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                            class="mdi mdi-arrow-right ms-1"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- end /tr -->
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
                <h2 class="mb-4"><i class="ri-wallet-line" style="color: #7578f9"></i> Assets</h2>
                @foreach ($assets as $i => $asset)
                    <h3 c>{!! num_view_html($asset->balance) !!} <span class="asset_currency">≈  {{ $asset->convertBalance()}}$</span></h3>
                    <h4 class="asset_name"><i class="youdex-font-{{strtolower($asset->token->token_name)}} asset-icon"></i>  {{$asset->token->token_name}}</h4>
                    @if($i !== ( count($assets) - 1))  <div class="line mb-4"></div>@endif
                @endforeach
                
                <a class="btn btn-soft-primary btn-md mt-4" href=" {{route('assets.manage')}} ">Manage<i class="mdi mdi-arrow-right ms-1"></i></a>

            </div>
        </div>
        <div class="card">
            <div class="card-body exchange">
                <h2 class="mb-4"><i class="ri-exchange-line" style="color: #7578f9"></i> Exchange</h2>

                <form>
                    <div>
                        <h5>U2 Amount</h5>
                        <input type="number" class="form-control" placeholder="Min (0,001)" />
                        <h6>(max: 100$)</h6>
                    </div>
                    <div class="icon">
                        <i class="youdex-font-switch-38"></i>
                    </div>
                    <div>
                        <h5>USDT Amount</h5>
                        <input type="number" class="form-control" placeholder="Min (0,001)" />
                        <h6>(max: 100$)</h6>
                    </div>
                    <div class="detail mt-5">
                        <h5>Order Details</h5>
                        <h6><span>Fee amount:</span> 0</h6>
                        <h6><span>Total:</span> 0</h6>
                    </div>
                    <button type="submit" class="btn btn-soft-success btn-md mt-4">Buy</button>
                    <button type="submit" class="btn btn-soft-danger btn-md mt-4">Sell</button>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-body exchange">
                <h2 class="mb-4"><i class="ri-qr-scan-2-line" style="color: #7578f9"></i> Invite to earn</h2>

                <div class="qr">
                    <img src="https://www.kaspersky.com.tr/content/tr-tr/images/repository/isc/2020/9910/a-guide-to-qr-codes-and-how-to-scan-qr-codes-2.png" />
                </div>

                <button onclick="copy()" type="submit" class="btn btn-soft-primary btn-md mt-4">Copy link</button>

            </div>
        </div>


    </div>
    <!-- end col -->
</div>

@endsection