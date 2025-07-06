@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="card shining-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/images/coins/00.png') }}"
                                            class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                        <span class="fs-6 fw-bold me-2" style="line-height: 20px"><a href="/convert"
                                                class="text-white">{{ env('APP_NAME')  }}</a> <br>
                                            <span
                                                style="font-weight: lighter">${{ number_format(1 / $rate, 2) }}</span></span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fs-6 fw-bold me-2"
                                            style="line-height: 20px">{{ number_format($pc_balance, 2) }} NXT <br>
                                            <span style="font-weight: lighter">$
                                                {{ number_format($pc_total, 2) }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shining-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/images/coins/01.png') }}"
                                            class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                        <span class="fs-6 fw-bold me-2" style="line-height: 20px">USDT <br>
                                            <span style="font-weight: lighter">${{ number_format(1, 2) }}</span></span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fs-6 fw-bold me-2" style="line-height: 20px">
                                            {{ number_format($usdt_balance, 2) }} USDT <br>
                                            <span
                                                style="font-weight: lighter">${{ number_format($usdt_balance, 2) }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shining-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/images/coins/02.png') }}"
                                            class="img-fluid avatar avatar-30 avatar-rounded" style="width: 30px">
                                        <span class="fs-6 fw-bold me-2" style="line-height: 20px">Airdrop <br>
                                            <span style="font-weight: lighter">${{ number_format(1, 2) }}</span></span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fs-6 fw-bold me-2"
                                            style="line-height: 20px">{{ number_format($spc_balance, 2) }} SHC <br>
                                            <span
                                                style="font-weight: lighter">${{ number_format($spc_balance, 2) }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-lg-8">
                <div class="row">
                </div>
                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">Recent Transaction</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <table class="table data-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Wallet</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $trno)
                                            <tr>
                                                <td>
                                                    <span class="title fw-bold">
                                                        @if (isset($trno->user->wallet))
                                                            {{ substr($trno->user->wallet, 0, 6) . '...' . substr($trno->user->wallet, -6) }}
                                                        @else
                                                            {{ 'admin' }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
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
                                                            {{ number_format($trno->amount, 2) }} {{ $trno->currency }}

                                                        </span>
                                                    @endif
                                                </td>
                                                <td> {{ $trno->remark }} </td>
                                                <td> {{ $trno->created_at }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <div>
                            <span class="fw-bold badge mb-3" style="font-size: 20px">Recent Transfers</span>
                        </div>
                        <ul class="academy-list list-inline m-0 p-0">

                            @foreach ($credits as $credit)
                                <li>
                                    <div class="d-flex justify-content-between align-items-center rounded-pill">
                                        <img src="{{ $credit->currency == 'usdt' ? '../../assets/images/coins/01.png' : '../../assets/images/coins/00.png' }}"
                                            class="img-fluid avatar avatar-40 avatar-rounded" alt="img6">
                                        <div class="ms-3 flex-grow-1">
                                            <span class="title fw-bold">
                                                @if ($credit->user->wallet)
                                                    {{ substr($credit->user->wallet, 0, 6) . '...' . substr($credit->user->wallet, -6) }}
                                                @else
                                                    {{ $credit->user->username }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="">
                                            <p class="mb-0 text-white"> {{ number_format($credit->amount) }}
                                                {{ $credit->currency }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection