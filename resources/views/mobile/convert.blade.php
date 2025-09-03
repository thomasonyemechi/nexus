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
        <h2 class="page__title">Buy Nexus Token</h2>
        <div class="fieldset">
            <div class="form">

                <div class="fw-bold h4 fw-bold mb-3">
                    Max Prucahse: <span class="plus-bold"> $ {{ number_format($usdt_balance, 2) }}</span>
                </div>



                <form id="buypmc" method="post" action="/mobile/purchase-fiat">
                    @csrf
                    <div class="form__row d-flex align-items-center justify-space">
                        <input type="number" inputmode="numeric" name="usdt_amount" value="" id="usdt"
                            class="form__input form__input--23" placeholder="Enter Amount" min="50"
                            max="{{ $usdt_balance }}">
                        <div class="form__coin-icon"><img src="{{ asset('assets/images/logos/tether.png') }}" alt=""
                                title=""><span>USDT</span></div>

                    </div>

                    @error('usdt_amount')
                        <span class="mt-0 minus " style="font-size: 10px"> {{ $message }} </span> <br>
                    @enderror

                    <span class="mt-0 minus " style="font-size: 10px">Purchase Range ($30 - $10,0000)</span>

                    <div class="fw-bold h4 fw-bold mt-4 nxt" style="display: none">
                        You get: <span class="plus "> <span class="val"> 0.00 </span> NXT</span>
                    </div>


                </form>
            </div>
        </div>



        <div class="swiper-container slider-portfolio slider-portfolio--round-corners slider-init mb-40"
            data-paginationtype="progressbar" data-spacebetweenitems="10" data-itemsperview="auto">
            <div class="swiper-wrapper">
             
                <div class="swiper-slide slider-portfolio__slide slider-portfolio__slide--1h">
                    <div class="slider-portfolio__caption caption">
                        <div class="caption__content">
                            <a href="/mobile/royalty">

                                <h2 class="caption__title">
                                <img src="{{ asset('assets/images/crystal.png') }}" alt="">
                                    <span>CRYSTAL MEMEBR</span>
                                </h2>
                                <div class="caption__chart"><canvas class="chartup" width="100%" height="5"></canvas>
                                </div>
                                <div class="caption__info"><strong> $ {{ number_format(2000) }}</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
            <div class="swiper-pagination slider-portfolio__pagination"></div>

        </div>


        <h2 class="page__title">All Crypto Purchase</h2>


        @foreach ($purchases as $pur)
            <a class="card-coin" href="#">
                <div class="card-coin__logo"><img src="{{ asset('assets/images/icons/swap.svg') }}" alt=""
                        title=""><span>
                        <span class="plus"> {{ number_format($pur->amount * $pur->rate, 2) }}</span> NXT <b>
                            {{ formatDate($pur->created_at) }}
                        </b></span></div>
                <div class="card-coin__price"><strong>{{ $pur->rate }} NXT / 1 USDT</strong><span class="minus"> -
                        {{ $pur->amount }} USDT </span>
                </div>
            </a>
        @endforeach

    </div>

    <div class="bottom-fixed-button">
        <button class="button button--full button--main open-popup buypmcbtn">
            Buy Token
        </button>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('#buypmc').on('submit', function() {
                $('.buypmcbtn').attr('disabled', 'disabled');
                $('.buypmcbtn').html(`
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `);
            })

            $('.buypmcbtn').on('click', function() {
                $('#buypmc').submit();
            })


            const formatter = new Intl.NumberFormat('en-US', {
                style: 'decimal', // or 'currency'
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });



            $('#usdt').on('keyup', function() {
                usdt = $('#usdt');

                amt_usdt = parseInt(usdt.val());
                $.ajax({
                    method: 'get',
                    url: '/get_price'
                }).done(function(res) {
                    price = amt_usdt * res.price

                    price = (price == NaN) ? 0 : price;

                    section = $('.nxt');
                    section.show();
                    if (!price) {
                        price = 0;
                    }

                    section.find('.val').html(formatter.format(price));

                }).fail(function(res) {
                    console.log(res);
                })
            })

        })
    </script>
@endpush
