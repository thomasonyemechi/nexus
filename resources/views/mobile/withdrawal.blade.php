@extends('layouts.app')


@section('page_title')
    Buy Nexus Token
@endsection

@php
    $price = coinTotalPurchase(auth()->user()->id);
@endphp

@section('page_content')
    <style>
        .step-item {
            display: flex;
            align-items: start;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .step-item i {
            font-size: 1.25rem;
            color: #d4af37;
            margin-top: 2px;
        }


        .bottom-toolbar {
            display: none;
        }
    </style>


    <div class="page__content page__content--with-header page__content--with-bottom-nav">
        <h2 class="page__title">Funds Withdrawal</h2>
        <div class="fieldset">
            <div class="form">

                <div class="fw-bold h4 fw-bold mb-3">
                    Max Withdrawal: <span class="plus-bold"> $ {{ number_format($usdt_balance, 2) }}</span>
                </div>



                <form id="withdraw" method="post" action="/mobile/withdrawal">
                    @csrf



                    <div class="form__row d-flex align-items-center justify-space">
                        <input type="number" inputmode="numeric" name="amount" value="" id="usdt"
                            class="form__input form__input--23" placeholder="Enter Amount" min="10"
                            max="{{ $usdt_balance }}">
                        <div class="form__coin-icon"><img src="{{ asset('assets/images/logos/tether.png') }}" alt=""
                                title=""><span>USDT</span></div>

                    </div>

                    @error('amount')
                        <span class="mt-0 minus " style="font-size: 10px"> {{ $message }} </span> <br>
                    @enderror

                    <span class="mt-0 minus " style="font-size: 10px">Withdrawal Range ($10 - $1,000)</span>



                </form>
            </div>
        </div>




        <h2 class="page__title">All Crypto Withdrawals</h2>


        @foreach ($withdrawals as $with)
            <a class="card-coin" href="#">
                <div class="card-coin__logo"><img src="{{ asset('assets/images/icons/swap.svg') }}" alt=""
                        title=""><span>

                        @if ($with->status == 'approved')
                            <span class="minus"> - {{ number_format($with->amount) }}</span> USDT
                        @else
                            <span class=""> {{ number_format($with->amount) }} </span> USDT
                        @endif



                        <b>
                            {{ formatDate($with->created_at) }}
                        </b>
                    </span></div>
                <div class=""><strong> {!! depositStatus($with->status) !!}</strong> </span>
                </div>
            </a>
        @endforeach

    </div>

    <div class="bottom-fixed-button">
        <button class="button button--full button--main open-popup withdraw">
            Withdraw USDT
        </button>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('#withdraw').on('submit', function() {
                $('.withdraw').attr('disabled', 'disabled');
                $('.withdraw').html(`
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `);
            })

            $('.withdraw').on('click', function() {
                $('#withdraw').submit();
            })




        })
    </script>
@endpush
