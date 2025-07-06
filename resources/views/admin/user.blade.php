@extends('layouts.admin02')
@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title text-white">Manage Client > <small> {{ $user->wallet }} </small> </h4>
                    <div class="form-outline">

                    </div>
                </div>



                <div class="card " style="box-shadow: 1px 1px rgb(239, 64, 20);">
                    <div class="card-body mb-0">

                        <h4 class="fw-bold small mb-3">Quick Actions</h4>

                        <div class="d-flex  justify-content-start pb-2 " style="overflow-x: scroll;">
                          
                            <a href="/transfer" class="btn btn-outline-secondary  me-2 action-btn " data-bs-toggle="modal"
                                data-bs-target="#depositModalToZone"> Transfer <br>
                                History</a>
                            <button class="btn btn-dark me-2 action-btn ">Check <br> Downlines</button>
                            <button class="btn btn-outline-danger me-2 withdrawal_fund action-btn ">ZONE
                                <br>Transactions</button>

                        </div>




                    </div>
                </div>



            </div>




            <div class="col-lg-6">
                <div class="card" style="box-shadow: 1px 1px #fc0;">
                    <div class="card-body">
                        <h4 class="fw-bold mt-2 mb-3">Nexus Token Overview</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <div class="">
                                                <span class="fs-1 text-white fw-bold me-2"
                                                    style="font-size: 20px">${{ number_format($total, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/images/coins/00.png') }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px"><a href="/convert"
                                                        class="text-white">{{ env('APP_NAME')  }}</a> <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format(1 / $rate, 4) }}</span></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fs-6 fw-bold me-2"
                                                    style="line-height: 20px">{{ number_format($pc_balance, 4) }} nxt
                                                    <br>
                                                    <span style="font-weight: lighter">$
                                                        {{ number_format($pc_total, 4) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/images/coins/01.png') }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px">USDT <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format(1, 2) }}</span></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px">
                                                    {{ number_format(usdtBalance($user_id), 2) }} USDT <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format($usdt_balance, 2) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/images/coins/02.png') }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px">Commission
                                                    <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format(1, 2) }}</span></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fs-6 fw-bold me-2"
                                                    style="line-height: 20px">{{ number_format($spc_balance, 2) }} SHC
                                                    <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format($spc_balance, 2) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <h6 class="fw-bold mb-2">Recent Coin Transactions</h6>



                        <div class="table-responsive shadow rounded-3">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $trno)
                                        <tr>

                                            <td>

                                                <img src="{{ $trno->currency == 'usdt' ? '../../assets/images/coins/01.png' : '../../assets/images/coins/00.png' }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" alt="">
                                                <span class="fw-bold">
                                                    @if ($trno->amount < 0)
                                                        <span class="text-danger">
                                                            <svg width="10" height="8" viewBox="0 0 8 5"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E">
                                                                </path>
                                                            </svg>
                                                            {{ number_format(abs($trno->amount), 2) }}
                                                            {{ $trno->currency }}
                                                        </span>
                                                    @else
                                                        <span class="text-success">
                                                            <svg width="10" height="8" viewBox="0 0 8 5"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42">
                                                                </path>
                                                            </svg>
                                                            {{ number_format($trno->amount, 2) }}
                                                            {{ $trno->currency }}

                                                        </span>
                                                    @endif
                                                </span>
                                            </td>

                                            <td> {{ $trno->remark }} </td>

                                            <td> {{ formatDate($trno->created_at) }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="card" style="box-shadow: 1px 1px rgb(25, 8, 148);">
                    <div class="card-body">
                        <h4 class="fw-bold mt-2 mb-3">Hybrid Zone Overview</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/images/coins/01.png') }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px"><a
                                                        href="#" class="text-white">USDT </a> <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format(1, 2) }}</span></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-bold">$
                                                    {{ number_format($user->zoneUsdtBalance(), 2) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/images/coins/00.png') }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px">Hybrid <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format(1 / $rate, 4) }}</span></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px">
                                                    {{ number_format($user->zonenxtBalance(), 3) }} nxt <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format($user->zonenxtBalance() / $rate, 2) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/images/coins/01.png') }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px"><a
                                                        href="javascript:;" class="text-white">Earnings </a> <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format(1, 2) }}</span></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-bold">$
                                                    {{ number_format(zoneEarnings($user->id), 2) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card shining-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('assets/images/coins/energy.png') }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                                <span class="fs-6 fw-bold me-2" style="line-height: 20px"><a
                                                        href="javascript:;" class="text-white">Energy </a> <br>
                                                    <span
                                                        style="font-weight: lighter">${{ number_format(1, 2) }}</span></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-bold">$
                                                    {{ number_format($user->myEnergy(), 2) }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-2">Recent Zone Transactions</h6>



                        <div class="table-responsive shadow rounded-3">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">slot</th>
                                        <th scope="col">Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wallet_transactions as $trno)
                                        <tr>

                                            <td>

                                                <img src="{{ $trno->currency == 'usdt' ? '../../assets/images/coins/01.png' : '../../assets/images/coins/00.png' }}"
                                                    class="img-fluid avatar avatar-30 avatar-rounded"
                                                    alt="">
                                                <span class="fw-bold">
                                                    @if ($trno->amount < 0)
                                                        <span class="text-danger">
                                                            <svg width="10" height="8" viewBox="0 0 8 5"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z"
                                                                    fill="#FF2E2E">
                                                                </path>
                                                            </svg>
                                                            {{ number_format(abs($trno->amount), 2) }}
                                                            {{ $trno->currency }}
                                                        </span>
                                                    @else
                                                        <span class="text-success">
                                                            <svg width="10" height="8" viewBox="0 0 8 5"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z"
                                                                    fill="#00EC42">
                                                                </path>
                                                            </svg>
                                                            {{ number_format($trno->amount, 2) }}
                                                            {{ $trno->currency }}

                                                        </span>
                                                    @endif
                                                </span>
                                            </td>

                                            <td> {{ $trno->remark }} </td>

                                            <td>
                                                @if ($trno->slot_ref > 0)
                                                    <div class="badge" style="background-color: {{ $trno->slot->color }} " >
                                                        slot {{ $trno->slot_ref }}
                                                    </div>
                                                @endif
                                            </td>

                                            <td> {{ formatDate($trno->created_at) }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
