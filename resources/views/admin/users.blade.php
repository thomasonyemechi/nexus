@extends('layouts.admin02')
@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between ">
                            <h4 class="card-title text-white">Manage Users</h4>
                            <div class="form-outline">
                                <form action="">
                                    <input type="search" name="user" class="form-control ms-1" style="width: 300px"
                                        placeholder="Search users by wallet, username.." aria-label="Search">
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            {!! isset($_GET['user'])
                                ? '<p class="mb-2 fw-bold" >Search Result for <b>" ' . $_GET['user'] . ' "</b></p>'
                                : '' !!}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <th>Wallet Address</th>
                                            <th>nxt</th>
                                            <th>USDT</th>
                                            <th>SHC</th>
                                            <th>Purchase</th>
                                            <th>Zone <br> Level </th>
                                            <th>Zone <br> Earning </th>
                                            <th>Zone <br> Balance </th>
                                            <th>Reffered By</th>
                                            <th>Last Login</th>
                                            <th>Joined</th>
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
                                                <td style="width: 80%; whitespace: wrap; "> <a class=" fw-bold text-white   "  style="width: 80%" href="#">
                                                        <span >{{ $user->wallet }} </span> </a> </td>
                                                <td>
                                                    <span class="badge bg-warning">
                                                        {{ number_format(pcBalance($user->id)) }} nxt </span>
                                                </td>
                                                <td> {{ number_format(usdtBalance($user->id)) }} USDT </td>
                                                <td> {{ number_format(spcBalance($user->id)) }} SHC </td>
                                                <td> {{ number_format(coinTotalPurchase($user->id)) }} USDT </td>
                                                <td>
                                                    @php
                                                        $slot = \App\Models\MySlot::with(['slot'])
                                                            ->where(['user_id' => $user->id])
                                                            ->orderby('id', 'desc')
                                                            ->first();

                                                    @endphp

                                                    @if ($slot)
                                                        <span class="badge py-1"
                                                            style=" background-color: {{ $slot->slot->color }}; ">Zone
                                                            {{ $slot->slot->id }}</span>
                                                    @else
                                                        <span class="badge py-1 text-danger ">No Slot</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    <span class="badge bg-success">
                                                        ${{ number_format(\App\Models\ZEarning::where(['user_id' => $user->id, 'currency' => 'usdt'])->sum('amount')) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="fw-bold">
                                                        $ {{ number_format($user->zoneUsdtBalance()) }} </span>
                                                </td>


                                                <td>


                                             
                                                    {{ ($user->sponsor > 0) ? \App\Models\User::find($user->sponsor)->wallet : 'No sponsor' }}
                                                </td>
                                                <td> {{ date('j M, Y', strtotime($user->last_login)) }} </td>

                                                <td> {{ date('j M, Y', strtotime($user->created_at)) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-between flex-wrap">
                                    {{ $users->links('pagination::bootstrap-4') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
