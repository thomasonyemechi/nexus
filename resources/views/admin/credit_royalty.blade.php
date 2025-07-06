@extends('layouts.admin02')

@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card card-block card-stretch custom-scroll">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="caption">
                            <h6 class="font-weight-bold text-sm mb-2">Credit User Royalty</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/admin/credit" method="post">

                            @csrf

                            <div class="alert alert-warning">
                                Credit user's wallet with Nexus Token or USDT
                            </div>


                            <div class="form-group">
                                <label for="">Credit Type <span class="text-danger">*</span></label>
                                <select name="type" class="form-control" id="">
                                    <option value="royalty">Royalty Credit </option>
                                </select>
                                @error('type')
                                    <i class="text-danger fw-bold ">{{ $message }} </i>
                                @enderror



                                <div class="alert type_dis alert-info mt-2">

                                </div>


                            </div>



                            <div class="form-group">
                                <label for="">Currency <span class="text-danger">*</span></label>
                                <select name="currency" class="form-control" id="">
                                    <option value="nxt"> Nexus Token (nxt) </option>
                                    <option value="usdt"> USDT (USDT) </option>
                                </select>
                                @error('currency')
                                    <i class="text-danger fw-bold ">{{ $message }} </i>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="">Wallet Address <span class="text-danger">*</span> </label>
                                <input type="text" name="wallet_address" class="form-control"
                                    value="{{ old('wallet_address') }}" placeholder="Enter user's wallet address">
                                @error('wallet_address')
                                    <i class="text-danger fw-bold ">{{ $message }} </i>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="">Amount <span class="text-danger">*</span></label>
                                <input type="number" name="amount" step="any" class="form-control"
                                    value="{{ old('amount') }}" placeholder="Amount to send ">
                                @error('amount')
                                    <i class="text-danger fw-bold ">{{ $message }} </i>
                                @enderror
                            </div>



                            <div class="form-group">
                                <div class="d-flex justify-content-between ">
                                    <label for="">Remark</label>
                             
                                </div>
                                <input type="text" name="remark" class="form-control" value="{{ old('remark') }}"
                                    placeholder="Describe this transaction">
                                @error('remark')
                                    <i class="text-danger fw-bold ">{{ $message }} </i>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="">Confirm Access Pin</label>
                                <input type="password" name="access_pin" class="form-control"
                                    value="{{ old('access_pin') }}" placeholder="******">
                                @error('access_pin')
                                    <i class="text-danger fw-bold ">{{ $message }} </i>
                                @enderror
                            </div>



                            <div class="mt-2 d-flex justify-content-end ">
                                <button class="btn btn-sm  btn-secondary">Credit Rotalty</button>
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
                                <h4 class="font-weight-bold mb-2">Royalty Payment History</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="border-0">Amount</th>
                                            <th scope="col" class="border-0">Wallet Address</th>
                                            <th scope="col" class="border-0">Remark</th>
                                            <th scope="col" class="border-0">By</th>
                                            <th scope="col" class="border-0 text-end">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($credits as $credit)
                                            <tr>
                                                <td class="align-middle text-success border-top-0">
                                                    {{ number_format($credit->amount, 2) }}
                                                    {{ $credit->currency }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $credit->user->wallet ?? $credit->user->username }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $credit->remark }}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    {{ $credit->admin->username }}
                                                </td>
                                                <td class="align-middle border-top-0 text-end">
                                                    {{ $credit->created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3 ">
                                {{ $credits->links('pagination::bootstrap-4') }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection


    @push('scripts')
        <script>
            $(function() {
                $('body').on('click', '.fill_me', function() {
                    text = $(this).html();
                    $('input[name="remark"]').val(text);
                })

                function doType() {
                    val = $('select[name="type"]').val();
                    dis = $('.type_dis');
                    if (val == 'normal') {
                        dis.html(
                            `User will be credit in default currency and uplines will receive the referral bonus`)
                    } else {
                        dis.html(`User wil be credited in selected curency and no referral payment will be made`);
                    }
                }


                $('select[name="type"]').on('change', function() {
                    doType()
                })

                doType();

            })
        </script>
    @endpush
