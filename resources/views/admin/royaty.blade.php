@extends('layouts.admin02')
@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between ">
                            <h4 class="card-title text-white">Royal Members</h4>
                            <div class="form-outline">
                                <form action="">
                                    <a href="/admin/users/credit_royalty" class="btn btn-primary">Credit Royalty</a>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <th>Wallet Address</th>
                                            <th>nxt</th>
                                            <th>USDT</th>
                                            <th>Max Purchase</th>
                                            <th class="text-end">Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($users) == 0)
                                            <tr>
                                                <td colspan="12">
                                                    <div class="alert alert-danger">
                                                        There is no content on this table
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach ($users as $user)
                                            <tr>
                                                <td> <a class=" fw-bold text-white  " href="#">
                                                        <span>{{ $user->wallet }} </span> </a> </td>
                                                <td>
                                                    <span class="badge bg-warning">
                                                        {{ number_format(pcBalance($user->id)) }} nxt </span>
                                                </td>
                                                <td> {{ number_format(usdtBalance($user->id)) }} USDT </td>
                                                <td> {{ number_format($user->purchases_max_amount) }} USDT </td>

                                                <td class="text-end"> {{ date('j M, Y', strtotime($user->created_at)) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-end flex-wrap">
                                    {{-- {{ $users->links('pagination::bootstrap-4') }} --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection