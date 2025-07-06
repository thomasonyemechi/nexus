@extends('layouts.admin02')

@section('page_content')


<style>
    footer {
        display: none;
    }
</style>
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card card-block card-stretch custom-scroll">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="caption">
                            <h6 class="font-weight-bold text-sm mb-2">Add new Wallet address</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/admin/add-wallet" method="post">

                            @csrf
                            <div class="form-group">
                                <label for="">wallet Address</label>
                                <input type="text" name="wallet_address" value="{{ old('wallet_address') }}" class="form-control"  id="">
                                @error('wallet_address')
                                    
                                    <i class="text-danger fw-bold ">{{ $message }} </i>
                                @enderror
                            </div>


                            <div class="mt-2 d-flex justify-content-end ">
                                <button class="btn btn-sm  btn-primary">Submit Address</button>
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
                                <h4 class="font-weight-bold mb-2">Wallet Addresses</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">Wallet Address</th>
                                            <th scope="col" class="border-0">Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wallets as $wallet)
                                            <tr>
                                                <td class="">
                                                    {{ $wallet->wallet_address }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $wallet->created_at }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex justify-content-end" >
                                                        <a href="/admin/delete-wallet/{{$wallet->id}}" onclick="return confirm('This wallet address will be deleted')" class=" btn btn-danger btn-sm py-0 fw-bold" > <i class="fe fe-trash" ></i> Delete </a>
                                                    </div>
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
