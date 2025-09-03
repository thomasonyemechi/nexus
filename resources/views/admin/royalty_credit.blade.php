@extends('layouts.admin02')
@section('page_content')
    <div class="container-fluid content-inner pb-0">
        <div class="row mb-4">
            <div class="col-lg-12">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between ">
                            <h4 class="card-title text-white">Credit Royal Members</h4>
                            <div class="form-outline">
                                {{-- <div class="d-flex justify-content-between ">
                                    <input type="number" id="royalty-input" step="0.01" class="form-control mx-4"
                                        style="width: 150px ;" placeholder="e.g 10%">
                                    <button class="btn btn-sm btn-primary" id="calculate-btn">Set Percent</button>
                                </div> --}}
                            </div>
                        </div>

                        {{-- <form method="post" id="royalty-form"> --}}

                        @csrf

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <th>Wallet Address</th>
                                            <th>Purchases</th>
                                            <th>Total <br> Ctystals</th>
                                            <th> {{ date('M',time()) }}  <br> Payouts</th>

                                            <th class="text-end">Action</th>
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

                                        @php
                                            $tt = 0;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr class="royal_row">
                                                <td> <a class=" fw-bold text-white  " href="#">
                                                        <span>{{ putwallet($user->wallet) }} </span> </a>
                                                </td>
                                                <td>

                                                    @php
                                                        $total_royal = 0;
                                                        foreach (royalPurchase($user->id) as $purchase) {
                                                            $total_royal += $purchase->amount;
                                                            echo '$ ' . number_format($purchase->amount) . ', ';
                                                        }

                                                        $tt += $total_royal;
                                                    @endphp
                                                </td>

                                                <td>
                                                    {{ number_format($total_royal) }}
                                                </td>


                                                <td>
                                                    $ {{ number_format(monthlyReward($user->id, now())) }}
                                                </td>

                                                <td>
                                                    <input type="hidden" name="user_id[]" value="{{ $user->id }}">
                                                    <input type="hidden" name="royal_percent[]"
                                                        value="{{ $total_royal }}">

                                                    <input type="hidden" name="total_royal" value="{{ $total_royal }}">




                                                    {{-- <input type="number" step="0.01" class="form-control "
                                                            name="royal_percent_main[]" style="width: 100px ;" readonly> --}}

                                                    <form action="/admin/users/distribute_single" method="post">
                                                        @csrf
                                                        <div class="d-flex justify-content-end ">


                                                            <input type="hidden" name="user_id" value="{{ $user->id }}"
                                                                id="">
                                                            <input type="number" step="0.01" name="amount"
                                                                class="form-control mx-4" style="width: 150px ;"
                                                                placeholder="Amount ">
                                                            <button class="btn btn-sm btn-primary"
                                                                type="submit">Credit</button>
                                                        </div>


                                                    </form>


                                                </td>

                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                            </td>

                                            <td>
                                                <span class="fw-bold"> $ {{ number_format($tt) }} </span>
                                            </td>

                                            <td>
                                            </td>

                                            <td>
                                                {{-- <span class="tt_royal"></span> --}}
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                {{-- <div class="d-flex justify-content-end flex-wrap">
                                        <button class="btn btn-success  btn-main" id="submit-btn">Credit All
                                            Royalty</button>
                                    </div> --}}

                            </div>
                        </div>
                        {{-- </form> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        // $('#calculate-btn').on('click', function() {
        //     // let totalRoyal = 0;
        //     let royaltyPercent = parseFloat($('#royalty-input').val()) / 100;
        //     tt = 0
        //     $('.royal_row').each(function() {

        //         let total = parseFloat($(this).find('input[name="total_royal"]').val());
        //         let userPercent = total * royaltyPercent;
        //         $(this).find('input[name="royal_percent_main[]"]').val(royaltyPercent);
        //         $(this).find('.total_royal').html(`$ ${userPercent}`);
        //         tt += parseFloat(userPercent);


        //     });


        //     $('.tt_royal').html(tt);
        // });


        $('#submit-btn').on('click', function(e) {
            e.preventDefault();

            let formData = $('#royalty-form').serialize();




            $.ajax({
                url: '/admin/users/distribute',
                method: 'POST',
                data: formData,
                success: function(response) {

                    console.log(response);

                    alert('Royalty distributed successfully!');

                    window.location.href = "/admin/dashboard"
                    // Optional: reload or show a success message
                },
                error: function(xhr) {
                    alert('Something went wrong while submitting!');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endpush
