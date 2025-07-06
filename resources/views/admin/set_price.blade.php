@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">

            <div class="col-lg-4">
                <div class="card card-block card-stretch custom-scroll">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="caption">
                            <h4 class="font-weight-bold mb-2">Update Coin Price</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <small>Current Price </small>
                            <h4 class="fw-bold">1 USDT = {{ $coin->price }} nxt</h4>
                            <hr>
                        </div>

                        <form action="/admin/set_price" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Coin Price equivalent to 1 USDT</label>
                                <input type="number" step="any" name="price" class="form-control"
                                    placeholder="Enter Coin Price">
                            </div>

                            <div class="mt-2 d-flex justify-content-end ">
                                <button class="btn btn-sm  btn-primary">Update Price</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="card card-block card-stretch custom-scroll">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="caption">
                            <h6 class="font-weight-bold text-sm mb-2">Change Receving Wallet Address</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <small>Current Address </small>
                            <h6 class="fw-bold"> {{$coin->wallet_address}} </h6>
                            <hr>
                        </div>

                        <form action="/admin/set_wallet" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">New Address</label>
                                <input type="text" name="wallet_address" class="form-control"
                                    placeholder="Enter wallet address">
                            </div>

                            <div class="mt-2 d-flex justify-content-end ">
                                <button class="btn btn-sm  btn-primary">Update Wallet</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">Price chnages</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">Amount</th>
                                            <th scope="col" class="border-0">Set By</th>
                                            <th scope="col" class="border-0">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($price_changes as $price)
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    {{ $price->price }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $price->user->username }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $price->created_at }}
                                                </td>
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
